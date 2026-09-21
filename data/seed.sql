-- Pokemon Calculator Hub Seed Data

-- Admin User (Password: PokemonAdmin2026!)
INSERT INTO `users` (`username`, `email`, `password_hash`, `role`) VALUES
('admin', 'admin@pokemoncalculator.online', '$2y$12$sZ30fHYPEIgeaLMurxeD1OG8NXKCVZo.0bcw1DO6Jb7xf7cGEHYZ6', 'admin');

-- Categories
INSERT INTO `categories` (`id`, `slug`, `name`, `description`, `type`, `menu_order`) VALUES
(1, 'pokemon-go', 'Pokemon GO', 'Calculators and tools tailored for Pokémon GO mobile trainers', 'tool', 1),
(2, 'main-series', 'Main Series', 'Generations 1–9 battle, breeding, and mechanics tools', 'tool', 2),
(3, 'competitive', 'Competitive', 'VGC, Smogon, and PvP battle optimization calculators', 'tool', 3),
(4, 'gameplay-guides', 'Guides & Strategy', 'In-depth gameplay guides, event coverage, and mechanics explainers', 'blog', 4),
(5, 'general', 'General', 'Site information and legal pages', 'page', 5);

-- Tools
INSERT INTO `tools` (`slug`, `name`, `short_name`, `icon_svg`, `short_description`, `category_id`, `file_path`, `menu_order`, `is_active`, `meta_title`, `meta_desc`) VALUES
('pokemon-go-cp-calculator', 'Pokemon GO CP Calculator', 'CP Calculator', '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/></svg>', 'Calculate Combat Power, max CP, HP, power-up costs, and IV combinations for any Pokémon in Pokémon GO.', 1, 'app/tools/cp-calculator.php', 1, 1, 'Pokemon GO CP Calculator [2026] — Combat Power, IVs & Stats', 'Calculate CP, HP, and power-up costs for all Pokemon in Pokemon GO. Interactive sliders, IV matrix, and Great/Ultra League ratings.'),

('pokemon-go-iv-calculator', 'Pokemon GO IV Calculator & Appraisal Matrix', 'IV Calculator', '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/><polyline points="17 6 23 6 23 12"/></svg>', 'Accurately calculate Pokémon GO IVs (Individual Values), appraisal percentages, and PvP stat product rankings.', 1, 'app/tools/iv-calculator.php', 2, 1, 'Pokemon GO IV Calculator [2026] — Appraisal & PvP Rank Checker', 'Find exact IV percentages, star ratings, and PvP stat product rankings for Pokemon GO. Fast, accurate, and updated with Gen 1–9 data.'),

('pokemon-go-evolution-cp-calculator', 'Pokemon GO Evolution CP Calculator', 'Evolution CP Calculator', '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>', 'Predict CP ranges after evolution, candy requirements, evolution items, and Great/Ultra League eligibility.', 1, 'app/tools/evolution-cp.php', 3, 1, 'Pokemon GO Evolution CP Calculator [2026] — CP Range & Candy Predictor', 'Predict the exact CP of your Pokemon after evolving. Check Great League & Ultra League CP caps, candy costs, and evolution item requirements.'),

('stardust-calculator', 'Pokemon GO Stardust & Power-Up Calculator', 'Stardust Calculator', '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9.5 7.5-2 2a4.95 4.95 0 1 0 7 7l2-2a4.95 4.95 0 1 0-7-7Z"/><path d="M14 6.5v10"/><path d="M10 7.5v10"/><path d="m16 7 1-5 1.37.68A3 3 0 0 0 19.7 3H21v1.3a3 3 0 0 0 .32 1.33L22 7l-5 1Z"/><path d="m8 17-1 5-1.37-.68A3 3 0 0 0 4.3 21H3v-1.3a3 3 0 0 0-.32-1.33L2 17l5-1Z"/></svg>', 'Calculate exact Stardust, Candy, and XL Candy needed to power up Pokémon from any level to level 50.', 1, 'app/tools/stardust-calculator.php', 4, 1, 'Pokemon GO Stardust Calculator [2026] — Power-Up & Trade Cost Guide', 'Calculate total Stardust, Regular Candy, and XL Candy needed to level up any Pokemon in Pokemon GO up to level 50. Includes Shadow, Purified, and Lucky discounts.'),

('pokemon-go-stat-calculator', 'Pokemon GO Stat Calculator', 'GO Stat Calculator', '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="6"/><circle cx="12" cy="12" r="2"/></svg>', 'Calculate effective Attack, Defense, Stamina, CP, and HP across all levels (1 to 50+) with exact CPM multipliers.', 1, 'app/tools/go-stat-calculator.php', 5, 1, 'Pokemon GO Stat Calculator [2026] — Base & In-Game Stats', 'Compute effective Attack, Defense, Stamina, CP, and HP stats for Pokemon GO across levels 1–50 using exact CPM scaling formulas.'),

('pokemon-go-catch-rate-calculator', 'Pokemon GO Catch Rate Calculator', 'Catch Rate Calculator', '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="3"/><line x1="12" y1="2" x2="12" y2="9"/><line x1="12" y1="15" x2="12" y2="22"/></svg>', 'Calculate exact catch probability, required throws, and difficulty rating with Pokeball, Berry, Medal, and Weather modifiers.', 1, 'app/tools/catch-rate-calculator.php', 6, 1, 'Pokemon GO Catch Rate Calculator [2026] — Catch Probability & Ball Guide', 'Calculate catch rate percentages for any Pokemon in Pokemon GO with Poke Ball types, Razz/Silver/Golden berries, type medals, and weather boost.'),

('pokemon-damage-calculator', 'Pokemon Battle Damage Calculator', 'Damage Calculator', '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m14.5 12.5-8 8a2.119 2.119 0 0 1-3-3l8-8"/><path d="m16 16 6-6"/><path d="m8 8 6-6"/></svg>', 'Comprehensive competitive damage calculator with Gens 1–9, natures, EVs/IVs, items, weather, and KO rolls.', 2, 'app/tools/damage-calculator.php', 7, 1, 'Pokemon Damage Calculator [2026] — Gen 1–9 Competitive Battle Damage', 'Calculate exact battle damage, OHKO chances, stat stages, abilities, items, and weather modifiers for competitive Pokemon battling.'),

('speed-tiers', 'Pokemon Speed Tier Calculator & Benchmark', 'Speed Tiers', '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2v4M12 18v4M4.93 4.93l2.83 2.83M16.24 16.24l2.83 2.83M2 12h4M18 12h4M4.93 19.07l2.83-2.83M16.24 7.76l2.83-2.83"/></svg>', 'Interactive speed tier matrix for VGC & Smogon formats with Choice Scarf, Booster Energy, and Tailwind modifiers.', 3, 'app/tools/speed-tiers.php', 8, 1, 'Pokemon Speed Tiers [2026] — Competitive Speed Benchmark & VGC Matrix', 'Interactive Pokemon Speed Tiers list for Gen 9 VGC and Smogon tiers. Compare real speed values with Choice Scarf, Tailwind, and Booster Energy boosts.');

-- Settings
INSERT INTO `settings` (`setting_key`, `setting_value`, `setting_group`) VALUES
('site_name', 'Pokemon Calculator', 'general'),
('site_tagline', 'Free Pokemon Calculators for Every Trainer', 'general'),
('site_description', 'Free, accurate Pokemon calculators and competitive tools for trainers worldwide. Calculate CP, IVs, Stardust, Evolutions, Speed Tiers, and Damage.', 'general'),
('site_url', 'http://localhost:8000', 'general'),
('admin_email', 'admin@pokemoncalculator.online', 'general'),
('default_theme', 'light', 'theme'),
('primary_color', '#0D9488', 'theme'),
('secondary_color', '#134E4A', 'theme'),
('accent_color', '#F4D03F', 'theme'),
('light_bg', '#F4F6F9', 'theme'),
('dark_bg', '#0D1117', 'theme'),
('meta_title_suffix', ' | Pokemon Calculator Hub', 'seo'),
('default_og_image', '/assets/img/og-default.png', 'seo'),
('social_twitter', 'https://twitter.com', 'social'),
('social_discord', 'https://discord.gg', 'social'),
('social_github', 'https://github.com/laheef/pokemoncalculators', 'social');
