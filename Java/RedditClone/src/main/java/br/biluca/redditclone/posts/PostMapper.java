package br.biluca.redditclone.posts;

import br.biluca.redditclone.auth.models.User;
import br.biluca.redditclone.posts.dto.PostRequest;
import br.biluca.redditclone.posts.dto.PostResponse;
import br.biluca.redditclone.posts.models.Post;
import br.biluca.redditclone.subreddit.Subreddit;
import lombok.experimental.UtilityClass;

import java.time.Instant;

@UtilityClass
public class PostMapper {

    public static Post toPost(PostRequest postRequest, Subreddit subreddit, User user){
        return Post.builder()
            .postId(postRequest.getPostId())
            .postName(postRequest.getPostName())
            .description(postRequest.getDescription())
            .url(postRequest.getUrl())
            .createdDate(Instant.now())
            .subreddit(subreddit)
            .user(user)
            .build();
    }

    public static PostResponse toPostResponse(Post post) {
        return PostResponse.builder()
            .id(post.getPostId())
            .postName(post.getPostName())
            .description(post.getDescription())
            .url(post.getUrl())
            .userName(post.getUser().getUsername())
            .subredditName(post.getSubreddit().getName())
            .build();
    }

}
