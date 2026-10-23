<?php require __DIR__ . '/header.php'; ?>

<h1>Publicaciones</h1>

<form action="/posts" method="GET">
    <label for="search">Buscar:</label>
    <input type="text" id="search" name="search"
        value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
    <button type="submit">Buscar</button>
</form>

<?php
    if (isset($_SESSION['id'])):
?>
    <a href="/posts/create">Crear publicación</a>
<?php
    endif;
?>

<?php
    if ($posts !== null):
?>
    <?php
        foreach ($posts as $post):
    ?>
        <article>
            <h2>
                <a href="/posts/<?= (int) $post['id'] ?>">
                    <?= htmlspecialchars($post['title']) ?>
                </a>
            </h2>

            <p>Categoría: <?= htmlspecialchars($post['category']) ?></p>
            <p><?= htmlspecialchars($post['content']) ?></p>
        </article>
    <?php
        endforeach;
    ?>
<?php
    else:
?>
    <p>No hay publicaciones.</p>
<?php
    endif;
?>