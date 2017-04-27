<?php

/**
 * ModelagemClasse.class [TIPO]
 * Descricao
 * 
 */
class ModelagemClasse {

    public $nome;
    public $idade;
    public $profissao;
    public $contaSalario;
    
    function __construct($nome, $idade, $profissao, $contaSalario) {
        $this->nome = $nome;
        $this->idade = $idade;
        $this->profissao = $profissao;
        $this->contaSalario = $contaSalario;
    }
    function setNome($nome) {
        $this->nome = $nome;
    }

    function setIdade($idade) {
        $this->idade = $idade;
    }

    function setProfissao($profissao) {
        $this->profissao = $profissao;
    }

    function setContaSalario($contaSalario) {
        $this->contaSalario = $contaSalario;
    }

    public function ToReal($valor){
        return number_format($valor, '2', '.', ',');
    }
    
    public function DarEcho($mensagem){
        echo $mensagem;
    }
    
    public function Trabalhar($trabalho, $valor){
        $this->contaSalario += $valor;
        $this->DarEcho("{$this->nome} desenvolveu um {$trabalho} e recebeu {$valor} <hr>");
    }
}
