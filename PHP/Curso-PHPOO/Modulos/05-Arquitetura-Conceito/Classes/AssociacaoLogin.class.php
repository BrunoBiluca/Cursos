<?php

/**
 * AssociacaoLogin.class [TIPO]
 * Descricao
 * 
 */
class AssociacaoLogin{
    
    /** @var AssociacaoCliente */
    private $cliente;
    private $login;
    
    function __construct($cliente) {
        
        if(is_object($cliente)){
            $this->cliente = $cliente;
            $this->login = true;
        }else{
            die("Erro ao logar!");
        }
    }
    
    function getCliente() {
        return $this->cliente;
    }

    function getLogin() {
        return $this->login;
    }



}
