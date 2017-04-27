<?php

include('phplot.php');

$username = "root";
$password = "senha";
$host = "localhost";

$mongo = new MongoClient("mongodb://{$username}:{$password}@{$host}");
$db = $mongo->selectDB("test"); 
$collection = $db->noticias;

$cursor = $collection->find(array(),array("comentarios" => 1, "_id" => 0));
$noticias = array();
foreach ($cursor as $document) {
    foreach($document as $comentarios){
        foreach ($comentarios as $individuais){
            $noticias[$individuais["usuario"]] = 0;
        }
    }
}
foreach ($cursor as $document) {
    foreach($document as $comentarios){
        foreach ($comentarios as $individuais){
            $noticias[$individuais["usuario"]] += 1;
        }
    }
}

arsort($noticias);
$i = 0;
$data = array();
foreach ($noticias as $chave => $valor) {
    if($i < 10){
        array_push($data, array($chave,$valor)) ;
    }
    $i++;
} 
#Instancia o objeto e setando o tamanho do grafico na tela
$plot = new PHPlot(1500,600);
#Tipo de borda, consulte a documentacao
$plot->SetImageBorderType('plain');
#Tipo de grafico, nesse caso barras, existem diversos(pizza…)
$plot->SetPlotType('bars');
#Tipo de dados, nesse caso texto que esta no array
$plot->SetDataType('text-data');
#Setando os valores com os dados do array
$plot->SetDataValues($data);
#Titulo do grafico
$plot->SetTitle('Usuários que mais comentaram');
#Legenda, nesse caso serao tres pq o array possui 3 valores que serao apresentados
$plot->SetLegend('none');
#Utilizados p/ marcar labels, necessario mas nao se aplica neste ex. (manual) :
$plot->SetXTickLabelPos('none');
$plot->SetXTickPos('none');
#Gera o grafico na tela
$plot->DrawGraph();
            
