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
            
            $prod1 = new AgregacaoProduto(10, "Metal Gear 5", 100);
            $prod2 = new AgregacaoProduto(11, "Street Fighter 5", 200);
            $prod3 = new AgregacaoProduto(12, "Persona 5", 300);
            
            $outro = new stdClass();
            $outro->produto = 1;
            $outro->nome = "Missign";
            $outro->valor = 10;
            
            $carrinho = new AgregacaoCarrinho($bruno);
            
            $carrinho->Add($prod3);
            $carrinho->Add($prod2);
            $carrinho->Remover($prod2);
            
            var_dump($bruno, $prod3, $outro, $carrinho);
        ?>
    </body>
</html>
