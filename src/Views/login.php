<?php require __DIR__ . '/header.php'; ?>

<h2>Iniciar sesión</h2>

<?php
    if (isset($_GET['message'])):
?>
    <p><?= htmlspecialchars($_GET['message']) ?></p>
<?php
    endif;
?>

<form action="/login" method="POST">
    <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>">
    
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>

    <label for="password">Contraseña:</label>
    <input type="password" id="password" name="password" required>

    <button type="submit">Iniciar sesión</button>
</form>