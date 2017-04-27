<!DOCTYPE html>

<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
            require './_app/Config.include.php';
            
            $dados = ['agent_name' => 'Chromiun' , 'agent_views' => 24];
            
            $update = new Update();
            $update->ExecuteUpdate('ws_siteviews_agent', $dados, "WHERE agent_id = :id", "id=3");
            
            if($update->GetResult()){
                echo "{$update->GetRowCount()} iten(s) foram atualizados no banco!";
            }
                    
            var_dump($update);
        ?>
    </body>
</html>
