package br.biluca.foundation.mail;

import lombok.AllArgsConstructor;
import org.springframework.stereotype.Service;
import org.thymeleaf.TemplateEngine;
import org.thymeleaf.context.Context;

@Service
@AllArgsConstructor
public class MailContentBuilder {
    private final TemplateEngine templateEngine;

    public String build(String message){
        var emailContext = new Context();
        emailContext.setVariable("message", message);
        return templateEngine.process("mailTemplate", emailContext);
    }
}
