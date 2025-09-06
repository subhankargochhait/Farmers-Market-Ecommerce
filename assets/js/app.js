// Initialize Lucide icons
lucide.createIcons();

// Mobile menu toggle with smooth animation + icon change
function toggleMobileMenu() {
    const mobileMenu = document.getElementById('mobile-menu');
    const menuIcon = document.getElementById("menu-icon");
    const closeIcon = document.getElementById("close-icon");

    if (mobileMenu.classList.contains("max-h-0")) {
        mobileMenu.classList.remove("max-h-0");
        mobileMenu.classList.add("max-h-[500px]");
    } else {
        mobileMenu.classList.add("max-h-0");
        mobileMenu.classList.remove("max-h-[500px]");
    }

    menuIcon.classList.toggle("hidden");
    closeIcon.classList.toggle("hidden");
}

// Back to top functionality
const backToTop = document.getElementById('backToTop');

window.addEventListener('scroll', () => {
    if (window.pageYOffset > 300) {
        backToTop.classList.remove('opacity-0', 'invisible');
        backToTop.classList.add('opacity-100', 'visible');
    } else {
        backToTop.classList.add('opacity-0', 'invisible');
        backToTop.classList.remove('opacity-100', 'visible');
    }
});

backToTop.addEventListener('click', () => {
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
});

// Smooth scrolling for anchor links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    });
});

// Scroll animations
const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -50px 0px'
};

const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('animate-fadeIn');
        }
    });
}, observerOptions);

// Observe all sections
document.querySelectorAll('section').forEach(section => {
    observer.observe(section);
});

// Add fade-in animation CSS
const style = document.createElement('style');
style.textContent = `
    .animate-fadeIn {
        animation: fadeIn 0.6s ease-out forwards;
    }
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
`;
document.head.appendChild(style);

// Counter animation
function animateCounter(element, target) {
    let current = 0;
    const increment = target / 100;
    const timer = setInterval(() => {
        current += increment;
        if (current >= target) {
            element.textContent = target + (element.dataset.suffix || "");
            clearInterval(timer);
        } else {
            element.textContent = Math.floor(current) + (element.dataset.suffix || "");
        }
    }, 20);
}

// Trigger counters when stats section is visible
const statsObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            const counters = entry.target.querySelectorAll('.counter');
            counters.forEach(counter => {
                const raw = counter.textContent.trim();
                const target = parseInt(raw.replace(/\D/g, '')) || 0;
                const suffix = raw.replace(/[0-9]/g, ""); // keep symbols like +
                counter.dataset.suffix = suffix;
                animateCounter(counter, target);
            });
            statsObserver.unobserve(entry.target);
        }
    });
});

// Observe first section that has .counter elements
const statsSection = document.querySelector('section .counter')?.closest("section");
if (statsSection) {
    statsObserver.observe(statsSection);
}
