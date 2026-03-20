document.addEventListener('DOMContentLoaded', function () {

    const links = document.querySelectorAll('nav a');
    const secciones = document.querySelectorAll('section[id]');
    let scrolleando = false;

    // Mapeo: qué sección activa qué link del nav (por texto del link)
    const mapaSeccionNav = {
        'slogan-principal':  'Inicio',
        'puritano':          'Inicio',
        'nuestros-servicios':'Inicio',
        'somos-dunosusa':    'Nosotros',
        'ofrece-terreno':    'Inicio'
    };

    function quitarActivos() {
        links.forEach(link => link.classList.remove('activo'));
    }

    function resaltarPorTexto(texto) {
        links.forEach(link => {
            if (link.textContent.trim() === texto) {
                link.classList.add('activo');
            }
        });
    }

    const observer = new IntersectionObserver((entries) => {
        if (scrolleando) return;
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const seccionId = entry.target.id;
                const navTexto = mapaSeccionNav[seccionId];
                if (navTexto) {
                    quitarActivos();
                    resaltarPorTexto(navTexto);
                }
            }
        });
    }, {
        threshold: 0.4,
        rootMargin: '-80px 0px 0px 0px'
    });

    secciones.forEach(seccion => observer.observe(seccion));

    links.forEach(link => {
        link.addEventListener('click', function (e) {
            const href = this.getAttribute('href');
            if (href.startsWith('#') && href.length > 1) {
                e.preventDefault();
                const destino = document.querySelector(href);
                if (destino) {
                    quitarActivos();
                    this.classList.add('activo');
                    scrolleando = true;
                    destino.scrollIntoView({ behavior: 'smooth' });
                    setTimeout(() => { scrolleando = false; }, 800);
                }
            }
        });
    });

});