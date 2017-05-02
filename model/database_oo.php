<?php
class Database {
    private static $dsn = 'mysql:host=localhost;dbname=tech_support';
    private static $username = 'root';
    private static $password = '';
    private static $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
    private static $db;

    private function __construct() {}
    
    public static function getDB() {
        if(!isset(self::$db)) {
            try {
                self::$db = new PDO(self::$dsn,
                                    self::$username,
                                    self::$password,
                                    self::$options);
            } catch (PDOException $e) {
                $error_message = $e->getMessage();
                include('../errors/database_error.php');
                exit();
            }
        }
        return self::$db;
    }
    
    public static function display_db_error($error_message) {
        global $app_path;
        include('../errors/database_error.php');
        exit();
    }
}