<?php
namespace src;

use PDO;

class DataBase{
    protected $pdo;

    public function __construct()
    {
        $dsn ="{$_ENV['DB_TYPE']}:host={$_ENV['DB_HOST']};dbname={$_ENV['DB_NAME']};charset={$_ENV['DB_CHARSET']}";
        $username = $_ENV['DB_USERNAME'];
        $password = $_ENV['DB_PASSWORD'];
        $this->pdo = new PDO($dsn, $username, $password,
            array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,pdo::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC)
        );
    }
    public function Query (string $sql, array $params = null, bool $fetchAll = true)
    {
        $stmt = $this->pdo->prepare($sql);

        if ($params !== null) {
            $success = $stmt->execute($params);
        } else {
            $success = $stmt->execute();
        }
        if ($fetchAll) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return $success;
        }
    }
}
