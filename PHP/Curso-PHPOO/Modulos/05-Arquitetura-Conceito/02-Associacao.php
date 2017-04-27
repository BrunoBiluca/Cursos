<!DOCTYPE html>

<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
            require './Include/Config.include.php';
            
            $bruno = new AssociacaoCliente("Bruno", "b.b.da.costa@gmail.com");
            $login = new AssociacaoLogin($bruno);
            
            if($login->getLogin()){
                echo "Gerenciando o cliente id: {$login->getCliente()->getCliente()} <br>";
                echo "{$login->getCliente()->getNome()} logou com sucesso usando o email {$login->getCliente()->getEmail()} <hr>";
            }else{
                die("Erro ao logar!");
            }
                        
            var_dump($bruno , $login);
        ?>
    </body>
</html>
