<div class="content form_create">

    <article>

        <?php extract($_SESSION['userlogin']); ?>

        <h1>Cadastrar Usuário!</h1>


        <?php
            $ClienteData = filter_input_array(INPUT_POST, FILTER_DEFAULT);
            if(isset($ClienteData['UserCreate'])){
                unset($ClienteData['UserCreate']);
                
                require '_models/AdminUser.class.php';
                
                $cadastrar = new AdminUser();
                $cadastrar->ExecutaCreate($ClienteData);
                

                WSErro($cadastrar->getError()[0], $cadastrar->getError()[1]);
            }
        ?>

        <form action = "" method = "post" name = "UserCreateForm">

            <label class="label">
                <span class="field">Nome:</span>
                <input
                    type = "text"
                    name = "user_name"
                    value="<?php if (!empty($ClienteData['user_name'])) echo $ClienteData['user_name']; ?>"
                    title = "Informe seu primeiro nome"
                    required
                    />
            </label>

            <label class="label">
                <span class="field">Sobrenome:</span>
                <input
                    type = "text"
                    name = "user_lastname"
                    value="<?php if (!empty($ClienteData['user_lastname'])) echo $ClienteData['user_lastname']; ?>"
                    title = "Informe seu sobrenome"
                    required
                    />
            </label>

            <label class="label">
                <span class="field">E-mail:</span>
                <input
                    type = "email"
                    name = "user_email"
                    value="<?php if (!empty($ClienteData['user_email'])) echo $ClienteData['user_email']; ?>"
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
                        value="<?php if (!empty($ClienteData['user_password'])) echo $ClienteData['user_password']; ?>"
                        title = "Informe sua senha [ de 6 a 12 caracteres! ]"
                        pattern = ".{6,12}"
                        required
                        />
                </label>


                <label class="label_medium">
                    <span class="field">Nível:</span>
                    <select name = "user_level" title = "Selecione o nível de usuário" required >
                        <option value = "">Selecione o Nível</option>
                        <option value = "1" <?php if (isset($ClienteData['user_level']) && $ClienteData['user_level'] == 1) echo 'selected="selected"'; ?>>User</option>
                        <option value="2" <?php if (isset($ClienteData['user_level']) && $ClienteData['user_level'] == 2) echo 'selected="selected"'; ?>>Editor</option>
                        <option value="3" <?php if (isset($ClienteData['user_level']) && $ClienteData['user_level'] == 3) echo 'selected="selected"'; ?>>Admin</option>
                    </select>
                </label>

            </div>

            <input type="submit" name="UserCreate" value="Cadastrar Usuário" class="btn green" />

        </form>


    </article>

    <div class="clear"></div>
</div> <!-- content home -->