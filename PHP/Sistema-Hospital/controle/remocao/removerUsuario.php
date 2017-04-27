<?php

    if (!empty($_POST) AND empty($_POST['login'])) {
        header("Location: ../../view/delecao/deletarCliente.php"); exit;
    }

    include("../dbAcesso.php");
    $db = new dbAcesso;
    
    $db->conecta();

    $login = mysql_real_escape_string($_POST['login'], $db->conecta);
    
    $deletarUsuario="DELETE FROM Usuarios WHERE login = '$login'";
    if (!mysql_query($deletarUsuario, $db->conecta)) {
      die('Error: ' . mysql_error($db->conecta));
    }    

    $db->desconecta();
    
    header("Location: ../../view/paginasUsuarios/page-administrador.php"); 
    exit;
?>