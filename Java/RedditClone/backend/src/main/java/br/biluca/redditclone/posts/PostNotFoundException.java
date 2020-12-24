package br.biluca.redditclone.posts;

public class PostNotFoundException extends RuntimeException{
    public PostNotFoundException(Long id) {
        super("Post not found for id: " + id);
    }
}
