<?php

/**
 * ComportamentoInicial.class [TIPO]
 * Descricao
 * 
 */
class ComportamentoInicial {

    var $nome;
    var $idade;
    var $profissao;
    var $salario;
    
    public function __construct($nome, $idade, $profissao, $salario) {
        $this->nome = (string) $nome;
        $this->idade = (int) $idade;
        $this->profissao = (string) $profissao;
        $this->salario = (float) $salario;
        echo "O objeto {$this->nome} foi instanciado com sucesso <hr>";
    }
    
    public function __destruct() {
        echo "O objeto {$this->nome} foi destruido <hr>";
    }
    
    function verClass(){
        echo "<pre>";
        print_r($this);
        echo "</pre>";
    }
    
}
