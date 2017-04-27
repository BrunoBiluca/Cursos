<?php
    if (!isset($_SESSION)) session_start();

    if (!empty($_POST)) {
        include("../../controle/dbAcesso.php");
        $db = new dbAcesso;

        $db->conecta();

        $loginCliente = $_SESSION['UsuarioLogin'];
        $loginMedico = $_POST['login'];
        $data = $_POST['data'];
      
        //Verifica se o médico tem horário disponível
        $sql = "SELECT AM.patrimonio FROM AgendaMedico as AM WHERE (AM.dataInicio < '$data') AND (AM.dataFim > '$data')";
        $dados = mysql_query($sql, $db->conecta);
        $linha = mysql_fetch_assoc($dados);
        $pConsultorio = $linha['patrimonio'];
        // calcula quantos dados retornaram
        $total = mysql_num_rows($dados);
        //Total é maior do que 0 se o médico está disponível
        if($total > 0){
            $antes = new DateTime($data);
            $antes->add(new DateInterval('PT0H15M0S'));
            $rAntes = $antes->format('Y-m-d H:i:s');
            $depois = new DateTime($data);
            $depois->sub(new DateInterval('PT0H15M0S'));            
            $rDepois = $depois->format('Y-m-d H:i:s');

            //Verifica se a data ja foi marcada
            $sql = "SELECT * FROM Consultas WHERE (loginMedico = '$loginMedico') AND ((data > '$rDepois') OR (data < '$rAntes'))";
            $dados2 = mysql_query($sql, $db->conecta);
            // calcula quantos dados retornaram
            $total2 = mysql_num_rows($dados2);
            //retorna nada se não bate horário
            if($total2 == 0){                
                $sql = "INSERT INTO Consultas(loginMedico,loginCliente,pConsultorio,data) 
                        VALUES ('$loginMedico', '$loginCliente','$pConsultorio', '$data')";
                if (!mysql_query($sql, $db->conecta)) {
                    die('Error: ' . mysql_error($db->conecta));
                }
                $_SESSION['erro'] = "Horário marcado";
                header("Location: marcarConsulta.php"); exit;
            }else{
                $_SESSION['erro'] = "Horário já está marcado tente um outro horário";
                header("Location: marcarConsulta.php"); exit;
            }
        }else{
            $_SESSION['erro'] = "O médico não está disponível neste horário";
            header("Location: marcarConsulta.php"); exit;
        }
    }
?>