<!DOCTYPE html>

<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        require('./Classes/ClassesObjetos.class.php');
        
        $inst = new ClassesObjetos();
        $inst->getClasse("Classe 1", "Mostrar os atributos e métodos");
        $inst->verClasse();
        
        $inst->classe = "Classe2";
        $inst->funcao = "Acessar banco de dados";
        $inst->verClasse();
               
        ?>
    </body>
</html>
