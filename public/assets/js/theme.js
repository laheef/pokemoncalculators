/**
 * Dual Theme System (Light / Dark)
 * Pokemon Calculator Hub
 */

// Toggle between light and dark themes
function pkmToggleTheme() {
    var html = document.documentElement;
    var current = html.getAttribute('data-theme') || 'light';
    var next = current === 'dark' ? 'light' : 'dark';
    
    html.setAttribute('data-theme', next);
    try {
        localStorage.setItem('pkm-theme', next);
    } catch(e) {}

    updateThemeToggleIcons(next);
}

// Update icon in buttons
function updateThemeToggleIcons(theme) {
    var buttons = document.querySelectorAll('.pkm-theme-toggle, #pkm-theme-btn, .pkm-theme-toggle-btn');
    var icon = theme === 'dark' ? '☀️' : '🌙';
    buttons.forEach(function(btn) {
        var iconSpan = btn.querySelector('.pkm-theme-icon') || btn;
        if (iconSpan && iconSpan !== btn) {
            iconSpan.textContent = icon;
        }
        btn.setAttribute('aria-label', theme === 'dark' ? 'Switch to light mode' : 'Switch to dark mode');
    });
}

// Synchronize state on page load
document.addEventListener('DOMContentLoaded', function() {
    var current = document.documentElement.getAttribute('data-theme') || 'light';
    updateThemeToggleIcons(current);
});
