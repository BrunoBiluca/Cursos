package br.biluca.foundation.mail;

import br.biluca.foundation.exceptions.SpringRedditException;
import lombok.AllArgsConstructor;
import lombok.extern.slf4j.Slf4j;
import org.springframework.mail.MailException;
import org.springframework.mail.javamail.JavaMailSender;
import org.springframework.mail.javamail.MimeMessageHelper;
import org.springframework.mail.javamail.MimeMessagePreparator;
import org.springframework.scheduling.annotation.Async;
import org.springframework.stereotype.Service;

@Service
@AllArgsConstructor
@Slf4j
public class MailService {

    private final JavaMailSender mailSender;
    private final MailContentBuilder mailContentBuilder;

    @Async
    public void send(NotificationEmail notificationEmail) {
        MimeMessagePreparator messagePreparator = mimeMessage -> new MimeMessageHelper(mimeMessage){{
            setFrom("springreddit@email.com");
            setTo(notificationEmail.getRecipient());
            setSubject(notificationEmail.getSubject());
            setText(mailContentBuilder.build(notificationEmail.getBody()));
        }};
        try {
            mailSender.send(messagePreparator);
            log.info("Activation email sent!!");
        } catch (MailException e) {
            throw new SpringRedditException(
                "Exception occurred when sending mail to " + notificationEmail.getRecipient()
            );
        }
    }

}