<?php

/**
 * Delete.class.php [TIPO]
 * Descricao
 * 
 */
class Delete extends Conn {

    private $tabela;
    private $places;
    private $termos;
    private $result;

    /** @var PDOStatement */
    private $delete;

    /** @var PDO */
    private $conn;

    public function ExecuteDelete($tabela, $termos, $parseString) {
        $this->tabela = $tabela;
        $this->termos = $termos;
        
        parse_str($parseString, $this->places);
        
        $this->GetSyntax();
        $this->Execute();
    }

    public function GetResult() {
        return $this->result;
    }
    
    public function GetRowCount(){
        return $this->delete->rowCount();
    }

    
    public function SetPlaces($parseString){
        parse_str($parseString, $this->places);
        $this->GetSyntax();
        $this->Execute();
    }

    private function Connect() {
        $this->conn = parent::GetConn();
        $this->delete = $this->conn->prepare($this->delete);
    }
    
    private function GetSyntax() {
        $this->delete = "DELETE FROM {$this->tabela} {$this->termos}";
    }

    //O parâmetro que é passado no execute do PDO informa os valores dos campos cujos os índices batem com os já existentes no banco de dados
    private function Execute() {
        $this->conn = $this->Connect();
        try {
            $this->delete->execute($this->places);
            $this->result = true;
        } catch (PDOException $e) {
            $this->result = null;
            WSErro("<b>Erro ao deletar:</b> {$e->getMessage()}", $e->getCode());
        }
    }

}
