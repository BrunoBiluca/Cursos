<!DOCTYPE html>

<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
            require './_app/Config.include.php';
            
            $dados = ['agent_name' => 'Safari' , 'agent_views' => 300];
            
            $cadastro = new Create();
            $cadastro->ExecuteCreate("ws_siteviews_agent", $dados);
            
            if($cadastro->GetResult()){
                echo "Cadastro efetuado com sucesso! <hr>";
            }
        ?>
    </body>
</html>
