<?php

    if (!empty($_POST) AND (empty($_POST['login']) OR empty($_POST['senha']))) {
        header("Location: ../../view/cadastro/cadastroFuncionario.php"); exit;
    }

    include("../dbAcesso.php");
    $db = new dbAcesso;
    
    $db->conecta();

    $tipoUsuario = mysql_real_escape_string($_POST['tipoUsuario'], $db->conecta);
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
    $salario = mysql_real_escape_string($_POST['salario'], $db->conecta);
    $dataIngresso = mysql_real_escape_string($_POST['dataIngresso'], $db->conecta);
    $especialidade = mysql_real_escape_string($_POST['especialidade'], $db->conecta);
    
    echo $dataIngresso;
    
    $inserirUsuario="INSERT INTO Usuarios(login, senha, tipoUsuario)
    VALUES ('$login', '$senha', '$tipoUsuario')";

    if (!mysql_query($inserirUsuario, $db->conecta)) {
      die('Error: ' . mysql_error($db->conecta));
    }
    
    if($tipoUsuario == '0'){
        $inserirFuncionario="INSERT INTO Administradores(cpf, nome, idade, sexo, rua, bairro, cidade, estado, numero, 
                               complemento, cep, telefoneR, celular, telefoneC, salario, dataIngresso, login)
                        VALUES ('$cpf', '$nome', '$idade', '$sexo', '$rua' , '$bairro', '$cidade', '$estado', '$numero',
                              '$complemento', '$cep', '$telefoneR', '$celular', '$telefoneC','$salario','$dataIngresso', '$login')";
    }else if($tipoUsuario == '2'){
        $inserirFuncionario="INSERT INTO Medicos(cpf, nome, idade, sexo, rua, bairro, cidade, estado, numero, 
                               complemento, cep, telefoneR, celular, telefoneC, especialidade, salario, dataIngresso, login)
                        VALUES ('$cpf', '$nome', '$idade', '$sexo', '$rua' , '$bairro', '$cidade', '$estado', '$numero',
                              '$complemento', '$cep', '$telefoneR', '$celular', '$telefoneC', '$especialidade','$salario','$dataIngresso', '$login')";
    }else if($tipoUsuario == '3'){
        $inserirFuncionario="INSERT INTO Enfermeiros(cpf, nome, idade, sexo, rua, bairro, cidade, estado, numero, 
                               complemento, cep, telefoneR, celular, telefoneC, salario, dataIngresso, login)
                        VALUES ('$cpf', '$nome', '$idade', '$sexo', '$rua' , '$bairro', '$cidade', '$estado', '$numero',
                              '$complemento', '$cep', '$telefoneR', '$celular', '$telefoneC','$salario','$dataIngresso', '$login')";
    }else if($tipoUsuario == '4'){
        $inserirFuncionario="INSERT INTO Gerentes(cpf, nome, idade, sexo, rua, bairro, cidade, estado, numero, 
                               complemento, cep, telefoneR, celular, telefoneC, salario, dataIngresso, login)
                        VALUES ('$cpf', '$nome', '$idade', '$sexo', '$rua' , '$bairro', '$cidade', '$estado', '$numero',
                              '$complemento', '$cep', '$telefoneR', '$celular', '$telefoneC', '$salario','$dataIngresso', '$login')";
    }
    
    if (!mysql_query($inserirFuncionario, $db->conecta)) {
      die('Error: ' . mysql_error($db->conecta));
    }
    echo "1 record added";

    $db->desconecta();
    
    header("Location: ../../view/paginasUsuarios/page-administrador.php"); 
    exit;
?>