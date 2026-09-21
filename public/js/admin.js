/**
 * Pokemon Calculator Hub - Admin Panel JavaScript
 * Interactions, Dark Mode, Slug Generation, Media Copying & Dropzone
 */

document.addEventListener('DOMContentLoaded', () => {
    // 1. Dark Mode Toggle
    const themeToggleBtn = document.getElementById('adminThemeToggle');
    if (themeToggleBtn) {
        themeToggleBtn.addEventListener('click', () => {
            const currentTheme = document.documentElement.getAttribute('data-theme') || 'light';
            const nextTheme = currentTheme === 'dark' ? 'light' : 'dark';
            document.documentElement.setAttribute('data-theme', nextTheme);
            localStorage.setItem('pkm_theme', nextTheme);
            
            const label = themeToggleBtn.querySelector('.pkm-theme-label');
            if (label) {
                label.textContent = nextTheme === 'dark' ? 'Light' : 'Dark';
            }
        });
    }

    // 2. Mobile Sidebar Toggle
    const menuToggle = document.getElementById('adminMenuToggle');
    const sidebar = document.querySelector('.pkm-admin-sidebar');
    if (menuToggle && sidebar) {
        menuToggle.addEventListener('click', () => {
            sidebar.classList.toggle('open');
        });
    }

    // 3. Auto Slug Generation
    const titleInput = document.getElementById('itemTitle') || document.getElementById('name');
    const slugInput = document.getElementById('itemSlug') || document.getElementById('slug');
    if (titleInput && slugInput && (!slugInput.value || slugInput.dataset.autogen === 'true')) {
        titleInput.addEventListener('input', () => {
            if (slugInput.dataset.autogen === 'false') return;
            const slug = titleInput.value
                .toLowerCase()
                .trim()
                .replace(/[^a-z0-9 -]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-');
            slugInput.value = slug;
        });

        slugInput.addEventListener('input', () => {
            slugInput.dataset.autogen = 'false';
        });
    }

    // 4. Tab Navigation (Settings page)
    const tabBtns = document.querySelectorAll('.pkm-tab-btn');
    const tabPanes = document.querySelectorAll('.pkm-tab-pane');
    if (tabBtns.length > 0) {
        tabBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                const targetId = btn.getAttribute('data-tab');
                tabBtns.forEach(b => b.classList.remove('active'));
                tabPanes.forEach(p => p.style.display = 'none');
                
                btn.classList.add('active');
                const targetPane = document.getElementById(targetId);
                if (targetPane) {
                    targetPane.style.display = 'block';
                }
            });
        });
    }

    // 5. Copy URL Helper
    document.querySelectorAll('.copy-url-btn').forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            const url = btn.getAttribute('data-url');
            if (navigator.clipboard) {
                navigator.clipboard.writeText(url).then(() => {
                    const originalText = btn.textContent;
                    btn.textContent = 'Copied!';
                    setTimeout(() => {
                        btn.textContent = originalText;
                    }, 2000);
                });
            }
        });
    });

    // 6. Confirm Delete dialogs
    document.querySelectorAll('.confirm-delete').forEach(form => {
        form.addEventListener('submit', (e) => {
            if (!confirm('Are you sure you want to delete this item? This action cannot be undone.')) {
                e.preventDefault();
            }
        });
    });

    // 7. Media Dropzone Drag & Drop
    const dropzone = document.getElementById('pkmDropzone');
    const fileInput = document.getElementById('mediaFileInput');
    if (dropzone && fileInput) {
        ['dragenter', 'dragover'].forEach(eventName => {
            dropzone.addEventListener(eventName, (e) => {
                e.preventDefault();
                e.stopPropagation();
                dropzone.classList.add('dragover');
            }, false);
        });

        ['dragleave', 'drop'].forEach(eventName => {
            dropzone.addEventListener(eventName, (e) => {
                e.preventDefault();
                e.stopPropagation();
                dropzone.classList.remove('dragover');
            }, false);
        });

        dropzone.addEventListener('drop', (e) => {
            const dt = e.dataTransfer;
            const files = dt.files;
            if (files.length) {
                fileInput.files = files;
                document.getElementById('uploadForm').submit();
            }
        });

        dropzone.addEventListener('click', () => {
            fileInput.click();
        });

        fileInput.addEventListener('change', () => {
            if (fileInput.files.length) {
                document.getElementById('uploadForm').submit();
            }
        });
    }
});
