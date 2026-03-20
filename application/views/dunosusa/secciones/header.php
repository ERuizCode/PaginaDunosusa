<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dunosusa</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/index.css') ?>">
</head>
<body>
    <header>
        <div class="container">
            <img class="logo" src="<?= base_url('assets/media/logo.png') ?>" alt="Dunosusa">
            <?php $pagina_actual = $this->router->fetch_method(); ?>
            <nav>
                <?php $tabindex = 1; foreach($nav_links as $link): ?>
                <a href="<?= ($link->url === '/') ? base_url() : base_url($link->url) ?>"
                   class="<?= ($pagina_actual == $link->metodo_activo) ? 'activo' : '' ?>"
                   tabindex="<?= $tabindex++ ?>">
                    <?= $link->texto ?>
                </a>
                <?php endforeach; ?>
            </nav>
        </div>
    </header>
    <script src="<?= base_url('assets/js/navbar.js') ?>"></script>