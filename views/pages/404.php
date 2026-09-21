<div class="pkm-404-container" style="max-width:700px; margin:80px auto; text-align:center; padding:40px 20px;">
    <div style="font-size:5rem; font-weight:900; color:var(--pkm-primary); font-family:var(--pkm-font-display, 'Exo 2', sans-serif); margin-bottom:20px;">
        404
    </div>
    <h1 style="font-size:2rem; color:var(--pkm-text); margin-bottom:16px;">
        A Wild 404 Appeared!
    </h1>
    <p style="color:var(--pkm-text-muted); font-size:1.1rem; line-height:1.6; margin-bottom:32px;">
        The page you are looking for has fled into the tall grass or does not exist.
    </p>
    <div style="display:flex; justify-content:center; gap:16px; flex-wrap:wrap;">
        <a href="<?= esc_url(home_url('/')) ?>" class="pkm-btn pkm-btn-primary" style="display:inline-block; padding:12px 28px; background:var(--pkm-primary); color:#fff; text-decoration:none; border-radius:var(--pkm-radius-sm); font-weight:700;">
            Return to Homepage
        </a>
        <a href="<?= esc_url(home_url('calculators')) ?>" class="pkm-btn" style="display:inline-block; padding:12px 28px; background:var(--pkm-bg-3); color:var(--pkm-text); text-decoration:none; border-radius:var(--pkm-radius-sm); font-weight:700; border:1px solid var(--pkm-border);">
            Browse All Calculators
        </a>
    </div>
</div>
