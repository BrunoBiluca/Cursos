<!DOCTYPE html>

<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
            require './Include/Config.include.php';
            
//            $conta = new Abstracao("Bruno", 100);
//            $conta2 = new Abstracao("Mara", 200);
//            $conta->Depositar(200);
//            $conta->Sacar(100);
//            $conta->Transferir(100, $conta2);
//            
//            var_dump($conta, $conta2);
            
            $cc = new AbstracaoCC("Bruno", 100, 1000);
            $cp = new AbstracaoCP("Ivo Olanda", 300);
            
            $cc->Depositar(100);
            $cc->Sacar(50);
            $cc->Transferir(500, $cp);

            echo "<hr>";
            
            $cp->Depositar(100);
            $cp->Sacar(50);
            $cp->Transferir(500, $cc);
            
            
            $cc->VerSaldo();
            $cp->VerSaldo();
            
            echo "<hr>";
            var_dump($cc, $cp);
        ?>
    </body>
</html>
