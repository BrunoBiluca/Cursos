<!DOCTYPE html>

<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        
            require('./Classes/ComportamentoInicial.class.php');
            
            $usuario1 = new ComportamentoInicial("Bruno", 23, "Programmer", 10);
            $usuario2 = new ComportamentoInicial("Lucy", 24, "Programmer", 100000);
            $usuario3 = new ComportamentoInicial("Mara", 51, "Severina", 500);
        
            $usuario1->verClass();
        ?>
    </body>
</html>
