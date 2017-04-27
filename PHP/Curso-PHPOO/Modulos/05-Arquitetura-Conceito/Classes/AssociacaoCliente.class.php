<?php

/**
 * AssociacaoCliente.class [TIPO]
 * Descricao
 * 
 */
class AssociacaoCliente{
    
    
    private $cliente;
    private $nome;
    private $email;
    
    function __construct($nome, $email) {
        $this->cliente = md5($nome);
        $this->nome = $nome;
        $this->email = $email;
    }
    
    function getCliente() {
        return $this->cliente;
    }

    function getNome() {
        return $this->nome;
    }

    function getEmail() {
        return $this->email;
    }



}
