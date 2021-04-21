<?php
class Database
{
    private static function connect()
    {
        $pdo = new PDO("mysql:host=127.0.0.1;dbname=db_events;charset=utf8", "root", "");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $pdo;
    }
    public function executeQuery(String $query, array $params)
    {
        $statement = self::connect()->prepare($query);
        $statement->execute($params);

        if (explode(' ', $query)[0] == "SELECT") {
            $data = $statement->fetchAll();

            return $data;
        }
    }
}
