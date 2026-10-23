<?php

namespace App\Models;

use App\Core\Database;

class Post extends BaseModel {
    public function __construct(Database $database) {
        parent::__construct($database, 'posts');
    }

    public function search(string $search): ?array {
        return $this->database->fetchAll(
            "SELECT * FROM posts WHERE title LIKE :title_search OR category LIKE :category_search",
            [
                'title_search' => '%' . $search . '%',
                'category_search' => '%' . $search . '%'
            ]
        );
    }

    public function getById(int $id): ?array {
        return $this->database->fetchOne(
            "SELECT * FROM posts WHERE id = :id",
            ['id' => $id]
        );
    }
}