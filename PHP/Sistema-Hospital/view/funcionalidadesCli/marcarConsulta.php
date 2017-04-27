<?php
    if (!isset($_SESSION)) session_start();

    if (!empty($_POST)) {
        include("../../controle/dbAcesso.php");
        $db = new dbAcesso;

        $db->conecta();

        $especialidade = $_POST['especialidade'];

        $sql = "SELECT AM.* FROM AgendaMedico as AM INNER JOIN Medicos as Me on AM.login = Me.login
                WHERE Me.especialidade = '$especialidade'";
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
        <form action="marcarConsulta.php" method="post">
        <table width="500px" align="center">
        <tr>    <!Login>
        <td width="300px">
            <b>Entre com a especialidade desejada:</b>
        </td>
        <td>
            <input type="text" name="especialidade">
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
            echo "Lista de horário";
            // inicia o loop que vai mostrar todos os dados 
            do {
        ?>
        <p><?php if(isset($linha['login'])) {echo $linha['login'];}; ?> / <?=$linha['patrimonio']?> / <?=$linha['dataInicio']?> / <?=$linha['dataFim']?></p>
        <?php 
            // finaliza o loop que vai mostrar os dados 
            }while($linha = mysql_fetch_assoc($dados));
            // fim do if 
        }else{
            echo "Não foi encontrado nada";
        }
        ?>
        
        <form action="validacaoConsulta.php" method="post">
        <table width="500px" align="center">
        <tr> 
        <td width="300px">
            <b>Entre com login do médico:</b>
        </td>
        <td>
            <input type="text" name="login">
        </td>
        </tr>
        <tr> 
        <td width="300px">
            <b>Entre a data e hora desejada:</b>
        </td>
        <td>
            <input type="text" name="data" onkeypress="mascara(this, '####-##-## ##:##:##')" maxlength="19">
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