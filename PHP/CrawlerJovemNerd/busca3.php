<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Nerdtório</title>
    </head>
    <body>
        <h1>Tema mais comentado</h1></br>
        <a href="index.php">Voltar</a></br>
        
        <?php
        
            $username = "root";
            $password = "senha";
            $host = "localhost";
        
            $mongo = new MongoClient("mongodb://{$username}:{$password}@{$host}");
            $db = $mongo->selectDB("test"); 
            $collection = $db->noticias;
            
            $cursor = $collection->find(array(),array("classificacao" => 1, "comentarios" => 1));
            $noticias = array();
            foreach ($cursor as $document) {
                $noticias[$document["classificacao"]] = 0;
            }
            foreach ($cursor as $document) {
                $noticias[$document["classificacao"]] += count($document["comentarios"]);
            }
            
            arsort($noticias);
            foreach ($noticias as $chave => $valor) {
                echo "$chave"."</br>";
                echo "$valor"."</br>";
            }
        ?>
        
    </body>
</html>
