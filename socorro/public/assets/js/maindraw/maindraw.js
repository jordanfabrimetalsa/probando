document.addEventListener('DOMContentLoaded', function () {
    const myCarousel = document.getElementById('heroCarousel');

    // Configuración básica del carrusel
    const carousel = new bootstrap.Carousel(myCarousel, {
        interval: 10000, // 5 segundos
        wrap: true,
        touch: true,
        keyboard: true,
        pause: false
    });

    // Configurar la transición suave
    const carouselInner = myCarousel.querySelector('.carousel-inner');
    carouselInner.style.transition = 'transform 1.5s ease-in-out';

    // Manejar el evento de transición completa
    myCarousel.addEventListener('slid.bs.carousel', function () { // No es necesario hacer nada aquí, solo para asegurar que el evento se maneje
    });

    // Iniciar manualmente el ciclo si es necesario
    let carouselInterval = setInterval(function () {
        carousel.next();
    }, 10000);

    // Limpiar el intervalo si el carrusel se detiene
    myCarousel.addEventListener('mouseenter', function () {
        clearInterval(carouselInterval);
    });

    myCarousel.addEventListener('mouseleave', function () {
        carouselInterval = setInterval(function () {
            carousel.next();
        }, 10000);
    });
});

// Navbar transparent at top, solid on scroll
document.addEventListener('DOMContentLoaded', function () {
    const nav = document.getElementById('mainNav');
    const collapseEl = document.getElementById('navbarNav');
    const togglerBtn = document.querySelector('#mainNav .navbar-toggler');
    let backdropEl = null;

    const ensureBackdrop = () => {
        if (backdropEl)
            return backdropEl;

        backdropEl = document.createElement('div');
        backdropEl.className = 'mainnav-backdrop';
        backdropEl.addEventListener('click', () => {
            requestCloseCollapse();
        });
        return backdropEl;
    };

    const openMobileMenu = () => {
        if (window.innerWidth >= 992)
            return;

        document.body.style.overflow = 'hidden';
        document.body.appendChild(ensureBackdrop());
    };

    const closeMobileMenu = () => {
        document.body.style.overflow = '';
        if (backdropEl && backdropEl.parentNode)
            backdropEl.parentNode.removeChild(backdropEl);

        backdropEl = null;
    };

    const requestCloseCollapse = () => {
        if (! collapseEl)
            return;

        if (!window.bootstrap || !window.bootstrap.Collapse)
            return;

        const instance = window.bootstrap.Collapse.getOrCreateInstance(collapseEl, {toggle: false});
        instance.hide();
    };

    if (togglerBtn) {
        togglerBtn.addEventListener('click', (e) => {
            if (window.innerWidth >= 992)
                return;

            if (! collapseEl || ! collapseEl.classList.contains('show'))
                return;

            e.preventDefault();
            e.stopPropagation();
            requestCloseCollapse();
        });
    }

    const onScroll = () => {
        const isMobile = window.innerWidth < 992;
        // Mobile: always dark
        if (isMobile) {
            nav.classList.add('scrolled');
        } else { // Desktop: dark only after scrolling down
            if (window.scrollY > 10) {
                nav.classList.add('scrolled');
            } else {
                nav.classList.remove('scrolled');
            }
        }
    };
    onScroll();
    window.addEventListener('scroll', onScroll, {passive: true});

    // Mobile: do NOT push content when menu opens (overlay behavior)
    const updateOffsets = () => {
        const isMobile = window.innerWidth < 992;
        if (! isMobile) {
            document.body.style.paddingTop = '';
            return;
        }
        // Always keep content flush; navbar stays dark and overlays
        document.body.style.paddingTop = '0px';
        nav.classList.add('scrolled');
    };
    updateOffsets();
    window.addEventListener('resize', updateOffsets);

    // Show emergency toast on load
    const toastEl = document.getElementById('emergencyToast');
    if (toastEl && window.bootstrap && window.bootstrap.Toast) {
        const toast = new bootstrap.Toast(toastEl, {autohide: false});
        toast.show();
    } else if (toastEl) {
        toastEl.classList.add('show');
    }

    if (collapseEl) {
        collapseEl.addEventListener('show.bs.collapse', function () {
            openMobileMenu();
        });
        collapseEl.addEventListener('hidden.bs.collapse', () => {
            closeMobileMenu();
            updateOffsets();
        });

        collapseEl.querySelectorAll('a.nav-link').forEach((link) => {
            link.addEventListener('click', () => {
                if (window.innerWidth >= 992)
                    return;

                requestCloseCollapse();
            });
        });
    }

    document.addEventListener('keydown', (e) => {
        if (e.key !== 'Escape')
            return;

        if (! collapseEl || ! collapseEl.classList.contains('show'))
            return;

        requestCloseCollapse();
    });

    window.addEventListener('resize', () => {
        if (window.innerWidth >= 992) {
            requestCloseCollapse();
            closeMobileMenu();
        }
    });
});
