<?php
    if (!isset($_SESSION)) session_start();

    if (!empty($_POST)) {
        include("../../controle/dbAcesso.php");
        $db = new dbAcesso;

        $db->conecta();

        $loginMedico = mysql_real_escape_string($_POST['loginMedico'],$db->conecta);
        $loginCliente = mysql_real_escape_string($_POST['loginCliente'],$db->conecta);
        $loginEnfermeiro = mysql_real_escape_string($_POST['loginEnfermeiro'],$db->conecta);
        $pLeito = mysql_real_escape_string($_POST['patrimonio'],$db->conecta);
        $descricao = mysql_real_escape_string($_POST['descricao'],$db->conecta);

        //Verifica se o enfermeiro tem horário disponível
        $sql = "SELECT * FROM AgendaEnfermeiro as AE WHERE (AE.login = '$loginMedico') AND (AE.dataInicio < '$dataInicio')
                AND (AE.dataFim > '$dataInicio')";
        $dados = mysql_query($sql, $db->conecta);
        $linha = mysql_fetch_assoc($dados);
        // calcula quantos dados retornaram
        $total = mysql_num_rows($dados);
        //Total é maior do que 0 se o médico está disponível
        if($total > 0){        
        
            //Verifica se o leito está sendo usado
            $sql = "SELECT Re.* FROM Recuperacao as Re INNER JOIN Leitos as Le on Re.pLeito = Le.patrimonio";
            $dados = mysql_query($sql, $db->conecta);
            $linha = mysql_fetch_assoc($dados);
            // calcula quantos dados retornaram
            $total = mysql_num_rows($dados);
            //Total é maior é zero se o leito não é usado
            if($total == 0){
                $sql = "INSERT INTO Recuperacao (loginMedico, loginCliente, loginEnfermeiro, pLeito, descricao)
                        VALUES ('$loginMedico', '$loginCliente', '$loginEnfermeiro', '$pLeito', '$descricao')";

                if (!mysql_query($sql, $db->conecta)) {
                  die('Error: ' . mysql_error($db->conecta));
                }
                $_SESSION['erro'] = "Recuperação cadastrada com sucesso";
                header("Location: marcarRecuperacao.php"); exit;
            }else{
                $_SESSION['erro'] = "O leito escolhido já está sendo usado";
                header("Location: marcarRecuperacao.php"); exit;
            }
        }else{
            $_SESSION['erro'] = "O enfermeiro solicitado não está disponível neste horário";
            header("Location: marcarRecuperacao.php"); exit;
        }
    }
?>