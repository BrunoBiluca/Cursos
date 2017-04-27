<div class="content form_create">

    <article>

        <?php extract($_SESSION['userlogin']); ?>

        <h1>Olá <?= "{$user_name} {$user_lastname}"; ?>, atualize seu perfíl!</h1>

        <?php
        $post = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if (isset($post['UserUpdate'])) {
            unset($post['UserUpdate']);

            require '_models/AdminUser.class.php';

            $read = new Read();
            $read->ExeRead("ws_users", "WHERE user_email = :e", "e={$user_email}");
            $userID = $read->getResult()[0]['user_id'];

            $atualizar = new AdminUser();
            $atualizar->ExecutaUpdate($userID, $post);

            WSErro($atualizar->getError()[0], $atualizar->getError()[1]);
        }
        ?>

        <form action = "" method = "post" name = "UserEditForm">

            <label class="label">
                <span class="field">Nome:</span>
                <input
                    type = "text"
                    name = "user_name"
                    value = "<?= $user_name; ?>"
                    title = "Informe seu primeiro nome"
                    required
                    />
            </label>

            <label class="label">
                <span class="field">Sobrenome:</span>
                <input
                    type = "text"
                    name = "user_lastname"
                    value = "<?= $user_lastname; ?>"
                    title = "Informe seu sobrenome"
                    required
                    />
            </label>

            <label class="label">
                <span class="field">E-mail:</span>
                <input
                    type = "email"
                    name = "user_email"
                    value = "<?= $user_email; ?>"
                    title = "Informe seu e-mail"
                    required
                    />
            </label>

            <div class="label_line">

                <label class="label_medium">
                    <span class="field">Senha:</span>
                    <input
                        type = "password"
                        name = "user_password"
                        value = "<?= $user_password; ?>"
                        title = "Informe sua senha [ de 6 a 12 caracteres! ]"
                        pattern = ".{6,12}"
                        required
                        />
                </label>


                <label class="label_medium">
                    <span class="field">Nível:</span>
                    <select name = "user_level" title = "Selecione o nível de usuário" required >
                        <option value = "">Selecione o Nível</option>
                        <option value = "1" <?php if ($user_level == 1) echo 'selected="selected"'; ?>>User</option>
                        <option value="2" <?php if ($user_level == 2) echo 'selected="selected"'; ?>>Editor</option>
                        <option value="3" <?php if ($user_level == 3) echo 'selected="selected"'; ?>>Admin</option>
                    </select>
                </label>

            </div>

            <input type="submit" name="UserUpdate" value="Atualizar Usuário" class="btn green" />

        </form>


    </article>

    <div class="clear"></div>
</div> <!-- content home -->