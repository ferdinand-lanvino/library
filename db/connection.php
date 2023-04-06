<?php
class Connection
{
    private static $db;

    private static $host = 'localhost';
    private static $dbname = 'library';
    private static $user = 'root';
    private static $password = 'likmi';

    private static function getDB()
    {
        if (!isset(self::$db)) {
            try {
                self::$db = new PDO("mysql:host=" . self::$host . ";dbname=" . self::$dbname, self::$user, self::$password);
                self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                $error_message = $e->getMessage();
                exit();
            }
        }
        return self::$db;
    }

    public static function executeQuery($query, $params = null)
    {
        $statement = self::getDB()->prepare($query);
        $statement->execute($params);

        $data = [];
        try {
            $data = $statement->fetchAll(PDO::FETCH_ASSOC);
            $statement->closeCursor();
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            exit();
        }
        return $data;
    }
}
