import './bootstrap';

// ─── Alpine.js initialization ─────────────────────────
// Alpine is loaded via CDN in layout, no import needed here.
// Add global Alpine data/stores below if needed.

// ─── Lazy Loading Images ──────────────────────────────
document.addEventListener('DOMContentLoaded', () => {

    // Intersection Observer for lazy loading
    if ('IntersectionObserver' in window) {
        const lazyImages = document.querySelectorAll('img[loading="lazy"]');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    if (img.dataset.src) {
                        img.src = img.dataset.src;
                        img.removeAttribute('data-src');
                    }
                    img.classList.remove('opacity-0');
                    img.classList.add('opacity-100', 'transition-opacity', 'duration-300');
                    observer.unobserve(img);
                }
            });
        }, { rootMargin: '50px 0px' });

        lazyImages.forEach(img => observer.observe(img));
    }

    // ─── CSRF Token for all fetch() calls ─────────────
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;

    // Make it globally available
    window.csrfToken = csrfToken;

    // Patch fetch to auto-include CSRF for same-origin POST
    const originalFetch = window.fetch;
    window.fetch = function(url, options = {}) {
        if (options.method && ['POST', 'PUT', 'PATCH', 'DELETE'].includes(options.method.toUpperCase())) {
            options.headers = {
                'X-CSRF-TOKEN': csrfToken,
                ...options.headers,
            };
        }
        return originalFetch(url, options);
    };
});
