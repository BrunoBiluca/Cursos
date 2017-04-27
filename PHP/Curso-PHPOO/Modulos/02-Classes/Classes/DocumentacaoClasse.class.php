<?php

/**
 * <b>DocumentacaoClass</br>
 * Classe para mostrar como documentar uma classe, seus atributos e seus métodos
 * 
 */
class DocumentacaoClasse {
    
    /** @var Empresa Nome da Empresa */
    public $empresa;
    
    /** @var Setor Atributo que contabiliza o número de funcionarios em cada setor da empresa */
    public $setor;
    
    /** @var InteracaoClass */
    public $funcionario;
    
    function __construct($empresa) {
        $this->empresa = $empresa;
        $this->setor = 0;
    }
    
    /**
     * <b>Contratar:</b> Registra novo funcionário na empresa
     * @param InteracaoObjetos $funcionario Novo funcionário
     * @param string $profissao Profissão ou cargo do funcionário
     * @param float $salario Salário do funcionário
     */
    public function Contratar($funcionario, $profissao, $salario){
        $this->funcionario = $funcionario;
        $this->funcionario->Trabalhar($this->empresa, $profissao, $salario);
    }
    
    /**
     * <b>Pagar:</b> Efetua o pagamento dos funcionários e retorna seu salário
     * @return float
     */
    public function Pagar(){
        $this->funcionario->Receber();
        return $this->funcionario->salario;
    }
    
    public function Promover($cargo, $salario = null) {
        $this->funcionario->profissao = $cargo;
        
        if($salario):
            $this->funcionario->salario = $salario;
        endif;
    }
    
    public function Demitir($recisao){
        $this->funcionario->empresa = null;
        $this->funcionario->salario = null;
        $this->funcionario->contaSalario += $recisao;
        $this->funcionario = null;
    }

}
