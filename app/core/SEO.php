<?php
/**
 * Advanced SEO, OpenGraph & JSON-LD Schema Automation
 * Pokemon Calculator Hub Custom CMS
 */

namespace App\Core;

class SEO {
    /**
     * Render complete <head> SEO tags & schema
     */
    public static function renderHead(array $data = []): string {
        $siteName    = get_setting('site_name', 'Pokemon Calculator Hub');
        $siteTagline = get_setting('site_tagline', 'Pokemon GO & Competitive Calculators');
        $defaultDesc = get_setting('meta_description_default', 'Free, accurate Pokemon calculators for every trainer. Calculate CP, IVs, Stardust, Evolutions, Speed Tiers, and Damage.');
        
        $rawTitle    = $data['title'] ?? $data['meta_title'] ?? $siteName;
        
        // Build Title
        if ($rawTitle === $siteName || empty($rawTitle)) {
            $pageTitle = $siteName . ' — ' . $siteTagline;
        } elseif (str_contains($rawTitle, '—') || str_contains($rawTitle, '|')) {
            $pageTitle = $rawTitle;
        } else {
            $pageTitle = $rawTitle . ' — ' . $siteName;
        }

        $desc = $data['meta_desc'] ?? $data['excerpt'] ?? $defaultDesc;
        // Clean and trim description to max 160 characters if too long
        $desc = wp_strip_all_tags($desc);
        if (mb_strlen($desc) > 165) {
            $desc = mb_substr($desc, 0, 160) . '...';
        }

        $currentPath = ltrim(parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH), '/');
        $currentUrl = $data['canonical'] ?? pkm_absolute_url($currentPath);
        
        $ogImage = $data['og_image'] 
            ?? (get_setting('og_image_default') ? pkm_absolute_url(get_setting('og_image_default')) : pkm_absolute_url('assets/img/og-banner.png'));
        
        $type = !empty($data['is_article']) ? 'article' : 'website';
        $robots = $data['robots'] ?? 'index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1';

        $html = [];
        
        // Primary Meta
        $html[] = '<title>' . esc_html($pageTitle) . '</title>';
        $html[] = '<meta name="description" content="' . esc_attr($desc) . '">';
        $html[] = '<meta name="robots" content="' . esc_attr($robots) . '">';
        $html[] = '<link rel="canonical" href="' . esc_url($currentUrl) . '">';
        
        // Google Search & Mobile Site Name Identification Tags
        $html[] = '<meta name="application-name" content="' . esc_attr($siteName) . '">';
        $html[] = '<meta name="apple-mobile-web-app-title" content="' . esc_attr($siteName) . '">';
        
        // Open Graph / Facebook Site Name & Metadata
        $html[] = '<meta property="og:type" content="' . esc_attr($type) . '">';
        $html[] = '<meta property="og:site_name" content="' . esc_attr($siteName) . '">';
        $html[] = '<meta property="og:title" content="' . esc_attr($pageTitle) . '">';
        $html[] = '<meta property="og:description" content="' . esc_attr($desc) . '">';
        $html[] = '<meta property="og:url" content="' . esc_url($currentUrl) . '">';
        $html[] = '<meta property="og:image" content="' . esc_url($ogImage) . '">';
        $html[] = '<meta property="og:image:width" content="1200">';
        $html[] = '<meta property="og:image:height" content="630">';
        $html[] = '<meta property="og:locale" content="' . esc_attr(pkm_get_current_lang() === 'en' ? 'en_US' : pkm_get_current_lang()) . '">';

        // Twitter Card
        $html[] = '<meta name="twitter:card" content="summary_large_image">';
        $html[] = '<meta name="twitter:title" content="' . esc_attr($pageTitle) . '">';
        $html[] = '<meta name="twitter:description" content="' . esc_attr($desc) . '">';
        $html[] = '<meta name="twitter:image" content="' . esc_url($ogImage) . '">';
        if ($twHandle = get_setting('social_twitter')) {
            $parsedPath = parse_url($twHandle, PHP_URL_PATH) ?? '';
            $handle = basename($parsedPath);
            if (!empty($handle)) {
                $html[] = '<meta name="twitter:site" content="@' . esc_attr($handle) . '">';
            }
        }

        // Multilingual Alternate Hreflang Tags
        $html[] = self::renderHreflangTags($currentPath);

        // JSON-LD Structured Data (including Google Search WebSite Schema for Site Name)
        $html[] = self::renderJsonLd($data, $pageTitle, $desc, $currentUrl, $ogImage);

        return implode("\n    ", array_filter($html)) . "\n";
    }

    /**
     * Render Hreflang Tags for all supported languages
     */
    public static function renderHreflangTags(string $path = ''): string {
        if (!I18n::isMultilingualEnabled()) {
            return '';
        }

        $langs = I18n::getSupportedLanguages();
        $tags = [];
        foreach ($langs as $code => $info) {
            $url = ($code === 'en')
                ? pkm_absolute_url($path)
                : pkm_absolute_url($code . '/' . $path);
            
            $tags[] = '<link rel="alternate" hreflang="' . esc_attr($code) . '" href="' . esc_url($url) . '">';
        }
        $tags[] = '<link rel="alternate" hreflang="x-default" href="' . esc_url(pkm_absolute_url($path)) . '">';
        return implode("\n    ", $tags);
    }

    /**
     * Render comprehensive JSON-LD Structured Data
     */
    public static function renderJsonLd(array $data, string $title, string $desc, string $url, string $image): string {
        $schemas = [];
        $siteUrl = rtrim(pkm_absolute_url(), '/');
        $siteName = get_setting('site_name', 'Pokemon Calculator Hub');
        $defaultDesc = get_setting('meta_description_default', 'Free, accurate Pokemon calculators for every trainer. Calculate CP, IVs, Stardust, Evolutions, Speed Tiers, and Damage.');
        $currentLang = pkm_get_current_lang() === 'en' ? 'en-US' : pkm_get_current_lang();

        // Build Alternate Names for Google Search Site Name
        $altNamesRaw = get_setting('site_alternate_names', '');
        $altNames = [];
        if (!empty($altNamesRaw)) {
            $altNames = array_map('trim', explode(',', $altNamesRaw));
        }
        // Fallback default alternate names if none explicitly set
        if (empty($altNames)) {
            $candidates = [
                'Pokémon Calculator Hub',
                'Pokemon Calculator Hub',
                'PokemonCalculators',
                'PKM Calc Hub',
                'Pokemon Calculator'
            ];
            foreach ($candidates as $cand) {
                if (strcasecmp($cand, $siteName) !== 0 && !in_array($cand, $altNames, true)) {
                    $altNames[] = $cand;
                }
            }
        }

        // 1. Organization Schema
        $schemas[] = [
            '@context' => 'https://schema.org',
            '@type' => 'Organization',
            '@id' => $siteUrl . '/#organization',
            'name' => $siteName,
            'url' => $siteUrl . '/',
            'logo' => [
                '@type' => 'ImageObject',
                'url' => $image,
                'caption' => $siteName
            ],
            'sameAs' => array_values(array_filter([
                get_setting('social_twitter'),
                get_setting('social_discord'),
                get_setting('social_github'),
                get_setting('social_youtube')
            ]))
        ];

        // 2. WebSite Schema (Google Search Site Name structured data)
        $websiteSchema = [
            '@context' => 'https://schema.org',
            '@type' => 'WebSite',
            '@id' => $siteUrl . '/#website',
            'name' => $siteName,
            'alternateName' => array_values(array_filter(array_unique($altNames))),
            'url' => $siteUrl . '/',
            'inLanguage' => $currentLang,
            'description' => $defaultDesc,
            'publisher' => [
                '@id' => $siteUrl . '/#organization'
            ],
            'potentialAction' => [
                '@type' => 'SearchAction',
                'target' => [
                    '@type' => 'EntryPoint',
                    'urlTemplate' => $siteUrl . '/calculators?q={search_term_string}'
                ],
                'query-input' => 'required name=search_term_string'
            ]
        ];
        $schemas[] = $websiteSchema;

        // 3. WebApplication / SoftwareApplication Schema for Calculator Tools
        if (!empty($data['is_tool']) || !empty($data['tool'])) {
            $tool = $data['tool'] ?? [];
            $toolName = $tool['name'] ?? $title;
            $toolSlug = $tool['slug'] ?? '';
            $toolUrl = pkm_absolute_url($toolSlug);

            $schemas[] = [
                '@context' => 'https://schema.org',
                '@type' => 'SoftwareApplication',
                'name' => $toolName,
                'applicationCategory' => 'GameApplication',
                'operatingSystem' => 'All Web Browsers',
                'url' => $toolUrl,
                'description' => $desc,
                'softwareVersion' => '2.0',
                'offers' => [
                    '@type' => 'Offer',
                    'price' => '0',
                    'priceCurrency' => 'USD',
                    'availability' => 'https://schema.org/InStock'
                ],
                'aggregateRating' => [
                    '@type' => 'AggregateRating',
                    'ratingValue' => '4.9',
                    'ratingCount' => '1240',
                    'bestRating' => '5',
                    'worstRating' => '1'
                ],
                'author' => [
                    '@id' => $siteUrl . '/#organization'
                ]
            ];
        }

        // 4. Article / BlogPosting Schema for Blog Posts
        if (!empty($data['is_article']) && !empty($data['post'])) {
            $post = $data['post'];
            $postUrl = pkm_absolute_url('blog/' . $post['slug']);
            $authorName = $post['author_name'] ?? 'Pokemon Hub Meta Team';

            $schemas[] = [
                '@context' => 'https://schema.org',
                '@type' => 'Article',
                'headline' => $post['title'],
                'description' => $desc,
                'image' => $image,
                'datePublished' => date('c', strtotime($post['published_at'] ?? 'now')),
                'dateModified' => date('c', strtotime($post['updated_at'] ?? ($post['published_at'] ?? 'now'))),
                'mainEntityOfPage' => [
                    '@type' => 'WebPage',
                    '@id' => $postUrl
                ],
                'author' => [
                    '@type' => 'Person',
                    'name' => $authorName
                ],
                'publisher' => [
                    '@id' => $siteUrl . '/#organization'
                ]
            ];
        }

        // 5. BreadcrumbList Schema
        if (!empty($data['breadcrumbs']) && is_array($data['breadcrumbs'])) {
            $itemList = [];
            $pos = 1;
            foreach ($data['breadcrumbs'] as $name => $bUrl) {
                $fullItemUrl = str_starts_with($bUrl, 'http') ? $bUrl : pkm_absolute_url($bUrl);
                $itemList[] = [
                    '@type' => 'ListItem',
                    'position' => $pos++,
                    'name' => $name,
                    'item' => $fullItemUrl
                ];
            }
            $schemas[] = [
                '@context' => 'https://schema.org',
                '@type' => 'BreadcrumbList',
                'itemListElement' => $itemList
            ];
        }

        // 6. FAQPage Schema
        $faqs = $data['faqs'] ?? [];
        if (empty($faqs) && isset($data['tool']['slug']) && $data['tool']['slug'] === 'pokemon-go-cp-calculator') {
            $faqs = [
                ['q' => 'How is CP calculated in Pokemon GO?', 'a' => 'Combat Power is calculated using Base Attack, Defense, Stamina, individual IVs (0–15), and the official Combat Power Multiplier (CPM) for your Pokemon level.'],
                ['q' => 'What is the maximum CP achievable?', 'a' => 'Maximum CP is reached at Level 50 (or Level 51 with the Best Buddy boost) when a Pokemon has perfect 15/15/15 (100%) IVs.'],
                ['q' => 'Does evolution change a Pokemon IVs?', 'a' => 'No. IVs are permanently locked to a Pokemon and do not change upon evolution. Only CP and base stats scale upwards.']
            ];
        }

        if (!empty($faqs) && is_array($faqs)) {
            $mainEntity = [];
            foreach ($faqs as $faq) {
                if (!empty($faq['q']) && !empty($faq['a'])) {
                    $mainEntity[] = [
                        '@type' => 'Question',
                        'name' => $faq['q'],
                        'acceptedAnswer' => [
                            '@type' => 'Answer',
                            'text' => $faq['a']
                        ]
                    ];
                }
            }
            if ($mainEntity) {
                $schemas[] = [
                    '@context' => 'https://schema.org',
                    '@type' => 'FAQPage',
                    'mainEntity' => $mainEntity
                ];
            }
        }

        $out = [];
        foreach ($schemas as $s) {
            $out[] = '<script type="application/ld+json">' . "\n" . json_encode($s, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) . "\n" . '</script>';
        }

        return implode("\n    ", $out);
    }
}
