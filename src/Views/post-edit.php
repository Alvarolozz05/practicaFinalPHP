<?php require __DIR__ . '/header.php'; ?>

<h1>Editar publicación</h1>

<form action="/posts/<?= (int) $post['id'] ?>/update" method="POST">
    <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>">

    <label for="title">Título:</label>
    <input type="text" id="title" name="title" value="<?= htmlspecialchars($post['title']) ?>" required>

    <label for="category">Categoría:</label>
    <input type="text" id="category" name="category" value="<?= htmlspecialchars($post['category']) ?>" required>

    <label for="content">Contenido:</label>
    <textarea id="content" name="content" required><?= htmlspecialchars($post['content']) ?></textarea>

    <button type="submit">Guardar cambios</button>
</form>