<?php

//CONFIGURAÇÕES DO SITE ####################
//AUTO LOAD ################################
function __autoload($class) {

    $dirC = "Classes";
    $dirI = "Interfaces";
   
    if (file_exists("{$dirC}/{$class}.class.php")) {
        require_once ("{$dirC}/{$class}.class.php");
    } elseif (file_exists("{$dirI}/{$class}.interface.php")) {
        require_once ("{$dirI}/{$class}.interface.php");
    } else {
        die("Erro ao incluir a classe {$class}");
    }
    
}

//TRATAMENTO DE ERROS ####################
//Css constantes :: Mensagem de erro
define("WS_ACCEPT", 'accept');
define("WS_INFOR", 'infor');
define("WS_ALERT", 'alert');
define("WS_ERROR", 'error');

//WSErro :: Exibe os erros lançados :: Front
function WSErro($errMsg, $errNo, $errDie = null){
    $cssClass = ($errNo == E_USER_NOTICE ? WS_INFOR : ($errNo == E_USER_WARNING ? WS_ALERT : ($errNo == E_USER_ERROR ? WS_ERROR : $errNo)));
    echo "<p class=\"trigger {$cssClass}\">{$errMsg}<span class=\"ajax_close\"></span></p>";
    
    if($errDie){
        die;
    }
}

//PHPErro :: Personaliza o gatilho do PHP
function PHPErro($errNo, $errMsg, $errFile, $errLine){
    $cssClass = ($errNo == E_USER_NOTICE ? WS_INFOR : ($errNo == E_USER_WARNING ? WS_ALERT : ($errNo == E_USER_ERROR ? WS_ERROR : $errNo)));
    echo "<p class=\"trigger {$cssClass}\">"
    . "<b>Erro na linha {$errLine} : </b> {$errMsg} <br>"
    . "<small>{$errFile}</small>"
    . "<span class=\"ajax_close\"></span></p>";

    if($errNo == E_USER_ERROR){
        die;
    }
}
set_error_handler("PHPErro");


