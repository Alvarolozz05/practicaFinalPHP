<?php

namespace App\Controllers;

use App\Core\Database;
use App\Models\Post;
use App\Models\Comment;

class PostController {
    private Post $post;
    private Comment $comment;

    public function __construct(Database $database) {
        $this->post = new Post($database);
        $this->comment = new Comment($database);

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function index(): void {
        $search = trim($_GET['search'] ?? '');

        if ($search !== '') {
            $posts = $this->post->search($search);
        } else {
            $posts = $this->post->getAll();
        }

        require __DIR__ . '/../Views/posts.php';
    }

    public function show(int $id): void {
        $post = $this->post->getById($id);
        $comments = $this->comment->getByPostId($id);
        
        if ($post === null) {
            http_response_code(404);
            echo 'Publicación no encontrada';
            return;
        }

        require __DIR__ . '/../Views/post.php';
    }

    public function create(): void {
        if (!isset($_SESSION['id'])) {
            header('Location: /login?message=Debes iniciar sesión para publicar');
            exit;
        }

        require __DIR__ . '/../Views/post-create.php';
    }

    public function store(): void {
        if (!isset($_SESSION['csrf_token'], $_POST['csrf_token']) ||
            !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
            http_response_code(403);
            exit('Token CSRF no válido');
        }

        if (!isset($_SESSION['id'])) {
            header('Location: /login?message=Debes iniciar sesión para publicar');
            exit;
        }

        $this->post->insert([
            'user_id' => $_SESSION['id'],
            'title' => trim($_POST['title'] ?? ''),
            'category' => trim($_POST['category'] ?? ''),
            'content' => trim($_POST['content'] ?? '')
        ]);

        header('Location: /posts');
        exit;
    }

    public function edit(int $id): void {
        $post = $this->post->getById($id);

        if ($post === null) {
            http_response_code(404);
            echo 'Publicación no encontrada';
            return;
        }

        if ((int) $post['user_id'] !== (int) $_SESSION['id']) {
            http_response_code(403);
            echo 'Prohibido';
            return;
        }

        require __DIR__ . '/../Views/post-edit.php';
    }

    public function update(int $id): void {
        if (!isset($_SESSION['csrf_token'], $_POST['csrf_token']) ||
            !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
            http_response_code(403);
            exit('Token CSRF no válido');
        }
    
        $post = $this->post->getById($id);

        if ($post === null) {
            http_response_code(404);
            echo 'Publicación no encontrada';
            return;
        }

        if (!isset($_SESSION['id']) || (int) $post['user_id'] !== (int) $_SESSION['id']) {
            http_response_code(403);
            echo 'Prohibido';
            return;
        }

        $this->post->update($id, [
            'title' => trim($_POST['title'] ?? ''),
            'category' => trim($_POST['category'] ?? ''),
            'content' => trim($_POST['content'] ?? '')
        ]);

        header('Location: /posts/' . $id);
        exit;
    }

    public function destroy(int $id): void {
        if (!isset($_SESSION['csrf_token'], $_POST['csrf_token']) ||
            !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
            http_response_code(403);
            exit('Token CSRF no válido');
        }
        
        $post = $this->post->getById($id);

        if ($post === null) {
            http_response_code(404);
            echo 'Publicación no encontrada';
            return;
        }

        if (!isset($_SESSION['id']) || (int) $post['user_id'] !== (int) $_SESSION['id']) {
            http_response_code(403);
            echo 'Prohibido';
            return;
        }

        $this->post->delete($id);

        header('Location: /posts');
        exit;
    }
}