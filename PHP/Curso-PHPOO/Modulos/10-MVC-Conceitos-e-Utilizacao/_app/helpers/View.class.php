<?php

/**
 * View.class [TIPO]
 * Descricao
 * 
 */
class View {

    private static $data;
    private static $keys;
    private static $values;
    private static $template;
    
    public static function Load($template) {
        self::$template = (string) $template;
        self::$template = file_get_contents(self::$template . ".template.html");
    }
    
    public static function Show(array $data) {
        self::SetKeys($data);
        self::SetValues();
        self::ShowView();
    }
    
    public static function Request($file, array $data) {
        extract($data);
        require ("{$file}.include.php");
    }
    
    private static function SetKeys($data) {
        self::$data = $data;
        self::$keys = explode("&", "#" . implode("#&#", array_keys($data)) . "#");
    }
    
    private static function SetValues() {
        self::$values = array_values(self::$data);
    }
    
    private static function ShowView() {
        echo str_replace(self::$keys, self::$values, self::$template);
    }
    
    
}
