<?php $this->load->view('dunosusa/secciones/header'); ?>

<main id="bolsa-page">

    <!-- BUSCADOR BOLSA DE TRABAJO -->
    <div class="bolsa-buscador-wrap">
        <form action="<?= base_url('welcome/bolsadetrabajo') ?>" method="GET" class="bolsa-buscador-form">
            <div class="bolsa-buscador-inner">
                <input type="text"
                    name="q"
                    placeholder="¿Qué vacante estás buscando?"
                    value="<?= htmlspecialchars($busqueda ?? '') ?>"
                    class="bolsa-buscador-input">
                <button type="submit" class="bolsa-buscador-btn" aria-label="Buscar">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2">
                        <circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/>
                    </svg>
                </button>
            </div>
        </form>
    </div>

    <div class="bolsa-layout">

        <!-- Sidebar categorías -->
        <aside class="bolsa-sidebar">
            <h3 class="bolsa-sidebar-titulo">Categorías</h3>
            <ul class="bolsa-cat-lista">
                <li>
                    <a href="<?= base_url('welcome/bolsadetrabajo') ?>"
                       class="bolsa-cat-link <?= (!$categoria_activa && !$busqueda) ? 'activa' : '' ?>">
                        Todas las vacantes
                    </a>
                </li>
                <?php foreach ($categorias as $cat): ?>
                <li>
                    <a href="<?= base_url('welcome/bolsadetrabajo?cat=' . $cat->id) ?>"
                       class="bolsa-cat-link <?= ($categoria_activa == $cat->id) ? 'activa' : '' ?>">
                        <?= htmlspecialchars($cat->nombre) ?>
                    </a>
                </li>
                <?php endforeach; ?>
            </ul>
        </aside>

        <!-- Listado de empleos -->
        <section class="bolsa-listado">

            <?php if (!empty($busqueda)): ?>
                <p class="bolsa-resultado-texto">
                    Resultados para: <strong>"<?= htmlspecialchars($busqueda) ?>"</strong>
                    — <a href="<?= base_url('welcome/bolsadetrabajo') ?>">Limpiar búsqueda</a>
                </p>
            <?php endif; ?>

            <?php if (empty($empleos)): ?>
                <div class="bolsa-vacio">
                    <p>No se encontraron vacantes disponibles.</p>
                </div>
            <?php else: ?>

                <table id="tblbolsa" class="bolsa-tabla">
                    <thead>
                        <tr>
                            <th>Puesto</th>
                            <th>Ubicación</th>
                            <th>Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($empleos as $i => $e): ?>
                        <tr class="bolsa-fila <?= ($i % 2 == 0) ? 'par' : '' ?>"
                            onclick="window.location='<?= base_url('welcome/empleo_detalle?id=' . $e->id) ?>'"
                            style="cursor:pointer;">
                            <td class="bolsa-td-puesto"><?= htmlspecialchars($e->puesto) ?></td>
                            <td><?= htmlspecialchars($e->ubicacion) ?></td>
                            <td class="bolsa-td-fecha"><?= date('d M. Y', strtotime($e->fecha_publicacion)) ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

            <?php endif; ?>
        </section>

    </div>
</main>

<a href="#" class="boton-accesibilidad">
    <img src="<?= base_url('assets/media/logoaccesibilidad.png') ?>" alt="accesibilidad">
</a>

<?php $this->load->view('dunosusa/secciones/footer'); ?>
<script>
$(document).ready(function () {
    $('#tblbolsa').DataTable({
        language: {
            lengthMenu: "Mostrar _MENU_ vacantes por página",
            search: "Buscar:",
            info: "Mostrando _START_ a _END_ de _TOTAL_ vacantes",
            paginate: {
                first: "Primero",
                last: "Último",
                next: "›",
                previous: "‹"
            },
            zeroRecords: "No se encontraron resultados",
            infoEmpty: "No hay vacantes disponibles",
            infoFiltered: "(filtrado de _MAX_ vacantes)"
        }
    });
});
</script>
