<!DOCTYPE html>

<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>

        <h3>Tratamento por Existência</h3>
        <hr>

        <?php
        $string = "contato";

        if (is_string($string)):
            echo "String é string!";
        elseif (!is_string($string)):
            echo "String não é uma string";
        endif;

        echo "<hr>";

        if (!empty($string)) {
            echo "String existe e tem valor";
        } elseif (isset($string)) {
            echo "String existe mas não tem valor";
        }
        ?>

        <hr><hr>
        <h3>Tomada de decisão</h3>
        <hr>

        <?php
        $email = "contato";

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "Este não é um email válido!";
        } elseif ($email == "contato@bilucanexus.com") {
            die("Este email é reservado");
        } else {
            echo "E-mail válido!";
        }

        echo "XD";
        ?>


        <hr><hr>
        <h3>Retorno de flags</h3>
        <hr>

        <?php

        function getIdade($idade = null) {
            if (!$idade) {
                return false;
            } elseif (!is_int($idade)) {
                return false;
            }
            
            return "Você nasceu no ano de: " . (date('Y') - $idade);
        }
        
        $idade = 23;
        
        if(getIdade($idade)){
            echo getIdade($idade);
        }else{
            echo "Erro, informe um INT para a idade!";
        }
        
        ?>

        <hr><hr>
        <h3>Comparação</h3>
        <hr>

        <?php
        $um = 10;
        $dois = '10';
        
        if($um == $dois){
            echo "Um tem o mesmo valor de Dois!";
        }elseif($um != $dois){
            echo "Um não tem o mesmo valor de Dois!";
        }
        
        echo "<hr>";
        
        if($um === $dois){
            echo "Um tem o mesmo valor e é do mesmo tipo de Dois!";
        }elseif($um !== $dois){
            echo "Um não tem o mesmo valor ou não é do mesmo tipo de Dois!";
        }

        ?>


    </body>
</html>
