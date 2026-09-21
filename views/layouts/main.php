<!DOCTYPE html>
<html lang="<?= esc_attr(pkm_get_current_lang()) ?>" data-theme="<?= esc_attr(get_setting('default_theme', 'light')) ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- PKM Anti-Flash Script: Runs synchronously before paint -->
    <script>
    (function() {
        try {
            var saved = localStorage.getItem('pkm-theme');
            var preferred = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
            var defaultTheme = '<?= esc_js(get_setting('default_theme', 'light')) ?>';
            var theme = saved || defaultTheme;
            document.documentElement.setAttribute('data-theme', theme);
        } catch(e) {
            document.documentElement.setAttribute('data-theme', '<?= esc_js(get_setting('default_theme', 'light')) ?>');
        }
    })();
    </script>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Exo+2:ital,wght@0,300..900;1,300..900&family=Press+Start+2P&display=swap" rel="stylesheet">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="<?= home_url('assets/css/theme.css') ?>">
    <link rel="stylesheet" href="<?= home_url('assets/css/header-footer.css') ?>">
    <link rel="stylesheet" href="<?= home_url('assets/css/ads.css') ?>">
    <link rel="stylesheet" href="<?= home_url('assets/css/home.css') ?>">
    <link rel="stylesheet" href="<?= home_url('assets/css/calculators-hub.css') ?>">
    <link rel="stylesheet" href="<?= home_url('assets/css/type-chart.css') ?>">
    <link rel="stylesheet" href="<?= home_url('assets/css/pages.css') ?>">

    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="<?= pkm_get_favicon_url() ?>">
    <link rel="shortcut icon" type="image/svg+xml" href="<?= pkm_get_favicon_url() ?>">
    <link rel="apple-touch-icon" sizes="180x180" href="<?= pkm_get_favicon_url() ?>">
    <meta name="theme-color" content="#0D9488">

    <!-- SEO & Metadata & Schema -->
    <?= \App\Core\SEO::renderHead($seo_data ?? [
        'title' => $meta_title ?? $title ?? get_setting('site_name', 'Pokemon Calculator Hub'),
        'meta_desc' => $meta_desc ?? get_setting('site_description'),
        'canonical' => $canonical ?? null,
        'og_image' => $og_image ?? null,
        'is_tool' => $is_tool ?? false,
        'tool' => $tool ?? null,
        'is_article' => $is_article ?? false,
        'post' => $post ?? null,
        'faqs' => $faqs ?? null
    ]) ?>

    <!-- Google AdSense Auto-Script -->
    <?php if ($adsenseId = get_setting('adsense_client_id')): ?>
        <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=<?= esc_attr($adsenseId) ?>" crossorigin="anonymous"></script>
    <?php endif; ?>

    <!-- Google Analytics / Tag Manager -->
    <?php if ($gaId = get_setting('analytics_id')): ?>
        <script async src="https://www.googletagmanager.com/gtag/js?id=<?= esc_attr($gaId) ?>"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());
            gtag('config', '<?= esc_js($gaId) ?>');
        </script>
    <?php endif; ?>

    <!-- Custom Header Code (Configured via Admin Site Settings) -->
    <?php 
    $customHeader = get_setting('custom_header_code', get_setting('header_code', ''));
    if (!empty(trim($customHeader))) {
        echo "\n    <!-- Custom User Header Code -->\n    " . $customHeader . "\n";
    }
    ?>

    <?php if (!empty($extra_head)) echo $extra_head; ?>
</head>
<body class="<?= esc_attr($body_class ?? 'pkm-body') ?>">

    <!-- Skyscraper Ads (Left & Right desktop flanks) -->
    <?php 
    $skyLeft = get_setting('ad_slot_sky_left', '');
    if (!empty(trim($skyLeft))): 
    ?>
        <aside class="pkm-skyscraper pkm-skyscraper-left" aria-label="Advertisement Left">
            <div class="pkm-skyscraper-inner">
                <?= $skyLeft ?>
            </div>
        </aside>
    <?php endif; ?>

    <?php 
    $skyRight = get_setting('ad_slot_sky_right', '');
    if (!empty(trim($skyRight))): 
    ?>
        <aside class="pkm-skyscraper pkm-skyscraper-right" aria-label="Advertisement Right">
            <div class="pkm-skyscraper-inner">
                <?= $skyRight ?>
            </div>
        </aside>
    <?php endif; ?>

    <?php \App\Core\View::partial('header'); ?>

    <main id="main-content" class="pkm-main-content">
        <?= $content ?>
    </main>

    <?php \App\Core\View::partial('footer'); ?>

    <!-- Theme & Main Scripts -->
    <script src="<?= home_url('assets/js/theme.js') ?>"></script>
    <script src="<?= home_url('assets/js/main.js') ?>"></script>

    <!-- Custom Footer / Body Scripts (Configured via Admin Site Settings) -->
    <?php 
    $customFooter = get_setting('custom_footer_code', get_setting('footer_code', ''));
    if (!empty(trim($customFooter))) {
        echo "\n    <!-- Custom User Footer Code -->\n    " . $customFooter . "\n";
    }
    ?>

    <?php if (!empty($extra_scripts)) echo $extra_scripts; ?>
</body>
</html>
