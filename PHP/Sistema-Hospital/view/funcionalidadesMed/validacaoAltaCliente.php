<?php
    if (!isset($_SESSION)) session_start();

    if (!empty($_POST) AND empty($_POST['loginCliente'])) {
        header("Location: darAltaCliente.php"); exit;
    }

    include("../../controle/dbAcesso.php");
    $db = new dbAcesso;
    
    $db->conecta();

    $loginMedico = $_SESSION['UsuarioLogin'];
    $loginCliente = mysql_real_escape_string($_POST['loginCliente'], $db->conecta);
    //Verifica se o médico é 
    $sql = "SELECT * FROM Recuperacao WHERE (loginMedico = '$loginMedico') AND (loginCliente = '$loginCliente')";
    $dados = mysql_query($sql, $db->conecta);
    $total = mysql_num_rows($dados);
    
    if($total > 0){
        $deletarUsuario="DELETE FROM Recuperacao WHERE loginCliente = '$loginCliente'";
        if (!mysql_query($deletarUsuario, $db->conecta)) {
          die('Error: ' . mysql_error($db->conecta));
        }    
        $_SESSION['erro'] = "Foi dado alta com sucesso para o cliente";
        
        $db->desconecta();
        header("Location: darAltaPaciente.php"); exit;
    }else{
        $_SESSION['erro'] = "Você não é o médico para dar alta para esse cliente";
        header("Location: darAltaPaciente.php"); exit;
    }
?>