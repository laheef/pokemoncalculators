<?php
/**
 * Admin Google Indexing API & URL Inspection View
 * Pokemon Calculator Hub Custom CMS
 */
?>

<div class="pkm-admin-header">
    <div>
        <h1 class="pkm-admin-title">Google Search Console Indexing API</h1>
        <p class="pkm-admin-subtitle">Direct real-time URL indexing submission, Google Search Console URL inspection, and indexing health diagnostics.</p>
    </div>
    <div style="display:flex; gap:8px;">
        <button type="button" class="pkm-btn pkm-btn-secondary" onclick="document.getElementById('sa-credentials-card').scrollIntoView({behavior:'smooth'});">
            ⚙️ Service Account Key
        </button>
    </div>
</div>

<!-- API Status Alert -->
<?php if (!$isConfigured): ?>
    <div style="background:rgba(239,68,68,0.1); border:1px solid rgba(239,68,68,0.3); border-left:4px solid #EF4444; padding:16px 20px; border-radius:var(--pkm-radius-md); margin-bottom:24px;">
        <div style="display:flex; align-items:flex-start; gap:12px;">
            <div style="font-size:24px;">⚠️</div>
            <div>
                <h3 style="font-size:1.05rem; font-weight:700; color:#EF4444; margin:0 0 6px;">Google Cloud Service Account Not Configured</h3>
                <p style="margin:0 0 10px; font-size:0.9rem; color:var(--pkm-text); line-height:1.5;">
                    To submit URLs directly to Google's indexing pipeline and inspect indexing status, paste your Google Cloud Service Account JSON Key in the credentials section below.
                </p>
                <a href="#sa-credentials-card" class="pkm-btn pkm-btn-primary" style="padding:6px 14px; font-size:0.85rem;">
                    Configure Service Account Key &rarr;
                </a>
            </div>
        </div>
    </div>
<?php else: ?>
    <div style="background:rgba(16,185,129,0.1); border:1px solid rgba(16,185,129,0.3); border-left:4px solid #10B981; padding:14px 18px; border-radius:var(--pkm-radius-md); margin-bottom:24px; display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:12px;">
        <div style="display:flex; align-items:center; gap:10px;">
            <span style="display:inline-block; width:10px; height:10px; border-radius:50%; background:#10B981;"></span>
            <span style="font-weight:700; color:#10B981;">Google Indexing API Connected:</span>
            <code style="font-size:0.85rem;"><?= esc_html($serviceAccount['client_email'] ?? 'service-account@gcp') ?></code>
        </div>
        <span style="font-size:0.8rem; color:var(--pkm-text-muted);">Make sure this email is added as an <strong>Owner</strong> in Google Search Console.</span>
    </div>
<?php endif; ?>

<!-- Stats Overview -->
<div class="pkm-stats-grid" style="margin-bottom:28px;">
    <div class="pkm-stat-card">
        <div class="pkm-stat-icon blue">⚡</div>
        <div class="pkm-stat-info">
            <div class="pkm-stat-value"><?= intval($stats['total_submissions']) ?></div>
            <div class="pkm-stat-label">API Index Submissions</div>
        </div>
    </div>
    <div class="pkm-stat-card">
        <div class="pkm-stat-icon green">🔍</div>
        <div class="pkm-stat-info">
            <div class="pkm-stat-value"><?= intval($stats['total_inspections']) ?></div>
            <div class="pkm-stat-label">URL Inspections Checked</div>
        </div>
    </div>
    <div class="pkm-stat-card">
        <div class="pkm-stat-icon purple">✅</div>
        <div class="pkm-stat-info">
            <div class="pkm-stat-value"><?= intval($stats['indexed_count']) ?></div>
            <div class="pkm-stat-label">Verified Indexed (PASS)</div>
        </div>
    </div>
    <div class="pkm-stat-card">
        <div class="pkm-stat-icon <?= ($stats['error_count'] > 0) ? 'red' : 'orange' ?>">⚠️</div>
        <div class="pkm-stat-info">
            <div class="pkm-stat-value"><?= intval($stats['error_count']) ?></div>
            <div class="pkm-stat-label">Errors / Warnings</div>
        </div>
    </div>
</div>

<div class="pkm-dashboard-grid" style="grid-template-columns: 1fr 1fr; gap:24px; margin-bottom:28px;">
    <!-- CARD 1: URL INSPECTOR -->
    <div class="pkm-card" id="inspector">
        <div class="pkm-card-header">
            <h2 class="pkm-card-title">🔍 Inspect URL Indexing Status</h2>
        </div>
        <form method="POST" action="<?= esc_url(home_url('admin/indexing/inspect')) ?>">
            <?= \App\Admin\Auth::csrfInput() ?>
            <div class="pkm-form-group">
                <label class="pkm-form-label" for="inspect_url">Full Page URL to Inspect</label>
                <div style="display:flex; gap:8px;">
                    <input type="url" id="inspect_url" name="url" class="pkm-form-control"
                           placeholder="<?= esc_attr(pkm_absolute_url('pokemon-go-cp-calculator')) ?>"
                           value="<?= esc_attr($inspectResult['inspected_url'] ?? '') ?>" required>
                    <button type="submit" class="pkm-btn pkm-btn-primary" style="white-space:nowrap; padding:0 20px;">
                        Inspect
                    </button>
                </div>
                <span class="pkm-form-help">Queries Google Search Console URL Inspection API for real-time index verdict, crawl status, and schema errors.</span>
            </div>
        </form>

        <?php if (!empty($inspectResult)): ?>
            <?php 
                $v = strtoupper($inspectResult['verdict'] ?? 'UNKNOWN');
                $isPass = ($v === 'PASS');
                $isFail = ($v === 'FAIL' || $v === 'ERROR');
                $badgeBg = $isPass ? '#10B981' : ($isFail ? '#EF4444' : '#F59E0B');
            ?>
            <div style="margin-top:20px; border:1px solid var(--pkm-border); border-radius:var(--pkm-radius-md); padding:16px; background:var(--pkm-bg-2);">
                <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:12px; border-bottom:1px solid var(--pkm-border); padding-bottom:10px;">
                    <div>
                        <div style="font-size:0.75rem; text-transform:uppercase; color:var(--pkm-text-muted); font-weight:700;">Inspection Target</div>
                        <div style="font-weight:700; word-break:break-all; font-size:0.95rem;"><?= esc_html($inspectResult['inspected_url']) ?></div>
                    </div>
                    <span style="background:<?= $badgeBg ?>; color:#FFF; padding:4px 12px; border-radius:20px; font-weight:800; font-size:0.85rem;">
                        <?= esc_html($v) ?>
                    </span>
                </div>

                <div style="display:grid; grid-template-columns: 1fr 1fr; gap:12px; font-size:0.85rem;">
                    <div>
                        <strong style="color:var(--pkm-text-muted);">Coverage State:</strong>
                        <div style="font-weight:600;"><?= esc_html($inspectResult['coverage_state'] ?? 'N/A') ?></div>
                    </div>
                    <div>
                        <strong style="color:var(--pkm-text-muted);">Last Crawled:</strong>
                        <div style="font-weight:600;"><?= esc_html($inspectResult['crawled_at'] ?: 'Not crawled yet') ?></div>
                    </div>
                    <div>
                        <strong style="color:var(--pkm-text-muted);">Robots.txt Status:</strong>
                        <div style="font-weight:600;"><?= esc_html($inspectResult['robots_state'] ?? 'ALLOWED') ?></div>
                    </div>
                    <div>
                        <strong style="color:var(--pkm-text-muted);">Mobile Usability:</strong>
                        <div style="font-weight:600;"><?= esc_html($inspectResult['mobile_verdict'] ?? 'N/A') ?></div>
                    </div>
                    <div>
                        <strong style="color:var(--pkm-text-muted);">Rich Results / Schema:</strong>
                        <div style="font-weight:600;"><?= esc_html($inspectResult['rich_verdict'] ?? 'Valid') ?></div>
                    </div>
                    <div>
                        <strong style="color:var(--pkm-text-muted);">HTTP API Code:</strong>
                        <div style="font-weight:600;">HTTP <?= intval($inspectResult['code']) ?></div>
                    </div>
                </div>

                <?php if (!empty($inspectResult['error'])): ?>
                    <div style="margin-top:12px; padding:8px 12px; background:rgba(239,68,68,0.1); border-left:3px solid #EF4444; color:#EF4444; font-size:0.85rem;">
                        <strong>Error Details:</strong> <?= esc_html($inspectResult['error']) ?>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>

    <!-- CARD 2: DIRECT URL SUBMISSION -->
    <div class="pkm-card">
        <div class="pkm-card-header">
            <h2 class="pkm-card-title">⚡ Instant URL Indexing Submission</h2>
        </div>
        <form method="POST" action="<?= esc_url(home_url('admin/indexing/submit')) ?>">
            <?= \App\Admin\Auth::csrfInput() ?>
            <div class="pkm-form-group">
                <label class="pkm-form-label" for="submit_url">Target URL</label>
                <input type="url" id="submit_url" name="url" class="pkm-form-control"
                       placeholder="<?= esc_attr(pkm_absolute_url('pokemon-go-cp-calculator')) ?>" required>
            </div>
            <div class="pkm-form-row">
                <div class="pkm-form-group">
                    <label class="pkm-form-label" for="submit_action">Action Type</label>
                    <select id="submit_action" name="action" class="pkm-form-control">
                        <option value="URL_UPDATED">URL_UPDATED (Publish / Update Page)</option>
                        <option value="URL_DELETED">URL_DELETED (Remove Deleted URL from Index)</option>
                    </select>
                </div>
                <div class="pkm-form-group" style="display:flex; align-items:flex-end;">
                    <button type="submit" class="pkm-btn pkm-btn-primary" style="width:100%; height:44px;">
                        Submit to Google API 🚀
                    </button>
                </div>
            </div>
            <span class="pkm-form-help">Google Indexing API notifies Googlebot to immediately crawl and index new or updated content.</span>
        </form>
    </div>
</div>

<!-- BATCH SUBMISSION FOR ALL SITE URLS -->
<div class="pkm-card" style="margin-bottom:28px;">
    <div class="pkm-card-header" style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:12px;">
        <div>
            <h2 class="pkm-card-title">📦 All Site URLs & 1-Click Submission</h2>
            <p class="pkm-card-subtitle" style="margin:0; font-size:0.85rem; color:var(--pkm-text-muted);">
                Select pages to submit in batch or click "Publish" next to any individual calculator, page, or article.
            </p>
        </div>
        <div style="display:flex; gap:8px;">
            <button type="button" class="pkm-btn pkm-btn-secondary" onclick="toggleSelectAllUrls(true)">Select All</button>
            <button type="button" class="pkm-btn pkm-btn-secondary" onclick="toggleSelectAllUrls(false)">Deselect</button>
            <button type="submit" form="batchSubmitForm" class="pkm-btn pkm-btn-primary">
                ⚡ Batch Submit Selected
            </button>
        </div>
    </div>

    <form id="batchSubmitForm" method="POST" action="<?= esc_url(home_url('admin/indexing/batch-submit')) ?>">
        <?= \App\Admin\Auth::csrfInput() ?>
        <div class="pkm-table-wrap">
            <table class="pkm-table">
                <thead>
                    <tr>
                        <th style="width:40px;"><input type="checkbox" id="selectAllCheckbox" onchange="toggleSelectAllUrls(this.checked)"></th>
                        <th>Type</th>
                        <th>Page Title & URL</th>
                        <th style="text-align:right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($allUrls as $idx => $u): ?>
                        <tr>
                            <td>
                                <input type="checkbox" name="urls[]" value="<?= esc_attr($u['url']) ?>" class="site-url-cb" checked>
                            </td>
                            <td>
                                <span class="pkm-badge pkm-badge-info"><?= esc_html($u['type']) ?></span>
                            </td>
                            <td>
                                <div style="font-weight:700; color:var(--pkm-text);"><?= esc_html($u['title']) ?></div>
                                <a href="<?= esc_url($u['url']) ?>" target="_blank" style="font-size:0.8rem; color:var(--pkm-text-muted); text-decoration:none;">
                                    <?= esc_html($u['url']) ?> ↗
                                </a>
                            </td>
                            <td style="text-align:right; white-space:nowrap;">
                                <button type="button" class="pkm-btn pkm-btn-secondary" style="padding:4px 10px; font-size:0.8rem;"
                                        onclick="submitSingleUrl('<?= esc_js($u['url']) ?>')">
                                    ⚡ Publish
                                </button>
                                <button type="button" class="pkm-btn pkm-btn-secondary" style="padding:4px 10px; font-size:0.8rem;"
                                        onclick="inspectSingleUrl('<?= esc_js($u['url']) ?>')">
                                    🔍 Inspect
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </form>
</div>

<!-- SUBMISSION & INSPECTION LOG HISTORY -->
<div class="pkm-card" style="margin-bottom:28px;">
    <div class="pkm-card-header" style="display:flex; justify-content:space-between; align-items:center;">
        <div>
            <h2 class="pkm-card-title">📜 Submission & Inspection History Log</h2>
            <p class="pkm-card-subtitle" style="margin:0; font-size:0.85rem; color:var(--pkm-text-muted);">
                Audit log of recent Google Indexing notifications and Search Console inspections.
            </p>
        </div>
        <?php if (!empty($logs)): ?>
            <form method="POST" action="<?= esc_url(home_url('admin/indexing/clear-logs')) ?>" onsubmit="return confirm('Are you sure you want to clear all indexing logs?');">
                <?= \App\Admin\Auth::csrfInput() ?>
                <button type="submit" class="pkm-btn pkm-btn-danger" style="padding:6px 12px; font-size:0.8rem;">
                    Clear Logs
                </button>
            </form>
        <?php endif; ?>
    </div>

    <div class="pkm-table-wrap">
        <table class="pkm-table">
            <thead>
                <tr>
                    <th>Timestamp</th>
                    <th>Action</th>
                    <th>URL</th>
                    <th>Status</th>
                    <th>Coverage / Error Diagnostics</th>
                    <th style="text-align:right;">Inspect</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($logs)): ?>
                    <tr>
                        <td colspan="6" style="text-align:center; padding:32px; color:var(--pkm-text-muted);">
                            No indexing or inspection requests recorded yet. Submit a URL to begin!
                        </td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($logs as $log): ?>
                        <?php 
                            $isErr = ($log['api_status'] === 'ERROR' || $log['verdict'] === 'FAIL');
                            $isPass = ($log['verdict'] === 'PASS' || $log['api_status'] === 'SUBMITTED');
                            $badgeClass = $isErr ? 'pkm-badge-danger' : ($isPass ? 'pkm-badge-success' : 'pkm-badge-warning');
                        ?>
                        <tr>
                            <td style="white-space:nowrap; font-size:0.8rem; color:var(--pkm-text-muted);">
                                <?= esc_html(date('M j, Y H:i', strtotime($log['created_at']))) ?>
                            </td>
                            <td>
                                <span class="pkm-badge pkm-badge-info" style="font-size:0.75rem;">
                                    <?= esc_html($log['action']) ?>
                                </span>
                            </td>
                            <td>
                                <div style="font-weight:600; font-size:0.85rem; word-break:break-all; max-width:320px;">
                                    <?= esc_html($log['url']) ?>
                                </div>
                            </td>
                            <td>
                                <span class="pkm-badge <?= $badgeClass ?>" style="font-size:0.75rem;">
                                    <?= esc_html($log['verdict'] ?: $log['api_status']) ?>
                                </span>
                                <?php if ($log['http_status']): ?>
                                    <small style="color:var(--pkm-text-muted);">(HTTP <?= intval($log['http_status']) ?>)</small>
                                <?php endif; ?>
                            </td>
                            <td style="font-size:0.85rem;">
                                <?php if (!empty($log['coverage_state'])): ?>
                                    <div style="font-weight:600; color:var(--pkm-text);"><?= esc_html($log['coverage_state']) ?></div>
                                <?php endif; ?>
                                <?php if (!empty($log['error_message'])): ?>
                                    <div style="color:#EF4444; font-size:0.8rem;"><?= esc_html($log['error_message']) ?></div>
                                <?php endif; ?>
                            </td>
                            <td style="text-align:right;">
                                <button type="button" class="pkm-btn pkm-btn-secondary" style="padding:4px 8px; font-size:0.75rem;"
                                        onclick="inspectSingleUrl('<?= esc_js($log['url']) ?>')">
                                    🔍 Re-check
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- SERVICE ACCOUNT CREDENTIALS CONFIGURATION -->
<div class="pkm-card" id="sa-credentials-card">
    <div class="pkm-card-header">
        <h2 class="pkm-card-title">🔑 Google Cloud Service Account JSON Key</h2>
        <p class="pkm-card-subtitle">Paste your Google Cloud Service Account credentials JSON to enable real-time Indexing API and Search Console inspection.</p>
    </div>

    <form method="POST" action="<?= esc_url(home_url('admin/indexing/save-settings')) ?>">
        <?= \App\Admin\Auth::csrfInput() ?>

        <div class="pkm-form-group">
            <label class="pkm-form-label" for="google_service_account_json">Service Account JSON Key Content</label>
            <textarea id="google_service_account_json" name="google_service_account_json" class="pkm-form-control" style="min-height:160px; font-family:monospace; font-size:0.85rem;"
                      placeholder='{ "type": "service_account", "project_id": "...", "private_key_id": "...", "private_key": "-----BEGIN PRIVATE KEY-----\n...", "client_email": "name@project.iam.gserviceaccount.com", ... }'><?= esc_html(get_setting('google_service_account_json', '')) ?></textarea>
            <span class="pkm-form-help">Stored securely in settings. Never exposed on public frontend.</span>
        </div>

        <div style="background:var(--pkm-bg-3); border:1px solid var(--pkm-border); border-radius:var(--pkm-radius-sm); padding:16px; margin-bottom:20px; font-size:0.85rem; line-height:1.6;">
            <strong>📋 How to set up in 4 quick steps:</strong>
            <ol style="margin:8px 0 0 20px; padding:0;">
                <li>Create a project in the <strong>Google Cloud Console</strong> and enable both the <strong>Web Search Indexing API</strong> and <strong>Google Search Console API</strong>.</li>
                <li>Go to <strong>IAM & Admin &rarr; Service Accounts</strong>, create a Service Account, and create a <strong>JSON Key</strong>.</li>
                <li>Paste the downloaded JSON file content into the textarea above and click Save.</li>
                <li>Go to <strong>Google Search Console &rarr; Settings &rarr; Users and permissions</strong>, and add your Service Account email (<code><?= esc_html($serviceAccount['client_email'] ?? 'your-service-account-email@gserviceaccount.com') ?></code>) as an <strong>Owner</strong>.</li>
            </ol>
        </div>

        <button type="submit" class="pkm-btn pkm-btn-primary" style="padding:10px 24px;">
            Save Service Account Key
        </button>
    </form>
</div>

<script>
function toggleSelectAllUrls(checked) {
    document.querySelectorAll('.site-url-cb').forEach(function(cb) {
        cb.checked = checked;
    });
    var master = document.getElementById('selectAllCheckbox');
    if (master) master.checked = checked;
}

function submitSingleUrl(url) {
    var input = document.getElementById('submit_url');
    if (input) {
        input.value = url;
        input.scrollIntoView({behavior:'smooth'});
        input.focus();
    }
}

function inspectSingleUrl(url) {
    var input = document.getElementById('inspect_url');
    if (input) {
        input.value = url;
        input.scrollIntoView({behavior:'smooth'});
        input.form.submit();
    }
}
</script>
