/**
 * Main Frontend Interactions & Client-Side User Experience
 * Pokemon Calculator Hub
 */

document.addEventListener('DOMContentLoaded', function() {
    // 1. Header scroll shadow
    var header = document.querySelector('.pkm-header');
    if (header) {
        window.addEventListener('scroll', function() {
            if (window.scrollY > 20) {
                header.classList.add('pkm-header-scrolled');
            } else {
                header.classList.remove('pkm-header-scrolled');
            }
        }, { passive: true });
    }

    // 2. Mobile Menu Drawer Toggle
    var menuToggle = document.getElementById('pkm-mobile-menu-toggle');
    var mobileNav = document.getElementById('pkm-mobile-nav');
    var backdrop = document.getElementById('pkm-mobile-backdrop');
    var closeBtn = document.getElementById('pkm-mobile-close');

    function openMobileMenu() {
        if (mobileNav) {
            mobileNav.style.display = 'flex';
            requestAnimationFrame(function() {
                mobileNav.classList.add('active');
            });
        }
        if (backdrop) {
            backdrop.style.display = 'block';
            requestAnimationFrame(function() {
                backdrop.classList.add('active');
            });
        }
        document.body.style.overflow = 'hidden';
    }

    function closeMobileMenu() {
        if (mobileNav) {
            mobileNav.classList.remove('active');
            setTimeout(function() {
                if (!mobileNav.classList.contains('active')) {
                    mobileNav.style.display = 'none';
                }
            }, 300);
        }
        if (backdrop) {
            backdrop.classList.remove('active');
            setTimeout(function() {
                if (!backdrop.classList.contains('active')) {
                    backdrop.style.display = 'none';
                }
            }, 300);
        }
        document.body.style.overflow = '';
    }

    if (menuToggle) menuToggle.addEventListener('click', openMobileMenu);
    if (closeBtn) closeBtn.addEventListener('click', closeMobileMenu);
    if (backdrop) backdrop.addEventListener('click', closeMobileMenu);

    // 3. Language Switcher Dropdown Click Toggle
    var langBtn = document.getElementById('pkmLangBtn');
    var langDropdown = document.getElementById('pkmLangDropdown');
    var langSwitcher = document.getElementById('pkmLangSwitcher');

    if (langBtn && langDropdown) {
        langBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            var isOpen = langDropdown.style.visibility === 'visible' || langDropdown.classList.contains('active');
            if (isOpen) {
                langDropdown.style.opacity = '0';
                langDropdown.style.visibility = 'hidden';
                langDropdown.classList.remove('active');
                langBtn.setAttribute('aria-expanded', 'false');
            } else {
                langDropdown.style.opacity = '1';
                langDropdown.style.visibility = 'visible';
                langDropdown.classList.add('active');
                langBtn.setAttribute('aria-expanded', 'true');
            }
        });

        document.addEventListener('click', function(e) {
            if (langSwitcher && !langSwitcher.contains(e.target)) {
                langDropdown.style.opacity = '0';
                langDropdown.style.visibility = 'hidden';
                langDropdown.classList.remove('active');
                if (langBtn) langBtn.setAttribute('aria-expanded', 'false');
            }
        });
    }

    // 4. Mobile accordion dropdowns
    var mobileDropdownToggles = document.querySelectorAll('.pkm-mobile-dropdown-toggle');
    mobileDropdownToggles.forEach(function(toggle) {
        toggle.addEventListener('click', function(e) {
            e.preventDefault();
            var parent = toggle.closest('.pkm-mobile-dropdown');
            if (parent) {
                parent.classList.toggle('open');
            }
        });
    });

    // 5. FAQ Accordion
    var faqItems = document.querySelectorAll('.pkm-faq-item');
    faqItems.forEach(function(item) {
        var trigger = item.querySelector('.pkm-faq-q');
        if (trigger) {
            trigger.addEventListener('click', function() {
                var wasOpen = item.classList.contains('active');
                faqItems.forEach(function(other) { other.classList.remove('active'); });
                if (!wasOpen) {
                    item.classList.add('active');
                }
            });
        }
    });

    // 6. Client-Side Favorites & Recent Tool Tracking (User Experience)
    initUserToolFavorites();
});

// Live Search for Tools (Calculators Page)
function pkmSearchTools(query) {
    var filter = (query || '').toLowerCase().trim();
    var cards = document.querySelectorAll('.pkm-calc-card, .pkm-tool-card');
    var count = 0;

    cards.forEach(function(card) {
        var name = (card.getAttribute('data-name') || card.textContent || '').toLowerCase();
        var desc = (card.getAttribute('data-desc') || '').toLowerCase();
        var match = filter === '' || name.indexOf(filter) !== -1 || desc.indexOf(filter) !== -1;
        
        card.style.display = match ? '' : 'none';
        if (match) count++;
    });

    var countDisplay = document.getElementById('pkm-search-count');
    if (countDisplay) {
        countDisplay.textContent = filter === '' ? '' : (count + ' tool' + (count === 1 ? '' : 's') + ' found');
    }
}

// User Tool Favorites & History (Privacy-First Client-Side Storage)
function initUserToolFavorites() {
    try {
        var path = window.location.pathname.replace(/^\/(en|es|pt-br|fr|de)\//, '/').replace(/^\//, '');
        var favorites = JSON.parse(localStorage.getItem('pkm_favorite_tools') || '[]');
        var recents = JSON.parse(localStorage.getItem('pkm_recent_tools') || '[]');

        // If currently viewing a tool, record in recents
        if (path && path.indexOf('calculator') !== -1 || path === 'speed-tiers' || path === 'type-chart') {
            if (recents.indexOf(path) === -1) {
                recents.unshift(path);
                if (recents.length > 5) recents.pop();
                localStorage.setItem('pkm_recent_tools', JSON.stringify(recents));
            }
        }

        // Highlight favorited tool cards if any
        document.querySelectorAll('.pkm-tool-card, .pkm-calc-card').forEach(function(card) {
            var href = card.getAttribute('href') || '';
            var slug = href.split('/').filter(Boolean).pop();
            if (slug && favorites.indexOf(slug) !== -1) {
                card.classList.add('pkm-is-favorited');
            }
        });
    } catch(e) {
        // LocalStorage disabled or quota exceeded
    }
}

function pkmToggleFavorite(slug, e) {
    if (e) e.preventDefault();
    try {
        var favorites = JSON.parse(localStorage.getItem('pkm_favorite_tools') || '[]');
        var idx = favorites.indexOf(slug);
        if (idx !== -1) {
            favorites.splice(idx, 1);
        } else {
            favorites.push(slug);
        }
        localStorage.setItem('pkm_favorite_tools', JSON.stringify(favorites));
        initUserToolFavorites();
    } catch(e) {}
}
