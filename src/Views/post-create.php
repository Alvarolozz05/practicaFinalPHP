<?php require __DIR__ . '/header.php'; ?>

<h1>Crear publicación</h1>

<form action="/posts" method="POST">
    <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>">
    
    <label for="title">Título:</label>
    <input type="text" id="title" name="title" required>

    <label for="category">Categoría:</label>
    <input type="text" id="category" name="category" required>

    <label for="content">Contenido:</label>
    <textarea id="content" name="content" required></textarea>

    <button type="submit">Publicar</button>
</form>