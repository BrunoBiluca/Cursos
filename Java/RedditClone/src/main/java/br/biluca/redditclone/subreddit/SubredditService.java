package br.biluca.redditclone.subreddit;

import br.biluca.redditclone.auth.AuthService;
import lombok.AllArgsConstructor;
import org.springframework.stereotype.Service;
import org.springframework.transaction.annotation.Transactional;

import java.util.List;
import java.util.stream.Collectors;

@Service
@AllArgsConstructor
public class SubredditService {

    private final SubredditRepository subredditRepository;
    private final AuthService authService;

    @Transactional(readOnly = true)
    public List<SubredditDTO> getAll() {
        return subredditRepository
            .findAll()
            .stream()
            .map(SubredditMapper::toSubredditDTO)
            .collect(Collectors.toList());
    }

    @Transactional
    public SubredditDTO get(Long id) {
        Subreddit subreddit = subredditRepository.findById(id)
            .orElseThrow(() -> new SubredditNotFoundException(id));

        return SubredditMapper.toSubredditDTO(subreddit);
    }

    public SubredditDTO save(SubredditDTO subredditDTO) {
        var subreddit = subredditRepository.save(
            SubredditMapper.toSubreddit(subredditDTO, authService.getCurrentUser())
        );
        return SubredditMapper.toSubredditDTO(subreddit);
    }
}
