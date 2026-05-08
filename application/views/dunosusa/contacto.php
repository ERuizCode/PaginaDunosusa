<?php $this->load->view('dunosusa/secciones/header', $data ?? []); ?>

<main id="contacto-page">
    <div class="contacto-layout">

        <!-- IZQUIERDA: Formulario -->
        <div class="contacto-form-wrap">

            <?php if ($enviado): ?>
                <div class="contacto-exito">
                    ✅ ¡Tu mensaje fue enviado correctamente!<br>
                    Nos pondremos en contacto contigo pronto.
                </div>
            <?php else: ?>

                <?php if (!empty($error)): ?>
                    <div class="contacto-error"><?= $error ?></div>
                <?php endif; ?>

                <form action="<?= base_url('welcome/contacto') ?>" method="POST" class="contacto-form">

                    <h2 class="contacto-form-titulo">
                        <span id="form-titulo">
                            <?php
                                $id_post = $this->input->post('id_tipo');
                                $nombre_tipo = (!empty($tipos)) ? $tipos[0]->nombre : 'Contacto';
                                foreach ($tipos as $t) {
                                    if ($t->id == $id_post) { $nombre_tipo = $t->nombre; break; }
                                }
                                echo htmlspecialchars($nombre_tipo);
                            ?>
                        </span>
                    </h2>

                    <div class="contacto-campo">
                        <label for="id_tipo">Tipo: <span>*</span></label>
                        <select name="id_tipo" id="id_tipo" required
                                onchange="document.getElementById('form-titulo').textContent = this.options[this.selectedIndex].text">
                            <?php foreach ($tipos as $t): ?>
                                <option value="<?= $t->id ?>"
                                    <?= ($this->input->post('id_tipo') == $t->id) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($t->nombre) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="contacto-campo">
                        <label for="nombre">Nombre:</label>
                        <input type="text" id="nombre" name="nombre"
                        maxlength="70"
                               value="<?= htmlspecialchars($this->input->post('nombre') ?? '') ?>"
                               required>
                    </div>

                    <div class="contacto-campo">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email"
                               value="<?= htmlspecialchars($this->input->post('email') ?? '') ?>"
                               required>
                    </div>

                    <div class="contacto-campo">
                        <label for="telefono">Teléfono:</label>
                        <input type="tel" id="telefono" name="telefono"
                               value="<?= htmlspecialchars($this->input->post('telefono') ?? '') ?>">
                    </div>

                    <div class="contacto-campo">
                        <label for="asunto">Asunto:</label>
                        <input type="text" id="asunto" name="asunto"
                               value="<?= htmlspecialchars($this->input->post('asunto') ?? '') ?>"
                               required>
                    </div>

                    <div class="contacto-campo campo-textarea">
                        <label for="comentarios">Comentarios:</label>
                        <textarea id="comentarios" name="comentarios"
                                  rows="5"
                                  required><?= htmlspecialchars($this->input->post('comentarios') ?? '') ?></textarea>
                    </div>

                    <div class="contacto-btn-wrap">
                        <div></div>
                        <button type="submit" name="submit_contacto" class="contacto-btn">Enviar</button>
                    </div>

                </form>

            <?php endif; ?>
        </div>

        <!-- DERECHA: Info Dunosusa -->
        <aside class="contacto-info">
            <img src="<?= base_url('assets/media/logo.png') ?>"
                 alt="Abarrotes Dunosusa" class="contacto-logo">
            <p class="contacto-slogan">Tu vecino del buen precio</p>

            <div class="contacto-dato">
                <div class="contacto-icono-wrap">📍</div>
                <div class="contacto-dato-texto">
                    <strong>Dirección:</strong>
                    <p>Calle 9 No. 232 entre Periferico Oriente y 36 Col. Kanasin<br>
                       Kanasin, Yucatán, C.P. 97370.</p>
                </div>
            </div>

            <div class="contacto-dato">
                <div class="contacto-icono-wrap">🕐</div>
                <div class="contacto-dato-texto">
                    <strong>Horarios:</strong>
                    <p><strong>Tiendas:</strong><br>
                       Atención a clientes de 07:00 a 22:00 hrs de Lunes a Domingo.<br>
                       Recepción de mercancía de 07:00 a 19:00 hrs de Lunes a Domingo.</p>
                </div>
            </div>
        </aside>

    </div>
</main>

<a href="#" class="boton-accesibilidad">
    <img src="<?= base_url('assets/media/logoaccesibilidad.png') ?>" alt="accesibilidad">
</a>

<?php $this->load->view('dunosusa/secciones/footer'); ?>