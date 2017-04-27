<?php

/**
 * InteracaoClass.class [TIPO]
 * Descricao
 * 
 */
class InteracaoClass {
    public $nome;
    public $idade;
    public $profissao;
    public $contaSalario;
    public $empresa;
    public $salario;
    
    function __construct($nome, $idade, $profissao, $contaSalario) {
        $this->nome = $nome;
        $this->idade = $idade;
        $this->profissao = $profissao;
        $this->contaSalario = $contaSalario;
    }

    public function Trabalhar($empresa, $profissao, $salario){
        $this->empresa = $empresa;
        $this->profissao = $profissao;
        $this->salario = $salario;
    }
    
    public function Receber(){
        $this->contaSalario += $this->salario;
    }
    
}
