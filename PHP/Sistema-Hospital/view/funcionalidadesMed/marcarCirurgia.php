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

        $sql = "SELECT Ci.* FROM Cirurgias as Ci INNER JOIN SalaCirurgia as Sa on Ci.pSala = Sa.patrimonio
                WHERE Sa.tipo = '$tipo'";
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
        <form action="marcarCirurgia.php" method="post">
        <table width="500px" align="center">
        <tr>    <!Login>
        <td width="300px">
            <b>Entre com o tipo de sala para cirurgia:</b>
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
            echo "Lista de horário ocupados para este tipo de sala:";
            // inicia o loop que vai mostrar todos os dados 
            do {
        ?>
        <p>A sala de cirurgia <?=$linha['pSala']?> está ocupada de <?=$linha['dataInicio']?> até <?=$linha['dataFim']?></p>
        <?php 
            // finaliza o loop que vai mostrar os dados 
            }while($linha = mysql_fetch_assoc($dados));
            // fim do if 
        }else{
            echo "Não foi encontrado nada";
        }
        ?>
        <form action="validacaoCirurgia.php" method="post">
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
            <b>Entre com login do enfermeiro Auxiliar 1:</b>
        </td>
        <td>
            <input type="text" name="loginEnfermeiro1">
        </td>
        <tr> 
        <td width="300px">
            <b>Entre com login do enfermeiro Auxiliar 2:</b>
        </td>
        <td>
            <input type="text" name="loginEnfermeiro2">
        </td>
        </tr>
        <tr> 
        <td width="300px">
            <b>Entre com login do enfermeiro Auxiliar 3:</b>
        </td>
        <td>
            <input type="text" name="loginEnfermeiro3">
        </td>
        </tr>
        <tr> 
        <td width="300px">
            <b>Entre o patrimonio da sala de cirurgia:</b>
        </td>
        <td>
            <input type="text" name="patrimonio">
        </td>
        </tr>
        <tr>
        <td width="300px">
            <b>Data e hora de início:</b>
        </td>
        <td>
            <input type="text" name="dataInicio" onkeypress="mascara(this, '####-##-## ##:##:##')" maxlength="19">
        </td>
        </tr>
        <tr>
        <td width="300px">
            <b>Data e hora de final:</b>
        </td>
        <td>
            <input type="text" name="dataFim" onkeypress="mascara(this, '####-##-## ##:##:##')" maxlength="19">
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