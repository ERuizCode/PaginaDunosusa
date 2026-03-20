<?php $this->load->view('dunosusa/secciones/header'); ?>

<section id="slogan-principal">
    <h1><?= $slogan->titulo ?></h1>
    <button tabindex="8"><?= $slogan->texto_boton ?></button>
</section>

<section id="puritano">
    <div class="container">
        <div class="img-container"></div>
        <div class="texto">
            <h2>Nuestro Producto<span class="color-puritano"><br><?= $puritano->titulo ?></span></h2>
            <p><?= $puritano->parrafo ?></p>
        </div>
    </div>
</section>

<section id="nuestros-servicios">
    <div class="container">
        <h2>Nuestros Servicios</h2>
        <div class="servicios">
            <?php foreach($servicios as $i => $servicio): ?>
            <div class="carta">
                <h3><?= $servicio->titulo ?></h3>
                <p><?= $servicio->parrafo ?></p>
                <button tabindex="<?= 9 + $i ?>"><?= $servicio->texto_boton ?></button>
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
        <div class="img-container"></div>
    </div>
</section>

<section id="ofrece-terreno">
    <h2><?= $terreno->titulo ?></h2>
    <button tabindex="12"><?= $terreno->texto_boton ?></button>
</section>

<a href="#" class="boton-accesibilidad">
    <img src="<?= base_url('assets/media/logoaccesibilidad.png') ?>" alt="accesibilidad">
</a>

<?php $this->load->view('dunosusa/secciones/footer'); ?>