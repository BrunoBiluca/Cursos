package br.biluca.redditclone.votes;

import br.biluca.redditclone.posts.models.Post;
import br.biluca.redditclone.auth.models.User;
import org.springframework.data.jpa.repository.JpaRepository;

import java.util.Optional;

public interface VoteRepository extends JpaRepository<Vote, Long> {
    Optional<Vote> findTopByPostAndUserOrderByVoteIdDesc(Post post, User currentUser);
}