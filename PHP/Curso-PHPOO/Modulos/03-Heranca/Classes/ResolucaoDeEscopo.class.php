<?php

/**
 * ResolucaoDeEscopo.class.php [TIPO]
 * Descricao
 * 
 */
class ResolucaoDeEscopo{

    public $produto;
    public $valor;
    public static $vendas;
    public static $lucro;
    
    function __construct($produto, $valor) {
        $this->produto = $produto;
        $this->valor = $valor;
    }
    
    public function Vender(){
        self::$vendas += 1;
        self::$lucro += $this->valor;
        echo "O {$this->produto} foi vendido por {$this->valor} <br>";
    }
    
    public static function Relatorio(){
        echo "<hr>";
        echo "Este produto vendeu " .self::$vendas. " unidade(s). Total de lucro R$ " . self::$lucro . ".";
        echo "<hr>";
    }

    
    
}
