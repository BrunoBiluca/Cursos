<?php

/**
 * Create.class.php [TIPO]
 * Descricao
 * 
 */
class Create extends Conn {

    private $tabela;
    private $dados;
    private $result;

    /** @var PDOStatement */
    private $create;

    /** @var PDO */
    private $conn;

    public function ExecuteCreate($tabela, array $dados) {
        $this->tabela = (string) $tabela;
        $this->dados = $dados;

        $this->GetSyntax();
        $this->Execute();
    }

    public function GetResult() {
        return $this->result;
    }

    private function Connect() {
        $this->conn = parent::GetConn();
        $this->create = $this->conn->prepare($this->create);
    }

    private function GetSyntax() {
        $fields = implode(', ', array_keys($this->dados));
        $places = ':' . implode(', :', array_keys($this->dados));
        $this->create = "INSERT INTO {$this->tabela} ({$fields}) VALUES ({$places})";
    }

    private function Execute() {
        $this->Connect();
        try {
            $this->create->execute($this->dados);
            $this->result = $this->conn->lastInsertId();
        } catch (PDOException $e) {
            WSErro("<b>Erro ao cadastrar:</b> {$e->getMessage()}", $e->getCode());
        }
    }

}
