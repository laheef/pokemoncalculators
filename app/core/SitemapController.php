<?php
/**
 * Dynamic XML Sitemap Generator
 * Pokemon Calculator Hub Custom CMS
 */

namespace App\Core;

class SitemapController {
    /**
     * Generate dynamic XML sitemap
     */
    public function index(Request $request): void {
        header('Content-Type: application/xml; charset=utf-8');
        header('X-Robots-Tag: noindex, follow');

        $langs = array_keys(I18n::getSupportedLanguages());

        $urls = [];

        // 1. Homepage
        $latestUpdate = Database::fetchColumn("
            SELECT MAX(d) FROM (
                SELECT MAX(updated_at) as d FROM tools WHERE is_active = 1
                UNION ALL
                SELECT MAX(updated_at) as d FROM pages WHERE is_active = 1
                UNION ALL
                SELECT MAX(updated_at) as d FROM posts WHERE status = 'published'
            ) t
        ") ?: date('Y-m-d H:i:s');

        $urls[] = [
            'loc'        => pkm_absolute_url(''),
            'lastmod'    => date('Y-m-d', strtotime($latestUpdate)),
            'changefreq' => 'daily',
            'priority'   => '1.0',
            'path'       => ''
        ];

        // 2. Main Hubs
        $urls[] = [
            'loc'        => pkm_absolute_url('calculators'),
            'lastmod'    => date('Y-m-d', strtotime($latestUpdate)),
            'changefreq' => 'weekly',
            'priority'   => '0.9',
            'path'       => 'calculators'
        ];

        $urls[] = [
            'loc'        => pkm_absolute_url('type-chart'),
            'lastmod'    => date('Y-m-d', strtotime($latestUpdate)),
            'changefreq' => 'monthly',
            'priority'   => '0.8',
            'path'       => 'type-chart'
        ];

        $urls[] = [
            'loc'        => pkm_absolute_url('blog'),
            'lastmod'    => date('Y-m-d', strtotime($latestUpdate)),
            'changefreq' => 'daily',
            'priority'   => '0.8',
            'path'       => 'blog'
        ];

        // 3. Calculator Tools
        $tools = Database::fetchAll("SELECT slug, updated_at FROM tools WHERE is_active = 1 ORDER BY menu_order ASC");
        foreach ($tools as $tool) {
            $urls[] = [
                'loc'        => pkm_absolute_url($tool['slug']),
                'lastmod'    => date('Y-m-d', strtotime($tool['updated_at'] ?: date('Y-m-d'))),
                'changefreq' => 'weekly',
                'priority'   => '0.9',
                'path'       => $tool['slug']
            ];
        }

        // 4. Core Pages
        $pages = Database::fetchAll("SELECT slug, updated_at FROM pages WHERE is_active = 1 ORDER BY id ASC");
        foreach ($pages as $p) {
            $priority = in_array($p['slug'], ['privacy-policy', 'cookie-policy', 'terms-and-conditions']) ? '0.5' : '0.7';
            $changefreq = in_array($p['slug'], ['privacy-policy', 'cookie-policy', 'terms-and-conditions']) ? 'yearly' : 'monthly';
            $urls[] = [
                'loc'        => pkm_absolute_url($p['slug']),
                'lastmod'    => date('Y-m-d', strtotime($p['updated_at'] ?: date('Y-m-d'))),
                'changefreq' => $changefreq,
                'priority'   => $priority,
                'path'       => $p['slug']
            ];
        }

        // 5. Blog Posts
        $posts = Database::fetchAll("SELECT slug, updated_at, published_at FROM posts WHERE status = 'published' ORDER BY published_at DESC");
        foreach ($posts as $post) {
            $modDate = $post['updated_at'] ?: ($post['published_at'] ?: date('Y-m-d'));
            $urls[] = [
                'loc'        => pkm_absolute_url('blog/' . $post['slug']),
                'lastmod'    => date('Y-m-d', strtotime($modDate)),
                'changefreq' => 'weekly',
                'priority'   => '0.7',
                'path'       => 'blog/' . $post['slug']
            ];
        }

        // Render XML
        echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        echo '<?xml-stylesheet type="text/xsl" href="' . esc_url(pkm_absolute_url('sitemap.xsl')) . '"?>' . "\n";
        echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xhtml="http://www.w3.org/1999/xhtml">' . "\n";

        foreach ($urls as $u) {
            echo "  <url>\n";
            echo "    <loc>" . esc_html($u['loc']) . "</loc>\n";
            echo "    <lastmod>" . esc_html($u['lastmod']) . "</lastmod>\n";
            echo "    <changefreq>" . esc_html($u['changefreq']) . "</changefreq>\n";
            echo "    <priority>" . esc_html($u['priority']) . "</priority>\n";

            // Multi-language alternate links
            foreach ($langs as $langCode) {
                $altUrl = ($langCode === 'en')
                    ? pkm_absolute_url($u['path'])
                    : pkm_absolute_url($langCode . '/' . $u['path']);
                
                echo '    <xhtml:link rel="alternate" hreflang="' . esc_attr($langCode) . '" href="' . esc_url($altUrl) . '"/>' . "\n";
            }
            echo '    <xhtml:link rel="alternate" hreflang="x-default" href="' . esc_url($u['loc']) . '"/>' . "\n";

            echo "  </url>\n";
        }

        echo '</urlset>';
        exit;
    }
}
