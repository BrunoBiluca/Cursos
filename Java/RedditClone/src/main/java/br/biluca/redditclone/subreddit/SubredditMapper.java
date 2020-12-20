package br.biluca.redditclone.subreddit;

import br.biluca.redditclone.auth.models.User;
import lombok.experimental.UtilityClass;

import java.time.Instant;

@UtilityClass
public class SubredditMapper {
    public static SubredditDTO toSubredditDTO(Subreddit subreddit){
        return SubredditDTO.builder()
            .id(subreddit.getId())
            .name(subreddit.getName())
            .description(subreddit.getDescription())
            .postCount(subreddit.getPosts().size())
            .build();
    }

    public static Subreddit toSubreddit(SubredditDTO subredditDTO, User user){
        return Subreddit.builder()
            .name(subredditDTO.getName())
            .description(subredditDTO.getDescription())
            .createdDate(Instant.now())
            .user(user)
            .build();
    }
}
