<!DOCTYPE html>

<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
            require './_app/Config.include.php';
            
            $atual = filter_input(INPUT_GET, 'atual', FILTER_VALIDATE_INT);
            
            $pager = new Pager('04-gestao-de-resultados.php?atual=', 'Primeira', "Última", 1);
            $pager->ExecutaPager($atual, 1);
            
            $read = new Read();
            $read->ExecuteRead("ws_categories", "LIMIT :limit OFFSET :offset", "limit={$pager->GetLimit()}&offset={$pager->GetOffset()}");

            if(!$read->GetRowCount()){
                $pager->RetornaPagina();
                echo "Não existem resultados! <hr>";
            }else{
                var_dump($read->GetResult());
            }
            
            $pager->ExecutaPaginator("ws_categories");
            echo $pager->GetPaginator();
            
        ?>
    </body>
</html>
