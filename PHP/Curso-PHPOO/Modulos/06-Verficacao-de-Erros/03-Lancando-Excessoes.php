<!DOCTYPE html>

<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php

            $eu = null;
            
            if(!$eu){
                $a = new Exception("Eu está NULL", E_USER_NOTICE);
            }
            
            echo $a->getMessage();
            
            echo "<hr>";
            
            var_dump($a);

            echo "<hr>";
            
            try {
                if(!$eu){
                    throw new Exception("Eu continua NULL", E_USER_NOTICE);
                }
            } catch (Exception $e) {
                echo "<p> Erro {$e->getCode()} na linha # {$e->getLine()} : {$e->getMessage()} <br>";
                echo "<small>{$e->getFile()}</small></p>";
            }

        ?>
    </body>
</html>
