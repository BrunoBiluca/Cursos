<?php

    if (!empty($_POST) AND (empty($_POST['patrimonio']) OR empty($_POST['manutencao']) OR empty($_POST['local']))) {
        header("Location: ../../view/cadastro/cadastroConsultorio.php"); exit;
    }

    include("../dbAcesso.php");
    $db = new dbAcesso;
    
    $db->conecta();

    $patrimonio = mysql_real_escape_string($_POST['patrimonio'], $db->conecta);
    $manutencao = mysql_real_escape_string($_POST['manutencao'], $db->conecta);
    $local = mysql_real_escape_string($_POST['local'], $db->conecta);

    $inserirConsultorio="INSERT INTO Consultorios (patrimonio, manutencao, local)
                      VALUES ('$patrimonio', '$manutencao', '$local')";
    
    if (!mysql_query($inserirConsultorio, $db->conecta)) {
      die('Error: ' . mysql_error($db->conecta));
    }
    echo "1 record added";

    header("Location: ../../view/paginasUsuarios/page-administrador.php"); 
    
    $db->desconecta();
?>