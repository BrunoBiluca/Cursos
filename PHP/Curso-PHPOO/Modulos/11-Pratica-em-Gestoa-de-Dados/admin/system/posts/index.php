<div class="content list_content">

    <section>

        <h1>Posts:</h1>

        <?php
        $empty = filter_input(INPUT_GET, "empty", FILTER_VALIDATE_BOOLEAN);
        if($empty){
            WSErro("Oppsssss, você tentou acessar um post que não existe no sistema!", WS_ALERT);
        }
        
        $action = filter_input(INPUT_GET, "action", FILTER_DEFAULT);
        if($action){
            $postId = filter_input(INPUT_GET, "postId", FILTER_VALIDATE_INT);
            
            require_once '_models/AdminPosts.class.php';
            $postAction = new AdminPosts();

            switch ($action):
                case "ativar":
                    $postAction->SetPostStatus($postId, '1');
                    WSErro("Post atualizado para status <b>ativo</b>. O post agora foi publicado no site!", WS_ACCEPT);
                    break;
                case "inativar":
                    $postAction->SetPostStatus($postId, '0');
                    WSErro("Post atualizado para status <b>inativo</b>. O post agora é um rascunho!", WS_ALERT);
                    break;
                case "deletar":
                    $postAction->ExecutaDelete($postId);
                    WSErro($postAction->getError()[0], $postAction->getError()[1]);
                    break;                
            endswitch;
        }
        
        $i = 0; //Variável para manter a formatação da página

        $getPage = filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT);
        $pager = new Pager("painel.php?exe=posts/index&page=");
        $pager->ExePager($getPage, 2);

        $read = new Read();
        $read->ExeRead("ws_posts", "ORDER BY post_status ASC, post_date DESC LIMIT :limit OFFSET :offset", "limit={$pager->getLimit()}&offset={$pager->getOffset()}");
        if ($read->getResult()):
            foreach ($read->getResult() as $post) :
                $i++;
                extract($post);
                $status = (!$post_status ? 'style="background: #fffeb8"' : '');
                ?>
                <article<?php if ($i % 2 == 0) echo ' class="right" '; ?> <?= $status; ?>>

                    <div class="img thumb_small">
                        <?= Check::Image("../uploads/" . $post_cover, $post_name, 120, 70); ?>
                    </div>
                    <h1><a target="_blank" href="../artigo/<?= $post_name ?>" title="Ver Post"><?= $post_title ?></a></h1>
                    <ul class="info post_actions">
                        <li><strong>Data:</strong> <?= date('d/m/Y H:i', strtotime($post_date)); ?>Hs</li>
                        <li><a class="act_view" target="_blank" href="../artigo/<?= $post_name ?>" title="Ver no site">Ver no site</a></li>
                        <li><a class="act_edit" href="painel.php?exe=posts/update&postId=<?= $post_id ?>" title="Editar">Editar</a></li>
                        <?php if (!$post_status): ?>
                            <li><a class="act_inative" href="painel.php?exe=posts/index&postId=<?= $post_id ?>&action=ativar" title="Ativar">Ativar</a></li>
                        <?php else: ?>
                            <li><a class="act_ative" href="painel.php?exe=posts/index&postId=<?= $post_id ?>&action=inativar" title="Inativar">Ativar</a></li>
                        <?php endif; ?>
                        <li><a class="act_delete" href="painel.php?exe=posts/index&postId=<?= $post_id ?>&action=deletar" title="Excluir">Deletar</a></li>
                    </ul>

                </article>
                <?php
            endforeach;
        else:
            $pager->ReturnPage();
            WSErro("Não existem posts cadastrados ainda!", WS_INFOR);
        endif;
        ?>

        <div class="clear"></div>
    </section>

    <?php
        $pager->ExePaginator("ws_posts");
        echo $pager->getPaginator();
    ?>
    
    <div class="clear"></div>
</div> <!-- content home -->