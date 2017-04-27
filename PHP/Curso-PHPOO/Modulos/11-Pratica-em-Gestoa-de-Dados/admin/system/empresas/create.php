<div class="content form_create">

    <article>

        <header>
            <h1>Cadastrar Empresa:</h1>
        </header>

        <?php
            $post = filter_input_array(INPUT_POST, FILTER_DEFAULT);
            
            if(isset($post["SendPostForm"])){
                $post['empresa_status'] = ($post["SendPostForm"] == "Cadastrar" ? '0' : '1');
                unset($post["SendPostForm"]);
                $post['empresa_capa'] = ($_FILES['empresa_capa']['tmp_name'] ? $_FILES['empresa_capa'] : '');
                $post['empresa_date'] = date("Y/m/d H:i:s");
                
                require '_models/AdminEmpresa.class.php';
                
                $cadastrar = new AdminEmpresa();
                $cadastrar->ExecutaCreate($post);
                
                if(!$cadastrar->getResult()){
                    WSErro($cadastrar->getError()[0], $cadastrar->getError()[1]);
                }else{
                    header("Location: painel.php?exe=empresas/update&create=true&empID={$cadastrar->getResult()}");
                }
            }
        
        ?>


        <form name="PostForm" action="" method="post" enctype="multipart/form-data">

            <label class="label">
                <span class="field">Logo da empresa: <sup>Exatamente 578x288px (JPG ou PNG)</sup></span>
                <input type="file" name="empresa_capa" />
            </label>

            <label class="label">
                <span class="field">Nome da Empresa:</span>
                <input type="text" name="empresa_title" value="<?php if(isset($post['empresa_title'])) echo $post['empresa_title']; ?>"/>
            </label>

            <label class="label">
                <span class="field">Ramo de atividade:</span>
                <input type="text" name="empresa_ramo" value="<?php if(isset($post['empresa_ramo'])) echo $post['empresa_ramo']; ?>"/>
            </label>

           <div class="label_line">
                <label class="label_medium">
                    <span class="field">Site da Empresa:</span>
                    <input type="url" pattern="https?://.+" placeholder="http://www.exemplo.com.br" name="empresa_site" value="<?php if(isset($post['empresa_site'])) echo $post['empresa_site']; ?>" />
                </label>

                <label class="label_medium">
                    <span class="field">Facebook Page:</span>
                    <input type="text" name="empresa_facebook" value="<?php if(isset($post['empresa_facebook'])) echo $post['empresa_facebook']; ?>" />
                </label>                
            </div><!-- line -->
            
            <label class="label">
                <span class="field">Sobre a empresa:</span>
                <textarea name="empresa_sobre" rows="3"><?php if(isset($post['empresa_sobre'])) echo $post['empresa_sobre']; ?></textarea>
            </label>

            <label class="label">
                <span class="field">Nome da rua / Número:</span>
                <input type="text" name="empresa_endereco" value="<?php if(isset($post['empresa_endereco'])) echo $post['empresa_endereco']; ?>"/>
            </label>

            <div class="label_line">

                <label class="label_small">
                    <span class="field">Estado UF:</span>
                    <select class="j_loadstate" name="empresa_uf">
                        <option value="" disabled selected> Selecione o estado </option>
                        <?php
                        $readState = new Read;
                        $readState->ExeRead("app_estados", "ORDER BY estado_nome ASC");
                        foreach ($readState->getResult() as $estado):
                            extract($estado);
                            echo "<option value=\"{$estado_id}\" ";
                            if(isset($post['empresa_uf']) && $estado_id == $post['empresa_uf']) echo 'selected="selected"';
                            echo "> {$estado_uf} / {$estado_nome} </option>";
                        endforeach;
                        ?>                        
                    </select>
                </label>

                <label class="label_small">
                    <span class="field">Cidade:</span>
                    <select class="j_loadcity" name="empresa_cidade">
                        <?php if (!isset($post['empresa_cidade'])): ?>
                            <option value="" selected disabled> Selecione antes um estado </option>
                            <?php
                        else:
                            $City = new Read;
                            $City->ExeRead("app_cidades", "WHERE estado_id = :uf ORDER BY cidade_nome ASC", "uf={$post['empresa_uf']}");
                            if ($City->getRowCount()):
                                foreach ($City->getResult() as $cidade):
                                    extract($cidade);
                                    echo "<option value=\"{$cidade_id}\" ";
                                    if (isset($data['empresa_cidade']) && $post['empresa_cidade'] == $cidade_id):
                                        echo "selected";
                                    endif;
                                    echo "> {$cidade_nome} </option>";
                                endforeach;
                            endif;
                        endif;
                        ?>
                    </select>
                </label>


                <label class="label_small">
                    <span class="field">Indicação:</span>
                    <select name="empresa_categoria">
                        <option value="" disabled selected> Indique a empresa como </option>
                        <option value="onde-comer" <?php if(isset($post['empresa_categoria']) && $post['empresa_categoria'] == "onde-comer") echo 'selected="selected"'; ?>> Onde Comer </option>
                        <option value="onde-ficar" <?php if(isset($post['empresa_categoria']) && $post['empresa_categoria'] == "onde-ficar") echo 'selected="selected"'; ?>> Onde Ficar </option>
                        <option value="onde-comprar" <?php if(isset($post['empresa_categoria']) && $post['empresa_categoria'] == "onde-comprar") echo 'selected="selected"'; ?>> Onde Comprar </option>
                        <option value="onde-se-divertir" <?php if(isset($post['empresa_categoria']) && $post['empresa_categoria'] == "onde-se-divertir") echo 'selected="selected"'; ?>> Onde se Divertir </option>
                    </select>
                </label>

            </div><!--/line-->


            <div class="gbform"></div>

            <input type="submit" class="btn blue" value="Cadastrar" name="SendPostForm" />
            <input type="submit" class="btn green" value="Cadastrar & Publicar" name="SendPostForm" />

        </form>

    </article>

    <div class="clear"></div>
</div> <!-- content form- -->