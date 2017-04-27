<?php

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
