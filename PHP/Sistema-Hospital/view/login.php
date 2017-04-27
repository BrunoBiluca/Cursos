<!DOCTYPE html>

<?php
    if (!isset($_SESSION)) session_start();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Sistema do Hospital de TownsVille</title>
    </head>
    <body>
        <?php 
            include("cabecalho.php");
            $cab = new cabecalho;
        
            $cab->setTipoUsuario($_SESSION['UsuarioTipo']);
            $cab->mostrarCabecalho();
        ?>
        <!-- Formulário de Login -->
        <form action="../controle/validacaoLogin.php" method="post">
        <fieldset>
        <legend>Dados de Login</legend>
            <label for="txUsuario">Usuário</label>
            <input type="text" name="login" id="txUsuario" maxlength="25" />
            <label for="txSenha">Senha</label>
            <input type="password" name="senha" id="txSenha" />

            <input type="submit" value="Entrar" />
        </fieldset>
        </form>
    </body>
</html>
