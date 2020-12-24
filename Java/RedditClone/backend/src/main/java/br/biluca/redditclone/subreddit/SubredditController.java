package br.biluca.redditclone.subreddit;


import lombok.AllArgsConstructor;
import org.springframework.web.bind.annotation.*;

import javax.validation.Valid;
import java.util.List;

@RestController
@RequestMapping("/api/subreddit")
@AllArgsConstructor
public class SubredditController {
    private final SubredditService subredditService;

    @GetMapping
    public List<SubredditDTO> getAll(){
        return subredditService.getAll();
    }

    @GetMapping("/{id}")
    public SubredditDTO get(@PathVariable Long id){
        return subredditService.get(id);
    }

    @PostMapping
    public SubredditDTO create(@RequestBody @Valid SubredditDTO subreddit){
        return subredditService.save(subreddit);
    }
}
