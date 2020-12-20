package br.biluca.redditclone.repositories;

import br.biluca.redditclone.models.Post;
import br.biluca.redditclone.subreddit.Subreddit;
import br.biluca.redditclone.models.User;
import org.springframework.data.jpa.repository.JpaRepository;

import java.util.List;

public interface PostRepository extends JpaRepository<Post, Long> {
    List<Post> findAllBySubreddit(Subreddit subreddit);

    List<Post> findByUser(User user);
}
