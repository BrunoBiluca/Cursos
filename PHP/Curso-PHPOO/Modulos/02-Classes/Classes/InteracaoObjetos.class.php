<?php

/**
 * InteracaoObjetos [TIPO]
 * Descricao
 * 
 */
class InteracaoObjetos {
    
    public $empresa;
    public $setor;
    
    /** @var InteracaoClass */
    public $funcionario;
    
    function __construct($empresa) {
        $this->empresa = $empresa;
        $this->setor = 0;
    }
    
    public function Contratar($funcionario, $profissao, $salario){
        $this->funcionario = $funcionario;
        $this->funcionario->Trabalhar($this->empresa, $profissao, $salario);
    }
    
    public function Pagar(){
        $this->funcionario->Receber();
    }
    
    public function Promover($cargo, $salario = null) {
        $this->funcionario->profissao = $cargo;
        
        if($salario):
            $this->funcionario->salario = $salario;
        endif;
    }
    
    public function Demitir($recisao){
        $this->funcionario->empresa = null;
        $this->funcionario->salario = null;
        $this->funcionario->contaSalario += $recisao;
        $this->funcionario = null;
    }
    

}
