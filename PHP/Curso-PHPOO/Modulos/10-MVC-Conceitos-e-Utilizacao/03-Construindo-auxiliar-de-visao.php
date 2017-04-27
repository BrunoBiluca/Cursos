<!DOCTYPE html>

<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
            require './_app/Config.include.php';
            
//            View::Load("_mvc/category");
//            
//            $read = new Read();
//            $read->ExecuteRead('ws_categories');
//            
//            foreach ($read->GetResult() as $res) {
//                View::Show($res);
//                
//            }
//            echo "<hr>";
//            echo "<h1>Request</h1>";
//            foreach ($read->GetResult() as $res) {
//                View::Request("_mvc/category", $res);
//                echo "<hr>";
//            }
            
            $read = new Read();
            $read->ExecuteRead('ws_siteviews_agent');
            View::Load('_mvc/navegador');
            foreach ($read->GetResult() as $res) {
                View::Show($res);
            }
        ?>
    </body>
</html>
