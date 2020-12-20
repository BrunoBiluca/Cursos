package br.biluca.redditclone.auth;

import br.biluca.foundation.exceptions.SpringRedditException;
import br.biluca.foundation.security.JwtProvider;
import br.biluca.redditclone.auth.dto.AuthenticationResponse;
import br.biluca.redditclone.auth.dto.LoginRequest;
import br.biluca.redditclone.auth.dto.RegisterRequest;
import br.biluca.redditclone.models.User;
import br.biluca.redditclone.models.VerificationToken;
import br.biluca.redditclone.repositories.UserRepository;
import br.biluca.redditclone.repositories.VerificationTokenRepository;
import lombok.AllArgsConstructor;
import lombok.extern.slf4j.Slf4j;
import org.springframework.security.authentication.AuthenticationManager;
import org.springframework.security.authentication.UsernamePasswordAuthenticationToken;
import org.springframework.security.core.context.SecurityContextHolder;
import org.springframework.security.core.userdetails.UsernameNotFoundException;
import org.springframework.security.crypto.password.PasswordEncoder;
import org.springframework.stereotype.Service;
import org.springframework.transaction.annotation.Transactional;

import java.time.Instant;
import java.util.UUID;


@Service
@AllArgsConstructor
@Slf4j
public class AuthService {

    private final AuthenticationManager authenticationManager;
    private final AuthMailService authMailService;
    private final JwtProvider jwtProvider;
    private final PasswordEncoder passwordEncoder;
    private final UserRepository userRepository;
    private final VerificationTokenRepository verificationTokenRepository;

    @Transactional
    public void signup(RegisterRequest registerRequest) {
        var user = new User()
            .setUsername(registerRequest.getUsername())
            .setEmail(registerRequest.getEmail())
            .setPassword(passwordEncoder.encode(registerRequest.getPassword()))
            .setCreated(Instant.now())
            .setEnabled(false);

        userRepository.save(user);

        var token = UUID.randomUUID().toString();
        var verificationToken = new VerificationToken()
            .setToken(token)
            .setUser(user);

        verificationTokenRepository.save(verificationToken);
        log.info("Registration Successful, Sending Activation Email");

        authMailService.sendActivationEmail(user, token);
    }

    public void verifyAccount(String token) {
        var verificationToken = verificationTokenRepository.findByToken(token)
            .orElseThrow(() -> new SpringRedditException("Invalid Token"));

        fetchUserAndEnable(verificationToken);
    }

    private void fetchUserAndEnable(VerificationToken token){
        var userName = token.getUser().getUsername();
        var user = userRepository.findByUsername(userName)
            .orElseThrow(() -> new SpringRedditException("User not found with id - " + userName));

        user.setEnabled(true);
        userRepository.save(user);
    }

    public AuthenticationResponse login(LoginRequest request) {
        var authentication = authenticationManager
            .authenticate(new UsernamePasswordAuthenticationToken(
                request.getUsername(), request.getPassword()
            ));

        SecurityContextHolder.getContext().setAuthentication(authentication);
        return new AuthenticationResponse(
            jwtProvider.generateToken(authentication),
            request.getUsername()
        );
    }

    @Transactional(readOnly = true)
    public User getCurrentUser() {
        var principal = (org.springframework.security.core.userdetails.User)
            SecurityContextHolder.getContext().getAuthentication().getPrincipal();

        var username = principal.getUsername();
        return userRepository.findByUsername(username)
            .orElseThrow(() -> new UsernameNotFoundException("User not found for username: " + username));
    }
}
