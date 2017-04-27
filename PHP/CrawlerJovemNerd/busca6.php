<?php
    if (!empty($_POST)) {
        $username = "root";
        $password = "senha";
        $host = "localhost";

        $mongo = new MongoClient("mongodb://{$username}:{$password}@{$host}");
        $db = $mongo->selectDB("test"); 
        $collection = $db->noticias;

        $busca = $_POST['busca'];
        $cursor = $collection->find(array("titulo" => new MongoRegex("/$busca/")),array(
            "titulo" => 1, "link" => 1, "_id" => 0));
        $cursor2 = $collection->find(array(),array("comentarios" => 1, "_id" => 0));

        #Noticias
        $noticias = array();
        foreach ($cursor as $document) {
            $noticias[$document["titulo"]] = $document["link"];
        }

        #Comentarios
        $expRegular = '/'.$busca.'/';
        $noticias2 = array();
        foreach ($cursor2 as $document) {
            foreach($document as $comentarios){
                foreach ($comentarios as $individuais){
                    if(preg_match($expRegular, $individuais["coment"])){
                        array_push($noticias2, array(
                            "usuario" => $individuais["usuario"], "coment" => $individuais["coment"]));
                    }
                }
            }
        } 
    }
?>

<html>
    <head>
        <meta charset="UTF-8">
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">
        <link rel="stylesheet" type="text/css" href="style.css">
        <title>Nerdtório</title>
    </head>
    <body>
        <div class="container-fluid" style="background-color:gray;">
            <div class="row row-grande" style="background-color:black;">
                <div class="col-md-12"><h1 align="center" style="color: whitesmoke">Busca de notícias por palavra</h1></div>
            </div>            
            <div class="row" style="background-color:black;">
                <div class="col-md-12">
                    <a href="index.php" role="button" class="btn btn-primary btn-lg">
                        <h1 align="center"> Voltar </h1>
                    </a>
                </div>
            </div>
            <div class="row row-pequeno"></div>
            <div class="row row-grande">
                 <form class="form-horizontal" role="form" action="busca6.php" method="post">
                    <div class="form-group">
                        <label class="control-label col-md-4">Entre uma palavra a ser pesquisa:</label>         
                        <div class="col-md-6">          
                            <input type="text" class="form-control" name="busca">
                        </div>
                        <div class="col-md-2"></div>
                    </div>
                    <div class="form-group">            
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-default">Enviar</button>
                        </div>
                    </div>
                </form>                
            </div>
            <div class="row">
                <div class="col-md-12"><h2 align="center">Notícias</h2></div>
            </div>
            <?php
                if (!empty($_POST)):            
                    foreach ($noticias as $chave => $valor):
            ?>
            <div class="row">
                <a href="<?php echo $valor?>" role="button" class="btn btn-primary btn-block btn-lg">                
                    <div class="col-md-12"><h3 align="left"><?php echo $chave; ?></h3></div>
                </a>
            </div>
            <?php
                    endforeach;
                endif;
            ?>
            <div class="row row-grande"></div>     
            <div class="row">
                <div class="col-md-12"><h2 align="center">Comentários</h2></div>
            </div>
            <?php
                if (!empty($_POST)):            
                    foreach ($noticias2 as $comentario):
            ?>
            <div class="row" style="background-color:gray;">             
                <br>
                <div class="col-md-3" style="background-color:darkgray;"><b><?php echo $comentario["usuario"]; ?></b></div>
                <div class="col-md-9" style="background-color:darkgray;"><?php echo $comentario["coment"]; ?></div>
            </div>
            <?php
                    endforeach;
                endif;
            ?>            
            <div class="row row-grande" style="background-color:black;">
                <div class="col-md-12"><h2 align="center" style="color: whitesmoke">Rodapé</h2></div>
            </div>
        </div>           
    </body>
</html>
