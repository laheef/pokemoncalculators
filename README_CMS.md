# Pokemon Calculator Hub — Standalone Custom PHP CMS

A self-contained, high-performance standalone PHP application migrating **Pokemon Calculator Hub** off WordPress entirely while preserving 100% of its visual design, color tokens, dark/light theme persistence, SEO metadata, and calculator logic.

---

## 🏗️ Project Architecture

```
pokemoncalculators/
├── config/
│   ├── config.php            # App constants, environment & MariaDB/MySQL settings
│   ├── theme-tokens.php      # Color system tokens & CSS custom properties
│   └── routes.php            # Central front-controller route definitions & 301 redirects
├── app/
│   ├── core/
│   │   ├── Database.php      # PDO database connection manager & query helpers
│   │   ├── Router.php        # Fast regex route dispatcher with param & lang-prefix support
│   │   ├── Request.php       # HTTP request abstraction (GET, POST, JSON, headers)
│   │   ├── Response.php      # HTTP response helper (status codes, JSON, redirects)
│   │   ├── View.php          # Template engine with layout & partial injection
│   │   ├── SEO.php           # Meta tags, OpenGraph, Canonical, Hreflang & Schema.org JSON-LD
│   │   ├── I18n.php          # Multilingual engine (EN, ES, PT-BR, FR, DE)
│   │   └── Helpers.php       # Global utilities, WordPress polyfills, SVG renderers
│   ├── tools/                # Standalone calculator tool logic files
│   │   ├── cp-calculator.php
│   │   ├── iv-calculator.php
│   │   ├── evolution-cp.php
│   │   ├── stardust-calculator.php
│   │   ├── go-stat-calculator.php
│   │   ├── catch-rate-calculator.php
│   │   ├── damage-calculator.php
│   │   └── speed-tiers.php
│   ├── pages/                # Page controllers
│   │   ├── HomeController.php
│   │   ├── CalculatorsController.php
│   │   ├── TypeChartController.php
│   │   └── PageController.php
│   ├── blog/                 # Blog post controllers
│   └── admin/                # Custom CMS Admin Panel (Phase 2)
├── views/
│   ├── layouts/
│   │   └── main.php          # Main HTML document layout with synchronous anti-flash script
│   ├── partials/
│   │   ├── header.php        # Sticky navigation header, drawer, theme toggle
│   │   ├── footer.php        # Footer columns, copyright, legal disclaimer
│   │   └── ads/              # Monetization ad slot modules (A, B, C, F)
│   ├── home/
│   │   └── index.php         # Complete 8-section homepage matching WordPress
│   ├── tools/
│   │   ├── index.php         # Calculators Listing Hub with live search & filter
│   │   └── show.php          # Single calculator container with related tools
│   └── pages/
│       ├── type-chart.php    # Interactive Gen 1–9 Type Matchup Matrix
│       └── 404.php           # 404 error page
├── data/
│   ├── pkm-pokemon-data.json # Comprehensive 1,025 Pokémon database
│   ├── schema.sql            # MariaDB database schema (users, tools, pages, posts, settings)
│   └── seed.sql              # Seed data for tools, categories, admin user & settings
└── public/
    ├── index.php             # Web root front controller entry point
    ├── router.php            # Built-in PHP server router
    ├── assets/
    │   ├── css/              # Modular stylesheets (theme, header-footer, home, calculators)
    │   └── js/               # theme.js (dark/light toggle), main.js
    └── favicon.ico
```

---

## 🎮 Included Calculators & Tools (Phase 1)

1. **Combat Power (CP) Calculator** (`/pokemon-go-cp-calculator`): Calculates CP, HP, power-up costs, IV matrix, and Great/Ultra League ratings.
2. **IV Calculator & Appraisal Matrix** (`/pokemon-go-iv-calculator`): Solves IV combinations, star ratings (0–4 stars), and PvP stat product rank.
3. **Evolution CP Calculator** (`/pokemon-go-evolution-cp-calculator`): Multi-stage evolution prediction with item requirements and league caps.
4. **Stardust & Power-Up Calculator** (`/stardust-calculator`): Stardust, regular candy, and XL candy costs from Level 1 to 50 with Lucky/Shadow/Purified discounts.
5. **GO Stat Calculator** (`/pokemon-go-stat-calculator`): Base & in-game effective Attack, Defense, Stamina, CP, and HP across all levels.
6. **Catch Rate Calculator** (`/pokemon-go-catch-rate-calculator`): Live catch probability %, expected throws, BCR multiplier, and difficulty rating badge.
7. **Damage Calculator** (`/pokemon-damage-calculator`): Gen 1–9 competitive battle damage calculator with moves, natures, EVs/IVs, items, and weather.
8. **Speed Tiers Calculator** (`/speed-tiers`): Competitive speed tier benchmarks for VGC and Smogon with Choice Scarf, Tailwind, and Booster Energy modifiers.
9. **Type Chart Matrix** (`/type-chart`): Complete 18-type interaction table with interactive weakness/resistance highlights.
10. **Calculators Listing Hub** (`/calculators`): Live instant search and category filter.
