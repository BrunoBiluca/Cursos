<!DOCTYPE html>

<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        
            require './Classes/ModelagemClasse.class.php';
        
            $usuario = new ModelagemClasse("Bruno", 23, "Programador", -160);
            
            $usuario->Trabalhar("Site", 300);
            
            var_dump($usuario);
        
        ?>
    </body>
</html>
