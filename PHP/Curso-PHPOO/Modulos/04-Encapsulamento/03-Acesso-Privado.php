<!DOCTYPE html>

<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
            require './Include/Config.include.php';
        
            $cliente = new AcessoPrivado("Bruno", "b.b.da.costa@gmail.com", 12345678912);
            
            var_dump($cliente);
        ?>
    </body>
</html>
