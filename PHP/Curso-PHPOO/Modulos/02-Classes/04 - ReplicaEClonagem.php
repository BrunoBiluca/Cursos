<!DOCTYPE html>

<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
            require ('./Classes/ReplicaClonagem.class.php');
            
            $readA = new ReplicaClonagem("post", "categoria = 'noticias'", "ORDER BT data DESC");
            $readA->LerQuery();
            $readA->setTermos("categoria = 'internet'");
            
            //$readB = readA //mesmo objeto
            $readB = clone($readA); //objeto clonado, readB é um novo objeto
            $readB->setTermos("categoria = 'redes sociais'");
            
            $readC = clone($readA);
            $readC->setTabela("comentarios");
            $readC->setTermos("post = 25");
            
            $readA->LerQuery();
            $readB->LerQuery();
            $readC->LerQuery();
            
            var_dump($readA, $readB, $readC);
        
        ?>
    </body>
</html>
