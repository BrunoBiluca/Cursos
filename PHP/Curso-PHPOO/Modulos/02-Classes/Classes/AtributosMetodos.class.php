<?php

/**
 * AtributosMetodos [TIPO]
 * Descricao
 * 
 */
class AtributosMetodos {
    
    var $nome;
    var $idade;
    var $profissao;
    
    function SetUsuario($nome, $idade, $profissao){
        $this->nome = $nome;
        $this->SetIdade($idade);
        $this->profissao = $profissao;
    }
    
    function GetUsuario(){
        return "Este é {$this->nome} ele tem {$this->idade} anos e trabalha com {$this->profissao}";
    }
    
    function GetClass(){
        echo "<pre>";
        print_r($this);
        echo "</pre>";
    }
    
    function SetIdade($idade){
        if(!is_int($idade)){
            die('A idade fornecida não está correta!');
        }else{
            $this->idade = $idade;
        }
    }
    
    
    
}
