package br.biluca.redditclone.auth.dto;

import lombok.AllArgsConstructor;
import lombok.Data;
import lombok.experimental.Accessors;

@Data
@Accessors(chain = true)
@AllArgsConstructor
public class AuthenticationResponse {
    private String authenticationToken;
    private String username;
}
