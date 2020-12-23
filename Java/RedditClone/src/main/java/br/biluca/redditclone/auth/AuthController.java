package br.biluca.redditclone.auth;

import br.biluca.redditclone.auth.dto.AuthenticationResponse;
import br.biluca.redditclone.auth.dto.LoginRequest;
import br.biluca.redditclone.auth.dto.RefreshTokenRequest;
import br.biluca.redditclone.auth.dto.RegisterRequest;
import lombok.AllArgsConstructor;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

import javax.validation.Valid;

import static org.springframework.http.HttpStatus.CREATED;
import static org.springframework.http.HttpStatus.OK;

@RestController
@RequestMapping("/api/auth")
@AllArgsConstructor
public class AuthController {

    private final AuthService authService;
    private final RefreshTokenService refreshTokenService;

    @PostMapping("/signup")
    public ResponseEntity<String> signup(@RequestBody RegisterRequest registerRequest){
        authService.signup(registerRequest);
        return new ResponseEntity<>("User successfully created", CREATED);
    }

    @PostMapping("/login")
    public AuthenticationResponse login(@RequestBody LoginRequest request){
        return authService.login(request);
    }

    @GetMapping("/accountVerification/{token}")
    public ResponseEntity<String> verifyAccount(@PathVariable String token){
        authService.verifyAccount(token);
        return new ResponseEntity<>("Account Activated Successfully", OK);
    }

    @PostMapping("/refresh/token")
    public AuthenticationResponse refreshToken(@RequestBody @Valid RefreshTokenRequest request){
        return authService.refreshToken(request);
    }

    @PostMapping("/logout")
    public ResponseEntity<String> logout(@Valid @RequestBody RefreshTokenRequest refreshTokenRequest){
        refreshTokenService.deleteRefreshToken(refreshTokenRequest.getRefreshToken());
        return ResponseEntity.ok("Refresh token deleted successfully!!");
    }

}
