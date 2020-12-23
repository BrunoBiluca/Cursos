package br.biluca.foundation.security;

import br.biluca.foundation.exceptions.SpringRedditException;
import io.jsonwebtoken.Jwts;
import lombok.Getter;
import org.springframework.beans.factory.annotation.Value;
import org.springframework.security.core.Authentication;
import org.springframework.security.core.userdetails.User;
import org.springframework.stereotype.Service;

import javax.annotation.PostConstruct;
import java.io.IOException;
import java.security.*;
import java.security.cert.CertificateException;
import java.time.Instant;

import static io.jsonwebtoken.Jwts.parser;
import static java.util.Date.from;

@Service
public class JwtProvider {

    private KeyStore keyStore;

    @Getter
    @Value("${jwt.expiration.time}")
    private Long jwtExpirationTimeInMillis;

    @PostConstruct
    public void init(){
        try {
            var keyResource = getClass().getResourceAsStream("/springblog.jks");
            keyStore = KeyStore.getInstance("JKS");
            keyStore.load(keyResource, "secret".toCharArray());
        } catch (KeyStoreException | CertificateException | NoSuchAlgorithmException | IOException e) {
            throw new SpringRedditException("Exception occurred while loading keystore");
        }
    }

    public String generateToken(Authentication authentication) {
        var principal = (User) authentication.getPrincipal();
        return generateToken(principal.getUsername());
    }

    public String generateToken(String username) {
        return Jwts.builder()
            .setSubject(username)
            .setIssuedAt(from(Instant.now()))
            .signWith(getPrivateKey())
            .setExpiration(from(Instant.now().plusMillis(jwtExpirationTimeInMillis)))
            .compact();
    }

    public boolean validateToken(String jwt) {
        parser().setSigningKey(getPublicKey()).parseClaimsJws(jwt);
        return true;
    }

    public String getUsernameFromJWT(String jwt) {
        return parser()
            .setSigningKey(getPublicKey())
            .parseClaimsJws(jwt)
            .getBody()
            .getSubject();
    }

    private PrivateKey getPrivateKey() {
        try {
            return (PrivateKey) keyStore.getKey("springblog", "secret".toCharArray());
        } catch (KeyStoreException | NoSuchAlgorithmException | UnrecoverableKeyException e) {
            throw new SpringRedditException("Exception occurred while retrieving public key from keystore");
        }
    }

    private PublicKey getPublicKey(){
        try {
            return keyStore.getCertificate("springblog").getPublicKey();
        } catch (KeyStoreException e) {
            throw new SpringRedditException("Exception occurred while retrieving public key from keystore");
        }
    }
}
