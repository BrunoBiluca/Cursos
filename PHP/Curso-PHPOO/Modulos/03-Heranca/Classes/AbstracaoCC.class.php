<?php

/**
 * AbstracaoCC.class.php [TIPO]
 * Descricao
 * 
 */
class AbstracaoCC extends Abstracao {
    
    public $limite;
    
    public function __construct($cliente, $saldo, $limite) {
        parent::__construct($cliente, $saldo);
        $this->conta = "Conta Corrente";
        $this->limite = $limite;
    }
    
    final public function Sacar($valor) {
        if($this->saldo + $this->limite >= $valor):
            parent::Sacar($valor);
        else:
            echo "<span style='color:red'><b>{$this->conta}:</b> Saque de {$this->formatoReal($valor)} não foi possível, saldo e limites insuficientes!</span> <br>";
        endif;
        
    }
    
    final public function Transferir($valor, $destino){
        if($this->saldo + $this->limite >= $valor):
            parent::Transferir($valor, $destino);
        else:
            echo "<span style='color:red'><b>{$this->conta}:</b> Trasnferência de {$this->formatoReal($valor)} não foi possível, saldo e limites insuficientes!</span> <br>";
        endif;
    }

    public function VerSaldo() {
        parent::Extrato();
    }

}
