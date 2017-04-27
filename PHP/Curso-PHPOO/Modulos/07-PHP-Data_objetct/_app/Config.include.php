<?php

//CONFIGURAÇÕES DO SITE ####################
//Configurações banco de dados
define('HOST', 'localhost');
define('USER', 'root');
define('PASS', '');
define('DBSA', 'curso-phpoo');

//AUTO LOAD ################################
function __autoload($class) {

    $dirC = ['conn'];
    $iDir = false;
    
    foreach ($dirC as $dirName) {
        if (!$iDir && file_exists(__DIR__ . "\\{$dirName}\\{$class}.class.php")) {
            include_once (__DIR__ . "\\{$dirName}\\{$class}.class.php");
            $iDir = true;
        }        
    }
    
    if(!$iDir){
        trigger_error("Não foi possível incluir {$class}.class.php", E_USER_ERROR);
        die;
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


