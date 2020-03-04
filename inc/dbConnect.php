<?php
/*
*     Author              :  Fujise Thomas.
*     Project             :  AList.
*     Page                :  dbConnect.php.
*     Brief               :  Object Edatabase for database connection.
*     Starting Date       :  05.02.2020.
*/
require_once dirname(__DIR__) . '/config/config.php';
/**
 * Object EDatabase
 */
class EDatabase
{
    private static $db;
    private function __construct() {}
    private function __clone() {}
    public static function getDb()
    {
        if (!self::$db) {
            try {
                $dsn = DB_DBTYPE . ':host=' . DB_HOST . ';port=' . DB_PORT . ';dbname=' . DB_NAME . ';charset=utf8';
                self::$db = new PDO($dsn, DB_USER, DB_PASS);
                self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo "EDatabase Error: " . $e;
            }
        }
        return self::$db;
    }
}
