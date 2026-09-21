# Pokémon Calculator Hub - Standalone Custom PHP CMS

A high-performance, standalone, custom PHP Content Management System (CMS) converted from the original WordPress child theme into a modern, framework-free PHP 8.x architecture with custom Admin Panel, SEO automation, multi-language support, Google Ads & Skyscraper monetization engine, Google Search Console Indexing API integration, and role-based user management.

---

## 🚀 Key Features

### 1. Google Search Console Indexing API & URL Inspection
- **Direct Indexing API Submission**: Submit URLs in real-time to Google's indexing pipeline (`URL_UPDATED` or `URL_DELETED`) using native RS256 JWT service account authentication.
- **1-Click Batch Submission**: Submit all 16+ calculators, CMS pages, and blog articles to Google Indexing with a single click.
- **Search Console URL Inspection**: Inspect live index status, coverage state (e.g. `Submitted and indexed`, `Crawled - currently not indexed`), crawl timestamps, mobile usability, and schema / rich result diagnostics.
- **Real-Time Audit History Log**: Detailed log tracking every submission and inspection request with error diagnostics, HTTP codes, and re-check shortcuts.
- **Secure Service Account JSON Storage**: Paste your Google Cloud Service Account JSON Key directly in the Admin Panel without touching server code.

### 2. Google Ads & Skyscraper Monetization Engine
- **Left & Right Desktop Skyscraper Units**: Dedicated sticky skyscraper units (`160x600` / `120x600` / `300x600`) flanking the left and right margins of the page on widescreen desktop viewports (`>= 1300px`).
- **Google AdSense Client Setup**: Auto-injects the official Google AdSense script into `<head>` when a publisher ID (e.g. `ca-pub-xxxxxxxxxxxxxxxx`) is configured.
- **Dedicated Ad Slots**:
  - Left Skyscraper (`ad_slot_sky_left`)
  - Right Skyscraper (`ad_slot_sky_right`)
  - Top Header Leaderboard (`ad_slot_top`)
  - Below Result Card (`ad_slot_below_result`)
  - Mid-Content Break (`ad_slot_mid_content`)
  - FAQ Section (`ad_slot_mid_faq`)
  - In-Content Sidebar (`ad_slot_sidebar`)
  - Bottom Banner (`ad_slot_bottom`)
- **Conditional Ad Display**: Ad slot containers only render on frontend pages when ad code is actively configured in Admin Settings. Blank slots produce zero empty containers or layout shifts.

### 3. Custom Header & Footer Code Injection
- **Custom `<head>` Code**: Easily inject custom tracking codes, Google Tag Manager `<head>` scripts, Google Search Console domain verification meta tags, or custom CSS from the Admin Panel.
- **Custom `</body>` Code**: Dedicated field for non-blocking footer tracking scripts, conversion pixels, or chat widgets.

### 4. Google Search Site Name Schema & SEO
- **Official `schema.org/WebSite` Schema**: Fully structured with `name`, `alternateName` array, `url`, `publisher`, `inLanguage`, and `SearchAction` (sitelinks searchbox) to ensure Google Search Console and Google SERP display the official **Site Name** prominently above the URL snippet.
- **Supporting Meta Tags**: Automatic synchronization of `<meta property="og:site_name">`, `<meta name="application-name">`, and `<meta name="apple-mobile-web-app-title">`.
- **Dynamic XML Sitemap & Robots.txt**: Automated indexing across all calculators, blog posts, and 5 language variants.

### 5. Complete Suite of 8 Pokémon Calculators
- **Pokémon GO CP Calculator** (`/pokemon-go-cp-calculator`): Accurate Combat Power formula with IV sliders and level multipliers.
- **Evolution CP Calculator** (`/pokemon-go-evolution-cp-calculator`): Multi-evolution multiplier engine and CP prediction.
- **IV & Stat Judge Calculator** (`/pokemon-go-iv-calculator`): IV appraisal percentage with stat distribution visualizer.
- **Stardust & Candy Cost Calculator** (`/stardust-calculator`): Level-up resource calculator with Lucky & Purified Pokémon discounts.
- **VGC / Competitive Damage Calculator** (`/pokemon-damage-calculator`): Gen 9 battle damage engine (Types, Weather, Terrain, Items, STAB, Crits).
- **Speed Tiers Comparison Tool** (`/speed-tiers`): Interactive competitive speed bracket visualizer with Nature, EV, and Modifier filters.
- **GO Stat Conversion Tool** (`/pokemon-go-stat-calculator`): Main series base stats to Pokémon GO Attack/Defense/Stamina converter.
- **Catch Rate & Ball Probability Tool** (`/pokemon-go-catch-rate-calculator`): Capture rate formula with Poké Ball multipliers, Razz/Golden Razz Berries, and throw bonuses.

### 6. Custom Admin Panel (`/admin`)
- **Dashboard**: High-level telemetry, quick stats (tools, pages, articles, uploads, users), and quick actions.
- **Google Indexing API Manager**: Inspect URLs, submit batch updates, audit indexing errors.
- **Site & Theme Settings**: Configure Google Ads, Left/Right Skyscrapers, Custom Header Code, Google Site Name Schema, Color Tokens, and Social links.
- **Tools Manager**: Control calculator status, display names, URLs, descriptions, categories, and icon badges.
- **Pages Manager**: Dynamic CMS page management with slugs, categories, publish statuses, and WYSIWYG/HTML content.
- **Blog & News Manager**: Complete publishing workflow for guides and competitive articles.
- **Media Library**: Direct image file uploader with MIME verification, visual gallery, copy-to-clipboard URL helpers, and safe deletion.
- **Users & Team Management**: Role-Based Access Control (`admin`, `editor`, `author`), user creation, credential management, self-deletion protection, and staff profile settings.

---

## 🔐 Default Admin Access

- **Admin URL**: `http://localhost:8000/admin/login`
- **Username**: `admin`
- **Password**: `admin123`
