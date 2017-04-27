<!DOCTYPE html>

<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        //Controller
        //Responsável por receber os dados e decidir o que fazer com eles
        require './_app/Config.include.php';

        //Model
        //Leitura e tratamento dos dados
        $read = new Read();
        $read->ExecuteRead('ws_categories');

        foreach ($read->GetResult() as $cat) {
            extract($cat);

            //View
            //Renderiza o html e interage com o cliente
            echo "<article>"
            . "<header><h1>{$category_name}</h1></header>"
            . "<p>$category_content</p>"
            . "</article> <hr>";
            //End View
        }
        
        //End Model
        
        //End Controller
        ?>
    </body>
</html>
