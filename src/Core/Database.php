<?php

namespace App\Core;

use PDO;
use PDOException;
use PDOStatement;

class Database {
    private PDO $connection;

    public function __construct() {
        $config = require __DIR__ . '/../../config.php';
        $dbConfig = $config['db'];

        $dsn = "mysql:host={$dbConfig['host']};dbname={$dbConfig['dbname']};charset={$dbConfig['charset']}";

        $this->connection = new PDO(
            $dsn,
            $dbConfig['user'],
            $dbConfig['pass'],
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]
        );
    }

    public function query(string $sql, array $params = []): PDOStatement {
        $statement = $this->connection->prepare($sql);
        $statement->execute($params);

        return $statement;
    }

    public function fetchAll(string $sql, array $params = []): ?array {
        $result = $this->query($sql, $params)->fetchAll();

        return $result ?: null;
    }

    public function fetchOne(string $sql, array $params = []): ?array {
        $result = $this->query($sql, $params)->fetch();

        return $result === false ? null : $result;
    }
}