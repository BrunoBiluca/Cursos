<?php

/**
 * Check.class [TIPO]
 * Classe responsável por manipular e validar dados do sistema!
 * 
 */
class Check {

    private static $data;
    private static $format;

    public static function Email($email) {
        self::$data = (string) $email;
        self::$format = '/[a-z0-9_\.\-]+@[a-z0-9_\.\-]*[a-z0-9_\.\-]+\.[a-z]{2,4}$/';

        if (preg_match(self::$format, self::$data)) {
            return true;
        } else {
            return false;
        }
    }

    public static function Nome($nome) {
        self::$format = array();
        self::$format['a'] = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜüÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿRr"!@#$%&*()_-+={[}]/?;:.,\\\'<>°ºª';
        self::$format['b'] = 'aaaaaaaceeeeiiiidnoooooouuuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr                                 ';

        //Troca todos os caracteres contidos em a pelos correspondentes em b
        self::$data = strtr(utf8_decode($nome), utf8_decode(self::$format['a']), utf8_decode(self::$format['b']));
        self::$data = strip_tags(trim(self::$data));

        self::$data = str_replace(" ", "-", self::$data);
        self::$data = str_replace(array("-----", "----", "---", "--"), "-", self::$data);

        return strtolower(utf8_encode(self::$data));
    }

    public static function Data($data) {
        self::$format = explode(" ", $data);
        self::$data = explode("/", self::$format[0]);

        if (empty(self::$format[1])) {
            self::$format[1] = date("H:m:i");
        }

        self::$data = self::$data[2] . "-" . self::$data[1] . "-" . self::$data[0] . " " . self::$format[1];

        return self::$data;
    }

    public static function Words($string, $limit, $pointer = null) {
        self::$data = strip_tags(trim($string));
        self::$format = (int) $limit;

        $arrWords = explode(" ", $string);
        $numWords = count($arrWords);
        $newWords = implode(" ", array_slice($arrWords, 0, self::$format));

        $pointer = (empty($pointer) ? '...' : ' ' . $pointer);
        $result = (self::$format < $numWords ? $newWords . $pointer : self::$data);
        return $result;
    }

    public static function CatByName($name) {
        $read = new Read();
        $read->ExecuteRead('ws_categories', "WHERE category_name = :name", "name={$name}");

        if ($read->GetRowCount()) {
            return "Categoria encontrada id = {$read->GetResult()[0]['category_id']}";
        } else {
            return "A categoria {$name} não foi encontrada!";
        }
    }

    public static function UserOnline() {
        $now = date("Y-m-d H:m:i");
        $delUserOnline = new Delete();
        $delUserOnline->ExecuteDelete('ws_siteviews_online', "WHERE online_endview < :now", "now=$now");

        $readUserOnline = new Read();
        $readUserOnline->ExecuteRead('ws_siteviews_online');
        return $readUserOnline->GetRowCount();
    }

    public static function Image($imageURL, $imageDesc, $imageW = null, $imageH = null) {
        self::$data = 'uploads/' . $imageURL;

        if (file_exists(self::$data)) {
            //$path = HOME;
            $image = self::$data;
            return "<img src=\"tim.php?src=/{$image}&w={$imageW}&h={$imageH}\" alt=\"{$imageDesc}\" title=\"{$imageDesc}\" />";
        } else {
            return false;
        }
    }

}
