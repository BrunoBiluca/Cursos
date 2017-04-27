<?php

/**
 * HerancaJuridica [TIPO]
 * Descricao
 * 
 */
class HerancaJuridica extends Heranca{
    
    public $empresa;
    public $funcionarios;
    
    function __construct($nome, $idade, $empresa) {
        parent::__construct($nome, $idade);
        $this->empresa = $empresa;
        $this->funcionarios = 0;
    }
    
    public function Contratar($funcionario){
        echo "A empresa {$this->empresa} de {$this->nome} contratou {$funcionario}! <hr>";
        $this->funcionarios += 1;
    }

    public function VerEmpresa(){
        echo "A empresa {$this->empresa} foi fundada por {$this->nome} e tem {$this->funcionarios} <br><small style='color:#09f'>";
        parent::VerPessoa();
        echo "</small>";
    }
    
}
