<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dunosusa</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/index.css') ?>">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.7/css/dataTables.dataTables.css" />
</head>
<body>
    <header>
        <div class="container">

            <a href="<?= base_url('welcome/home') ?>" class="logo-link">
                <img class="logo" src="<?= base_url('assets/media/logo.png') ?>" alt="Dunosusa">
            </a>

            <?php $pagina_actual = $this->router->fetch_method(); ?>
            <nav>
                <?php $tabindex = 1; foreach($nav_links as $link): ?>
                <a href="<?= ($link->url === '/') ? base_url() : base_url($link->url) ?>"
                   class="<?= ($pagina_actual == $link->metodo_activo) ? 'activo' : '' ?>"
                   tabindex="<?= $tabindex++ ?>">
                    <?= $link->texto ?>
                </a>
                <?php endforeach; ?>

                <!-- ÍCONO PERFIL -->
                <a href="<?= base_url('welcome/login') ?>" class="nav-perfil" aria-label="Mi cuenta" tabindex="<?= $tabindex++ ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22"
                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="8" r="4"/>
                        <path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/>
                    </svg>
                </a>

            </nav>
        </div>
    </header>
    <script src="<?= base_url('assets/js/navbar.js') ?>"></script>