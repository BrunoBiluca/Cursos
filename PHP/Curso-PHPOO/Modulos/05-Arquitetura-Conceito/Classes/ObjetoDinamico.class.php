<?php

/**
 * ObjetoDinamico.class.php [TIPO]
 * Descricao
 * 
 */
class ObjetoDinamico {

    public $nome;
    private $email;
    
    public function Novo($cliente){
        if(is_object($cliente)){
            $this->nome = $cliente->nome;
            $this->email = $cliente->email;
        }else{
            die("Entre com um objeto que contém nome e email!");
        }
    }
    
}
