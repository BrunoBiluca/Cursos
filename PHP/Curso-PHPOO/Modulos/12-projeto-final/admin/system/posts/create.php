<div class="content form_create">

    <article>

        <header>
            <h1>Atualizar Post:</h1>
        </header>

        <?php
        $post = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if(isset($post) && $post['SendPostForm']){
            $post['post_status'] = ($post['SendPostForm'] == 'Atualizar' ? '0' : '1');
            $post['post_cover'] = ($_FILES['post_cover']['tmp_name'] ? $_FILES['post_cover'] : null);
            unset($post['SendPostForm']);
            
            require '_models/AdminPosts.class.php';
            $cadastrar = new AdminPosts();
            $cadastrar->ExecutaCreate($post);

            if($cadastrar->getResult()){
                if(!empty($_FILES['gallery_covers']['tmp_name'])){
                    $sendGallery = new AdminPosts();
                    $sendGallery->SendGallery($_FILES['gallery_covers'], $cadastrar->getResult());
                }
                
                header("Location: painel.php?exe=posts/update&create=true&postId=" . $cadastrar->getResult());
            }else{
                WSErro($cadastrar->getError()[0], $cadastrar->getError()[1]);
            }
        }
        ?>


        <form name="PostForm" action="" method="post" enctype="multipart/form-data">

            <label class="label">
                <span class="field">Enviar Capa:</span>
                <input type="file" name="post_cover" />
            </label>

            <label class="label">
                <span class="field">Titulo:</span>
                <input type="text" name="post_title" value="<?php if (isset($post['post_title'])) echo $post['post_title']; ?>" />
            </label>

            <label class="label">
                <span class="field">Conteúdo:</span>
                <textarea class="js_editor" name="post_content" rows="10"><?php if (isset($post['post_content'])) echo htmlspecialchars($post['post_content']); ?></textarea>
            </label>

            <div class="label_line">

                <label class="label_small">
                    <span class="field">Data:</span>
                    <input type="text" class="formDate center" name="post_date" value="<?php if (isset($post['post_date'])): echo $post['post_date']; else: echo date("d/m/Y H:i:s"); endif; ?>" />
                </label>

                <label class="label_small">
                    <span class="field">Categoria:</span>
                    <select name="post_category">
                        <option value=""> Selecione a categoria: </option>
                        <?php
                        $readSes = new Read();
                        $readSes->ExeRead("ws_categories", "WHERE category_parent IS NULL ORDER BY category_title ASC");

                        if ($readSes->getRowCount() >= 1):
                            foreach ($readSes->getResult() as $ses):
                                echo "<option disabled=\"disabled\" value=\"\"> {$ses['category_title']} </option>";
                                $readCat = new Read();
                                $readCat->ExeRead("ws_categories", "WHERE category_parent = :parent ORDER BY category_title ASC", "parent={$ses['category_id']}");
                                if ($readCat->getRowCount() >= 1):
                                    foreach ($readCat->getResult() as $cat):
                                        echo "<option ";
                                        if ($post['post_category'] == $cat['category_id']):
                                            echo "selected=selected ";
                                        endif;
                                        echo "value=\"{$cat['category_id']}\"> &raquo&raquo {$cat['category_title']} </option>";
                                    endforeach;
                                endif;
                            endforeach;
                        endif;
                        ?>
                    </select>
                </label>

                <label class="label_small">
                    <span class="field">Author:</span>
                    <select name="post_author">
                        <option value="<?= "{$_SESSION['userlogin']['user_id']}"; ?>"> <?= "{$_SESSION['userlogin']['user_name']} {$_SESSION['userlogin']['user_lastname']}"; ?> </option>
                        <?php
                        $readAut = new Read();
                        $readAut->ExeRead("ws_users", "WHERE user_id != :loginId ORDER BY user_name ASC", "loginId={$_SESSION['userlogin']['user_id']}");
                        if ($readAut->getRowCount() >= 1) {
                            foreach ($readAut->getResult() as $aut) {
                                echo "<option ";
                                if($post['post_author'] == $aut['user_id']):
                                    echo "selected=selected ";
                                endif;
                                echo "value=\"{$aut['user_id']}\"> {$aut['user_name']} </option>";
                            }
                        }
                        ?>
                    </select>
                </label>

            </div><!--/line-->

            <div class="label gbform">

                <label class="label">             
                    <span class="field">Enviar Galeria:</span>
                    <input type="file" multiple name="gallery_covers[]" />
                </label>               
            </div>

            <input type="submit" class="btn blue" value="Atualizar" name="SendPostForm" />
            <input type="submit" class="btn green" value="Atualizar & Publicar" name="SendPostForm" />

        </form>

    </article>

    <div class="clear"></div>
</div> <!-- content home -->