document.addEventListener('DOMContentLoaded', function () {

    const links = document.querySelectorAll('nav a');
    const secciones = document.querySelectorAll('section[id]');
    let scrolleando = false; // ← bandera

    const observer = new IntersectionObserver((entries) => {
        if (scrolleando) return; // ← si se hizo click, ignora el observer
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                links.forEach(link => link.classList.remove('activo'));
                const linkActivo = document.querySelector(`nav a[href="#${entry.target.id}"]`);
                if (linkActivo) linkActivo.classList.add('activo');
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
                    // Resaltar inmediato y bloquear observer
                    links.forEach(l => l.classList.remove('activo'));
                    this.classList.add('activo');

                    scrolleando = true; // ← Bloquea el observer
                    destino.scrollIntoView({ behavior: 'smooth' });

                    // Desbloquea observer después de que termina el scroll
                    setTimeout(() => { scrolleando = false; }, 800);
                }
            }
        });
    });

});