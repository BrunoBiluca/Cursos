<?php

    if (!empty($_POST) AND (empty($_POST['patrimonio']) OR empty($_POST['manutencao'])
                                OR empty($_POST['tipo']) OR empty($_POST['local']))) {
        header("Location: ../../view/cadastro/cadastroLeito.php"); exit;
    }

    include("../dbAcesso.php");
    $db = new dbAcesso;
    
    $db->conecta();

    $patrimonio = mysql_real_escape_string($_POST['patrimonio'], $db->conecta);
    $manutencao = mysql_real_escape_string($_POST['manutencao'], $db->conecta);
    $tipo = mysql_real_escape_string($_POST['tipo'], $db->conecta);
    $local = mysql_real_escape_string($_POST['local'], $db->conecta);

    $inserirLeito="INSERT INTO Leitos(patrimonio, manutencao, tipo, local)
                      VALUES ('$patrimonio', '$manutencao', '$tipo', '$local')";
    
    if (!mysql_query($inserirLeito, $db->conecta)) {
      die('Error: ' . mysql_error($db->conecta));
    }
    echo "1 record added";
    
    header("Location: ../../view/paginasUsuarios/page-administrador.php"); 

    $db->desconecta();
?>