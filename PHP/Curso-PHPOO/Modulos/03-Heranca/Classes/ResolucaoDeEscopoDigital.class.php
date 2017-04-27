<?php

/**
 * ResolucaoDeEscopoDigital.class [TIPO]
 * Descricao
 * 
 */
class ResolucaoDeEscopoDigital extends ResolucaoDeEscopo{

    public static $digital;
    
    public function Vender() {
        self::$digital += 1;
        parent::Vender();
    }
    
}
