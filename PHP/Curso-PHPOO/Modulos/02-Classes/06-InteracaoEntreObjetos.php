<!DOCTYPE html>

<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
            require './Classes/InteracaoClass.class.php';
            require './Classes/InteracaoObjetos.class.php';
            
            $bruno = new InteracaoClass("Bruno", 23, "Programador", 1000);
            $bilucaStudios = new InteracaoObjetos("BilucaStudios");
            
            $bilucaStudios->Contratar($bruno, "Garoto de Programa", 10);
            $bilucaStudios->Pagar();
            $bilucaStudios->Promover("Gerente de puteiro");
            $bilucaStudios->Promover("Cafatão das minas", 20);
            
            $bilucaStudios->Demitir(0);
                    
            var_dump($bruno, $bilucaStudios);
        ?>
    </body>
</html>
