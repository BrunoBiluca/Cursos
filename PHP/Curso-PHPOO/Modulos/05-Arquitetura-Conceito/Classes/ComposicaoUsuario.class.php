<?php

/**
 * ComposicaoUsuario.class [TIPO]
 * Descricao
 * 
 */
class ComposicaoUsuario {

    public $nome;
    public $email;
    private $endereco;
    
    function __construct($nome, $email) {
        $this->nome = $nome;
        $this->email = $email;
    }
    
    public function CadastrarEndereco($cidade, $estado){
        $this->endereco = new ComposicaoEndereco($cidade, $estado);
    }
    
    /** @return ComposicaoEndereco */
    function getEndereco() {
        return $this->endereco;
    }



    
    
}
