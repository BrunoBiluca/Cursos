package br.biluca.redditclone.posts.controllers;

import br.biluca.redditclone.posts.PostService;
import br.biluca.redditclone.posts.dto.PostResponse;
import lombok.AllArgsConstructor;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;

import java.util.List;

@RestController
@RequestMapping("/api/subreddit/{subredditId}/posts")
@AllArgsConstructor
public class PostBySubredditController {

    private final PostService postService;

    @GetMapping
    public ResponseEntity<List<PostResponse>> getAll(@PathVariable Long subredditId){
        return ResponseEntity.ok().body(postService.getBySubredditId(subredditId));
    }
}
