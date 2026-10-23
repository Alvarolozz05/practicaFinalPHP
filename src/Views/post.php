<?php require __DIR__ . '/header.php'; ?>

<h1><?= htmlspecialchars($post['title']) ?></h1>

<p>Categoría: <?= htmlspecialchars($post['category']) ?></p>
<p><?= htmlspecialchars($post['content']) ?></p>

<?php
    if (isset($_SESSION['id']) && (int) $_SESSION['id'] === (int) $post['user_id']):
?>
    <a href="/posts/<?= (int) $post['id'] ?>/edit">Editar</a>

    <form action="/posts/<?= (int) $post['id'] ?>/delete" method="POST">
        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>">
        <button type="submit">Eliminar</button>
    </form>
<?php
    endif;
?>

<h2>Comentarios</h2>

<?php
    if ($comments !== null):
?>
    <?php
        foreach ($comments as $comment):
    ?>
        <article>
            <p><?= htmlspecialchars($comment['content']) ?></p>
            <small>
                <?= htmlspecialchars($comment['created_at']) ?>
            </small>
        </article>
    <?php
        endforeach;
    ?>
<?php
    else:
?>
    <p>No hay comentarios.</p>
<?php
    endif;
?>

<?php
    if (isset($_SESSION['id'])):
?>
    <h3>Añadir comentario</h3>

    <form action="/posts/<?= (int) $post['id'] ?>/comments" method="POST">
        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>">
        
        <label for="content">Comentario:</label>
        <textarea id="content" name="content" required></textarea>

        <button type="submit">Enviar comentario</button>
    </form>
<?php
    endif;
?>

<a href="/posts">Volver a publicaciones</a>