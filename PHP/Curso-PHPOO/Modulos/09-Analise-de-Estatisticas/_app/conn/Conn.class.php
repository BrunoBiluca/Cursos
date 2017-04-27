<?php

/**
 * conn.class [TIPO]
 * Descricao
 * 
 */
class Conn {

    private static $host = HOST;
    private static $user = USER;
    private static $pass = PASS;
    private static $dbsa = DBSA;

    /** @var PDO */
    private static $connect = null;

    /**
     * Conecta a um banco de dados com o patter Singleton.
     * Retorna um objeto PDO
     */
    private function Conectar() {

        try {

            if (self::$connect == null) {
                $dsn = 'mysql:host=' . self::$host . ';dbname=' . self::$dbsa;
                $options = [ PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8'];
                self::$connect = new PDO($dsn, self::$user, self::$pass, $options);
            }
        } catch (PDOException $e) {
            PHPErro($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
            die;
        }
        
        self::$connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        return self::$connect;
    }

    /** Retorna um objeto PDO Singleton Patter */
    public function GetConn() {
        return self::Conectar();
    }

}
