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
@RequestMapping("/api/users/{userName}/posts")
@AllArgsConstructor
public class PostByUserController {
    private final PostService postService;

    @GetMapping
    public ResponseEntity<List<PostResponse>> getAll(@PathVariable String userName){
        return ResponseEntity.ok().body(postService.getByUserName(userName));
    }
}
