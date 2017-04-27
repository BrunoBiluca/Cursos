<?php
      
    // Verifica se houve POST e se o usuário ou a senha é(são) vazio(s)
    if (!empty($_POST) AND (empty($_POST['login']) OR empty($_POST['senha']))) {
        header("Location: ../view/login.php"); exit;
    }
      
    include("../controle/dbAcesso.php");
    $db = new dbAcesso;
    
    $db->conecta();
      
    $login = mysql_real_escape_string($_POST['login'],$db->conecta);
    $senha = mysql_real_escape_string($_POST['senha'],$db->conecta);
      
    // Validação do usuário/senha digitados
    $sql = "SELECT tipoUsuario FROM Usuarios WHERE (login = '".$login ."') AND (senha = '".$senha."')";
    $query = mysql_query($sql,$db->conecta); 

    if (mysql_num_rows($query) != 1) {
        // Mensagem de erro quando os dados são inválidos e/ou o usuário não foi encontrado
        echo "Login inválido!"; exit;
    } else {
        // Salva os dados encontados na variável $resultado
        $resultado = mysql_fetch_assoc($query);
        // Se a sessão não existir, inicia uma
        if (!isset($_SESSION)) session_start();

        // Salva os dados encontrados na sessão
        $_SESSION['UsuarioLogin'] = $login;
        $_SESSION['UsuarioTipo'] = $resultado['tipoUsuario'];
      
        // Redireciona o visitante
        if($resultado['tipoUsuario'] == 0){
            header("Location: ../view/paginasUsuarios/page-administrador.php"); 
            exit;
        }else if($resultado['tipoUsuario'] == 1){
            header("Location: ../view/paginasUsuarios/page-cliente.php"); 
            exit;
        }else if($resultado['tipoUsuario'] == 2){
            header("Location: ../view/paginasUsuarios/page-medico.php"); 
            exit;
        }else if($resultado['tipoUsuario'] ==3){
            header("Location: ../view/paginasUsuarios/page-enfermeiro.php"); 
            exit;
        }else if($resultado['tipoUsuario'] == 4){
            header("Location: ../view/paginasUsuarios/page-gerente.php"); 
            exit;
        }
    }
      
?>