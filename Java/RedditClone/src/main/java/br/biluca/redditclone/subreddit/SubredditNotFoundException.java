package br.biluca.redditclone.subreddit;

public class SubredditNotFoundException extends RuntimeException {
    public SubredditNotFoundException(Long id) {
        super("Subreddit not found for id: " + id.toString());
    }

    public SubredditNotFoundException(String name) {
        super("Subreddit not found for name: " + name);
    }

}
