<!DOCTYPE html>

<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
            require './Include/Config.include.php';
            $cliente = new ObjetoDinamico();
            
            $bruno = new stdClass();
            $bruno->nome = "Bruno";
            $bruno->email = "b.b.da.costa@gmail.com";
            
            $cliente->Novo($bruno);
            
            var_dump($cliente, $bruno);
        ?>
    </body>
</html>
