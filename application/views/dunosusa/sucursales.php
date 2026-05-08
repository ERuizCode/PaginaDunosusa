<?php $this->load->view('dunosusa/secciones/header'); ?>

<main id="sucursales-page">

    <div class="sucursales-hero">
        <h1>Nuestras Sucursales</h1>
        <p>Encuéntranos en Mérida, Yucatán</p>
    </div>

    <div class="sucursales-layout container">

        <!-- LISTA LATERAL -->
        <aside class="sucursales-lista">
            <?php foreach($sucursales as $i => $s): ?>
            <div class="sucursal-card <?= ($i === 0) ? 'activa' : '' ?>"
                 data-lat="<?= $s->lat ?>"
                 data-lng="<?= $s->lng ?>"
                 data-nombre="<?= htmlspecialchars($s->nombre) ?>"
                 data-direccion="<?= htmlspecialchars($s->direccion . ', ' . $s->colonia) ?>"
                 data-maps="<?= $s->maps_url ?>"
                 onclick="seleccionarSucursal(this)">

                <div class="sucursal-card-info">
                    <h3><?= $s->nombre ?></h3>
                    <p><?= $s->direccion ?>, <?= $s->colonia ?></p>

                    <?php if($s->horario || !empty($s->telefono)): ?>
                    <div class="sucursal-extra">
                        <?php if($s->horario): ?>
                            <span class="sucursal-horario">🕐 <?= $s->horario ?></span>
                        <?php endif; ?>

                        <?php if(!empty($s->telefono)): ?>
                            <span class="sucursal-telefono">📞 <?= $s->telefono ?></span>
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </aside>

        <!-- MAPA -->
        <div class="sucursales-mapa-wrapper">
            <iframe
                id="mapa-principal"
                class="sucursales-mapa"
                src="https://maps.google.com/maps?q=Dunosusa+Merida+Yucatan&output=embed"
                width="100%" height="100%"
                style="border:0;"
                allowfullscreen
                loading="lazy">
            </iframe>

            <!-- Info flotante al seleccionar -->
            <div class="sucursal-popup" id="sucursal-popup" style="display:none;">
                <strong id="popup-nombre"></strong>
                <span id="popup-direccion"></span>
                <a id="popup-link" href="#" target="_blank" rel="noopener noreferrer">
                    Ver en Google Maps →
                </a>
            </div>
        </div>

    </div>

</main>

<script>
function seleccionarSucursal(card) {
    document.querySelectorAll('.sucursal-card').forEach(c => c.classList.remove('activa'));
    card.classList.add('activa');

    const nombre = card.dataset.nombre;
    const dir    = card.dataset.direccion;
    const maps   = card.dataset.maps;

    const query = encodeURIComponent(nombre + ' Dunosusa Merida Yucatan');
    document.getElementById('mapa-principal').src =
        `https://maps.google.com/maps?q=${query}&output=embed`;

    document.getElementById('popup-nombre').textContent    = nombre;
    document.getElementById('popup-direccion').textContent = dir;
    document.getElementById('popup-link').href = maps;
    document.getElementById('sucursal-popup').style.display = 'flex';

    card.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
}
</script>

<a href="#" class="boton-accesibilidad">
    <img src="<?= base_url('assets/media/logoaccesibilidad.png') ?>" alt="accesibilidad">
</a>

<?php $this->load->view('dunosusa/secciones/footer'); ?>