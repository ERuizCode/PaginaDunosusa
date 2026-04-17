<?php $this->load->view('dunosusa/secciones/header'); ?>

<section id="slogan-principal" style="background-image: linear-gradient(0deg,rgba(0,0,0,0.5),rgba(0,0,0,0.5)), url('<?= base_url($slogan->imagen) ?>');">
    <h1><?= $slogan->titulo ?></h1>
    <a href="<?= base_url('welcome/productos') ?>">
        <button tabindex="8"><?= $slogan->texto_boton ?></button>
    </a>
</section>

<section id="puritano">
    <div class="container">
        <div class="img-container" style="background-image: url('<?= base_url($puritano->imagen) ?>');"></div>
        <div class="texto">
            <h2><?= str_replace('El Puritano','<span class="color-puritano">El Puritano</span>',$puritano->titulo) ?></h2>
            <p><?= $puritano->parrafo ?></p>
        </div>
    </div>
</section>

<section id="nuestros-servicios">
    <div class="container">
        <h2><?= $nuservicio->titulo ?></h2>
        <div class="servicios">
            <?php foreach($servicios as $i => $servicio): ?>
            <div class="carta" 
                 style="background-image: linear-gradient(0deg,rgba(0,0,0,0.5),rgba(0,0,0,0.5)), url('<?= base_url($servicio->imagen) ?>');"
                 onclick="window.location='<?= base_url($servicio->enlace) ?>'"
                 role="button"
                 tabindex="<?= 9 + $i ?>">
                <h3><?= $servicio->titulo ?></h3>
                <p><?= $servicio->parrafo ?></p>
                <button tabindex="-1" onclick="event.stopPropagation(); window.location='<?= base_url($servicio->enlace) ?>'">
                    <?= $servicio->texto_boton ?>
                </button>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section id="somos-dunosusa">
    <div class="container">
        <div class="texto">
            <h2><?= $somos->titulo ?></h2>
            <p><?= $somos->parrafo ?></p>
        </div>
        <div class="img-container" style="background-image: url('<?= base_url($somos->imagen) ?>');"></div>
    </div>
</section>

<section id="ofrece-terreno" style="background-image: url('<?= base_url($terreno->imagen) ?>');">
    <h2><?= $terreno->titulo ?></h2>
    <button tabindex="12"><?= $terreno->parrafo ?></button>
</section>

<a href="#" class="boton-accesibilidad">
    <img src="<?= base_url('assets/media/logoaccesibilidad.png') ?>" alt="accesibilidad">
</a>

<?php $this->load->view('dunosusa/secciones/footer'); ?>