<?php
    //inicio de sesion para cerrar sesion
    if(!isset($_SESSION)){
        session_start();
    }

    $auth = $_SESSION['login'] ?? false;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienes Raices</title>
    <link rel="stylesheet" href="/build/css/app.css">
</head>
<body>
    <header class="header <?php echo $inicio ? 'inicio' : ''; ?>">
        <div class="contenedor contenido-header">
            <div class="barra">
                <a href="/">
                    <img src="/build/img/logo.svg" alt="Logotipo de Bienes Raices">
                </a>

                <div class="mobile-menu">
                    <img src="/build/img/barras.svg" alt="icono menu hamburguesa">
                </div>

                <div class="derecha">
                    
                    <nav class="navegacion">
                        <a href="nosotros.php">Nosotros</a>
                        <a href="anuncios.php">Nuestras Casas</a>
                        <a href="blog.php">Blog</a>
                        <a href="contacto.php">Contacto</a>
                        <?php if (!$auth) : ?>
                        <a href="login.php">| Iniciar Sesion |</a>
                        <?php endif; ?>
                        <?php if ($auth) : ?>
                        <a href="/admin">| Panel Admin</a>
                        <a href="cerrar-sesion.php">Cerrar Sesion |</a>
                        <?php endif; ?>
                    </nav>
                    <img class="dark-mode-boton" src="/build/img/dark-mode.svg" alt="boton modo oscuro">
                </div>

            </div>
            <?php if($inicio){ ?>
            <h1>Venta de Casas y Departamentos Exclusivos de Lujo</h1>
            <?php } ?>
        </div>
    </header>