<?php

/**
 * Heranca.class.php [TIPO]
 * Descricao
 * 
 */
class Heranca {

    public $nome;
    public $idade;
    public $formacao;
    
    function __construct($nome, $idade) {
        $this->nome = $nome;
        $this->idade = $idade;
        $this->formacao = array();
    }
    
    public function Envelhecer(){
        $this->idade += 1;
    }

    public function Formar($curso){
        $this->formacao[] = (string) $curso;
    }
    
    public function VerPessoa(){
        $formacao = implode(", ", $this->formacao);
        echo "{$this->nome} tem {$this->idade} anos e é formado em: {$formacao}";
    }
    
    
    
}
