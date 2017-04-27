<!DOCTYPE html>

<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
            require './Include/Config.include.php';
        
            $classA = new ClassesObjetos;
            $classB = new ComportamentoInicial("Bruno", 23, "Programador", 1000);
            $classC = new AtributosMetodos;
            
            var_dump($classA, $classB, $classC);
            echo "<hr>";
        ?>
    </body>
</html>
