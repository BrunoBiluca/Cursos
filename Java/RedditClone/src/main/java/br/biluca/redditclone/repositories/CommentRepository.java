package br.biluca.redditclone.repositories;

import br.biluca.redditclone.models.Comment;
import br.biluca.redditclone.models.Post;
import br.biluca.redditclone.models.User;
import org.springframework.data.jpa.repository.JpaRepository;

import java.util.List;

public interface CommentRepository extends JpaRepository<Comment, Long> {
    List<Comment> findByPost(Post post);

    List<Comment> findAllByUser(User user);
}