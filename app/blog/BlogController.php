<?php
/**
 * Frontend Blog Controller
 * Pokemon Calculator Hub
 */

namespace App\Blog;

use App\Core\Request;
use App\Core\Response;
use App\Core\View;
use App\Core\Database;
use App\Admin\Auth;

class BlogController {
    /**
     * Blog articles listing hub (/blog)
     */
    public function index(Request $request): void {
        $categorySlug = $request->get('cat');
        $tagSlug      = $request->get('tag');
        $searchQuery  = trim($request->get('q', ''));

        $sql = "
            SELECT p.*, c.name as category_name, c.slug as category_slug, u.username as author_name
            FROM posts p
            LEFT JOIN categories c ON p.category_id = c.id
            LEFT JOIN users u ON p.author_id = u.id
            WHERE p.status = 'published' AND p.published_at <= NOW()
        ";
        $params = [];

        if (!empty($categorySlug)) {
            $sql .= " AND c.slug = ?";
            $params[] = $categorySlug;
        }

        if (!empty($searchQuery)) {
            $sql .= " AND (p.title LIKE ? OR p.content LIKE ?)";
            $params[] = "%{$searchQuery}%";
            $params[] = "%{$searchQuery}%";
        }

        $sql .= " ORDER BY p.published_at DESC";

        $posts = Database::fetchAll($sql, $params);

        $categories = Database::fetchAll("
            SELECT c.*, COUNT(p.id) as post_count 
            FROM categories c 
            LEFT JOIN posts p ON c.id = p.category_id AND p.status = 'published'
            WHERE c.type = 'blog' OR c.type = 'general'
            GROUP BY c.id 
            ORDER BY c.menu_order ASC
        ");

        $seoData = [
            'title'       => 'Pokemon Guides, Meta Strategy & Event Blog',
            'meta_desc'   => 'Read the latest Pokemon GO guides, competitive VGC strategies, Community Day tips, and raid counters.',
            'canonical'   => home_url('blog'),
            'breadcrumbs' => [
                'Home' => home_url('/'),
                'Blog' => home_url('blog')
            ]
        ];

        View::render('blog/index', [
            'posts'          => $posts,
            'categories'     => $categories,
            'active_cat'     => $categorySlug,
            'search_query'   => $searchQuery,
            'seo_data'       => $seoData,
            'body_class'     => 'pkm-blog-hub-page'
        ]);
    }

    /**
     * Show single blog article (/blog/{slug})
     */
    public function show(Request $request, array $params): void {
        $slug = $params['slug'] ?? '';

        $post = Database::fetchOne("
            SELECT p.*, c.name as category_name, c.slug as category_slug, u.username as author_name
            FROM posts p
            LEFT JOIN categories c ON p.category_id = c.id
            LEFT JOIN users u ON p.author_id = u.id
            WHERE p.slug = ? AND (p.status = 'published' OR " . (Auth::check() ? '1=1' : '0=1') . ")
        ", [$slug]);

        if (!$post) {
            http_response_code(404);
            View::render('pages/404', [
                'meta_title' => 'Article Not Found — 404',
                'meta_desc' => 'The requested blog post was not found.'
            ]);
            return;
        }

        // Increment views counter
        Database::execute("UPDATE posts SET views_count = views_count + 1 WHERE id = ?", [$post['id']]);

        // Get post tags
        $tags = Database::fetchAll("
            SELECT t.* FROM tags t 
            JOIN post_tags pt ON t.id = pt.tag_id 
            WHERE pt.post_id = ?
        ", [$post['id']]);

        // Related posts
        $relatedPosts = Database::fetchAll("
            SELECT p.*, c.name as category_name 
            FROM posts p
            LEFT JOIN categories c ON p.category_id = c.id
            WHERE p.id != ? AND p.status = 'published'
            ORDER BY (p.category_id = ?) DESC, p.published_at DESC
            LIMIT 3
        ", [$post['id'], $post['category_id'] ?? 0]);

        $seoData = [
            'title'       => $post['meta_title'] ?: $post['title'],
            'meta_desc'   => $post['meta_desc'] ?: ($post['excerpt'] ?: wp_trim_words(strip_tags($post['content']), 25)),
            'canonical'   => home_url('blog/' . $post['slug']),
            'og_image'    => $post['featured_image'] ? home_url($post['featured_image']) : null,
            'is_article'  => true,
            'post'        => $post,
            'breadcrumbs' => [
                'Home'         => home_url('/'),
                'Blog'         => home_url('blog'),
                $post['title'] => home_url('blog/' . $post['slug'])
            ]
        ];

        View::render('blog/show', [
            'post'          => $post,
            'tags'          => $tags,
            'related_posts' => $relatedPosts,
            'seo_data'      => $seoData,
            'body_class'    => 'pkm-single-post-page'
        ]);
    }
}
