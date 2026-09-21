<?php
/**
 * Admin Blog Management Index View
 * Pokemon Calculator Hub Custom CMS
 */
?>

<div class="pkm-admin-header">
    <div>
        <h1 class="pkm-admin-title">Blog & Articles Manager</h1>
        <p class="pkm-admin-subtitle">Write guides, meta tier analyses, Community Day breakdowns, and calculator tutorials.</p>
    </div>
    <div class="pkm-admin-actions">
        <a href="<?= esc_url(home_url('admin/blog/create')) ?>" class="pkm-btn pkm-btn-primary">
            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            Write New Post
        </a>
    </div>
</div>

<div class="pkm-card">
    <div class="pkm-table-responsive">
        <table class="pkm-table">
            <thead>
                <tr>
                    <th>Article Title</th>
                    <th>Author</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Views</th>
                    <th>Date</th>
                    <th style="text-align: right;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($posts)): ?>
                    <?php foreach ($posts as $post): ?>
                        <tr>
                            <td>
                                <strong style="font-size:0.95rem;"><?= esc_html($post['title']) ?></strong>
                                <div>
                                    <a href="<?= esc_url(home_url('blog/' . $post['slug'])) ?>" target="_blank" style="color:var(--pkm-admin-primary); text-decoration:none; font-size:0.8rem;">
                                        /blog/<?= esc_html($post['slug']) ?> &nearr;
                                    </a>
                                </div>
                            </td>
                            <td><?= esc_html($post['author_name'] ?? 'Admin') ?></td>
                            <td>
                                <span class="pkm-badge pkm-badge-primary">
                                    <?= esc_html($post['category_name'] ?? 'General') ?>
                                </span>
                            </td>
                            <td>
                                <?php if ($post['status'] === 'published'): ?>
                                    <span class="pkm-badge pkm-badge-success">Published</span>
                                <?php else: ?>
                                    <span class="pkm-badge pkm-badge-warning">Draft</span>
                                <?php endif; ?>
                            </td>
                            <td><?= intval($post['views_count'] ?? 0) ?></td>
                            <td style="font-size:0.85rem; color:var(--pkm-admin-text-muted);">
                                <?= date('M j, Y', strtotime($post['published_at'] ?? $post['created_at'])) ?>
                            </td>
                            <td style="text-align: right; white-space: nowrap;">
                                <a href="<?= esc_url(home_url('admin/blog/edit?id=' . $post['id'])) ?>" class="pkm-btn pkm-btn-secondary pkm-btn-sm">
                                    Edit
                                </a>
                                <form method="POST" action="<?= esc_url(home_url('admin/blog/delete')) ?>" class="confirm-delete" style="display:inline-block; margin-left:4px;">
                                    <?= \App\Admin\Auth::csrfInput() ?>
                                    <input type="hidden" name="id" value="<?= intval($post['id']) ?>">
                                    <button type="submit" class="pkm-btn pkm-btn-danger pkm-btn-sm" style="padding:4px 8px;">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" style="text-align:center; padding:32px; color:var(--pkm-admin-text-muted);">
                            No blog posts found. Click "Write New Post" to publish your first article.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
