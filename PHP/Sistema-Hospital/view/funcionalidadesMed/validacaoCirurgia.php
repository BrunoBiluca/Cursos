<?php
    if (!isset($_SESSION)) session_start();

    if (!empty($_POST)) {
        include("../../controle/dbAcesso.php");
        $db = new dbAcesso;

        $db->conecta();

        $loginMedico = mysql_real_escape_string($_POST['loginMedico'],$db->conecta);
        $loginCliente = mysql_real_escape_string($_POST['loginCliente'],$db->conecta);
        $loginEnfermeiro1 = mysql_real_escape_string($_POST['loginEnfermeiro1'],$db->conecta);
        $loginEnfermeiro2 = mysql_real_escape_string($_POST['loginEnfermeiro2'],$db->conecta);
        $loginEnfermeiro3 = mysql_real_escape_string($_POST['loginEnfermeiro3'],$db->conecta);
        $pSala = mysql_real_escape_string($_POST['patrimonio'],$db->conecta);
        $dataInicio = mysql_real_escape_string($_POST['dataInicio'],$db->conecta);
        $dataFim = mysql_real_escape_string($_POST['dataFim'],$db->conecta);
        $descricao = mysql_real_escape_string($_POST['descricao'],$db->conecta);
      
        //Verifica se o médico tem horário disponível
        $sql = "SELECT * FROM AgendaMedico as AM WHERE (AM.login = '$loginMedico') AND (AM.dataInicio < '$dataInicio')
                AND (AM.dataFim > '$dataInicio')";
        $dados = mysql_query($sql, $db->conecta);
        $linha = mysql_fetch_assoc($dados);
        // calcula quantos dados retornaram
        $total = mysql_num_rows($dados);
        //Total é maior do que 0 se o médico está disponível
        if($total > 0){
                    //Verifica se o enfermeiro tem horário disponível
        $sql = "SELECT * FROM AgendaEnfermeiro as AE WHERE (AE.login = '$loginEnfermeiro1') AND (AE.dataInicio < '$dataInicio')
                AND (AE.dataFim > '$dataInicio')";
        $dados = mysql_query($sql, $db->conecta);
        $linha = mysql_fetch_assoc($dados);
        // calcula quantos dados retornaram
        $total = mysql_num_rows($dados);
        //Total é maior do que 0 se o médico está disponível
            if($total > 0){    
                $sql2 = "SELECT * FROM Cirurgias";
                $dados2 = mysql_query($sql2, $db->conecta);
                //Transforma os dados em um array
                $linha2 = mysql_fetch_assoc($dados2);
                // calcula quantos dados retornaram
                $total2 = mysql_num_rows($dados2);

                $_SESSION['erro'] = "Foi alocado com sucesso";
                if($total2 > 0) { 
                    do {
                        if($loginMedico == $linha2['loginMedico']){
                            if($dataInicio <= $linha2['dataFim'] AND $dataFim >= $linha2['dataInicio']){
                                $_SESSION['erro'] = "Estas data e hora já foram alocadas para este médico";
                                header("Location: marcarCirurgia.php"); exit;
                            }
                        }
                        if($pSala == $linha['pSala']){
                            if($dataInicio <= $linha2['dataFim'] AND $dataFim >= $linha2['dataInicio']){
                                $_SESSION['erro'] = "Estas data e hora já foram alocadas para esta Sala de cirurgia";
                                header("Location: marcarCirurgia.php"); exit;
                            }
                        }
                        if($loginEnfermeiro1 == $linha2['loginEnfermeiro1']){
                            if($dataInicio <= $linha2['dataFim'] AND $dataFim >= $linha2['dataInicio']){
                                $_SESSION['erro'] = "Estas data e hora já foram alocadas para este Enfermeiro";
                                header("Location: marcarCirurgia.php"); exit;
                            }
                        }
                        if($loginEnfermeiro2 == $linha2['loginEnfermeiro2']){
                            if($dataInicio <= $linha2['dataFim'] AND $dataFim >= $linha2['dataInicio']){
                                $_SESSION['erro'] = "Estas data e hora já foram alocadas para este Enfermeiro";
                                header("Location: marcarCirurgia.php"); exit;
                            }
                        }
                        if($loginEnfermeiro3 == $linha2['loginEnfermeiro3']){
                            if($dataInicio <= $linha2['dataFim'] AND $dataFim >= $linha2['dataInicio']){
                                $_SESSION['erro'] = "Estas data e hora já foram alocadas para este Enfermeiro";
                                header("Location: marcarCirurgia.php"); exit;
                            }
                        }
                        if($loginCliente == $linha2['loginCliente']){
                            if($dataInicio <= $linha2['dataFim'] AND $dataFim >= $linha2['dataInicio']){
                                $_SESSION['erro'] = "Estas data e hora já foram alocadas para este Cliente";
                                header("Location: marcarCirurgia.php"); exit;
                            }
                        }
                    }while($linha2 = mysql_fetch_assoc($dados2));
                }
                $sql = "INSERT INTO Cirurgias (loginMedico, loginCliente, loginEnfermeiro1,
                        loginEnfermeiro2, loginEnfermeiro3, pSala, descricao, dataInicio, dataFim)
                        VALUES ('$loginMedico', '$loginCliente', '$loginEnfermeiro1',
                        '$loginEnfermeiro2', '$loginEnfermeiro3', '$pSala', '$descricao', '$dataInicio', '$dataFim')";

                if (!mysql_query($sql, $db->conecta)) {
                  die('Error: ' . mysql_error($db->conecta));
                }
                $_SESSION['erro'] = "Cirurgia cadastrada com sucesso";
                header("Location: marcarCirurgia.php"); exit;
            }else{
                $_SESSION['erro'] = "O enfermeiro não está disponível neste horário";
                header("Location: marcarCirurgia.php"); exit;            
            }
        }else{
            $_SESSION['erro'] = "O médico não está disponível neste horário";
            header("Location: marcarCirurgia.php"); exit;
        }
    }
?>