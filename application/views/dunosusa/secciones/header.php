<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Evita zoom automatico en mobiles↓ -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dunosusa</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/index.css') ?>">
</head>


<body>
    <header>
        <div class="container">
            <img class="logo" src="<?= base_url('assets/media/logo.png') ?>" alt="Dunosusa">
            <?php
            //detecta el método actual del controller
            //$pagina_actual = $this->router->fetch_method();
            //Para resaltar seccion actual en el nav header
            ?>
            <nav>
                <a href="#slogan-principal"tabindex="1">Inicio</a>
                <a href="#somos-dunosusa"tabindex="2">Nosotros</a>
                <a href="#" tabindex="3"> Ventas Mayoreo</a>
                <a href="#" tabindex="4">Sucursales</a>
                <a href="#" tabindex="5">Bolsa de trabajo</a>
                <a href="#" tabindex="6">Contacto</a>
                <a href="#" tabindex="7">Mi Compra</a>
                

            </nav>
        </div>
    </header>

    