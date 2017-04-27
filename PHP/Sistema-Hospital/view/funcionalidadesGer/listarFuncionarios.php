<?php
    if (!isset($_SESSION)) session_start();

    if (!empty($_POST)) {
        include("../../controle/dbAcesso.php");
        $db = new dbAcesso;

        $db->conecta();

        $ordem = $_POST['ordem'];
        $alinha = $_POST['alinhamento'];

        if($ordem == 0){
            $tipo = "nome";
        }else if($ordem == 1){
            $tipo = "salario";
        }else if($ordem == 2){
            $tipo = "dataIngresso";
        }else{
            $tipo = "";
        }
        
        if($alinha == 0){
            $alinhamento = "ASC";
        }else if($ordem == 1){
            $alinhamento = "DESC";
        }else{
            $alinhamento = "";
        }

        $sql = "SELECT nome,salario,dataIngresso FROM Medicos
                UNION ALL
                SELECT nome,salario,dataIngresso FROM Enfermeiros
                UNION ALL
                SELECT nome,salario,dataIngresso FROM Administradores
                UNION ALL
                SELECT nome,salario,dataIngresso FROM Gerentes ORDER BY $tipo $alinhamento";
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
    </head>
    <body>
        <?php 
            include("../cabecalho.php");
            $cab = new cabecalho;
        
            $cab->setTipoUsuario($_SESSION['UsuarioTipo']);
            $cab->mostrarCabecalho();
        ?>
        
        <form name="form1" method="POST" action="listarFuncionarios.php">
            <b>Ordenar por:</b><br><br>
            <input name="ordem" type="radio" value="0">Nome<br>
            <input name="ordem" type="radio" value="1">Salário<br>
            <input name="ordem" type="radio" value="2">Data de Ingresso<br>
            <b>De que forma:</b><br><br>
            <input name="alinhamento" type="radio" value="0">Ascendente<br>
            <input name="alinhamento" type="radio" value="1">Descrescente<br>
            <input type="submit" value="Enviar">
        </form>      
        <?php
        if($total > 0) { 
            // inicia o loop que vai mostrar todos os dados 
            do {
        ?>
        <p><?=$linha['nome']?> / <?=$linha['salario']?> / <?=$linha['dataIngresso']?></p>
        <?php 
            // finaliza o loop que vai mostrar os dados 
            }while($linha = mysql_fetch_assoc($dados));
            // fim do if 
            }
        ?>

    </body>
</html>