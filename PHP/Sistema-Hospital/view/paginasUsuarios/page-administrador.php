<?php

    // A sessão precisa ser iniciada em cada página diferente
    if (!isset($_SESSION)) session_start();

    // Verifica se não há a variável da sessão que identifica o usuário
    $tipoUsuario = 0;
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
        
        <h1>Página Administrador</h1>
        <p>Olá, <?php echo $_SESSION['UsuarioLogin']; ?>!</p>
        <!-- Formulário de Login -->
        <br>
        <a href="../cadastro/cadastroFuncionario.php">Cadastrar funcionário</a>
        <br>
        <a href="../cadastro/cadastroLeito.php">Cadastrar Leito</a>
        <br>
        <a href="../cadastro/cadastroSalaCirurgia.php">Cadastrar Sala de cirurgia</a>
        <br>
        <a href="../cadastro/cadastroConsultorio.php">Cadastrar Consultório</a>
        <br>
        <a href="../delecao/deletarUsuario.php">Remover Usuários</a>        
        <br>
        <a href="../delecao/deletarLeito.php">Remover Leito</a>        
        <br>
        <a href="../delecao/deletarSalaCirurgia.php">Remover Sala de cirurgia</a>        
        <br>
        <a href="../delecao/deletarConsultorio.php">Remover Consultório</a>
        <br>
        <a href="../funcionalidadesAdm/alocacaoMedicoConsultorio.php">Alocar Médicos</a>
        <br>
        <a href="../funcionalidadesAdm/alocacaoEnfermeiro.php">Alocar Enfermeiros</a>
        <br>
        <a href="../../controle/logout.php">Logout</a>
    </body>
</html>

