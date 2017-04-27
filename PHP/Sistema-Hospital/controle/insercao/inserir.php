<?php

    if (!empty($_POST) AND (empty($_POST['login']) OR empty($_POST['senha']))) {
        header("Location: ../../view/cadastro/cadastro.php"); exit;
    }

    include("../dbAcesso.php");
    $db = new dbAcesso;
    
    $db->conecta();

    $login = mysql_real_escape_string($_POST['login'], $db->conecta);
    $senha = mysql_real_escape_string($_POST['senha'], $db->conecta);
    $cpf = mysql_real_escape_string($_POST['cpf'], $db->conecta);
    $nome = mysql_real_escape_string($_POST['nome'], $db->conecta);
    $idade = mysql_real_escape_string($_POST['idade'], $db->conecta);
    $sexo = mysql_real_escape_string($_POST['sexo'], $db->conecta);
    $rua = mysql_real_escape_string($_POST['rua'], $db->conecta);
    $numero = mysql_real_escape_string($_POST['numero'], $db->conecta);
    $bairro = mysql_real_escape_string($_POST['bairro'], $db->conecta);
    $complemento = mysql_real_escape_string($_POST['complemento'], $db->conecta);
    $cidade = mysql_real_escape_string($_POST['cidade'], $db->conecta);
    $estado = mysql_real_escape_string($_POST['estado'], $db->conecta);
    $cep = mysql_real_escape_string($_POST['cep'], $db->conecta);
    $telefoneR = mysql_real_escape_string($_POST['telefoneR'], $db->conecta);
    $celular = mysql_real_escape_string($_POST['celular'], $db->conecta);
    $telefoneC = mysql_real_escape_string($_POST['telefoneC'], $db->conecta);
    
    $inserirUsuario="INSERT INTO Usuarios(login, senha, tipoUsuario)
    VALUES ('$login', '$senha', '1')";

    if (!mysql_query($inserirUsuario, $db->conecta)) {
      die('Error: ' . mysql_error($db->conecta));
    }
    $inserirCliente="INSERT INTO Clientes(cpf, nome, idade, sexo, rua, bairro, cidade, estado, numero, 
                               complemento, cep, telefoneR, celular, telefoneC, login)
                      VALUES ('$cpf', '$nome', '$idade', '$sexo', '$rua' , '$bairro', '$cidade', '$estado', '$numero',
                              '$complemento', '$cep', '$telefoneR', '$celular', '$telefoneC', '$login')";
    
    if (!mysql_query($inserirCliente, $db->conecta)) {
      die('Error: ' . mysql_error($db->conecta));
    }
    echo "1 record added";

    header("Location: ../../view/index.php"); 
    
    $db->desconecta();
?>