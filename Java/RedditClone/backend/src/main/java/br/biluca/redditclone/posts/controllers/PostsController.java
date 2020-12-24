package br.biluca.redditclone.posts.controllers;

import br.biluca.redditclone.posts.PostService;
import br.biluca.redditclone.posts.dto.PostRequest;
import br.biluca.redditclone.posts.dto.PostResponse;
import lombok.AllArgsConstructor;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

import javax.validation.Valid;
import java.util.List;

@RestController
@RequestMapping("/api/posts")
@AllArgsConstructor
public class PostsController {

    private final PostService postService;

    @GetMapping
    public ResponseEntity<List<PostResponse>> getAll(){
        return ResponseEntity.ok().body(postService.getAll());
    }

    @GetMapping("/{id}")
    public ResponseEntity<PostResponse> get(@PathVariable Long id){
        return ResponseEntity.ok().body(postService.get(id));
    }

    @PostMapping
    public ResponseEntity<PostResponse> create(@RequestBody @Valid PostRequest postRequest){
        return new ResponseEntity<>(postService.save(postRequest), HttpStatus.CREATED);
    }

}
