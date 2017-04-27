<!DOCTYPE html>

<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
            require './Include/Config.include.php';
            
            $bruno = new AcessoProtegido("Bruno", "b.b.da.costa@gmail.com");
            $luna = new AcessoProtegidoFilha("Luna", "luna@gmail.com");
            
            $luna->AddCPF("Luna Costa", "23125514686");
            
            var_dump($bruno, $luna);
        ?>
    </body>
</html>
