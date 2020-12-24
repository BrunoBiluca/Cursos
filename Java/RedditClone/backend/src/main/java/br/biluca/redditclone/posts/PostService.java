package br.biluca.redditclone.posts;


import br.biluca.redditclone.auth.AuthService;
import br.biluca.redditclone.auth.repositories.UserRepository;
import br.biluca.redditclone.posts.dto.PostRequest;
import br.biluca.redditclone.posts.dto.PostResponse;
import br.biluca.redditclone.subreddit.SubredditNotFoundException;
import br.biluca.redditclone.subreddit.SubredditRepository;
import lombok.AllArgsConstructor;
import org.springframework.security.core.userdetails.UsernameNotFoundException;
import org.springframework.stereotype.Service;

import java.util.List;
import java.util.stream.Collectors;

@Service
@AllArgsConstructor
public class PostService {

    private final AuthService authService;
    private final PostRepository postRepository;
    private final SubredditRepository subredditRepository;
    private final UserRepository userRepository;
    private final PostMapper postMapper;

    public List<PostResponse> getAll() {
        return postRepository
            .findAll()
            .stream()
            .map(postMapper::toPostResponse)
            .collect(Collectors.toList());
    }

    public PostResponse get(Long id) {
        return postRepository.findById(id)
            .map(postMapper::toPostResponse)
            .orElseThrow(() -> new PostNotFoundException(id));
    }

    public PostResponse save(PostRequest postRequest) {
        String subredditName = postRequest.getSubredditName();
        var subreddit = subredditRepository.findByName(subredditName)
            .orElseThrow(() -> new SubredditNotFoundException(subredditName));

        var post = postRepository.save(
            postMapper.toPost(postRequest, subreddit, authService.getCurrentUser())
        );

        post.setUrl("http://localhost:8080/api/posts/" + post.getPostId());
        postRepository.save(post);
        return postMapper.toPostResponse(post);
    }

    public List<PostResponse> getBySubredditId(Long subredditId) {
        var subreddit = subredditRepository.findById(subredditId)
            .orElseThrow(() -> new SubredditNotFoundException(subredditId));

        return postRepository.findAllBySubreddit(subreddit)
            .stream()
            .map(postMapper::toPostResponse)
            .collect(Collectors.toList());
    }

    public List<PostResponse> getByUserName(String username) {
        var user = userRepository.findByUsername(username)
            .orElseThrow(() -> new UsernameNotFoundException("User not found for username: " + username));

        return postRepository.findByUser(user)
            .stream()
            .map(postMapper::toPostResponse)
            .collect(Collectors.toList());
    }
}
