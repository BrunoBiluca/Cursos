<?php

function __autoload($class) {
    
    $dir = "Classes";
    
    if(file_exists("{$dir}/{$class}.class.php")){
        require_once("{$dir}/{$class}.class.php");
    }else{
        die("Erro ao incluir o arquivo {$dir}/{$class}.class.php");
    }
    
}