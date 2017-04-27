<!DOCTYPE html>

<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
            require './Include/Config.include.php';
            
            $boleto = new Polimorfismo("PS4", "1600");
            $boleto->Pagar();
            
            var_dump($boleto);
            echo "<hr>";
            
            $deposito = new PolimorfismoDeposito("PS4", "1600");
            $deposito->Pagar();
            
            var_dump($deposito);
            echo "<hr>";
            
            $cartao = new PolimorfismoCartao("PS4", "1600");
            $cartao->Pagar(10);
            
            var_dump($cartao);
            echo "<hr>";

        ?>
    </body>
</html>
