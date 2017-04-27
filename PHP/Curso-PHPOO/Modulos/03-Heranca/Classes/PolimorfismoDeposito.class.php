<?php

/**
 * PolimorfismoDeposito [TIPO]
 * Descricao
 * 
 */
class PolimorfismoDeposito extends Polimorfismo{
    
    public $desconto;
    
    function __construct($produto, $valor) {
        parent::__construct($produto, $valor);
        $this->desconto = 15;
        $this->metodo = "Depósito";
    }
    
    function setDesconto($desconto) {
        $this->desconto = $desconto;
    }
    
    /**
     * Função que sobreescreve o método da classe pai
     * OverRide, método tem a mesma entrada que o método pai, porém seu processamento é diferente;
     */
    public function Pagar(){
        $this->valor = $this->valor - (($this->valor * $this->desconto) / 100);
        parent::Pagar();
    }

    
}
