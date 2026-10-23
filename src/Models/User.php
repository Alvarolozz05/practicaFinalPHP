<?php

namespace App\Models;

use App\Core\Database;

class User extends BaseModel {
    public function __construct(Database $database) {
        parent::__construct($database, 'users');
    }

    public function findByEmail(string $email, string $password): ?int {
        $user = $this->database->fetchOne(
            "SELECT * FROM users WHERE email = :email",
            ['email' => $email]
        );

        if ($user !== null && password_verify($password, $user['password'])) {
            return (int) $user['id'];
        }

        return null;
    }
}