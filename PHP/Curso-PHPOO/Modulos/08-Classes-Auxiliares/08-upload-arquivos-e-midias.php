<!DOCTYPE html>

<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" href="css/reset.css"/>
        <style>
            label{ display:block; margin-top: 15px;}
            label span{display: block;}
        </style>
    </head>
    <body>
        <?php
        require './_app/Config.include.php';

        $form = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if ($form && $form['sendFile']) {
            $file = $_FILES['arquivo'];
            if ($file['name']) {

                //$upload = new Upload("uploads/");
                //$upload->File($file);
                
                //var_dump($upload);
            }
            
            $midia = $_FILES['midia'];
            if ($midia['name']) {

                $upload = new Upload("uploads/");
                $upload->Media($midia);
                
                var_dump($upload);
            }
        }
        ?>


        <form name="fileForm" action="" method="post" enctype="multipart/form-data">
            <label>
                <span>Arquivo: </span>
                <input type="file" name="arquivo"/>
            </label>
            <label>
                <span>Mídia: </span>
                <input type="file" name="midia"/>
            </label>
            <br>
            <input type="submit" name="sendFile" value="Enviar Arquivo!"/>
        </form>

    </body>
</html>
