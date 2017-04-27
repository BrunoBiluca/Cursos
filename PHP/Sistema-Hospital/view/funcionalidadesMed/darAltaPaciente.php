<?php
    if (!isset($_SESSION)) session_start();
    if (empty($_SESSION['erro'])){
        $_SESSION['erro'] = "";
    }
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Sistema do Hospital de TownsVille</title>
        <script language="JavaScript" type="text/javascript" src="../mascaraValidacao.js"></script> 
    </head>
    <body>
         <?php 
            include("../cabecalho.php");
            $cab = new cabecalho;
        
            $cab->setTipoUsuario($_SESSION['UsuarioTipo']);
            $cab->mostrarCabecalho();
        ?>
        <form action="validacaoAltaCliente.php" method="post">
        <table width="500px" align="center">
        <tr>
        <td width="400px">
            <b>Entre com o cliente que receberá alta:</b>
        </td>
        <td>
            <input type="text" name="loginCliente">
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
            echo $_SESSION['erro'];
            $_SESSION['erro'] = "";
        ?>
        
    </body>
</html>