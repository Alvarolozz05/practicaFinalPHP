<?php require __DIR__ . '/header.php'; ?>

<h2>Registrarse</h2>

<?php
    if (isset($_GET['message'])):
?>
    <p><?= htmlspecialchars($_GET['message']) ?></p>
<?php
    endif;
?>

<form action="/register" method="POST">
    <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>">
    
    <label for="username">Nombre de usuario:</label>
    <input type="text" id="username" name="username" required>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>

    <label for="password">Contraseña:</label>
    <input type="password" id="password" name="password" required>

    <button type="submit">Registrarse</button>
</form>