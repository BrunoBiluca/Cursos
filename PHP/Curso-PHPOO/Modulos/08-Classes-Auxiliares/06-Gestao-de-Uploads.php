<!DOCTYPE html>

<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" href="css/reset.css"/>
    </head>
    <body>
        <?php
            require './_app/Config.include.php';
            
            $form = filter_input_array(INPUT_POST, FILTER_DEFAULT);
            if($form && $form['sendImage']){
                $upload = new Upload("uploads/");
                $image = $_FILES['imagem'];
                $upload->Image($image);
                
                if(!$upload->getResult()){
                    WSErro("Erro ao enviar a imagem:<br><small>{$upload->getError()}</small>", WS_ERROR);
                }else{
                    WSErro("Imagem enviada com sucesso:<br><small>{$upload->getResult()}</small>", WS_ACCEPT);
                }
                
                echo "<hr>";
                
                var_dump($upload);
            }
            
        ?>
        
        <form name="fileForm" action="" method="post" enctype="multipart/form-data">
            <label>
                <input type="file" name="imagem"/>
            </label>
            <input type="submit" name="sendImage" value="Enviar Arquivo!"/>
        </form>
        
        
    </body>
</html>
