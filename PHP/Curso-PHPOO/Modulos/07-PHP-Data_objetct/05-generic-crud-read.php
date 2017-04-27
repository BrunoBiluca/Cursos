<!DOCTYPE html>

<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
            require './_app/Config.include.php';
            
            $read = new Read();
            $read->ExecuteRead('ws_siteviews_agent', 'WHERE agent_views >= :views LIMIT :limit', 'views=10&limit=1');
            
            if($read->GetRowCount() >= 1){
                var_dump($read->GetResult());
                echo "<hr>";
            }
            
            var_dump($read);
        ?>
    </body>
</html>
