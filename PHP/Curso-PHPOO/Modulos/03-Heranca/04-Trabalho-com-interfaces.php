<!DOCTYPE html>

<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
            require './Include/Config.include.php';
            
            $aluno = new TrabalhoComInterfaces("Bruno", "CC");
            $aluno->Formar();
            $aluno->Matricular("Pos CC");
            $aluno->Formar();
            
            var_dump($aluno);
        ?>
    </body>
</html>
