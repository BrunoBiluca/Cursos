<?php

/**
 * PolimorfismoCartao [TIPO]
 * Descricao
 * 
 */
class PolimorfismoCartao extends Polimorfismo{
    
    public $juros;
    public $encargos;
    public $parcela;
    public $numParcelas;
    
    public function __construct($produto, $valor) {
        parent::__construct($produto, $valor);
        
        $this->juros = 1.17;
        $this->metodo = "Cartão de Crédito";
    }
    
    /**
     * Exemplo: Para 5,5% informe 5.5
     * @param type $juros
     */
    function setJuros($juros) {
        $this->juros = $juros;
    }

    function setEncargos() {
        $this->encargos = $this->valor * ($this->juros / 100) * $this->numParcelas;
    }

    function setNumParcelas($numParcelas) {
        
        $this->numParcelas = ((int) $numParcelas >= 1 ? $numParcelas : 1);
    }
    
    /**
     * Método que sobreescreve o método Pagar da classe Pai
     * OverLoad, método tem a entrada de dados diferente do método pai
     * @param type $numParcelas
     */
    function Pagar($numParcelas = null) {
        $this->setNumParcelas($numParcelas);
        $this->setEncargos();
        
        $this->valor = $this->valor + $this->encargos;
        $this->parcela = $this->valor / $this->numParcelas;
        
        echo "Você comprou o produto {$this->produto} por {$this->valor}<br>";
        echo "<small>Seu método de pagamento foi efetuado via {$this->metodo} em {$this->numParcelas}x parcelas de {$this->formatoReal($this->parcela)}. </small> <hr>";
    }


    
}
