<?php

/**
 * AcessoPrivado.class [TIPO]
 * Descricao
 * 
 */
class AcessoPrivado {

    private $nome;
    private $email;
    private $cpf;
    
    function __construct($nome, $email, $cpf) {
        $this->SetNome($nome);
        $this->SetEmail($email);
        $this->SetCPF($cpf);
    }
    
    public function SetNome($nome){
        if($nome && is_string($nome)){
            $this->nome = $nome;
        }else{
            die("Nome incorreto");
        }
    }
    
    public function SetEmail($email){
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            $this->email = $email;
        }else{
            die("Email inválido");
        }
    }

    public function SetCPF($cpf) {
        if(preg_match('/[0-9]*/i', $cpf) && strlen($cpf) == 11){
            $this->cpf = $cpf;
        }else{
            die("CPF inválido");
        }
    }
    
}
