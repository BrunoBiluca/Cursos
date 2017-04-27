<?php

/**
 * AcessoProtegido.class [TIPO]
 * Descricao
 * 
 */
class AcessoProtegido {
    protected $nome;
    protected $email;
    
    function __construct($nome, $email) {
        $this->nome = $nome;
        $this->setEmail($email);
    }
    
    public function SetEmail($email){
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            die("Email inválido");
        }else{
            $this->email = $email;
        }
    }
    
    protected function SetNome($nome){
        $this->nome = $nome;
    }
}

class AcessoProtegidoFilha extends AcessoProtegido{
    
    protected $cpf;
    
    public function AddCPF($nome, $cpf){
        parent::SetNome($nome);
        $this->cpf = $cpf;
    }

    
}
