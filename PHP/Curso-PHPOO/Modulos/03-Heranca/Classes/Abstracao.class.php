<?php

/**
 * Abstracao.class.php [TIPO]
 * Classe super classe abstrata para ser herdada por outras classes tipo conta
 * 
 */
abstract class Abstracao {

    public $cliente;
    public $conta;
    public $saldo;

    function __construct($cliente, $saldo) {
        $this->cliente = $cliente;
        $this->saldo = $saldo;
    }

    public function Sacar($valor) {
        $this->saldo -= $valor;
        echo "<span style='color:red'><b>{$this->conta}:</b> Saque de {$this->formatoReal($valor)} efetuado com sucesso!</span> <br>";
    }

    public function Depositar($valor) {
        $this->saldo += $valor;
        echo "<span style='color:green'><b>{$this->conta}:</b> Depósito de {$this->formatoReal($valor)} efetuado com sucesso!</span> <br>";
    }

    /**
     * Método que gerencia a transferência de valores entre contas
     * @param float $valor
     * @param Abstracao $destino
     */
    public function Transferir($valor, $destino) {
        if ($this === $destino): //Não pode transferir para a mesma conta
            echo "Você não pode transferir valores para a mesma conta";
        else:
            $this->Sacar($valor);
            $destino->Depositar($valor);
            echo "<span style='color:blue'><b>{$this->conta}:</b> Transferência de {$this->formatoReal($valor)} efetuado com sucesso de {$this->cliente} para {$destino->cliente}!</span> <br>";
        endif;
    }

    public function Extrato() {
        echo "<hr><hr> Olá {$this->cliente}. Seu saldo na conta {$this->conta} é de {$this->saldo}.";
    }

    public function formatoReal($valor) {
        return "R$ " . number_format($valor, 2, ",", ".");
    }
    
    abstract public function VerSaldo();

}
