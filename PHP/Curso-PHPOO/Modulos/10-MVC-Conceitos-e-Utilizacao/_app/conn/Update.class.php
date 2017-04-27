<?php

/**
 * Update.class.php [TIPO]
 * Descricao
 * 
 */
class Update extends Conn {

    private $tabela;
    private $dados;
    private $places;
    private $termos;
    private $result;

    /** @var PDOStatement */
    private $update;

    /** @var PDO */
    private $conn;

    public function ExecuteUpdate($tabela, array $dados, $termos, $parseString) {
        $this->tabela = $tabela;
        $this->dados = $dados;
        $this->termos = $termos;

        parse_str($parseString, $this->places);
        
        $this->GetSyntax();
        $this->Execute();
    }

    public function GetResult() {
        return $this->result;
    }
    
    public function GetRowCount(){
        return $this->update->rowCount();
    }

    
    public function SetPlaces($parseString){
        parse_str($parseString, $this->places);
        $this->GetSyntax();
        $this->Execute();
    }

    private function Connect() {
        $this->conn = parent::GetConn();
        $this->update = $this->conn->prepare($this->update);
    }
    
    private function GetSyntax() {
        foreach ($this->dados as $chave => $valor) {
            $places[] = $chave . ' = :' . $chave;
        }
        $places = implode(", ", $places);
        $this->update = "UPDATE {$this->tabela} SET {$places} {$this->termos}";
    }

    //O parâmetro que é passado no execute do PDO informa os valores dos campos cujos os índices batem com os já existentes no banco de dados
    private function Execute() {
        $this->conn = $this->Connect();
        try {
            $this->update->execute(array_merge($this->dados, $this->places));
            $this->result = true;
        } catch (PDOException $e) {
            $this->result = null;
            WSErro("<b>Erro ao atualizar:</b> {$e->getMessage()}", $e->getCode());
        }
    }

}
