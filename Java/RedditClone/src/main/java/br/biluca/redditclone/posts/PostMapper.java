package br.biluca.redditclone.posts;

import br.biluca.redditclone.auth.models.User;
import br.biluca.redditclone.comments.CommentRepository;
import br.biluca.redditclone.posts.dto.PostRequest;
import br.biluca.redditclone.posts.dto.PostResponse;
import br.biluca.redditclone.posts.models.Post;
import br.biluca.redditclone.subreddit.Subreddit;
import com.github.marlonlom.utilities.timeago.TimeAgo;
import lombok.AllArgsConstructor;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import java.time.Instant;

@Service
@AllArgsConstructor
public class PostMapper {

    @Autowired
    private final CommentRepository commentRepository;

    public Post toPost(PostRequest postRequest, Subreddit subreddit, User user){
        return Post.builder()
            .postId(postRequest.getPostId())
            .postName(postRequest.getPostName())
            .description(postRequest.getDescription())
            .url(postRequest.getUrl())
            .createdDate(Instant.now())
            .subreddit(subreddit)
            .user(user)
            .voteCount(0)
            .build();
    }

    public PostResponse toPostResponse(Post post) {
        return PostResponse.builder()
            .id(post.getPostId())
            .postName(post.getPostName())
            .description(post.getDescription())
            .url(post.getUrl())
            .userName(post.getUser().getUsername())
            .subredditName(post.getSubreddit().getName())
            .duration(TimeAgo.Companion.using(post.getCreatedDate().toEpochMilli()))
            .commentCount(commentRepository.findByPost(post).size())
            .voteCount(post.getVoteCount() != null ? post.getVoteCount() : 0)
            .build();
    }

}
