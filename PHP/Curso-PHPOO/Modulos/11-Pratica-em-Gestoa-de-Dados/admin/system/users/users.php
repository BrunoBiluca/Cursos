<div class="content form_create">

    <article>

        <?php extract($_SESSION['userlogin']); ?>

        <h1>Usuários: <a href="painel.php?exe=users/create" title="Cadastrar Novo" class="user_cad">Cadastrar Usuário</a></h1>

        <?php
        $delID = filter_input(INPUT_GET, 'delID', FILTER_VALIDATE_INT);
        if (isset($delID)) {
            require '_models/AdminUser.class.php';

            $remover = new AdminUser();
            $remover->ExecutaDelete($delID);
            
            WSErro($remover->getError()[0], $remover->getError()[1]);
        }
        ?>

        <ul class="ultable">

            <?php
            $readUsers = new Read();
            $readUsers->ExeRead("ws_users", "ORDER BY user_level DESC, user_name DESC");
            ?>

            <li class="t_title">
                <span class="ui center">Res:</span>
                <span class="un">Nome:</span>
                <span class="ue">E-mail:</span>
                <span class="ur center">Registro:</span>
                <span class="ua center">Atualização:</span>
                <span class="ul center">Nível:</span>
                <span class="ed center">-</span>
            </li>

            <?php
            if ($readUsers->getResult()):
                $u = 0;
                foreach ($readUsers->getResult() as $user) :
                    $u++;
                    ?>            
                    <li>
                        <span class="ui center"><?= $u; ?></span>
                        <span class="un"><?= $user['user_name'] ?></span>
                        <span class="ue"><?= $user['user_email'] ?></span>
                        <span class="ur center"><?= date("d/m/Y", strtotime($user['user_registration'])) ?></span>
                        <span class="ua center"><?= date("d/m/Y", strtotime($user['user_lastupdate'])) ?>Hs</span>
                        <span class="ul center"><?php echo ($user["user_level"] == 3 ? 'Admin' : ($user['user_level'] == 2 ? 'Editor' : 'User')); ?></span>
                        <span class="ed center">
                            <a href="painel.php?exe=users/profile" title="Editar" class="action user_edit">Editar</a>
                            <a href="painel.php?exe=users/users&delID=<?= $user['user_id'] ?>" title="Deletar" class="action user_dele">Deletar</a>
                        </span>
                    </li>
                    <?php
                endforeach;
            else:

            endif;
            ?>

        </ul>


    </article>

    <div class="clear"></div>
</div> <!-- content home -->