<?php

namespace App\Controllers;

use App\Core\Database;
use App\Models\User;
use PDOException;

class AuthController {
    private User $user;

    public function __construct(Database $database) {
        $this->user = new User($database);
    }

    public function showRegisterForm(): void {
        require __DIR__ . '/../Views/register.php';
    }
    
    public function register(): void {
        if (!isset($_SESSION['csrf_token'], $_POST['csrf_token']) ||
            !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
            http_response_code(403);
            exit('Token CSRF no válido');
        }

        $email = trim($_POST['email'] ?? '');
        $username = trim($_POST['username'] ?? '');
        $password = $_POST['password'] ?? '';

        if ($email === '' || $username === '' || $password === '') {
            header('Location: /register?message=Completa todos los campos');
            exit;
        }

        try {
            $this->user->insert([
                'username' => $username,
                'email' => $email,
                'password' => password_hash($password, PASSWORD_DEFAULT)
            ]);
        } catch (PDOException $exception) {
            if ($exception->getCode() === '23000') {
                header('Location: /register?message=El correo o el nombre de usuario ya está registrado');
                exit;
            }

            throw $exception;
        }

        header('Location: /');
        exit;
    }

    public function showLoginForm(): void {
        require __DIR__ . '/../Views/login.php';
    }

    public function login(): void {
        if (!isset($_SESSION['csrf_token'], $_POST['csrf_token']) ||
            !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
            http_response_code(403);
            exit('Token CSRF no válido');
        }

        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        $id = $this->user->findByEmail($email, $password);

        if ($id !== null) {
            $_SESSION['id'] = $id;
            $_SESSION['email'] = $email;

            header('Location: /');
            exit;
        }

        header('Location: /login?message=Correo o contraseña incorrectos');
        exit;
    }

    public function logout(): void {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        session_destroy();

        header('Location: /');
        exit;
    }
}