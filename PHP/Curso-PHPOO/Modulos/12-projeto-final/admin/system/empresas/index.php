<div class="content list_content">

    <section class="list_emp">

        <h1>Empresas:</h1>      

        <?php
        $empty = filter_input(INPUT_GET, "empty", FILTER_VALIDATE_BOOLEAN);
        if ($empty) {
            WSErro("Você tentou editar uma empresa que não existe no sistema!", WS_ALERT);
        }

        $action = filter_input(INPUT_GET, "action", FILTER_DEFAULT);
        if ($action) {
            $empID = filter_input(INPUT_GET, "empID", FILTER_VALIDATE_INT);

            require_once '_models/AdminEmpresa.class.php';
            $empresaAction = new AdminEmpresa();

            switch ($action) {
                case "ativar":
                    $empresaAction->SetEmpresaStatus($empID, '1');
                    WSErro("Empresa atualizada para status <b>ativa</b>. A empresa agora foi publicado no site!", WS_ACCEPT);
                    break;
                case "inativar":
                    $empresaAction->SetEmpresaStatus($empID, '0');
                    WSErro("Empresa atualizada para status <b>inativa</b>. A empresa agora é um rascunho!", WS_ACCEPT);
                    break;
                case "deletar":
                    $empresaAction->ExecutaDelete($empID);
                    WSErro($empresaAction->getError()[0], $empresaAction->getError()[1]);
                    break;
            }
        }

        $getPage = filter_input(INPUT_GET, "page", FILTER_VALIDATE_INT);
        $pager = new Pager("painel.php?exe=empresas/index&page=");
        $pager->ExePager($getPage, 4);

        $empresas = new Read();
        $empresas->ExeRead('app_empresas', "ORDER BY empresa_status ASC, empresa_date DESC LIMIT :limit OFFSET :offset", "limit={$pager->getLimit()}&offset={$pager->getOffset()}");
        if ($empresas->getResult()):
            $i = 0;
            foreach ($empresas->getResult() as $empresa):
                $i++;
                extract($empresa);

                $cidade = "";
                $read = new Read();
                $read->ExeRead('app_cidades', "WHERE cidade_id = :id", "id={$empresa_cidade}");
                $cidade .= $read->getResult()[0]['cidade_nome'];
                $read->ExeRead('app_estados', "WHERE estado_id = :id", "id={$empresa_uf}");
                $cidade .= "/" . $read->getResult()[0]['estado_nome'];
                $status = (!$empresa_status ? 'style="background: #fffeb8"' : '');
                ?>
                <article<?php if ($i % 2 == 0) echo ' class="right"'; ?> <?= $status ?>>
                    <header>
                        <div class="img thumb_emp">
                            <?= Check::Image("../uploads/empresas/" . $empresa_capa, $empresa_title, 120, 70); ?>
                        </div>
                        <hgroup>
                            <h1><a target="_blank" href="../artigo/<?= $empresa_name ?>" title="Ver Post"><?= $empresa_title ?></a></h1>
                            <h2><a target="_blank" href="../filtrarcidade" title="Ver Post"><?= $cidade ?></a></h2>
                        </hgroup>
                    </header>
                    <ul class="info post_actions">
                        <li><strong>Data:</strong> <?= date('d/m/Y H:i', strtotime($empresa_date)); ?>Hs</li>
                        <li><a class="act_view" target="_blank" href="painel.php?exe=empresas/post&empID=<?= $empresa_id ?>" title="Ver no site">Ver no site</a></li>
                        <li><a class="act_edit" href="painel.php?exe=empresas/update&empID=<?= $empresa_id ?>" title="Editar">Editar</a></li>
                        <?php if (!$empresa_status): ?>
                            <li><a class="act_inative" href="painel.php?exe=empresas/index&empID=<?= $empresa_id ?>&action=ativar" title="Ativar">Ativar</a></li>
                        <?php else: ?>
                            <li><a class="act_ative" href="painel.php?exe=empresas/index&empID=<?= $empresa_id ?>&action=inativar" title="Inativar">Ativar</a></li>
                        <?php endif; ?>
                        <li><a class="act_delete" href="painel.php?exe=empresas/index&empID=<?= $empresa_id ?>&action=deletar" title="Excluir">Deletar</a></li>
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
        $pager->ExePaginator("app_empresas");
        echo $pager->getPaginator();
    ?>

    <div class="clear"></div>
</div> <!-- content home -->