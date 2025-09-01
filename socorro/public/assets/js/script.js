// Main JavaScript functionality
document.addEventListener('DOMContentLoaded', function() {
    // Navigation functionality
    const navbar = document.getElementById('navbar');
    const navToggle = document.getElementById('nav-toggle');
    const navMenu = document.getElementById('nav-menu');
    const navLinks = document.querySelectorAll('.nav-link');

    // Mobile menu toggle
    if (navToggle && navMenu) {
        navToggle.addEventListener('click', function() {
            navToggle.classList.toggle('active');
            navMenu.classList.toggle('active');
        });
    }

    // Close mobile menu when clicking on a link
    if (navLinks && navLinks.length && navToggle && navMenu) {
        navLinks.forEach(link => {
            link.addEventListener('click', function() {
                navToggle.classList.remove('active');
                navMenu.classList.remove('active');
            });
        });
    }

    // Navbar scroll effect
    if (navbar) {
        window.addEventListener('scroll', function() {
            if (window.scrollY > 100) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
    }

    // Smooth scrolling for navigation links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                const headerOffset = 80;
                const elementPosition = target.getBoundingClientRect().top;
                const offsetPosition = elementPosition + window.pageYOffset - headerOffset;

                window.scrollTo({
                    top: offsetPosition,
                    behavior: 'smooth'
                });
            }
        });
    });

    // Active navigation highlighting
    const sections = document.querySelectorAll('section[id']);
    
    function highlightNavigation() {
        const scrollPosition = window.scrollY + 100;

        sections.forEach(section => {
            const sectionTop = section.offsetTop;
            const sectionHeight = section.offsetHeight;
            const sectionId = section.getAttribute('id');
            const navLink = document.querySelector(`.nav-link[href="#${sectionId}"]`);

            if (scrollPosition >= sectionTop && scrollPosition < sectionTop + sectionHeight) {
                navLinks.forEach(link => link.classList.remove('active'));
                if (navLink) {
                    navLink.classList.add('active');
                }
            }
        });
    }

    window.addEventListener('scroll', highlightNavigation);

    // Intersection Observer for fade-in animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
            }
        });
    }, observerOptions);

    // Add fade-in class to elements and observe them
    const animatedElements = document.querySelectorAll('.service-card, .team-member, .gallery-item, .contact-form, .emergency-card');
    animatedElements.forEach(el => {
        el.classList.add('fade-in');
        observer.observe(el);
    });

    // Gallery lightbox functionality
    const galleryItems = document.querySelectorAll('.gallery-item');
    
    galleryItems.forEach(item => {
        item.addEventListener('click', function() {
            const img = this.querySelector('img');
            const overlay = this.querySelector('.gallery-overlay');
            const title = overlay.querySelector('h4').textContent;
            const description = overlay.querySelector('p').textContent;
            
            createLightbox(img.src, title, description);
        });
    });

    function createLightbox(imageSrc, title, description) {
        const lightbox = document.createElement('div');
        lightbox.className = 'lightbox';
        lightbox.innerHTML = `
            <div class="lightbox-content">
                <span class="lightbox-close">&times;</span>
                <img src="${imageSrc}" alt="${title}">
                <div class="lightbox-info">
                    <h3>${title}</h3>
                    <p>${description}</p>
                </div>
            </div>
        `;

        document.body.appendChild(lightbox);
        document.body.style.overflow = 'hidden';

        // Close lightbox functionality
        const closeBtn = lightbox.querySelector('.lightbox-close');
        closeBtn.addEventListener('click', closeLightbox);
        lightbox.addEventListener('click', function(e) {
            if (e.target === lightbox) {
                closeLightbox();
            }
        });

        function closeLightbox() {
            document.body.removeChild(lightbox);
            document.body.style.overflow = '';
        }

        // Close with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeLightbox();
            }
        });
    }

    // Contact form functionality
    const contactForm = document.querySelector('.contact-form');
    
    if (contactForm) contactForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Get form data
        const formData = new FormData(this);
        const name = this.querySelector('input[type="text"]').value;
        const email = this.querySelector('input[type="email"]').value;
        const type = this.querySelector('select').value;
        const message = this.querySelector('textarea').value;

        // Simple validation
        if (!name || !email || !type || !message) {
            showNotification('Por favor completa todos los campos', 'error');
            return;
        }

        // Simulate form submission
        showNotification('¡Mensaje enviado exitosamente! Te contactaremos pronto.', 'success');
        this.reset();
    });

    // Notification system
    function showNotification(message, type = 'info') {
        const notification = document.createElement('div');
        notification.className = `notification notification-${type}`;
        notification.textContent = message;
        
        document.body.appendChild(notification);
        
        setTimeout(() => {
            notification.classList.add('show');
        }, 100);

        setTimeout(() => {
            notification.classList.remove('show');
            setTimeout(() => {
                document.body.removeChild(notification);
            }, 300);
        }, 4000);
    }

    // Emergency button animations
    const emergencyButtons = document.querySelectorAll('.btn-emergency');
    emergencyButtons.forEach(btn => {
        btn.addEventListener('mouseenter', function() {
            this.style.animationDuration = '0.5s';
        });
        
        btn.addEventListener('mouseleave', function() {
            this.style.animationDuration = '2s';
        });
    });

    // Parallax effect for hero section
    window.addEventListener('scroll', function() {
        const scrolled = window.pageYOffset;
        const heroBackground = document.querySelector('.hero-background');
        
        if (heroBackground) {
            const speed = scrolled * 0.5;
            heroBackground.style.transform = `translateY(${speed}px)`;
        }
    });

    // Counter animation for stats
    function animateCounters() {
        const counters = document.querySelectorAll('.stat-number');
        
        counters.forEach(counter => {
            const target = counter.textContent;
            const isNumber = !isNaN(target.replace('+', ''));
            
            if (isNumber) {
                const targetNum = parseInt(target.replace('+', ''));
                let current = 0;
                const increment = targetNum / 100;
                
                const timer = setInterval(() => {
                    current += increment;
                    if (current >= targetNum) {
                        current = targetNum;
                        clearInterval(timer);
                    }
                    counter.textContent = Math.floor(current) + (target.includes('+') ? '+' : '');
                }, 30);
            }
        });
    }

    // Trigger counter animation when hero is visible
    const heroObserver = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                animateCounters();
                heroObserver.unobserve(entry.target);
            }
        });
    }, { threshold: 0.5 });

    const heroSection = document.querySelector('.hero');
    if (heroSection) {
        heroObserver.observe(heroSection);
    }

    // Service cards hover effect
    const serviceCards = document.querySelectorAll('.service-card');
    serviceCards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-10px) scale(1.02)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(-5px) scale(1)';
        });
    });

    // Team member cards interactive effect
    const teamMembers = document.querySelectorAll('.team-member');
    teamMembers.forEach(member => {
        member.addEventListener('mouseenter', function() {
            const img = this.querySelector('.member-image');
            img.style.transform = 'scale(1.1) rotate(5deg)';
        });
        
        member.addEventListener('mouseleave', function() {
            const img = this.querySelector('.member-image');
            img.style.transform = 'scale(1) rotate(0deg)';
        });
    });

    // Add dynamic styles for notifications and lightbox
    const styles = `
        .notification {
            position: fixed;
            top: 100px;
            right: 20px;
            padding: 1rem 2rem;
            border-radius: 8px;
            color: white;
            font-weight: 500;
            transform: translateX(400px);
            transition: transform 0.3s ease;
            z-index: 2000;
            max-width: 350px;
        }
        
        .notification.show {
            transform: translateX(0);
        }
        
        .notification-success {
            background: #10b981;
        }
        
        .notification-error {
            background: #ef4444;
        }
        
        .notification-info {
            background: #3b82f6;
        }
        
        .lightbox {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.9);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 2000;
            animation: fadeIn 0.3s ease;
        }
        
        .lightbox-content {
            position: relative;
            max-width: 90%;
            max-height: 90%;
            background: white;
            border-radius: 15px;
            overflow: hidden;
            animation: scaleIn 0.3s ease;
        }
        
        .lightbox-close {
            position: absolute;
            top: 15px;
            right: 20px;
            font-size: 2rem;
            color: white;
            cursor: pointer;
            z-index: 1;
            background: rgba(0, 0, 0, 0.5);
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }
        
        .lightbox-close:hover {
            background: rgba(239, 68, 68, 0.8);
            transform: scale(1.1);
        }
        
        .lightbox img {
            width: 100%;
            height: auto;
            display: block;
        }
        
        .lightbox-info {
            padding: 2rem;
        }
        
        .lightbox-info h3 {
            color: #1e40af;
            margin-bottom: 1rem;
            font-size: 1.5rem;
        }
        
        .lightbox-info p {
            color: #64748b;
            line-height: 1.6;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        
        @keyframes scaleIn {
            from { transform: scale(0.8); opacity: 0; }
            to { transform: scale(1); opacity: 1; }
        }
        
        .nav-link.active {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-2px);
        }
        
        @media (max-width: 768px) {
            .notification {
                right: 10px;
                left: 10px;
                max-width: none;
            }
            
            .lightbox-content {
                max-width: 95%;
                max-height: 95%;
            }
            
            .lightbox-info {
                padding: 1.5rem;
            }
        }
    `;
    
    const styleSheet = document.createElement('style');
    styleSheet.textContent = styles;
    document.head.appendChild(styleSheet);
    
    console.log('🏔️ Rescate Montaña Pro - Sitio web cargado exitosamente');
    
    // Initialize snow effect
    initSnowEffect();
    
    // News pagination functionality
    initNewsPagination();
});

// Snow Effect
function initSnowEffect() {
    const snowContainer = document.getElementById('snow-container');
    if (!snowContainer) return; // Guard if not present on page

    const snowflakeSymbols = ['❄', '❅', '❆', '✻', '✼', '❋'];
    
    function createSnowflake() {
        const snowflake = document.createElement('div');
        snowflake.className = 'snowflake';
        snowflake.innerHTML = snowflakeSymbols[Math.floor(Math.random() * snowflakeSymbols.length)];
        
        // Random properties
        const size = Math.random() * 0.8 + 0.8; // 0.8 to 1.6
        const opacity = Math.random() * 0.6 + 0.4; // 0.4 to 1
        const duration = Math.random() * 8 + 8; // 8 to 16 seconds
        const delay = Math.random() * 2; // 0 to 2 seconds delay
        
        snowflake.style.left = Math.random() * 100 + '%';
        snowflake.style.fontSize = size + 'rem';
        snowflake.style.opacity = opacity;
        snowflake.style.animationDuration = duration + 's';
        snowflake.style.animationDelay = delay + 's';
        
        // Add slight horizontal drift
        const drift = (Math.random() - 0.5) * 100; // -50 to 50px
        snowflake.style.setProperty('--drift', drift + 'px');
        
        snowContainer.appendChild(snowflake);
        
        // Remove snowflake after animation
        setTimeout(() => {
            if (snowflake.parentNode) {
                snowflake.parentNode.removeChild(snowflake);
            }
        }, (duration + delay) * 1000);
    }
    
    // Create initial snowflakes
    for (let i = 0; i < 50; i++) {
        setTimeout(() => createSnowflake(), Math.random() * 5000);
    }
    
    // Continue creating snowflakes
    setInterval(() => {
        if (Math.random() < 0.7) { // 70% chance to create a snowflake
            createSnowflake();
        }
    }, 300);
}

// News pagination functionality
function initNewsPagination() {
    const paginationBtns = document.querySelectorAll('.pagination-btn');
    
    paginationBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            if (this.textContent === '→') {
                // Next page logic
                const currentActive = document.querySelector('.pagination-btn.active');
                const currentPage = parseInt(currentActive.textContent);
                const nextBtn = document.querySelector(`.pagination-btn[textContent="${currentPage + 1}"]`);
                
                if (nextBtn) {
                    currentActive.classList.remove('active');
                    nextBtn.classList.add('active');
                }
                return;
            }
            
            // Remove active from all buttons
            paginationBtns.forEach(b => b.classList.remove('active'));
            
            // Add active to clicked button (if it's a number)
            if (!isNaN(this.textContent)) {
                this.classList.add('active');
            }
            
            // Simulate page change with animation
            const newsGrid = document.querySelector('.news-grid');
            newsGrid.style.opacity = '0.5';
            newsGrid.style.transform = 'translateY(20px)';
            
            setTimeout(() => {
                newsGrid.style.opacity = '1';
                newsGrid.style.transform = 'translateY(0)';
                showNotification(`Cargando página ${this.textContent}...`, 'info');
            }, 300);
        });
    });
}