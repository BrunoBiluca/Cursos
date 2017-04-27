<?php

/**
 * View.class [ HELPER MVC ]
 * Reponsável por carregar o template, povoar e exibir a view, povoar e incluir arquivos PHP no sistem.
 * Arquitetura MVC!
 */
class View {

    private static $Data;
    private static $Keys;
    private static $Values;
    private static $Template;

    /**
     * <b>Carregar Template View:</b> informe o caminho e o nome do arquivo que deseja carregar como view.
     * Não precisa informar extenção. O arquivo deve ter o formato view<b>.tpl.html</b>
     * @param STRING $Template = Caminho / Nome_do_arquivo
     */
    public static function Load($Template) {
        self::$Template = (string) $Template;
        self::$Template = file_get_contents(self::$Template . '.tpl.html');
    }

    /**
     * <b>Exibir Template View:</b> Execute um foreach com um getResult() do seu model e informe o envelope
     * neste método para configurar a view. Não esqueça de carregar a view acima do foreach com o método Load.
     * @param array $Data = Array com dados obtidos
     */
    public static function Show(array $Data) {
        self::setKeys($Data);
        self::setValues();
        self::ShowView();
    }

    /**
     * <b>Carregar PHP View:</b> Tendo um arquivo PHP com echo em variáveis extraídas, utilize esse método
     * para incluir, povoar e exibir o mesmo. Basta informar o caminho do arquivo<b>.inc.php</b> e um
     * envelope de dados dentro de um foreach!
     * @param STRING $File = Caminho / Nome_do_arquivo
     * @param ARRAY $Data = Array com dados obtidos
     */
    public static function Request($File, array $Data) {
        extract($Data);
        require("{$File}.inc.php");
    }

    /*
     * ***************************************
     * **********  PRIVATE METHODS  **********
     * ***************************************
     */

    //Executa o tratamento dos campos para substituição de chaves na view.
    private static function setKeys($Data) {
        self::$Data = $Data;
        self::$Keys = explode('&', '#' . implode("#&#", array_keys(self::$Data)) . '#');
    }

    //Obtém os valores a serem inseridos nas chaves da view.
    private static function setValues() {
        self::$Values = array_values(self::$Data);
    }

    //Exibe o template view com echo!
    private static function ShowView() {
        echo str_replace(self::$Keys, self::$Values, self::$Template);
    }

}
