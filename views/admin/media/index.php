<?php
/**
 * Admin Media Library View
 * Pokemon Calculator Hub Custom CMS
 */
?>

<div class="pkm-admin-header">
    <div>
        <h1 class="pkm-admin-title">Media Library</h1>
        <p class="pkm-admin-subtitle">Upload graphics, banners, sprites, and guide illustrations.</p>
    </div>
</div>

<!-- UPLOAD DROPZONE -->
<div class="pkm-card">
    <form id="uploadForm" method="POST" action="<?= esc_url(home_url('admin/media/upload')) ?>" enctype="multipart/form-data">
        <?= \App\Admin\Auth::csrfInput() ?>
        <input type="file" id="mediaFileInput" name="media_file" style="display:none;" accept="image/*,.svg,.webp">
        
        <div class="pkm-dropzone" id="pkmDropzone">
            <svg width="48" height="48" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color:var(--pkm-admin-primary); margin-bottom:12px;">
                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/>
            </svg>
            <h3 style="font-size:1.1rem; color:var(--pkm-admin-text); margin-bottom:4px;">Drag and drop files here, or click to browse</h3>
            <p style="font-size:0.85rem; color:var(--pkm-admin-text-muted);">Supports PNG, JPG, WEBP, GIF, SVG (up to 10MB)</p>
        </div>
    </form>
</div>

<!-- MEDIA ASSETS GRID -->
<div class="pkm-card">
    <div class="pkm-card-header">
        <h2 class="pkm-card-title">Uploaded Media Files (<?= count($media) ?>)</h2>
    </div>

    <?php if (!empty($media)): ?>
        <div class="pkm-media-grid">
            <?php foreach ($media as $item): ?>
                <div class="pkm-media-item">
                    <div class="pkm-media-thumb">
                        <img src="<?= esc_url(home_url($item['file_path'])) ?>" alt="<?= esc_attr($item['original_name']) ?>" loading="lazy">
                    </div>
                    <div class="pkm-media-info">
                        <div class="pkm-media-title" title="<?= esc_attr($item['original_name']) ?>">
                            <?= esc_html($item['original_name']) ?>
                        </div>
                        <div style="color:var(--pkm-admin-text-muted); font-size:0.75rem; margin-bottom:8px;">
                            <?= pkm_format_bytes($item['file_size']) ?>
                        </div>
                        <div style="display:flex; justify-content:space-between; align-items:center;">
                            <button type="button" class="pkm-btn pkm-btn-secondary pkm-btn-sm copy-url-btn" data-url="<?= esc_url(home_url($item['file_path'])) ?>" style="font-size:0.75rem; padding:3px 8px;">
                                Copy URL
                            </button>
                            <form method="POST" action="<?= esc_url(home_url('admin/media/delete')) ?>" class="confirm-delete" style="display:inline;">
                                <?= \App\Admin\Auth::csrfInput() ?>
                                <input type="hidden" name="id" value="<?= intval($item['id']) ?>">
                                <button type="submit" style="background:none; border:none; color:var(--pkm-admin-danger); cursor:pointer; font-size:0.75rem;">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div style="text-align:center; padding:40px; color:var(--pkm-admin-text-muted);">
            No media files uploaded yet. Upload your first image using the dropzone above.
        </div>
    <?php endif; ?>
</div>
