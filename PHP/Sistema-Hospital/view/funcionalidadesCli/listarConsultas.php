<?php
    if (!isset($_SESSION)) session_start();

    include("../../controle/dbAcesso.php");
    $db = new dbAcesso;
    
    $db->conecta();

    $login = $_SESSION['UsuarioLogin'];
    
    $sql = "SELECT * FROM Consultas WHERE loginCliente = '".$login ."'";
    $dados = mysql_query($sql, $db->conecta);
    //Transforma os dados em um array
    $linha = mysql_fetch_assoc($dados);
    // calcula quantos dados retornaram
    $total = mysql_num_rows($dados);
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
        
        
        <?php
        if($total > 0) { 
            // inicia o loop que vai mostrar todos os dados 
            do {
        ?>
        
        <p> Número da consulta <?=$linha['id']?> <br>
            Você tem uma consulta marcado com <?=$linha['loginMedico']?> <br>
            No consultório <?=$linha['pConsultorio']?> <br>
            Na data <?=$linha['data']?></p>
        
        <?php 
            // finaliza o loop que vai mostrar os dados 
            }while($linha = mysql_fetch_assoc($dados));
            // fim do if 
            }
        ?>

    </body>
</html>