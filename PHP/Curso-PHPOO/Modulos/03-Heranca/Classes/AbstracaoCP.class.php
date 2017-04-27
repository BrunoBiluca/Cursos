<?php

/**
 * AbstracaoCP.class.php [TIPO]
 * Descricao
 * 
 */
class AbstracaoCP extends AbstracaoCC{

    public $rendimentos;
    
    public function __construct($cliente, $saldo) {
        parent::__construct($cliente, $saldo, 0);
        $this->conta = "Conta Poupança";
        $this->rendimentos = 1.7;
    }
    
    final public function Depositar($valor) {
        $juros = $valor * $this->rendimentos / 100;
        $deposito = $valor + $juros;
        parent::Depositar($deposito);
        echo "<small style='color:#09f'>Valor do depósito {$this->formatoReal($valor)} || Valor do rendimento {$this->formatoReal($juros)}</small><br>";
    }
    
}
