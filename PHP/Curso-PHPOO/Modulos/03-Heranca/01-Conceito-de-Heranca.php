<!DOCTYPE html>

<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
            require './Include/Config.include.php';
            
            $pessoa = new Heranca("Bruno", 23);
            $pessoa->Formar("Pica grossa");
            $pessoa->Envelhecer();
            $pessoa->Formar("Como comer um cu em 5 passos");
            $pessoa->VerPessoa();
            
            echo "<hr>";
            
            $pessoaJ = new HerancaJuridica("Bruno", 23, "Prostibulo Central");
            $pessoaJ->Formar("Pica grossa");
            $pessoaJ->Envelhecer();
            $pessoaJ->Formar("Como comer um cu em 5 passos");
            $pessoaJ->VerPessoa();
            
            echo "<hr>";
            
            $pessoaJ->Contratar('Carlinhos pau de ventilador');
            $pessoaJ->VerEmpresa();
            
            echo "<hr>";
            
        ?>
    </body>
</html>
