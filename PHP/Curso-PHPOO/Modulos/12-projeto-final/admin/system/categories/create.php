<?php
if (!class_exists('Login')) :
    header('Location: ../../painel.php');
    die;
endif;
?>

<div class="content form_create">

    <article>

        <header>
            <h1>Criar Categoria:</h1>
        </header>

        <?php
        
        $data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        
        if(!empty($data['SendPostForm'])){
            unset($data['SendPostForm']);
            
            require("_models/AdminCategory.class.php");
            
            $cadastra = new AdminCategory();
            $cadastra->ExecutaCreate($data);
            if(!$cadastra->GetResult()){
                WSErro($cadastra->GetError()[0], $cadastra->GetError()[1]);
            }else{
                header("Location: painel.php?exe=categories/update&create=true&catId=" . $cadastra->GetResult());
            }
        }
        ?>

        <form name="PostForm" action="" method="post" enctype="multipart/form-data">


            <label class="label">
                <span class="field">Titulo:</span>
                <input type="text" name="category_title" value="<?php if (isset($data)) echo $data['category_title']; ?>" />
            </label>

            <label class="label">
                <span class="field">Conteúdo:</span>
                <textarea name="category_content" rows="5"><?php if (isset($data)) echo $data['category_content']; ?></textarea>
            </label>

            <div class="label_line">

                <label class="label_small">
                    <span class="field">Data:</span>
                    <input type="text" class="formDate center" name="category_date" value="<?= date('d/m/Y H:i:s'); ?>" />
                </label>

                <label class="label_small left">
                    <span class="field">Seção:</span>
                    <select name="category_parent">
                        <option value="null"> Selecione a Seção: </option>
                        <?php
                            $readSes = new Read();
                            $readSes->ExeRead('ws_categories', "WHERE category_parent IS NULL ORDER BY category_title");
                            if(!$readSes->getResult()){
                                echo '<option disabled="disable" value="null"> Cadastre uma categoria antes! </option>';
                            }else{
                                foreach ($readSes->getResult() as $parent) {
                                    echo "<option value=\"{$parent['category_id']}\" ";
                                    
                                    if($parent['category_id'] == $data['category_parent']){ //para fazer a persistência de dados
                                        echo 'selected="selected"';
                                    }
                                    
                                    echo "> {$parent['category_title']} </option>";
                                }
                            }
                        ?>
                    </select>
                </label>
            </div>

            <div class="gbform"></div>

            <input type="submit" class="btn green" value="Cadastrar Categoria" name="SendPostForm" />
        </form>

    </article>

    <div class="clear"></div>
</div> <!-- content home -->