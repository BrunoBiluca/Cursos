package br.biluca.redditclone.auth;

import br.biluca.foundation.mail.MailContentBuilder;
import br.biluca.foundation.mail.MailService;
import br.biluca.foundation.mail.NotificationEmail;
import br.biluca.redditclone.models.User;
import lombok.AllArgsConstructor;
import org.springframework.stereotype.Service;

@Service
@AllArgsConstructor
public class AuthMailService {
    public static final String ACTIVATION_EMAIL = "http://localhost:8080/api/auth/accountVerification";

    private final MailContentBuilder mailContentBuilder;
    private final MailService mailService;

    public void sendActivationEmail(User user, String token){
        String message = mailContentBuilder.build(
            "Thank you for signing up to Spring Reddit, "
                + "please click on the below url to activate your account : "
                + ACTIVATION_EMAIL + "/" + token
        );

        mailService.send(new NotificationEmail("Please Activate your account", user.getEmail(), message));
    }

}
