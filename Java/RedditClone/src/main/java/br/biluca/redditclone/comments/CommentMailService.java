package br.biluca.redditclone.comments;

import br.biluca.foundation.mail.MailContentBuilder;
import br.biluca.foundation.mail.MailService;
import br.biluca.foundation.mail.NotificationEmail;
import br.biluca.redditclone.posts.models.Post;
import lombok.AllArgsConstructor;
import org.springframework.stereotype.Service;

@Service
@AllArgsConstructor
public class CommentMailService {

    private final MailContentBuilder mailContentBuilder;
    private final MailService mailService;

    public void sendNotificationEmail(Post post, Comment comment){
        mailService.send(new NotificationEmail(
            "New comment on your post: " + post.getPostName(),
            post.getUser().getEmail(),
            mailContentBuilder.build(comment.getText())
        ));
    }
}
