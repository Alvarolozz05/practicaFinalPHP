<?php

namespace App\Models;

use App\Core\Database;

class Comment extends BaseModel {
    public function __construct(Database $database) {
        parent::__construct($database, 'comments');
    }

    public function getByPostId(int $postId): ?array {
        return $this->database->fetchAll(
            "SELECT * FROM comments WHERE post_id = :post_id ORDER BY created_at ASC",
            ['post_id' => $postId]
        );
    }
}