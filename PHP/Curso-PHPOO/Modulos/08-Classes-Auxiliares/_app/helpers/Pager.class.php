<?php

/**
 * Pager [Helper]
 * Classe que faz a paginação dos resultados no site
 * 
 */
class Pager {

    /** DEFINE O PAGER */
    private $page;
    private $limit;
    private $offset;

    /** Realiza a leitura */
    private $tabela;
    private $termos;
    private $places;

    /** Define o paginador */
    private $rows;
    private $link;
    private $maxLinks;
    private $first;
    private $last;

    /** Renderiza o paginador */
    private $paginator;

    function __construct($link, $first = null, $last = null, $maxLinks = null) {
        $this->link = (string) $link;
        $this->first = ((string) $first ? $first : "Primeira Página");
        $this->last = ((string) $last ? $last : "Última Página");
        $this->maxLinks = ((int) $maxLinks ? $maxLinks : 5);
    }

    public function ExecutaPager($page, $limit) {
        $this->page = ((int) $page ? $page : 1);
        $this->limit = (int) $limit;
        $this->offset = ($this->page * $this->limit) - $this->limit;
    }

    public function RetornaPagina() {
        if ($this->page > 1) {
            $nPage = $this->page - 1;
            header("Location: {$this->link}{$nPage}");
        }
    }

    public function GetPage() {
        return $this->page;
    }

    public function GetLimit() {
        return $this->limit;
    }

    public function GetOffset() {
        return $this->offset;
    }

    public function ExecutaPaginator($tabela, $termos = null, $parseString = null) {
        $this->tabela = (string) $tabela;
        $this->termos = (string) $termos;
        $this->places = (string) $parseString;
        $this->GetSyntax();
    }

    public function GetPaginator() {
        return $this->paginator;
    }

    private function GetSyntax() {
        $read = new Read();
        $read->ExecuteRead($this->tabela, $this->termos, $this->places);
        $this->rows = $read->GetRowCount();
        
        if ($this->rows > $this->limit) {
            $paginas = ceil($this->rows / $this->limit);

            $this->paginator = "<ul class=\"paginator\">";
            $this->paginator .= "<li><a title=\"{$this->first}\" href=\"{$this->link}1\">{$this->first}</a></li>";

            for ($iPag = $this->page - $this->maxLinks; $iPag < $this->page; $iPag++) {
                if ($iPag >= 1) {
                    $this->paginator .= "<li><a title=\"Página {$iPag}\" href=\"{$this->link}{$iPag}\">{$iPag}</a></li>";
                }
            }
            $this->paginator .= "<li><span class=\"active\">{$this->page}</span></li>"; 
            for ($dPag = $this->page + 1; $dPag <= $this->page + $this->maxLinks; $dPag++) {
                if ($dPag <= $paginas) {
                    $this->paginator .= "<li><a title=\"Página {$dPag}\" href=\"{$this->link}{$dPag}\">{$dPag}</a></li>";
                }
            }

            $this->paginator .= "<li><a title=\"{$this->last}\" href=\"{$this->link}{$paginas}\">{$this->last}</a></li>";
            $this->paginator .= "</ul>";
        }
    }

}
