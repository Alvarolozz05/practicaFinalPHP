<?php

namespace App\Controllers;

use App\Core\Database;
use App\Models\Comment;
use App\Models\Post;

class CommentController {
    private Comment $comment;
    private Post $post;

    public function __construct(Database $database) {
        $this->comment = new Comment($database);
        $this->post = new Post($database);

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function store(int $postId): void {
        if (!isset($_SESSION['id'])) {
            header('Location: /login?message=Debes iniciar sesión para comentar');
            exit;
        }

        $post = $this->post->getById($postId);

        if ($post === null) {
            http_response_code(404);
            echo 'Publicación no encontrada';
            return;
        }

        $content = trim($_POST['content'] ?? '');

        if ($content === '') {
            header('Location: /posts/' . $postId);
            exit;
        }

        $this->comment->insert([
            'post_id' => $postId,
            'user_id' => $_SESSION['id'],
            'content' => $content
        ]);

        header('Location: /posts/' . $postId);
        exit;
    }
}