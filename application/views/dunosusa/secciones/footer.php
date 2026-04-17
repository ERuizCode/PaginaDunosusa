<footer>
    <div class="footer-contenido container">

        <!-- Columna 1: Dirección y Teléfonos -->
        <div class="footer-col">
            <?php foreach($footer_contacto as $item):
                // Solo mostrar filas de dirección y teléfono (tienen titulo y descripcion real)
                if ($item->titulo === null) continue;
                if (trim($item->descripcion) === '') continue;
                if (in_array($item->titulo, ['Ubicaciones', 'Aviso de privacidad'])) continue;
            ?>
                <p><strong><?= $item->titulo ?></strong></p>
                <p><?= $item->descripcion ?></p><br>
            <?php endforeach; ?>
            <img src="<?= base_url('assets/media/logo.png') ?>" alt="Dunosusa" style="height: 70px; margin-top: 20px;">
        </div>

        <!-- Columna 2: Ubicaciones -->
        <?php
        $col_ubicaciones = null;
        foreach($footer_contacto as $item) {
            if ($item->titulo === 'Ubicaciones') { $col_ubicaciones = $item; break; }
        }
        ?>
        <div class="footer-col">
            <h4><?= $col_ubicaciones->titulo ?></h4>
            <ul>
                <?php $tabindex = 13; foreach($footer_ubicaciones as $ub): ?>
                <li><a href="<?= $ub->url ?>" tabindex="<?= $tabindex++ ?>"><?= $ub->texto ?></a></li>
                <?php endforeach; ?>
            </ul>
        </div>

        <!-- Columna 3: Aviso de Privacidad -->
        <?php
        $col_aviso = null;
        foreach($footer_contacto as $item) {
            if ($item->titulo === 'Aviso de privacidad') { $col_aviso = $item; break; }
        }
        ?>
        <div class="footer-col">
            <h4><?= $col_aviso->titulo ?></h4>
        </div>

        <!-- Columna 4: Redes Sociales -->
        <?php
        $col_redes = null;
        foreach($footer_contacto as $item) {
            if ($item->titulo === 'Redes sociales') { $col_redes = $item; break; }
        }
        ?>
        <div class="footer-col">
            <h4><?= $col_redes ? $col_redes->titulo : 'Redes sociales' ?></h4>
            <div class="redes">
                <?php $tabindex = 21; foreach($footer_redes as $red): ?>
                <a href="<?= $red->url ?>" target="_blank" class="red-social"
                   tabindex="<?= $tabindex++ ?>" aria-label="<?= $red->nombre ?>">
                    <?= $red->svg ?>
                </a>
                <?php endforeach; ?>
            </div>
        </div>

    </div>

    <!-- Barra inferior con derechos -->
    <div class="footer-bottom">
        <div class="container">
            <?php foreach($footer_contacto as $item): ?>
                <?php if ($item->titulo === null): ?>
                    <p><?= $item->descripcion ?></p>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
</footer>
</body>
</html>