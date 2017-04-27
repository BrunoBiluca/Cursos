<?php

/**
 * AcessoPublico.class [TIPO]
 * Descricao
 * 
 */
class AcessoPublico {

    public $nome;
    public $email;
    
    function __construct($nome, $email) {
        $this->nome = $nome;
        $this->setEmail($email);
    }
    
    public function setEmail($email){
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            die("Email inválido");
        }else{
            $this->email = $email;
        }
    }

    
}
