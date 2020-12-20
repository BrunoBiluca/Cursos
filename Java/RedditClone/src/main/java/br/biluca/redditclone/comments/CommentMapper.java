package br.biluca.redditclone.comments;

import br.biluca.redditclone.auth.models.User;
import br.biluca.redditclone.posts.models.Post;
import lombok.experimental.UtilityClass;

import java.time.Instant;

@UtilityClass
public class CommentMapper {

    public Comment newEntity(CommentDTO commentDTO, Post post, User user){
        return Comment.builder()
            .createdDate(Instant.now())
            .text(commentDTO.getText())
            .post(post)
            .user(user)
            .build();
    }

    public CommentDTO toDTO(Comment comment){
        return CommentDTO.builder()
            .id(comment.getId())
            .createdDate(comment.getCreatedDate())
            .text(comment.getText())
            .postId(comment.getPost().getPostId())
            .userName(comment.getUser().getUsername())
            .build();
    }

}
