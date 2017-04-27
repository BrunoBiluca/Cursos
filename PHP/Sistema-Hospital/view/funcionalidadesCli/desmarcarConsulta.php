<?php
    // A sessão precisa ser iniciada em cada página diferente
    if (!isset($_SESSION)) session_start();
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Sistema do Hospital de TownsVille</title>
    </head>
    <body>
         <?php 
            include("../cabecalho.php");
            $cab = new cabecalho;
        
            $cab->setTipoUsuario($_SESSION['UsuarioTipo']);
            $cab->mostrarCabecalho();
        ?>
        <form action="desmarcarConsulta.php" method="post">
        <table width="500px" align="center">
        <tr>    <!Login>
        <td width="400px">
            <b>Entre com o número da consulta a ser desmarcada:</b>
        </td>
        <td>
            <input type="text" name="id">
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
    </body>
</html>

<?php

    if (!empty($_POST)) {

        include("../../controle/dbAcesso.php");
        $db = new dbAcesso;

        $db->conecta();

        $id = mysql_real_escape_string($_POST['id'], $db->conecta);

        $deletar="DELETE FROM Consultas WHERE id = '$id'";
        if (!mysql_query($deletar, $db->conecta)) {
          die('Error: ' . mysql_error($db->conecta));
        }    
        echo "A consulta foi desmarcada com sucesso!";
        
        $db->desconecta();
    }
?>