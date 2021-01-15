package br.biluca.contactpage;

import org.springframework.data.repository.CrudRepository;

public interface ContactFormRepository extends CrudRepository<ContactForm, Long> {
}
