<?php
/**
 * Admin Blog / Articles Manager Controller
 * Pokemon Calculator Hub Custom CMS
 */

namespace App\Admin;

use App\Core\Request;
use App\Core\Response;
use App\Core\View;
use App\Core\Database;

class BlogController {
    /**
     * List all blog articles
     */
    public function index(Request $request): void {
        Auth::requireAuth();

        $posts = Database::fetchAll("
            SELECT p.*, c.name as category_name, u.username as author_name
            FROM posts p
            LEFT JOIN categories c ON p.category_id = c.id
            LEFT JOIN users u ON p.author_id = u.id
            ORDER BY p.published_at DESC, p.id DESC
        ");

        View::render('admin/blog/index', [
            'title'       => 'Blog & Articles Manager',
            'posts'       => $posts,
            'flashes'     => Auth::getFlashes(),
            'active_menu' => 'blog'
        ], 'admin');
    }

    /**
     * Show create article form
     */
    public function create(Request $request): void {
        Auth::requireAuth();

        $categories = Database::fetchAll("SELECT * FROM categories WHERE type = 'blog' OR type = 'general' ORDER BY menu_order ASC");
        $tags = Database::fetchAll("SELECT * FROM tags ORDER BY name ASC");

        View::render('admin/blog/form', [
            'title'       => 'Write New Article',
            'post'        => null,
            'categories'  => $categories,
            'tags'        => $tags,
            'post_tags'   => [],
            'flashes'     => Auth::getFlashes(),
            'active_menu' => 'blog'
        ], 'admin');
    }

    /**
     * Store new blog article
     */
    public function store(Request $request): void {
        Auth::requireAuth();

        if (!Auth::verifyCsrf($request->post('_csrf_token'))) {
            Auth::setFlash('error', 'CSRF validation failed.');
            Response::redirect(home_url('admin/blog/create'));
            return;
        }

        $title          = trim($request->post('title', ''));
        $slug           = trim($request->post('slug', ''));
        $content        = $request->post('content', '');
        $excerpt        = trim($request->post('excerpt', ''));
        $category_id    = $request->post('category_id') ? intval($request->post('category_id')) : null;
        $featured_image = trim($request->post('featured_image', ''));
        $status         = $request->post('status', 'published');
        $meta_title     = trim($request->post('meta_title', ''));
        $meta_desc      = trim($request->post('meta_description', $request->post('meta_desc', '')));
        $published_at   = $request->post('published_at') ?: date('Y-m-d H:i:s');
        $author_id      = $_SESSION['admin_user_id'] ?? 1;

        if (empty($title)) {
            Auth::setFlash('error', 'Article title is required.');
            Response::redirect(home_url('admin/blog/create'));
            return;
        }

        if (empty($slug)) {
            $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $title), '-'));
        }

        $exists = Database::fetchOne("SELECT id FROM posts WHERE slug = ?", [$slug]);
        if ($exists) {
            Auth::setFlash('error', 'An article with this slug already exists. Please choose a unique slug.');
            Response::redirect(home_url('admin/blog/create'));
            return;
        }

        Database::execute("
            INSERT INTO posts (slug, title, content, excerpt, category_id, author_id, featured_image, status, meta_title, meta_desc, published_at, created_at, updated_at)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW())
        ", [$slug, $title, $content, $excerpt, $category_id, $author_id, $featured_image, $status, $meta_title, $meta_desc, $published_at]);

        $postId = Database::lastInsertId();

        // Handle tags
        $tagsInput = trim($request->post('tags', ''));
        if (!empty($tagsInput)) {
            $tagNames = array_filter(array_map('trim', explode(',', $tagsInput)));
            foreach ($tagNames as $tname) {
                $tslug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $tname), '-'));
                $tag = Database::fetchOne("SELECT id FROM tags WHERE slug = ?", [$tslug]);
                if (!$tag) {
                    Database::execute("INSERT INTO tags (slug, name) VALUES (?, ?)", [$tslug, $tname]);
                    $tagId = Database::lastInsertId();
                } else {
                    $tagId = $tag['id'];
                }
                Database::execute("INSERT IGNORE INTO post_tags (post_id, tag_id) VALUES (?, ?)", [$postId, $tagId]);
            }
        }

        Auth::setFlash('success', "Article '{$title}' saved successfully!");
        Response::redirect(home_url('admin/blog'));
    }

    /**
     * Show edit article form
     */
    public function edit(Request $request, array $params = []): void {
        Auth::requireAuth();
        $id = intval($params['id'] ?? $request->get('id', 0));

        $post = Database::fetchOne("SELECT * FROM posts WHERE id = ?", [$id]);
        if (!$post) {
            Auth::setFlash('error', 'Article not found.');
            Response::redirect(home_url('admin/blog'));
            return;
        }

        $post['meta_description'] = $post['meta_desc'] ?? '';

        $categories = Database::fetchAll("SELECT * FROM categories WHERE type = 'blog' OR type = 'general' ORDER BY menu_order ASC");
        
        $postTags = Database::fetchAll("
            SELECT t.name FROM tags t 
            JOIN post_tags pt ON t.id = pt.tag_id 
            WHERE pt.post_id = ?
        ", [$id]);

        View::render('admin/blog/form', [
            'title'       => "Edit Article: {$post['title']}",
            'post'        => $post,
            'categories'  => $categories,
            'post_tags'   => $postTags,
            'flashes'     => Auth::getFlashes(),
            'active_menu' => 'blog'
        ], 'admin');
    }

    /**
     * Update existing article
     */
    public function update(Request $request, array $params = []): void {
        Auth::requireAuth();
        $id = intval($params['id'] ?? $request->post('id', 0));

        if (!Auth::verifyCsrf($request->post('_csrf_token'))) {
            Auth::setFlash('error', 'CSRF validation failed.');
            Response::redirect(home_url('admin/blog'));
            return;
        }

        $post = Database::fetchOne("SELECT * FROM posts WHERE id = ?", [$id]);
        if (!$post) {
            Auth::setFlash('error', 'Article not found.');
            Response::redirect(home_url('admin/blog'));
            return;
        }

        $title          = trim($request->post('title', ''));
        $slug           = trim($request->post('slug', ''));
        $content        = $request->post('content', '');
        $excerpt        = trim($request->post('excerpt', ''));
        $category_id    = $request->post('category_id') ? intval($request->post('category_id')) : null;
        $featured_image = trim($request->post('featured_image', ''));
        $status         = $request->post('status', 'published');
        $meta_title     = trim($request->post('meta_title', ''));
        $meta_desc      = trim($request->post('meta_description', $request->post('meta_desc', '')));
        $published_at   = $request->post('published_at') ?: $post['published_at'];

        if (empty($title)) {
            Auth::setFlash('error', 'Article title is required.');
            Response::redirect(home_url('admin/blog/edit?id=' . $id));
            return;
        }

        if (empty($slug)) {
            $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $title), '-'));
        }

        $exists = Database::fetchOne("SELECT id FROM posts WHERE slug = ? AND id != ?", [$slug, $id]);
        if ($exists) {
            Auth::setFlash('error', 'Another article already uses this slug.');
            Response::redirect(home_url('admin/blog/edit?id=' . $id));
            return;
        }

        Database::execute("
            UPDATE posts 
            SET slug = ?, title = ?, content = ?, excerpt = ?, category_id = ?, featured_image = ?, status = ?, meta_title = ?, meta_desc = ?, published_at = ?, updated_at = NOW()
            WHERE id = ?
        ", [$slug, $title, $content, $excerpt, $category_id, $featured_image, $status, $meta_title, $meta_desc, $published_at, $id]);

        // Refresh tags
        Database::execute("DELETE FROM post_tags WHERE post_id = ?", [$id]);
        $tagsInput = trim($request->post('tags', ''));
        if (!empty($tagsInput)) {
            $tagNames = array_filter(array_map('trim', explode(',', $tagsInput)));
            foreach ($tagNames as $tname) {
                $tslug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $tname), '-'));
                $tag = Database::fetchOne("SELECT id FROM tags WHERE slug = ?", [$tslug]);
                if (!$tag) {
                    Database::execute("INSERT INTO tags (slug, name) VALUES (?, ?)", [$tslug, $tname]);
                    $tagId = Database::lastInsertId();
                } else {
                    $tagId = $tag['id'];
                }
                Database::execute("INSERT IGNORE INTO post_tags (post_id, tag_id) VALUES (?, ?)", [$id, $tagId]);
            }
        }

        Auth::setFlash('success', "Article '{$title}' updated successfully.");
        Response::redirect(home_url('admin/blog'));
    }

    /**
     * Delete article
     */
    public function delete(Request $request, array $params = []): void {
        Auth::requireAuth();
        $id = intval($params['id'] ?? $request->post('id', 0));

        if (!Auth::verifyCsrf($request->post('_csrf_token'))) {
            Auth::setFlash('error', 'CSRF validation failed.');
            Response::redirect(home_url('admin/blog'));
            return;
        }

        $post = Database::fetchOne("SELECT title FROM posts WHERE id = ?", [$id]);
        if ($post) {
            Database::execute("DELETE FROM post_tags WHERE post_id = ?", [$id]);
            Database::execute("DELETE FROM posts WHERE id = ?", [$id]);
            Auth::setFlash('success', "Article '{$post['title']}' deleted.");
        }

        Response::redirect(home_url('admin/blog'));
    }
}
