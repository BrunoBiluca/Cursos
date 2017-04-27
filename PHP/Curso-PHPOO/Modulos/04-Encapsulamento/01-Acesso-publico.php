<!DOCTYPE html>

<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
            require './Include/Config.include.php';
            
            $bruno = new AcessoPublico("Bruno", "b.b.da.costa@gmail.com");
            
            //Acesso publico pode acessar atributos e métodos e manipular manualmente
            $bruno->email = "vagem";
            
            var_dump($bruno);
        ?>
    </body>
</html>
