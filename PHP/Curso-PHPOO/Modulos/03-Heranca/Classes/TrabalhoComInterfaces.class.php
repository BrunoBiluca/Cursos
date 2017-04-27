<?php

/**
 * TrabalhoComInterfaces [TIPO]
 * Descricao
 * 
 */
class TrabalhoComInterfaces implements IAluno{
    public $aluno;
    public $curso;
    public $formacao;
    
    function __construct($aluno, $curso) {
        $this->aluno = $aluno;
        $this->curso = $curso;
        $this->formacao = array();
    }

    public function Formar() {
        $this->formacao[] = $this->curso;
        echo "O aluno {$this->aluno} formou no curso de {$this->curso}!<br>";
    }

    public function Matricular($curso) {
        $this->curso = $curso;
        echo "{$this->aluno} matriculou no curso de {$this->curso}<br>";
    }

}
