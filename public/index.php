<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Core\Database;
use App\Controllers\AuthController;
use App\Controllers\PostController;
use App\Controllers\CommentController;

$database = new Database();
$authController = new AuthController($database);
$postController = new PostController($database);
$commentController = new CommentController($database);

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

if ($uri === '/register' && $method === 'GET') {
    $authController->showRegisterForm();
} elseif ($uri === '/register' && $method === 'POST') {
    $authController->register();
} elseif ($uri === '/login' && $method === 'GET') {
    $authController->showLoginForm();
} elseif ($uri === '/login' && $method === 'POST') {
    $authController->login();
} elseif ($uri === '/logout') {
    $authController->logout();
} elseif ($uri === '/posts' && $method === 'GET') {
    $postController->index();
} elseif ($uri === '/posts/create' && $method === 'GET') {
    $postController->create();
} elseif ($uri === '/posts' && $method === 'POST') {
    $postController->store();
} elseif (preg_match('#^/posts/(\d+)/edit$#', $uri, $matches) && $method === 'GET') {
    $postController->edit((int) $matches[1]);
} elseif (preg_match('#^/posts/(\d+)/update$#', $uri, $matches) && $method === 'POST') {
    $postController->update((int) $matches[1]);
} elseif (preg_match('#^/posts/(\d+)/delete$#', $uri, $matches) && $method === 'POST') {
    $postController->destroy((int) $matches[1]);
} elseif (preg_match('#^/posts/(\d+)$#', $uri, $matches) && $method === 'GET') {
    $postController->show((int) $matches[1]);
} elseif ($uri === '/') {
    echo '<h1>Tablón de anuncios</h1>';
    require __DIR__ . '/../src/Views/header.php';
    echo '<p><a href="/posts">Ver publicaciones</a></p>';
} elseif (preg_match('#^/posts/(\d+)/comments$#', $uri, $matches) && $method === 'POST') {
    $commentController->store((int) $matches[1]);
} else {
    http_response_code(404);
    echo 'Página no encontrada';
}