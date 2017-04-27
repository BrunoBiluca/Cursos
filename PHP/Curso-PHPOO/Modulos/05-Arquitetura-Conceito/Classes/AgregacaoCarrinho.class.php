<?php

/**
 * AgregacaoCarrinho.class [TIPO]
 * Descricao
 * 
 */
class AgregacaoCarrinho {

    private $cliente;
    private $produtos;
    private $total;
    
    public function __construct(AssociacaoCliente $cliente) {
        $this->cliente = $cliente;
    }

    public function Add(AgregacaoProduto $produto){
        $this->produtos[$produto->getProduto()] = $produto;
        $this->total += $produto->getValor();
        $this->VerCarrinho($produto, "adicionou");
    }
    
    public function Remover(AgregacaoProduto $produto) {
        unset($this->produtos[$produto->getProduto()]);
        $this->total -= $produto->getValor();
        $this->VerCarrinho($produto, "removeu");
    }
    
    public function VerCarrinho(AgregacaoProduto $produto, $action){
        echo "Você {$action} um curso {$produto->getNome()} em seu carrinho. Valor total no carrinho {$this->total} <hr>";
    }
    
    
}
