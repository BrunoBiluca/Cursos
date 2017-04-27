<?php

/**
 * ClassesObjetos [TIPO]
 * Descricao
 * 
 */
class ClassesObjetos {
    
    var $classe;
    var $funcao;
    
    function getClasse($classe, $funcao){
        echo "A classe {$classe} tem a função de {$funcao}";
        //Usar duas aspas permite criar um laço {} que permite colocar a variável dentro
    }
    
    function verClasse(){
        echo "<pre>";
        print_r($this);
        echo "</pre>";
    }
    
    
}
