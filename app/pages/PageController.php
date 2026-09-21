<?php
/**
 * Frontend Page Controller
 * Pokemon Calculator Hub
 */

namespace App\Pages;

use App\Core\Request;
use App\Core\Response;
use App\Core\View;
use App\Core\Database;

class PageController {
    /**
     * Show single static or dynamic page
     */
    public function show(Request $request, array $params): void {
        $slug = $params['slug'] ?? trim($request->getPath(), '/');

        // Aliases mapping for bulletproof URL resolution
        $aliases = [
            'about' => 'about-us',
            'about-us' => 'about-us',
            'contact' => 'contact-us',
            'contact-us' => 'contact-us',
            'privacy' => 'privacy-policy',
            'privacy-policy' => 'privacy-policy',
            'cookie' => 'cookie-policy',
            'cookie-policy' => 'cookie-policy',
            'terms' => 'terms-and-conditions',
            'terms-of-service' => 'terms-and-conditions',
            'terms-and-conditions' => 'terms-and-conditions',
        ];

        $targetSlug = $aliases[$slug] ?? $slug;

        $page = Database::fetchOne("
            SELECT p.*, c.name as category_name, c.slug as category_slug
            FROM pages p
            LEFT JOIN categories c ON p.category_id = c.id
            WHERE (p.slug = ? OR p.slug = ?) AND p.is_active = 1
            ORDER BY (p.slug = ?) DESC
            LIMIT 1
        ", [$targetSlug, $slug, $targetSlug]);

        if (!$page) {
            http_response_code(404);
            View::render('pages/404', [
                'meta_title' => 'Page Not Found — 404',
                'meta_desc' => 'The requested page was not found.'
            ]);
            return;
        }

        // Check if page has an associated category with tools
        $relatedTools = [];
        if (!empty($page['category_id'])) {
            $relatedTools = Database::fetchAll("
                SELECT t.*, c.name as category_name 
                FROM tools t
                LEFT JOIN categories c ON t.category_id = c.id
                WHERE t.category_id = ? AND t.is_active = 1
                ORDER BY t.menu_order ASC
                LIMIT 4
            ", [$page['category_id']]);
        }

        $faqs = [];
        if (in_array($page['slug'], ['contact-us', 'contact'])) {
            $faqs = [
                [
                    'q' => 'How often is Pokemon data updated?',
                    'a' => 'Our database syncs with official Game Master updates and APK pushes within 24 hours of new Pokemon, movesets, or CP rebalances.'
                ],
                [
                    'q' => 'Are these calculators free to use?',
                    'a' => 'Yes, 100% free! Every tool on Pokemon Calculator Hub is publicly accessible without subscriptions or paywalls.'
                ],
                [
                    'q' => 'Can I request a custom calculator or guide?',
                    'a' => 'Absolutely! Submit a feature request through our contact form and describe the tool or guide you would like to see.'
                ]
            ];
        }

        $seoData = [
            'title'       => $page['meta_title'] ?: $page['title'],
            'meta_desc'   => $page['meta_desc'] ?: ($page['excerpt'] ?: wp_trim_words(strip_tags($page['content']), 25)),
            'canonical'   => home_url($page['slug']),
            'og_image'    => $page['og_image'] ? home_url($page['og_image']) : null,
            'faqs'        => $faqs,
            'breadcrumbs' => [
                'Home'         => home_url('/'),
                $page['title'] => home_url($page['slug'])
            ]
        ];

        View::render('pages/show', [
            'page'          => $page,
            'related_tools' => $relatedTools,
            'seo_data'      => $seoData,
            'body_class'    => 'pkm-page pkm-page-' . esc_attr($page['slug'])
        ]);
    }

    /**
     * Handle Contact Form submission
     */
    public function submitContact(Request $request): void {
        $name    = trim($request->post('name', ''));
        $email   = trim($request->post('email', ''));
        $subject = trim($request->post('subject', 'General Inquiry'));
        $message = trim($request->post('message', ''));
        $ip      = $request->getIp();

        if (empty($name) || empty($email) || empty($message)) {
            $_SESSION['contact_error'] = 'Please fill out all required fields.';
            Response::redirect(home_url('contact'));
            return;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['contact_error'] = 'Please enter a valid email address.';
            Response::redirect(home_url('contact'));
            return;
        }

        Database::execute("
            INSERT INTO contact_submissions (name, email, subject, message, ip_address)
            VALUES (?, ?, ?, ?, ?)
        ", [$name, $email, $subject, $message, $ip]);

        $_SESSION['contact_success'] = 'Thank you! Your message has been sent successfully. We will respond shortly.';
        Response::redirect(home_url('contact'));
    }
}
