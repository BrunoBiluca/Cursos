package br.biluca.redditclone.votes;

import br.biluca.foundation.exceptions.SpringRedditException;
import br.biluca.redditclone.auth.AuthService;
import br.biluca.redditclone.auth.models.User;
import br.biluca.redditclone.posts.PostNotFoundException;
import br.biluca.redditclone.posts.PostRepository;
import br.biluca.redditclone.posts.models.Post;
import lombok.AllArgsConstructor;
import org.springframework.stereotype.Service;

@Service
@AllArgsConstructor
public class VoteService {

    private final AuthService authService;
    private final PostRepository postRepository;
    private final VoteRepository voteRepository;

    public void vote(VoteDTO voteDTO) {
        var postId = voteDTO.getPostId();
        var post = postRepository.findById(postId)
            .orElseThrow(() -> new PostNotFoundException(postId));

        var vote = voteRepository.findTopByPostAndUserOrderByVoteIdDesc(post, authService.getCurrentUser());

        if(vote.isPresent() && vote.get().getVoteType().equals(voteDTO.getVoteType())){
            throw new SpringRedditException(
                "You already " + voteDTO.getVoteType() + " for this post."
            );
        }
        updateVoteCount(voteDTO, post);

        voteRepository.save(mapToVote(voteDTO, post, authService.getCurrentUser()));
        postRepository.save(post);
    }

    private void updateVoteCount(VoteDTO voteDTO, Post post) {
        var voteCount = post.getVoteCount() != null ? post.getVoteCount() : 0;
        if(voteDTO.getVoteType().equals(VoteType.UPVOTE)){
            voteCount += 1;
        }
        else if(voteDTO.getVoteType().equals(VoteType.DOWNVOTE)){
            voteCount -= 1;
        }
        post.setVoteCount(voteCount);
    }

    private Vote mapToVote(VoteDTO voteDTO, Post post, User currentUser) {
        return Vote.builder()
            .voteType(voteDTO.getVoteType())
            .user(currentUser)
            .post(post)
            .build();
    }
}
