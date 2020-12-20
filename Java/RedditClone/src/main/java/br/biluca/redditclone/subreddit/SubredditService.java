package br.biluca.redditclone.subreddit;

import br.biluca.redditclone.auth.AuthService;
import lombok.AllArgsConstructor;
import org.springframework.stereotype.Service;
import org.springframework.transaction.annotation.Transactional;

import java.time.Instant;
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
            .map(this::mapToSubredditDTO)
            .collect(Collectors.toList());
    }

    @Transactional
    public SubredditDTO get(Long id) {
        Subreddit subreddit = subredditRepository.findById(id)
            .orElseThrow(() -> new SubredditNotFoundException(id));

        return mapToSubredditDTO(subreddit);
    }

    public SubredditDTO save(SubredditDTO subredditDTO) {
        var subreddit = subredditRepository.save(mapToSubreddit(subredditDTO));
        return mapToSubredditDTO(subreddit);
    }

    private SubredditDTO mapToSubredditDTO(Subreddit subreddit){
        return SubredditDTO.builder()
            .id(subreddit.getId())
            .name(subreddit.getName())
            .description(subreddit.getDescription())
            .postCount(subreddit.getPosts().size())
            .build();
    }

    private Subreddit mapToSubreddit(SubredditDTO subredditDTO){
        return Subreddit.builder()
            .name("/r/" + subredditDTO.getName())
            .description(subredditDTO.getDescription())
            .createdDate(Instant.now())
            .user(authService.getCurrentUser())
            .build();
    }
}
