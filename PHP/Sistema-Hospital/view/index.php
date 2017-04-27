<!DOCTYPE html>

<?php
    if (!isset($_SESSION)) session_start();
    if (empty($_SESSION['UsuarioTipo'])){
        $_SESSION['UsuarioTipo'] = -1;
    }
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Sistema do Hospital de TownsVille</title>
    </head>
    <body>
        <?php 
            include("cabecalho.php");
            $cab = new cabecalho;
        
            $cab->setTipoUsuario($_SESSION['UsuarioTipo']);
            $cab->mostrarCabecalho();
        ?>
        
        
        <?php
        
            include("../controle/dbAcesso.php");
            $obj = new dbAcesso;
            
            $obj->conecta();
            echo "<br>";
            $obj->criaTabelaUsuarios();
            echo "<br>";
            $obj->criaTabelaClientes();
            echo "<br>";
            $obj->criaTabelaMedicos();
            echo "<br>";
            $obj->criaTabelaEnfermeiros();
            echo "<br>";
            $obj->criaTabelaAdms();
            echo "<br>";
            $obj->criaTabelaGerentes();
            echo "<br>";
            $obj->criaTabelaAgendaMedico();
            echo "<br>";
            $obj->criaTabelaAgendaEnfermeiro();
            echo "<br>";
            $obj->criaTabelaConsultas();
            echo "<br>";
            $obj->criaTabelaCirurgias();
            echo "<br>";
            $obj->criaTabelaConsultorios();
            echo "<br>";
            $obj->criaTabelaRecuperacao();
            echo "<br>";
            $obj->criaTabelaLeitos();
            echo "<br>";
            $obj->criaTabelaSalaCirurgia();
            echo "<br>";
            $obj->desconecta();
        ?>
    </body>
</html>
