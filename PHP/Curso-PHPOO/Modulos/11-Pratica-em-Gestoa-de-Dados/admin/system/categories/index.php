<div class="content cat_list">

    <section>

        <h1>Categorias:</h1>

        <?php
        //Verifica o valor empty pelo metodo GET
        $empty = filter_input(INPUT_GET, 'empty', FILTER_VALIDATE_BOOLEAN);
        if ($empty) {
            WSErro("Você tentou editar um categoria que não existe no sistema!", WS_INFOR);
        }

        $deleteCat = filter_input(INPUT_GET, 'delete', FILTER_VALIDATE_INT);
        if ($deleteCat) {
            require '_models/AdminCategory.class.php';
            $deletar = new AdminCategory();
            $deletar->executaDelete($deleteCat);

            WSErro($deletar->GetError()[0], $deletar->GetError()[1]);
        }

        $readSes = new Read();
        $readSes->ExeRead("ws_categories", "WHERE category_parent IS NULL ORDER BY category_title ASC");

        if (!$readSes->getResult()):
            WSErro("Nenhuma categoria está cadastrada no sistema!", WS_INFOR);
        else:
            //Seções
            foreach ($readSes->getResult() as $secao):
                extract($secao);

                $readPosts = new Read();
                $readPosts->ExeRead("ws_posts", "WHERE post_cat_parent = :parent", "parent={$category_id}");

                $readCats = new Read();
                $readCats->ExeRead("ws_categories", "WHERE category_parent = :parent", "parent={$category_id}");


                $numPosts = $readPosts->getRowCount();
                $numCats = $readCats->getRowCount();
                ?>
                <section>
                    <header>
                        <h1><?= $category_title ?>  <span>( <?= $numPosts ?> posts ) ( <?= $numCats ?> Categorias )</span></h1>
                        <p class="tagline"><?= $category_content ?></p>

                        <ul class="info post_actions">
                            <li><strong>Data:</strong> <?= date('d/m/Y H:i', strtotime($category_date)); ?>Hs</li>
                            <li><a class="act_view" target="_blank" href="painel.php?exe=categories/<?= $category_name ?>" title="Ver no site">Ver no site</a></li>
                            <li><a class="act_edit" href="painel.php?exe=categories/update&catId=<?= $category_id ?>" title="Editar">Editar</a></li>
                            <li><a class="act_delete" href="painel.php?exe=categories/index&delete=<?= $category_id ?>" title="Excluir">Deletar</a></li>
                        </ul>
                    </header>

                    <h2>Sub categorias de vídeo aulas:</h2>

                    <?php
                    $a = 0;
                    if (!$readCats->getResult()):
                        WSErro("Nenhuma categoria foi cadastrada para esta seção!", WS_INFOR);
                    else:
                        //Categorias das seções ou subcategorias
                        foreach ($readCats->getResult() as $cat):
                            $a++;

                            $readCatPosts = new Read();
                            $readCatPosts->ExeRead("ws_posts", "WHERE post_category = :parent", "parent={$cat['category_id']}");
                            $numPostSubCat = $readCatPosts->getRowCount();
                            ?>
                            <article<?php if ($a % 3 == 0) echo ' class="right"'; ?>>
                                <h1><a target="_blank" href="painel.php?exe=categories/<?= $cat['category_name'] ?>" title="Ver Categoria"><?= $cat['category_title'] ?></a>  ( <?= $numPostSubCat ?> posts )</h1>

                                <ul class="info post_actions">
                                    <li><strong>Data:</strong> <?= date('d/m/Y H:i', strtotime($cat['category_date'])); ?>Hs</li>
                                    <li><a class="act_view" target="_blank" href="painel.php?exe=categories/<?= $cat['category_name'] ?>" title="Ver no site">Ver no site</a></li>
                                    <li><a class="act_edit" href="painel.php?exe=categories/update&catId=<?= $cat['category_id'] ?>" title="Editar">Editar</a></li>
                                    <li><a class="act_delete" href="painel.php?exe=categories/index&delete=<?= $cat['category_id'] ?>" title="Excluir">Deletar</a></li>
                                </ul>
                            </article>
                            <?php
                        endforeach;
                    endif;
                    ?>

                </section>
                <?php
            endforeach;
        endif;
        ?>

        <div class="clear"></div>
    </section>

    <div class="clear"></div>
</div> <!-- content home -->