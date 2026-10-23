<?php

namespace App\Models;

use App\Core\Database;

abstract class BaseModel {
    protected Database $database;
    protected string $table;

    public function __construct(Database $database, string $table) {
        $this->database = $database;
        $this->table = $table;
    }

    public function getAll(): ?array {
        $result = $this->database->fetchAll(
            "SELECT * FROM {$this->table}"
        );

        return $result ?: null;
    }

    public function getById(int $id): ?array {
        return $this->database->fetchOne(
            "SELECT * FROM {$this->table} WHERE id = :id",
            ['id' => $id]
        );
    }

    public function delete(int $id): void {
        $this->database->query(
            "DELETE FROM {$this->table} WHERE id = :id",
            ['id' => $id]
        );
    }

    public function insert(array $data): void {
        $columns = array_keys($data);
        $placeholders = array_map(
            fn(string $column): string => ':' . $column,
            $columns
        );

        $sql = "INSERT INTO {$this->table} (" . implode(', ', $columns) . ") VALUES (" . implode(', ', $placeholders) . ")";

        $this->database->query($sql, $data);
    }

    public function update(int $id, array $data): void {
        $fields = [];

        foreach (array_keys($data) as $column) {
            $fields[] = "{$column} = :{$column}";
        }

        $data['id'] = $id;
        $sql = "UPDATE {$this->table} SET " . implode(', ', $fields) . " WHERE id = :id";

        $this->database->query($sql, $data);
    }
}