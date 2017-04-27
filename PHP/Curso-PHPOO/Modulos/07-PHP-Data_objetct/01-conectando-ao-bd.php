<!DOCTYPE html>

<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
            require './_app/Config.include.php';
            
            $conn = new Conn();
            
            $conn->GetConn();
            
            var_dump($conn->GetConn());
        ?>
    </body>
</html>
