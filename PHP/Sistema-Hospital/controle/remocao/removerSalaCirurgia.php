<?php

    if (!empty($_POST) AND empty($_POST['patrimonio'])) {
        header("Location: ../../view/delecao/deletarSalaCirurgia.php"); exit;
    }

    include("../dbAcesso.php");
    $db = new dbAcesso;
    
    $db->conecta();

    $patrimonio = mysql_real_escape_string($_POST['patrimonio'], $db->conecta);
    
    $deletarUsuario="DELETE FROM SalaCirurgia WHERE patrimonio = '$patrimonio'";
    if (!mysql_query($deletarUsuario, $db->conecta)) {
      die('Error: ' . mysql_error($db->conecta));
    }    

    $db->desconecta();
    
    header("Location: ../../view/paginasUsuarios/page-administrador.php"); 
    exit;
?>