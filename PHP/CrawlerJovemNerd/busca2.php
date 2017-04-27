<?php
    if (!empty($_POST)) {
        $username = "root";
        $password = "senha";
        $host = "localhost";

        $mongo = new MongoClient("mongodb://{$username}:{$password}@{$host}");
        $db = $mongo->selectDB("test"); 
        $collection = $db->noticias;

        $data = $_POST['data'];
        //$cursor = $collection->find( { city: { $in: [ "Belo Horizonte, MG", "Contagem, MG" ] } } );
        $cursor = $collection->find(array("data" => new MongoRegex("/$data/")),array("titulo" => 1,"link" => 1, "data" => 1));

        $noticias = array();
        foreach ($cursor as $document) {
            $noticias[$document["titulo"]] = array("data" => $document["data"], "link" => $document["link"]);
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
        <script language="JavaScript" type="text/javascript" src="../mascaraValidacao.js"></script> 
    </head>
    <body>
        <div class="container-fluid" style="background-color:gray;">
            <div class="row row-grande" style="background-color:black;">
                <div class="col-md-12"><h1 align="center" style="color: whitesmoke">Notícias de uma data específica</h1></div>
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
                 <form class="form-horizontal" role="form" action="busca2.php" method="post">
                    <div class="form-group">
                        <label class="control-label col-md-4">Entre com a data para a pesquisa:</label>         
                        <div class="col-md-6">          
                            <input type="text" class="form-control" name="data">
                        </div>
                        <div class="col-md-2"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <p align="center">Formato: dia de mês de ano</br>
                            Exemplo: 18 de November de 2014</p>
                        </div>
                    </div>
                    <div class="form-group">            
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-default">Enviar</button>
                        </div>
                    </div>
                </form>                
            </div>
            <?php
                if (!empty($_POST)):            
                    foreach ($noticias as $chave => $valor):
            ?>
            <div class="row">
                <a href="<?php echo $valor["link"] ?>" role="button" class="btn btn-primary btn-block btn-lg">                
                    <div class="col-md-7"><h3 align="left"><?php echo $chave; ?></h3></div>
                    <div class="col-md-5"><h3 align="left"><?php echo $valor["data"]; ?></h3></div>
                </a>
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
