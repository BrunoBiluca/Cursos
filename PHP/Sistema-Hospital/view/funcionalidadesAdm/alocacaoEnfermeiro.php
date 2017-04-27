<?php
    if (!isset($_SESSION)) session_start();
?>

<html>
    <head>
        <meta charset="UTF-8">
        <script language="JavaScript" type="text/javascript" src="../mascaraValidacao.js"></script> 
        <title>Sistema do Hospital de TownsVille</title>
    </head>
    <body>
        <?php 
            include("../cabecalho.php");
            $cab = new cabecalho;
        
            $cab->setTipoUsuario($_SESSION['UsuarioTipo']);
            $cab->mostrarCabecalho();
        ?>
        <form action="validacaoEnfermeiro.php" method="post">
        <table width="100px" align="center">
        <tr>
        <td width="100px">
            <b>Login do Enfermeiro:</b>
        </td>
        <td>
            <input type="text" name="login">
        </td>
        </tr>
        <tr>
        <td width="300px">
            <b>Data e hora de início:</b>
        </td>
        <td>
            <input type="text" name="dataInicio" onkeypress="mascara(this, '####-##-## ##:##:##')" maxlength="19">
        </td>
        </tr>
        <tr>
        <td width="300px">
            <b>Data e hora de final:</b>
        </td>
        <td>
            <input type="text" name="dataFim" onkeypress="mascara(this, '####-##-## ##:##:##')" maxlength="19">
        </td>
        </tr>
        <tr>
            <td colspan="2">
            <input type="submit" value="Enviar">
            <input type="reset" value="Limpar">
            </td>
        </tr>
        </table>
        </form>
        <?php
            if (!empty($_SESSION['erro'])){
                echo $_SESSION['erro'];
            }
        ?>
        
        
    </body>
</html>