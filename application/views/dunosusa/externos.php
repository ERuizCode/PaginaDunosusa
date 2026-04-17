<?php $this->load->view('dunosusa/secciones/header'); ?>


<main id="externos-page">


    <!-- BARRA DE ICONOS -->
    <nav class="externos-barra">
        <?php foreach($externos as $item): ?>
        <a href="#<?= $item->slug ?>" class="externos-barra-item">
            <img src="<?= base_url($item->icono) ?>"
                 alt="<?= $item->nombre ?>"
                 width="70" height="70"
                 loading="lazy">
            <span><?= $item->nombre ?></span>
        </a>
        <?php endforeach; ?>
    </nav>


    <!-- SECCIONES -->
    <?php
    $colores = [
        'Primero el Planeta' => '#036431',
        'Va y Ven'           => '#0057b8',
        'Amazon'             => '#555555',
    ];
    ?>

    <?php foreach($externos as $i => $item): ?>
    <?php $color = $colores[$item->nombre] ?? '#c0392b'; ?>
    <section id="<?= $item->slug ?>"
             class="externo-seccion <?= ($i % 2 === 0) ? 'seccion-par' : 'seccion-impar' ?>">
        <div class="externo-contenido">
            <div class="externo-img"
                 style="background-image: url('<?= base_url($item->imagen) ?>');">
            </div>
            <div class="externo-texto">
                <h2 style="color: <?= $color ?>"><?= $item->nombre ?></h2>
                <p><?= $item->descripcion ?></p>
            </div>
        </div>
    </section>
    <?php endforeach; ?>


</main>

<a href="#" class="boton-accesibilidad">
    <img src="<?= base_url('assets/media/logoaccesibilidad.png') ?>" alt="accesibilidad">
</a>

<?php $this->load->view('dunosusa/secciones/footer'); ?>