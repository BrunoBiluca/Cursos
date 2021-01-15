package br.biluca.contactpage;

import lombok.AllArgsConstructor;
import lombok.Data;
import lombok.NoArgsConstructor;
import lombok.experimental.Accessors;

import javax.persistence.*;
import javax.validation.constraints.NotBlank;
import java.time.Instant;

@Data
@Entity
@Accessors(chain = true)
@AllArgsConstructor
@NoArgsConstructor
public class ContactForm {

    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private long Id;

    @NotBlank(message = "Name cannot be empty or Null")
    private String name;

    @NotBlank
    private String email;

    @NotBlank
    @Lob
    private String message;

    private Instant createdAt;

}
