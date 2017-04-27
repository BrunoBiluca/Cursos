<?php
    if (!isset($_SESSION)) session_start();
    if (empty($_SESSION['erro'])){
        $_SESSION['erro'] = "";
    }


    if (!empty($_POST)) {
        include("../../controle/dbAcesso.php");
        $db = new dbAcesso;

        $db->conecta();

        $tipo = $_POST['tipo'];

        $sql = "SELECT Re.* FROM Recuperacao as Re INNER JOIN Leitos as Le on Re.pLeito = Le.patrimonio
                WHERE Le.tipo = '$tipo'";
        $dados = mysql_query($sql, $db->conecta);
        //Transforma os dados em um array
        $linha = mysql_fetch_assoc($dados);
        // calcula quantos dados retornaram
        $total = mysql_num_rows($dados);
    }
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Sistema do Hospital de TownsVille</title>
        <script language="JavaScript" type="text/javascript" src="../mascaraValidacao.js"></script> 
    </head>
    <body>
         <?php 
            include("../cabecalho.php");
            $cab = new cabecalho;
        
            $cab->setTipoUsuario($_SESSION['UsuarioTipo']);
            $cab->mostrarCabecalho();
        ?>
        <form action="marcarRecuperacao.php" method="post">
        <table width="500px" align="center">
        <tr>
        <td width="400px">
            <b>Entre com o tipo de leito que o paciente ficará internado:</b>
        </td>
        <td>
            <input type="text" name="tipo">
        </td>
        </tr>
        <tr>
            <td colspan="2">
            <input type="submit" value="Enviar">
            <input type="reset" value="Limpar">
            </td>
        </tr>
        </table>
        </form>

        <?php
        if($total > 0) { 
            echo "Lista de horário ocupados para este tipo de leito:";
            // inicia o loop que vai mostrar todos os dados 
            do {
        ?>
        <p>O leito <?=$linha['pLeito']?> está ocupada.</p>
        <?php 
            // finaliza o loop que vai mostrar os dados 
            }while($linha = mysql_fetch_assoc($dados));
            // fim do if 
        }else{
            echo "Não foi encontrado nada";
        }
        ?>
        <form action="validacaoRecuperacao.php" method="post">
        <table width="500px" align="center">
        <tr> 
        <td width="300px">
            <b>Entre com login do médico:</b>
        </td>
        <td>
            <input type="text" name="loginMedico">
        </td>
        <tr> 
        <td width="300px">
            <b>Entre com login do cliente:</b>
        </td>
        <td>
            <input type="text" name="loginCliente">
        </td>
        <tr> 
        <td width="300px">
            <b>Entre com login do enfermeiro:</b>
        </td>
        <td>
            <input type="text" name="loginEnfermeiro">
        </td>
        <tr> 
        <td width="300px">
            <b>Entre o patrimonio do leito:</b>
        </td>
        <td>
            <input type="text" name="patrimonio">
        </td>
        </tr>
        <tr> 
        <td width="300px">
            <b>Descrição da cirurgia:</b>
        </td>
        <td>
            <input type="text" name="descricao">
        </td>
        </tr>
        <tr>
            <td colspan="2">
            <input type="submit" value="Enviar">
            <input type="reset" value="Limpar">
            </td>
        </tr>
        </table>
        </form>
        
        <?php 
            echo $_SESSION['erro'];
            $_SESSION['erro'] = "";
        ?>
        
    </body>
</html>