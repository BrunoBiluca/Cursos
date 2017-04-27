<?php

/**
 * AgragacaoProduto.class [TIPO]
 * Descricao
 * 
 */
class AgregacaoProduto{
    private $produto;
    private $nome;
    private $valor;
    
    function __construct($produto, $nome, $valor) {
        $this->produto = $produto;
        $this->nome = $nome;
        $this->valor = $valor;
    }
    
    function getProduto() {
        return $this->produto;
    }

    function getNome() {
        return $this->nome;
    }

    function getValor() {
        return $this->valor;
    }


    
}
