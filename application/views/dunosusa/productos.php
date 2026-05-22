<?php $this->load->view('dunosusa/secciones/header'); ?>

<main id="productos-page">

    <!-- BARRA NARANJA -->
    <div class="productos-barra">

        <!-- BOTÓN CAT DESPLEGABLE -->
        <div class="cat-dropdown-wrap">
            <button type="button" id="btn-categorias" class="btn-sidebar-toggle" aria-expanded="false">
                <span class="hamburger-icon"><span></span><span></span><span></span></span>
                Categorías
                <span class="toggle-chevron">&#8250;</span>
            </button>

            <!-- PANEL DROPDOWN -->
            <div class="cat-dropdown" id="cat-dropdown">
                <?php foreach($categorias as $cat): ?>
                <div class="cat-dropdown-item <?= ($categoria_activa == $cat->id) ? 'activa' : '' ?>">
                    <a href="<?= base_url('welcome/productos?cat='.$cat->id) ?>" class="cat-dropdown-link">
                        <?= htmlspecialchars($cat->nombre) ?>
                        <span class="cat-arrow">›</span>
                    </a>
                    <?php if($categoria_activa == $cat->id && !empty($subcategorias)): ?>
                    <div class="subcat-dropdown">
                        <?php foreach($subcategorias as $sub): ?>
                        <a href="<?= base_url('welcome/productos?cat='.$cat->id.'&sub='.$sub->id) ?>"
                           class="subcat-dropdown-link <?= ($sub_activa == $sub->id) ? 'activa' : '' ?>">
                            <?= htmlspecialchars($sub->nombre) ?>
                        </a>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- BUSCADOR -->
        <form action="<?= base_url('welcome/productos') ?>" method="GET" class="productos-buscador">
            <input type="text" name="q"
                   placeholder="¿Qué estás buscando?"
                   value="<?= htmlspecialchars($busqueda ?? '') ?>"
                   autocomplete="off">
            <button type="submit">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                     viewBox="0 0 24 24" fill="none" stroke="currentColor"
                     stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
                </svg>
            </button>
        </form>

                            <!-- BOTÓN CARRITO -->
        <button type="button" class="btn-carrito" aria-label="Carrito de compras">
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22"
                 viewBox="0 0 24 24" fill="none" stroke="currentColor"
                 stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/>
                <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/>
            </svg>
            <span class="carrito-badge">0</span>
        </button>

    </div>
    

    <!-- LAYOUT SIN SIDEBAR -->
    <div class="productos-layout container">
        <section class="productos-contenido">

            <?php if(!empty($busqueda)): ?>
                <h2 class="productos-titulo">
                    Resultados para: <em>"<?= htmlspecialchars($busqueda) ?>"</em>
                </h2>
            <?php elseif(!empty($productos)): ?>
                <h2 class="productos-titulo">
                    <?= htmlspecialchars($productos[0]->categoria) ?>
                    <?php if($sub_activa): ?>
                        <span class="productos-subtitulo">› <?= htmlspecialchars($productos[0]->subcategoria) ?></span>
                    <?php endif; ?>
                </h2>
            <?php else: ?>
                <h2 class="productos-titulo">Nuestros Productos</h2>
                <p class="productos-intro">Selecciona una categoría o busca un producto.</p>
            <?php endif; ?>

                <?php if(!empty($productos)): ?>
<div class="productos-grid">
    <?php foreach($productos as $p): ?>
    <div class="producto-card">

        <span class="producto-categoria"><?= htmlspecialchars($p->subcategoria) ?></span>

        <div class="producto-img-wrap">
            <img src="<?= base_url('assets/media/productos/' . rawurlencode($p->imagen)) ?>"
                 alt="<?= htmlspecialchars($p->nombre) ?>"
                 loading="lazy"
                 onerror="this.src='<?= base_url('assets/media/productos/sin-imagen.png') ?>'">
        </div>

        <div class="producto-info">
            <p class="producto-nombre"><?= htmlspecialchars($p->nombre) ?></p>

            <div class="producto-footer">
                <p class="producto-precio">$<?= number_format($p->precio, 2) ?></p>

                <div class="producto-controles"
                    data-id="<?= $p->id ?>" 
                    data-existencia="<?= $p->existencia ?>"> <button type="button" class="btn-cantidad btn-restar deshabilitado" aria-label="Restar">−</button>
                   <span class="cantidad-num">0</span>
                   <button type="button" class="btn-cantidad btn-sumar" aria-label="Sumar">+</button>
                </div>
            </div>
        </div>

    </div>
        <?php endforeach; ?>
    </div>
                <?php elseif(!empty($busqueda) || !empty($categoria_activa)): ?>
                <p class="productos-vacio">No se encontraron productos.</p>
                <?php endif; ?>

        </section>
    </div>
</main>


<a href="#" class="boton-accesibilidad">
    <img src="<?= base_url('assets/media/logoaccesibilidad.png') ?>" alt="accesibilidad">
</a>

<?php $this->load->view('dunosusa/secciones/footer'); ?>

<script>
    const btnCat   = document.getElementById('btn-categorias');
    const dropdown = document.getElementById('cat-dropdown');
    const chevron  = btnCat.querySelector('.toggle-chevron');

    btnCat.addEventListener('click', function(e) {
        e.stopPropagation();
        const abierto = dropdown.classList.toggle('visible');
        chevron.classList.toggle('abierto', abierto);
        btnCat.setAttribute('aria-expanded', abierto);
    });

    // Cierra al hacer clic fuera
    document.addEventListener('click', function() {
        dropdown.classList.remove('visible');
        chevron.classList.remove('abierto');
        btnCat.setAttribute('aria-expanded', 'false');
    });

    dropdown.addEventListener('click', function(e) {
       e.stopPropagation();
        const abierto = dropdown.classList.toggle('visible');
        chevron.classList.toggle('abierto', abierto);
        btnCat.setAttribute('aria-expanded', abierto);
    });

    document.addEventListener('click', function() {
        dropdown.classList.remove('visible');
        chevron.classList.remove('abierto');
        btnCat.setAttribute('aria-expanded', 'false');
    });

    dropdown.addEventListener('click', function(e) {
        e.stopPropagation();
    });
    const contadorCarrito = document.querySelector('.carrito-badge');
    let carrito = {};

    document.querySelectorAll('.producto-controles').forEach(function(control) {
        const btnRestar = control.querySelector('.btn-restar');
        const btnSumar = control.querySelector('.btn-sumar');
        const cantidad = control.querySelector('.cantidad-num');
        const idProducto = control.getAttribute('data-id');
        const existencia = parseInt(control.getAttribute('data-existencia'));

    //boton suma
    btnSumar.addEventListener('click', function() {

        let numero = parseInt(cantidad.textContent);

        if (numero < existencia) {
            numero = numero + 1;
            cantidad.textContent = numero;
            carrito[idProducto] = numero;
            actualizarCarrito();

        } 

    });

    // boton resta
    btnRestar.addEventListener('click', function() {
        let numero = parseInt(cantidad.textContent);

        if (numero > 0) {
            numero = numero - 1;
            cantidad.textContent = numero;

            if (numero == 0) {
                delete carrito[idProducto];

            } else {
                carrito[idProducto] = numero;
            }
            actualizarCarrito();

        }

    });

});

//total
function actualizarCarrito() {
    let total = 0;

    for (let id in carrito) {
        total = total + carrito[id];

    }
    contadorCarrito.textContent = total;

}

</script>