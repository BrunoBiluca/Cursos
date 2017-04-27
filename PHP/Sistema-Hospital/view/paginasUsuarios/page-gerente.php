<?php

    // A sessão precisa ser iniciada em cada página diferente
    if (!isset($_SESSION)) session_start();

    // Verifica se não há a variável da sessão que identifica o usuário
    $tipoUsuario = 4;
    if ($_SESSION['UsuarioTipo'] != $tipoUsuario){
        // Destrói a sessão por segurança
        session_destroy();
        // Redireciona o visitante de volta pro login
        header("Location: ../view/index.php"); exit;
    }    
    
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
        <h1>Página Gerente</h1>
        <p>Olá, <?php echo $_SESSION['UsuarioLogin']; ?>!</p>

        <br>
        <a href="../funcionalidadesGer/listarFuncionarios.php">Relatório de funcionários</a>
        <br>
        <a href="../funcionalidadesGer/">Logout</a>
        <br>
        <a href="../funcionalidadesGer/">Logout</a>
        <br>
        <a href="../funcionalidadesGer/">Logout</a>        
        <br>
        <a href="../../controle/logout.php">Logout</a>
        
    </body>
</html>