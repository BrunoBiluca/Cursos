<!DOCTYPE html>

<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
            require './_app/Config.include.php';
            
            $delete = new Delete();
            $delete->ExecuteDelete('ws_siteviews_agent', "WHERE agent_id = :id", "id=2");
            
            if($delete->GetResult()){
                echo "{$delete->GetRowCount()} registro(s) foram removidos!<hr>";
            }
            
            var_dump($delete);
        ?>
    </body>
</html>
