<!DOCTYPE html>

<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
            require './Include/Config.include.php';
            
            $produto = new ResolucaoDeEscopo("Livro", 10);
            $digital = new ResolucaoDeEscopoDigital("Livro", 5);

            $produto->Vender();
            $produto->Vender();
            $produto->Vender();
            $produto->Vender();
            $produto->Vender();

            $digital->Vender();
            $digital->Vender();
            
            //$produto->Relatorio();
            ResolucaoDeEscopo::Relatorio();
            
            echo "Foram vendido " . ResolucaoDeEscopoDigital::$digital . " livros digitais! <br>";
            
            var_dump($produto);
        ?>
    </body>
</html>
