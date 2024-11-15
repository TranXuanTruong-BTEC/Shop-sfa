import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// Custom cursor
const cursor = {
    dot: document.querySelector('.cursor-dot'),
    outline: document.querySelector('.cursor-outline'),
    init: function() {
        document.addEventListener('mousemove', (e) => {
            this.dot.style.left = e.clientX + 'px';
            this.dot.style.top = e.clientY + 'px';
            
            this.outline.style.left = e.clientX + 'px';
            this.outline.style.top = e.clientY + 'px';
        });

        // Add hover effect
        document.querySelectorAll('[data-cursor]').forEach(element => {
            element.addEventListener('mouseenter', () => {
                this.outline.classList.add('cursor-hover');
            });
            
            element.addEventListener('mouseleave', () => {
                this.outline.classList.remove('cursor-hover');
            });
        });
    }
};

// Initialize
document.addEventListener('DOMContentLoaded', () => {
    cursor.init();
});

// Smooth scroll
const smoothScroll = {
    init: function() {
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    }
};

// Initialize
smoothScroll.init();
