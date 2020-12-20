package br.biluca.redditclone.comments;

import br.biluca.redditclone.auth.AuthService;
import br.biluca.redditclone.auth.repositories.UserRepository;
import br.biluca.redditclone.posts.PostNotFoundException;
import br.biluca.redditclone.posts.PostRepository;
import lombok.AllArgsConstructor;
import org.springframework.security.core.userdetails.UsernameNotFoundException;
import org.springframework.stereotype.Service;

import java.util.List;
import java.util.stream.Collectors;

@Service
@AllArgsConstructor
public class CommentService {
    private final AuthService authService;
    private final CommentRepository commentRepository;
    private final CommentMailService commentMailService;
    private final PostRepository postRepository;
    private final UserRepository userRepository;

    public CommentDTO save(CommentDTO commentDTO) {
        var postId = commentDTO.getPostId();
        var post = postRepository.findById(postId)
            .orElseThrow(() -> new PostNotFoundException(postId));

        var comment = commentRepository.save(
            CommentMapper.newEntity(commentDTO, post, authService.getCurrentUser())
        );

        commentMailService.sendNotificationEmail(post, comment);
        return CommentMapper.toDTO(comment);
    }

    public List<CommentDTO> getByUsername(String username) {
        var user = userRepository
            .findByUsername(username)
            .orElseThrow(() -> new UsernameNotFoundException("User not found for username: " + username));

        return commentRepository
            .findAllByUser(user)
            .stream()
            .map(CommentMapper::toDTO)
            .collect(Collectors.toList());
    }

    public List<CommentDTO> getByPostId(Long postId) {
        var post = postRepository.findById(postId)
            .orElseThrow(() -> new PostNotFoundException(postId));

        return commentRepository.findByPost(post)
            .stream()
            .map(CommentMapper::toDTO)
            .collect(Collectors.toList());
    }
}
