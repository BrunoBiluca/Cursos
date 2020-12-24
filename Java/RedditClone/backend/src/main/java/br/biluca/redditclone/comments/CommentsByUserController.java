package br.biluca.redditclone.comments;

import lombok.AllArgsConstructor;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;

import java.util.List;

@RestController
@RequestMapping("/api/users/{username}/comments")
@AllArgsConstructor
public class CommentsByUserController {

    private final CommentService commentService;

    @GetMapping
    public ResponseEntity<List<CommentDTO>> getAll(@PathVariable String username){
        return ResponseEntity.ok().body(commentService.getByUsername(username));
    }

}
