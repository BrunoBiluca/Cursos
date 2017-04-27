<?php

/**
 * ReplicaClonagem.class [TIPO]
 * Descricao
 * 
 */
class ReplicaClonagem {

    var $tabela;
    var $termos;
    var $addQuery;
    var $query;
    
    function setTabela($tabela) {
        $this->tabela = $tabela;
    }

    function setTermos($termos) {
        $this->termos = $termos;
    }

    function __construct($tabela, $termos, $addQuery) {
        $this->tabela = $tabela;
        $this->termos = $termos;
        $this->addQuery = $addQuery;
    }

    function LerQuery() {
        $this->query = "SELECT * FROM {$this->tabela} WHERE {$this->termos} {$this->addQuery}";
        echo "{$this->query} <hr>";
    }

}
