<?php
    if (!isset($_SESSION)) session_start();
    // Verifica se houve POST e se o usuário ou a senha é(são) vazio(s)
    if (!empty($_POST) AND (empty($_POST['login']) OR empty($_POST['patrimonio']))) {
        header("Location: alocacaoMedicoConsultorio.php"); exit;
    }
    
    include("../../controle/dbAcesso.php");
    $db = new dbAcesso;
    
    $db->conecta();
      
    $login = mysql_real_escape_string($_POST['login'],$db->conecta);
    $patrimonio = mysql_real_escape_string($_POST['patrimonio'],$db->conecta);
    $dataInicio = mysql_real_escape_string($_POST['dataInicio'],$db->conecta); 
    $dataFim = mysql_real_escape_string($_POST['dataFim'],$db->conecta); 
    
    $sql = "SELECT * FROM AgendaMedico";
    $dados = mysql_query($sql, $db->conecta);
    //Transforma os dados em um array
    $linha = mysql_fetch_assoc($dados);
    // calcula quantos dados retornaram
    $total = mysql_num_rows($dados);
    
    $_SESSION['erro'] = "Foi alocado com sucesso";
    if($total > 0) { 
        do {
            if($login == $linha['login']){
                if($dataInicio <= $linha['dataFim'] AND $dataFim >= $linha['dataInicio']){
                    $_SESSION['erro'] = "Estas data e hora já foram alocadas para este médico";
                    header("Location: alocacaoMedicoConsultorio.php"); exit;
                }
            }
            if($patrimonio == $linha['patrimonio']){
                if($dataInicio <= $linha['dataFim'] AND $dataFim >= $linha['dataInicio']){
                    $_SESSION['erro'] = "Estas data e hora já foram alocadas para este consultório";
                    header("Location: alocacaoMedicoConsultorio.php"); exit;
                }
            }
        }while($linha = mysql_fetch_assoc($dados));
    }
    // Validação do usuário/senha digitados
    $sql = "INSERT INTO AgendaMedico (login, patrimonio, dataInicio, dataFim)
            VALUES('$login', '$patrimonio', '$dataInicio', '$dataFim')";

    if (!mysql_query($sql, $db->conecta)) {
      die('Error: ' . mysql_error($db->conecta));
    }
    echo "salvo com sucesso";
    
    header("Location: alocacaoMedicoConsultorio.php"); 
      
?>