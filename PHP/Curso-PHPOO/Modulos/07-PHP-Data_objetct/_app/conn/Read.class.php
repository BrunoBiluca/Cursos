<?php

/**
 * Read.class.php [TIPO]
 * Descricao
 * 
 */
class Read extends Conn {

    private $places;
    private $select;
    private $result;

    /** @var PDOStatement */
    private $read;

    /** @var PDO */
    private $conn;

    public function ExecuteRead($tabela, $termos = null, $parseString = null) {
        if (!empty($parseString)) {
            parse_str($parseString, $this->places);
        }

        $this->select = "SELECT * FROM {$tabela} {$termos}";
        $this->Execute();
    }

    public function GetResult() {
        return $this->result;
    }
    
    public function GetRowCount(){
        return $this->read->rowCount();
    }
    
    public function FullRead($query, $parseString = null) {
        $this->select = (string) $query;
        if(!empty($parseString)){
            $this->places = $parseString;
        }
        $this->Execute();
    }
    
    public function SetPlacas($parseString){
        parse_str($parseString, $this->places);
        $this->Execute();
    }

    private function Connect() {
        $this->conn = parent::GetConn();
        $this->read = $this->conn->prepare($this->select);
        $this->read->setFetchMode(PDO::FETCH_ASSOC);
    }

    private function GetSyntax() {
        if (!empty($this->places)) {
            foreach ($this->places as $vinculo => $valor) {
                if ($vinculo == 'limit' || $vinculo == 'offset') {
                    $valor = (int) $valor;
                }
                $this->read->bindValue(":{$vinculo}", $valor, (is_int($valor) ? PDO::PARAM_INT : PDO::PARAM_STR));
            }
        }
    }

    private function Execute() {
        $this->conn = $this->Connect();
        try {
            $this->GetSyntax();
            $this->read->execute();
            $this->result = $this->read->fetchAll();
        } catch (PDOException $e) {
            $this->result = null;
            WSErro("<b>Erro ao ler:</b> {$e->getMessage()}", $e->getCode());
        }
    }

}
