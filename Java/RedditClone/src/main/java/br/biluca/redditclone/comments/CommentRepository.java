package br.biluca.redditclone.comments;

import br.biluca.redditclone.auth.models.User;
import br.biluca.redditclone.posts.models.Post;
import org.springframework.data.jpa.repository.JpaRepository;

import java.util.List;

public interface CommentRepository extends JpaRepository<Comment, Long> {
    List<Comment> findByPost(Post post);

    List<Comment> findAllByUser(User user);
}