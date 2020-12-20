package br.biluca.redditclone.repositories;

import br.biluca.redditclone.models.Post;
import br.biluca.redditclone.models.User;
import br.biluca.redditclone.models.Vote;
import org.springframework.data.jpa.repository.JpaRepository;

import java.util.Optional;

public interface VoteRepository extends JpaRepository<Vote, Long> {
    Optional<Vote> findTopByPostAndUserOrderByVoteIdDesc(Post post, User currentUser);
}