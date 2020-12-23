package br.biluca.redditclone.auth;

import br.biluca.foundation.exceptions.SpringRedditException;
import br.biluca.redditclone.auth.dto.RefreshTokenRequest;
import br.biluca.redditclone.auth.models.RefreshToken;
import br.biluca.redditclone.auth.repositories.RefreshTokenRepository;
import lombok.AllArgsConstructor;
import org.springframework.stereotype.Service;
import org.springframework.transaction.annotation.Transactional;

import java.time.Instant;
import java.util.UUID;

@Service
@AllArgsConstructor
@Transactional
public class RefreshTokenService {

    private final RefreshTokenRepository refreshTokenRepository;

    public RefreshToken generateRefreshToken() {
        RefreshToken refreshToken = new RefreshToken();
        refreshToken.setToken(UUID.randomUUID().toString());
        refreshToken.setCreatedDate(Instant.now());

        return refreshTokenRepository.save(refreshToken);
    }

    public void deleteRefreshToken(String token) {
        refreshTokenRepository.deleteByToken(token);
    }

    public void validateRefreshToken(RefreshTokenRequest refreshToken) {
        refreshTokenRepository
            .findByToken(refreshToken.getRefreshToken())
            .orElseThrow(() -> new SpringRedditException("Invalid refresh token"));
    }
}
