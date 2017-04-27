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
        $read->ExecuteRead('ws_categories');
        
        $template = file_get_contents('_mvc/category.template.html');

        foreach ($read->GetResult() as $cat) {
            extract($cat);

            $cat['pubtime'] = date("Y-m-d", strtotime($cat['category_date']));
            
            $links = explode("&", "#" . implode("#&#", array_keys($cat)) . "#");
            echo str_replace($links, array_values($cat), $template);

        }
        ?>
    </body>
</html>
