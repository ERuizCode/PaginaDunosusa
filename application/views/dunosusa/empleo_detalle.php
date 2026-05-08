<?php $this->load->view('dunosusa/secciones/header'); ?>

<main id="empleo-detalle-page">

    <div class="empleo-detalle-wrap">

        <!-- Botón volver -->
        <a href="<?= base_url('welcome/bolsadetrabajo') ?>" class="empleo-volver">
            ← Volver a vacantes
        </a>

        <div class="empleo-detalle-card">

            <!-- Cabecera -->
            <div class="empleo-detalle-header">
                <div class="empleo-detalle-meta">
                    <p><strong>Fecha:</strong> <?= date('d M. Y', strtotime($empleo->fecha_publicacion)) ?></p>
                    <p><strong>Ubicación:</strong> <?= htmlspecialchars($empleo->ubicacion) ?></p>
                    <p><strong>Empresa:</strong> Dunosusa</p>
                </div>
                <?php if (!empty($empleo->url_candidatura)): ?>
                <a href="<?= $empleo->url_candidatura ?>" target="_blank" class="empleo-btn-candidatura">
                    Enviar candidatura ahora »
                </a>
                <?php endif; ?>
            </div>

            <hr class="empleo-divider">

            <!-- Título -->
            <h2 class="empleo-titulo-seccion">¡ÚNETE A NUESTRO EQUIPO!</h2>
            <p class="empleo-subtitulo">Estamos buscando: <strong><?= htmlspecialchars($empleo->puesto) ?></strong></p>

            <!-- Tabla área/puesto/responde a -->
            <table class="empleo-info-tabla">
                <tr><td><strong>Area</strong></td><td><?= htmlspecialchars($empleo->area) ?></td></tr>
                <tr><td><strong>Puesto</strong></td><td><?= htmlspecialchars($empleo->puesto) ?></td></tr>
                <tr><td><strong>Responde a</strong></td><td><?= htmlspecialchars($empleo->responde_a) ?></td></tr>
            </table>

            <!-- Requisitos -->
            <h3 class="empleo-seccion-titulo">Requisitos:</h3>
            <ul class="empleo-lista">
                <?php foreach (explode("\n", $empleo->requisitos) as $req): ?>
                    <?php if(trim($req)): ?>
                    <li><?= htmlspecialchars(trim($req)) ?></li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>

            <!-- Actividades -->
            <h3 class="empleo-seccion-titulo">Actividad:</h3>
            <ul class="empleo-lista">
                <?php foreach (explode("\n", $empleo->actividades) as $act): ?>
                    <?php if(trim($act)): ?>
                    <li><?= htmlspecialchars(trim($act)) ?></li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>

            <!-- Ofrecemos -->
            <h3 class="empleo-seccion-titulo">Ofrecemos</h3>
            <ul class="empleo-lista">
                <?php foreach (explode("\n", $empleo->ofrecemos) as $of): ?>
                    <?php if(trim($of)): ?>
                    <li><?= htmlspecialchars(trim($of)) ?></li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>

        </div>
    </div>

</main>

<a href="#" class="boton-accesibilidad">
    <img src="<?= base_url('assets/media/logoaccesibilidad.png') ?>" alt="accesibilidad">
</a>

<?php $this->load->view('dunosusa/secciones/footer'); ?>