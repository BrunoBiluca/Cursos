<?php 
//include_once('simple_html_dom.php');
//phpinfo();


//    include_once('simple_html_dom.php');
//    $target_url = "http://www.jovemnerd.com.br/";
//    $html = new simple_html_dom();
//    $html->load_file($target_url);
//    foreach($html->find('a') as $link){
//        echo $link->href.'<br />';
//    }


//    include_once('simple_html_dom.php');
//    $target_url = "http://jovemnerd.com.br/categoria/jovem-nerd-news/";
//    $html = new simple_html_dom();
//    $html->load_file($target_url);
//    foreach($html->find('div[class=post]') as $post){
//        echo $post."<br />";
//    }


?>

<head>
    <style type="text/css">
        div.post{background-color: gray;border-radius: 10px;-moz-border-radius: 10px;padding:20px;}
        img{float:left;border:0px;padding-right: 10px;padding-bottom: 10px;}
        body{width:60%;font-family: verdana,tahamo,sans-serif;margin-left:20%;}
        a{text-decoration:none;color:blue;}
    </style>
   <meta charset="UTF-8">
   <title>Coletor Web</title>
</head>
<?php
    ini_set('max_execution_time', 300); 

    include_once('simple_html_dom.php');
    
    $username = "root";
    $password = "senha";
    $host = "localhost";
    
    $facebook = "https://graph.facebook.com/fql?q=SELECT%20share_count,%20like_count,%20comment_count,total_count%20FROM%20link_stat%20WHERE%20url='";
    $twitter = "http://cdn.syndication.twitter.com/widgets/tweetbutton/count.json?url=";

    
    $mongo = new MongoClient("mongodb://{$username}:{$password}@{$host}");
    $db = $mongo->selectDB("test");    
    
    $db->createCollection("noticias",false);
    $collection = $db->noticias;

    $target_url = 'http://jovemnerd.com.br/categoria/jovem-nerd-news/';

    $i = 0;
    while($i < 100){
        $html = file_get_html($target_url);
        $target_url = $html->find('div[class=nav-previous]',0)->find('a',0)->href;          //Nova url
            foreach($html->find('div[class=entry]') as $post){

                $data = $post->find('span[class=entry-date]',0)->innertext;                     //Data
                echo $post->find('a',0)->href."</br>";                                          //Endereço
                $item['href']  = $post->find('a',0)->href;

                //Verifica se a notícia já foi visitada
                $query = array("link" => $item['href']);
                $noticiaVisitada = $collection->findOne($query);

                //echo "</br>".$noticiaVisitada."</br>";

                if($noticiaVisitada){

                    //Contador de likes facebook
                    $pluginF = $facebook.$item['href']."'";
                    $jsonFacebook = file_get_contents($pluginF);
                    $expRegular = '/(.*"total_count":)(?P<digit>\d+)(.*)/';
                    preg_match($expRegular, $jsonFacebook, $linhas);
                    $likes = $linhas['digit'];

                    //Contador de twits
                    $pluginT = $twitter.$item['href'];
                    $jsonTwitter = file_get_contents($pluginT);
                    $expRegular2 = '/(.*"count":)(?P<digit>\d+)(.*)/';
                    preg_match($expRegular2, $jsonTwitter, $linhas2);
                    $twits = $linhas2['digit'];

                    $update = array('$set' => array("likes" => $likes, "twits" => $twits));
                    $where = array("link" => $item['href']);
                    $collection->update($where,$update);

                }
                else{
                    //Página da matéria
                    $html2 = file_get_html($item['href']);

                    echo $html2->find('h2[class=entry-title]',0)->innertext."</br>";                            //Titulo;
                    $titulo = $html2->find('h2[class=entry-title]',0)->innertext;

                    $postagem = $html2->find('div[class=entry-content]',0);                         //Postagem
                    $classificacao = $html2->find('span[class=cat-links]',0)->children(1)->innertext;           //classificação
                    echo "</br>";

                    //Contador de likes facebook
                    $pluginF = $facebook.$item['href']."'";
                    $jsonFacebook = file_get_contents($pluginF);
                    $expRegular = '/(.*"total_count":)(?P<digit>\d+)(.*)/';
                    preg_match($expRegular, $jsonFacebook, $linhas);
                    $likes = $linhas['digit'];
                    echo "</br>";

                    //Contador de twits
                    $pluginT = $twitter.$item['href'];
                    $jsonTwitter = file_get_contents($pluginT);
                    $expRegular2 = '/(.*"count":)(?P<digit>\d+)(.*)/';
                    preg_match($expRegular2, $jsonTwitter, $linhas2);
                    $twits = $linhas2['digit'];
                    echo "</br>";

                    $lista = array();
                    $i = 0;
                    foreach ($html2->find('li[class=comment]') as $comentario){                     //comentários
                        $usuario = $comentario->find('span',0)->innertext;   
                        $coment = $comentario->find('p',0)->innertext;
                        $dados = array("usuario" => $usuario, "coment" => $coment);
                        array_push($lista, $dados);
                    }

                    //Insere no banco de dados o titulo
                    $insert = array("titulo" => $titulo, "link" => $item['href'],"data" => $data, "classificacao" => $classificacao,
                                    "likes" => $likes, "twits" => $twits, "comentarios" => $lista);
                    $collection->insert($insert);   
                    echo "</br>";
                }
            }
        $i++;
    }
   
    $html->clear();
    unset($html);
    header("Location: index.php"); exit; // Redireciona o visitante
    ?>