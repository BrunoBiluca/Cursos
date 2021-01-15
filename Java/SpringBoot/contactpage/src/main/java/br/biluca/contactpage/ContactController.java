package br.biluca.contactpage;

import lombok.AllArgsConstructor;
import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.ModelAttribute;
import org.springframework.web.bind.annotation.PostMapping;

import java.time.Instant;

@Controller
@AllArgsConstructor
public class ContactController {

    private final ContactFormRepository contactFormRepository;

    @GetMapping("/")
    public String get(Model model){
        model.addAttribute("contactForm", new ContactForm());
        return "contact_form";
    }

    @PostMapping("/")
    public String post(@ModelAttribute ContactForm contactForm){
        contactForm.setCreatedAt(Instant.now());
        contactFormRepository.save(contactForm);
        return "contact_form_table";
    }

    @GetMapping("/contact-forms")
    public String getContactForms(Model model){
//        var contactForms = new ArrayList<ContactForm>(){{
//            add(new ContactForm().setName("Bruno"));
//            add(new ContactForm().setName("Bruno 2"));
//            add(new ContactForm().setName("Bruno 3"));
//        }};
//        model.addAttribute("contactForms", contactForms);
        model.addAttribute("contactForms", contactFormRepository.findAll());
        return "contact_form_table";
    }
}
