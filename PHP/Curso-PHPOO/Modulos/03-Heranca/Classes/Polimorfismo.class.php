<?php

/**
 * Polimorfismo.class.php [TIPO]
 * Descricao
 * 
 */
class Polimorfismo {

    public $produto;
    public $valor;
    public $metodo;
    
    function __construct($produto, $valor) {
        $this->produto = $produto;
        $this->valor = $valor;
        $this->metodo = "Boleto";
    }
    
    public function Pagar(){
        echo "Você comprou o produto {$this->produto} por {$this->valor}<br>";
        echo "<small>Seu método de pagamento foi por {$this->metodo}</small> <hr>";
    }
    
    public function formatoReal($valor){
        return "R$ ".number_format($valor,'2', '.', ',');
    }

    
}
