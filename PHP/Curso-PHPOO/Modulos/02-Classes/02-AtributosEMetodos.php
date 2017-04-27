<!DOCTYPE html>

<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        require('./Classes/AtributosMetodos.class.php');
        
        $pessoa = new AtributosMetodos();
        $pessoa->SetUsuario("Bruno", 23, "Tentando conseguir uma profissão");
        echo $pessoa->GetUsuario();
        
        echo "<hr>";
        
        $pessoa->SetUsuario("Jonh Doe", 666, "Ser foda");
        
        $pessoa->GetClass();
             
        ?>
    </body>
</html>
