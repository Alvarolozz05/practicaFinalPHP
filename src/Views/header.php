<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tablon de Anuncios</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <?php
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
    ?>

    <header>
        <?php
            if (isset($_SESSION['id'])):
        ?>
            <span>
                <?= htmlspecialchars($_SESSION['email']) ?>
            </span>
            <a href="/logout">Cerrar sesión</a>
        <?php
            else:
        ?>
            <a href="/login">Iniciar sesión</a>
            <a href="/register">Registrarse</a>
            <a href="/">Inicio</a>
        <?php
            endif;
        ?>
    </header>
</body>
</html>