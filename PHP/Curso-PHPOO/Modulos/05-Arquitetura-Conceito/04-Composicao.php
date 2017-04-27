<!DOCTYPE html>

<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
            require './Include/Config.include.php';
            
            $bruno = new ComposicaoUsuario("Bruno", "b.b.da.costa@gmail.com");
            $bruno->CadastrarEndereco("Lagoa Dourada", "MG");
            
            echo "O email de {$bruno->nome} é {$bruno->email} <br>";
            echo "{$bruno->nome} mora em {$bruno->getEndereco()->getCidade()}/{$bruno->getEndereco()->getEstado()} <hr>";
            
            var_dump($bruno);
        ?>
    </body>
</html>
