/*M!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19-11.8.6-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: pokemon_calc_db
-- ------------------------------------------------------
-- Server version	11.8.6-MariaDB-0+deb13u1 from Debian

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*M!100616 SET @OLD_NOTE_VERBOSITY=@@NOTE_VERBOSITY, NOTE_VERBOSITY=0 */;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `slug` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `type` enum('tool','blog','page','general') DEFAULT 'tool',
  `menu_order` int(11) DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES
(1,'pokemon-go','Pokemon GO','Calculators and tools tailored for PokÃ©mon GO mobile trainers','tool',1,'2026-09-20 13:48:24'),
(2,'main-series','Main Series','Generations 1â€“9 battle, breeding, and mechanics tools','tool',2,'2026-09-20 13:48:24'),
(3,'competitive','Competitive','VGC, Smogon, and PvP battle optimization calculators','tool',3,'2026-09-20 13:48:24'),
(4,'gameplay-guides','Guides & Strategy','In-depth gameplay guides, event coverage, and mechanics explainers','blog',4,'2026-09-20 13:48:24'),
(5,'general','General','Site information and legal pages','page',5,'2026-09-20 13:48:24');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `contact_submissions`
--

DROP TABLE IF EXISTS `contact_submissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `contact_submissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `subject` varchar(200) NOT NULL,
  `message` text NOT NULL,
  `is_read` tinyint(1) DEFAULT 0,
  `ip_address` varchar(45) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contact_submissions`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `contact_submissions` WRITE;
/*!40000 ALTER TABLE `contact_submissions` DISABLE KEYS */;
INSERT INTO `contact_submissions` VALUES
(2,'Brock Slate','brock@pewter-gym.org','Formula / Calculation Bug Report','Found a small rounding test case on Onix defense tier. Great tools!',0,'127.0.0.1','2026-09-20 14:56:03');
/*!40000 ALTER TABLE `contact_submissions` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `indexing_logs`
--

DROP TABLE IF EXISTS `indexing_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `indexing_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(500) NOT NULL,
  `action` varchar(50) NOT NULL DEFAULT 'URL_UPDATED',
  `http_status` int(11) DEFAULT NULL,
  `api_status` varchar(100) DEFAULT NULL,
  `coverage_state` varchar(255) DEFAULT NULL,
  `verdict` varchar(50) DEFAULT NULL,
  `crawled_at` datetime DEFAULT NULL,
  `robot_txt_state` varchar(100) DEFAULT NULL,
  `mobile_usability` varchar(100) DEFAULT NULL,
  `rich_results_verdict` varchar(100) DEFAULT NULL,
  `raw_response` longtext DEFAULT NULL,
  `error_message` text DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `indexing_logs`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `indexing_logs` WRITE;
/*!40000 ALTER TABLE `indexing_logs` DISABLE KEYS */;
INSERT INTO `indexing_logs` VALUES
(1,'http://pokemoncalculator.online/pokemon-go-cp-calculator','URL_UPDATED',401,'ERROR',NULL,NULL,NULL,NULL,NULL,NULL,'Auth Error','Google Service Account credentials missing, invalid, or authentication failed with Google OAuth2.','2026-09-20 15:40:43'),
(2,'http://pokemoncalculator.online/pokemon-go-iv-calculator','URL_UPDATED',401,'ERROR',NULL,NULL,NULL,NULL,NULL,NULL,'Auth Error','Google Service Account credentials missing, invalid, or authentication failed with Google OAuth2.','2026-09-20 15:40:43'),
(3,'http://pokemoncalculator.online/speed-tiers','URL_UPDATED',401,'ERROR',NULL,NULL,NULL,NULL,NULL,NULL,'Auth Error','Google Service Account credentials missing, invalid, or authentication failed with Google OAuth2.','2026-09-20 15:40:43'),
(4,'http://pokemoncalculator.online/pokemon-go-cp-calculator','INSPECT',401,'ERROR','Not Verified','FAIL',NULL,NULL,NULL,NULL,'Auth Error','Google Service Account credentials missing, invalid, or authentication failed with Google OAuth2.','2026-09-20 15:40:43');
/*!40000 ALTER TABLE `indexing_logs` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `media`
--

DROP TABLE IF EXISTS `media`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `media` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `file_name` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `file_type` varchar(50) NOT NULL,
  `file_size` int(11) NOT NULL,
  `alt_text` varchar(255) DEFAULT NULL,
  `uploaded_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `uploaded_by` (`uploaded_by`),
  CONSTRAINT `media_ibfk_1` FOREIGN KEY (`uploaded_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `media`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `media` WRITE;
/*!40000 ALTER TABLE `media` DISABLE KEYS */;
/*!40000 ALTER TABLE `media` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `slug` varchar(100) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` longtext DEFAULT NULL,
  `excerpt` text DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `page_width_template` enum('full','boxed','custom') DEFAULT 'full',
  `custom_width` int(11) DEFAULT 1280,
  `is_active` tinyint(1) DEFAULT 1,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_desc` text DEFAULT NULL,
  `og_image` varchar(255) DEFAULT NULL,
  `menu_order` int(11) DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `pages_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pages`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `pages` WRITE;
/*!40000 ALTER TABLE `pages` DISABLE KEYS */;
INSERT INTO `pages` VALUES
(2,'about-us','About Us — Pokémon Calculator Hub','<div class=\"pkm-about-content\">\n\n    <div style=\"margin-bottom:36px; padding:24px; background:var(--pkm-bg-3); border-radius:var(--pkm-radius); border-left:4px solid var(--pkm-primary);\">\n        <p style=\"font-size:1.15rem; font-weight:600; color:var(--pkm-text); margin:0;\">\n            <strong>Pokémon Calculator Hub</strong> was built by dedicated competitive trainers, math enthusiasts, and software engineers to deliver instant, 100% accurate, and ad-uncluttered calculation tools for the global Pokémon community.\n        </p>\n    </div>\n\n    <h2 style=\"font-size:1.6rem; color:var(--pkm-text); margin-top:32px; margin-bottom:16px; border-bottom:2px solid var(--pkm-border); padding-bottom:8px;\">\n        1. Our Mission: Precision Without Compromise\n    </h2>\n    <p>\n        Whether preparing for a high-stakes Pokémon GO Championship Series tournament, optimizing stat products for Great and Ultra League battles, or calculating the exact stardust required to power a shadow Legendary Pokémon from Level 8 to Level 50, precision matters. A single miscalculated IV threshold or unoptimized stat spread can mean the difference between a decisive charge move tie-break (CMP tie) victory or defeat.\n    </p>\n    <p>\n        Most existing calculator sites suffer from excessive popups, intrusive video overlays, outdated Game Master formulas, or paywalls. <strong>Pokémon Calculator Hub</strong> was architected from the ground up to solve these frustrations. We deliver lightweight, server-side and client-side calculators that execute instantly across both desktop and mobile devices without tracking bloat.\n    </p>\n\n    <h2 style=\"font-size:1.6rem; color:var(--pkm-text); margin-top:40px; margin-bottom:16px; border-bottom:2px solid var(--pkm-border); padding-bottom:8px;\">\n        2. Mathematical Fidelity & Game Master Parity\n    </h2>\n    <p>\n        Our calculation engines mirror official in-game mechanics with rigorous mathematical parity:\n    </p>\n    <ul style=\"padding-left:24px; margin-bottom:20px; display:flex; flex-direction:column; gap:10px;\">\n        <li>\n            <strong>Combat Power Multipliers (CPM):</strong> We maintain the complete, exact CPM curve from Level 1.0 to Level 51.5 (including half-level steps and the Level 51 Best Buddy boost) calibrated directly to Niantic\'s server-side constants.\n        </li>\n        <li>\n            <strong>Exact CP & HP Formulas:</strong> CP is calculated via the official integer truncation formula:\n            <br>\n            <code style=\"background:var(--pkm-bg-3); padding:4px 8px; border-radius:4px; font-size:0.9rem; display:inline-block; margin:6px 0;\">\n                CP = max(10, floor((BaseAtk + AtkIV) × sqrt(BaseDef + DefIV) × sqrt(BaseSta + StaIV) × (CPM^2) / 10))\n            </code>\n        </li>\n        <li>\n            <strong>PvP Stat Product Optimization:</strong> Real-time rank computation evaluating all 4,096 possible IV combinations (0/0/0 through 15/15/15) against league CP caps (1500 CP for Great League, 2500 CP for Ultra League, and Little Cup 500 CP).\n        </li>\n        <li>\n            <strong>Main Series Damage & Speed Tier Mechanics:</strong> Incorporates generation-specific modifiers, EV/IV allocations, Natures, stat stage stages (-6 to +6), Choice items, weather boosts, and critical hit thresholds.\n        </li>\n    </ul>\n\n    <h2 style=\"font-size:1.6rem; color:var(--pkm-text); margin-top:40px; margin-bottom:16px; border-bottom:2px solid var(--pkm-border); padding-bottom:8px;\">\n        3. Comprehensive 1,025+ Pokémon Database\n    </h2>\n    <p>\n        Our platform integrates a structured database indexing all <strong>1,025 Pokémon species</strong> spanning Generations 1 through 9 (from Bulbasaur to Pecharunt). For every entry, we maintain:\n    </p>\n    <div style=\"display:grid; grid-template-columns:repeat(auto-fit, minmax(220px, 1fr)); gap:16px; margin:20px 0;\">\n        <div style=\"background:var(--pkm-bg-3); padding:16px; border-radius:var(--pkm-radius); border:1px solid var(--pkm-border);\">\n            <strong style=\"color:var(--pkm-primary);\">Base Stats & Scaling</strong>\n            <p style=\"font-size:0.9rem; color:var(--pkm-text-muted); margin-top:6px;\">Official Base Attack, Defense, and Stamina/HP attributes verified from core data files.</p>\n        </div>\n        <div style=\"background:var(--pkm-bg-3); padding:16px; border-radius:var(--pkm-radius); border:1px solid var(--pkm-border);\">\n            <strong style=\"color:var(--pkm-primary);\">Regional & Special Forms</strong>\n            <p style=\"font-size:0.9rem; color:var(--pkm-text-muted); margin-top:6px;\">Full coverage of Alolan, Galarian, Hisuian, and Paldean forms plus Mega Evolutions and Primal Reversions.</p>\n        </div>\n        <div style=\"background:var(--pkm-bg-3); padding:16px; border-radius:var(--pkm-radius); border:1px solid var(--pkm-border);\">\n            <strong style=\"color:var(--pkm-primary);\">Evolution Pathways</strong>\n            <p style=\"font-size:0.9rem; color:var(--pkm-text-muted); margin-top:6px;\">Exact evolution branches, candy requirements, special item triggers, and evolution CP projections.</p>\n        </div>\n        <div style=\"background:var(--pkm-bg-3); padding:16px; border-radius:var(--pkm-radius); border:1px solid var(--pkm-border);\">\n            <strong style=\"color:var(--pkm-primary);\">Catch Rates & Modifiers</strong>\n            <p style=\"font-size:0.9rem; color:var(--pkm-text-muted); margin-top:6px;\">Base Capture Rates (BCR) and Base Flee Rates (BFR) for every wild encounter and raid boss.</p>\n        </div>\n    </div>\n\n    <h2 style=\"font-size:1.6rem; color:var(--pkm-text); margin-top:40px; margin-bottom:16px; border-bottom:2px solid var(--pkm-border); padding-bottom:8px;\">\n        4. Our Core Suite of Calculators\n    </h2>\n    <p>\n        Our custom platform currently powers 8 specialized calculation tools, designed for both casual collectors and master-tier competitive trainers:\n    </p>\n    <ol style=\"padding-left:24px; margin-bottom:24px; display:flex; flex-direction:column; gap:12px;\">\n        <li><strong>Pokémon GO CP Calculator:</strong> Calculate maximum Combat Power, custom level CP, and preview power-up progressions.</li>\n        <li><strong>IV Calculator & PvP Ranks:</strong> Check appraisal percentages (0–100%) and determine PvP stat product league rankings.</li>\n        <li><strong>Evolution CP Calculator:</strong> Predict the exact CP range of your Pokémon before spending valuable candy to evolve.</li>\n        <li><strong>Stardust & Candy Calculator:</strong> Budget exact regular candy, Candy XL, and stardust costs for standard, lucky, shadow, and purified Pokémon.</li>\n        <li><strong>GO Stat Calculator:</strong> Real-time calculation of effective Attack, Defense, and Stamina stats across any level.</li>\n        <li><strong>Catch Rate Calculator:</strong> Comprehensive catch probability matrix accounting for Ball types, Berries, Curveballs, throw precision (Nice/Great/Excellent), and Type Medals.</li>\n        <li><strong>Competitive Damage Calculator:</strong> In-depth damage calculation modeling moves, stat changes, items, and abilities for VGC and main-series battles.</li>\n        <li><strong>Speed Tiers Analyzer:</strong> Compare and rank speed thresholds across competitive metagames to determine turn order.</li>\n    </ol>\n\n    <h2 style=\"font-size:1.6rem; color:var(--pkm-text); margin-top:40px; margin-bottom:16px; border-bottom:2px solid var(--pkm-border); padding-bottom:8px;\">\n        5. Transparency, Privacy & Open Community\n    </h2>\n    <p>\n        We believe that competitive tools should respect user privacy. We do not require mandatory account registration to access any calculator, we store your visual preferences (such as Dark Mode) locally in your browser, and we maintain complete transparency in our calculation formulas.\n    </p>\n    <p>\n        Have feedback, questions, or ideas for new tools? We welcome your input! Reach out anytime via our <a href=\"/contact\" style=\"color:var(--pkm-primary); font-weight:700;\">Contact Us page</a>.\n    </p>\n\n</div>','Discover our mission to empower Pokémon trainers worldwide with real-time, mathematically rigorous, and community-verified calculation tools for Pokémon GO and competitive VGC battles.',NULL,'boxed',1120,1,'About Us — Pokémon Calculator Hub & Strategy Suite','Learn about Pokemon Calculator Hub: our mission, mathematical precision, Game Master parity, 1,025+ Pokemon database, and commitment to free, transparent trainer tools.',NULL,0,'2026-09-20 14:55:38','2026-09-20 14:55:38'),
(3,'contact-us','Contact Us — Feedback, Suggestions & Inquiries','<div class=\"pkm-contact-wrapper\">\n\n    <div style=\"display:grid; grid-template-columns:1.5fr 1fr; gap:36px; margin-bottom:48px;\">\n        \n        <!-- LEFT: Contact Form -->\n        <div>\n            <div style=\"margin-bottom:24px;\">\n                <h2 style=\"font-size:1.5rem; color:var(--pkm-text); margin-bottom:8px;\">Send Us a Message</h2>\n                <p style=\"color:var(--pkm-text-muted); font-size:0.95rem;\">\n                    Fill out the form below and our team will review your inquiry. We typically respond within 24 to 48 hours.\n                </p>\n            </div>\n\n            <form method=\"POST\" action=\"/contact/submit\" style=\"display:flex; flex-direction:column; gap:18px;\">\n                \n                <div>\n                    <label style=\"display:block; font-weight:700; font-size:0.9rem; margin-bottom:6px; color:var(--pkm-text);\" for=\"contact_name\">Your Name / Trainer Handle *</label>\n                    <input type=\"text\" id=\"contact_name\" name=\"name\" required placeholder=\"e.g. Red / TrainerAsh\" \n                           style=\"width:100%; padding:12px 14px; border:1px solid var(--pkm-border); border-radius:var(--pkm-radius); background:var(--pkm-bg-3); color:var(--pkm-text); font-size:0.95rem; box-sizing:border-box;\">\n                </div>\n\n                <div>\n                    <label style=\"display:block; font-weight:700; font-size:0.9rem; margin-bottom:6px; color:var(--pkm-text);\" for=\"contact_email\">Email Address *</label>\n                    <input type=\"email\" id=\"contact_email\" name=\"email\" required placeholder=\"name@example.com\" \n                           style=\"width:100%; padding:12px 14px; border:1px solid var(--pkm-border); border-radius:var(--pkm-radius); background:var(--pkm-bg-3); color:var(--pkm-text); font-size:0.95rem; box-sizing:border-box;\">\n                </div>\n\n                <div>\n                    <label style=\"display:block; font-weight:700; font-size:0.9rem; margin-bottom:6px; color:var(--pkm-text);\" for=\"contact_subject\">Subject / Inquiry Type *</label>\n                    <select id=\"contact_subject\" name=\"subject\" required \n                            style=\"width:100%; padding:12px 14px; border:1px solid var(--pkm-border); border-radius:var(--pkm-radius); background:var(--pkm-bg-3); color:var(--pkm-text); font-size:0.95rem; box-sizing:border-box;\">\n                        <option value=\"Formula / Calculation Bug Report\">Bug Report (Formula or CP Discrepancy)</option>\n                        <option value=\"New Calculator / Feature Suggestion\">Feature Request (Suggest a New Tool)</option>\n                        <option value=\"Pokemon Data Update Request\">Data Update (New Pokémon / Move / Form)</option>\n                        <option value=\"Partnership & Advertising\">Partnership / Advertising / Collaboration</option>\n                        <option value=\"General Feedback\">General Feedback & Other Inquiries</option>\n                    </select>\n                </div>\n\n                <div>\n                    <label style=\"display:block; font-weight:700; font-size:0.9rem; margin-bottom:6px; color:var(--pkm-text);\" for=\"contact_message\">Message Details *</label>\n                    <textarea id=\"contact_message\" name=\"message\" required rows=\"6\" placeholder=\"Please provide clear details, including Pokémon name, levels, IVs, or specific browser/device if reporting a bug...\" \n                              style=\"width:100%; padding:12px 14px; border:1px solid var(--pkm-border); border-radius:var(--pkm-radius); background:var(--pkm-bg-3); color:var(--pkm-text); font-size:0.95rem; font-family:inherit; resize:vertical; box-sizing:border-box;\"></textarea>\n                </div>\n\n                <button type=\"submit\" class=\"pkm-btn pkm-btn-primary\" style=\"padding:14px 28px; font-size:1rem; justify-content:center; cursor:pointer; font-weight:700;\">\n                    Send Message &rarr;\n                </button>\n            </form>\n        </div>\n\n        <!-- RIGHT: Contact Info & Guidelines -->\n        <div>\n            <div style=\"background:var(--pkm-bg-3); padding:28px; border-radius:var(--pkm-radius-lg); border:1px solid var(--pkm-border); margin-bottom:24px;\">\n                <h3 style=\"font-size:1.2rem; color:var(--pkm-text); margin-bottom:14px;\">Direct Contact Information</h3>\n                <p style=\"font-size:0.9rem; color:var(--pkm-text-muted); line-height:1.6; margin-bottom:16px;\">\n                    Prefer email? You can contact our engineering and content team directly:\n                </p>\n                <div style=\"display:flex; flex-direction:column; gap:10px; font-size:0.9rem;\">\n                    <div>\n                        <strong style=\"color:var(--pkm-text);\">General & Support:</strong><br>\n                        <a href=\"mailto:support@pokemoncalculator.site\" style=\"color:var(--pkm-primary); text-decoration:none;\">support@pokemoncalculator.site</a>\n                    </div>\n                    <div>\n                        <strong style=\"color:var(--pkm-text);\">Admin & Partnerships:</strong><br>\n                        <a href=\"mailto:admin@pokemoncalculator.site\" style=\"color:var(--pkm-primary); text-decoration:none;\">admin@pokemoncalculator.site</a>\n                    </div>\n                    <div>\n                        <strong style=\"color:var(--pkm-text);\">Typical Response Time:</strong><br>\n                        <span style=\"color:var(--pkm-text-muted);\">24–48 hours (Monday–Friday)</span>\n                    </div>\n                </div>\n            </div>\n\n            <div style=\"background:var(--pkm-bg-3); padding:24px; border-radius:var(--pkm-radius-lg); border:1px solid var(--pkm-border);\">\n                <h4 style=\"font-size:1.05rem; color:var(--pkm-text); margin-bottom:10px;\">Bug Report Tips</h4>\n                <p style=\"font-size:0.85rem; color:var(--pkm-text-muted); line-height:1.6;\">\n                    When reporting calculation anomalies, including the exact <strong>Pokémon Species, Level, IVs (Attack/Defense/Stamina), and CP</strong> helps us diagnose and deploy fixes quickly.\n                </p>\n            </div>\n        </div>\n\n    </div>\n\n    <!-- FAQ SECTION -->\n    <div style=\"border-top:1px solid var(--pkm-border); padding-top:40px; margin-top:40px;\">\n        <h2 style=\"font-size:1.5rem; color:var(--pkm-text); text-align:center; margin-bottom:28px;\">Frequently Asked Questions</h2>\n        \n        <div style=\"display:grid; grid-template-columns:repeat(auto-fit, minmax(300px, 1fr)); gap:20px;\">\n            <div style=\"background:var(--pkm-bg-3); padding:20px; border-radius:var(--pkm-radius); border:1px solid var(--pkm-border);\">\n                <h3 style=\"font-size:1rem; font-weight:700; color:var(--pkm-text); margin-bottom:8px;\">How often is Pokémon data updated?</h3>\n                <p style=\"font-size:0.88rem; color:var(--pkm-text-muted); line-height:1.6;\">\n                    Our database syncs with official Game Master updates and APK pushes within 24 hours of new Pokémon, movesets, or CP rebalances being pushed to the live servers.\n                </p>\n            </div>\n\n            <div style=\"background:var(--pkm-bg-3); padding:20px; border-radius:var(--pkm-radius); border:1px solid var(--pkm-border);\">\n                <h3 style=\"font-size:1rem; font-weight:700; color:var(--pkm-text); margin-bottom:8px;\">Are these calculators free to use?</h3>\n                <p style=\"font-size:0.88rem; color:var(--pkm-text-muted); line-height:1.6;\">\n                    Yes, 100% free! Every tool on Pokémon Calculator Hub is publicly accessible with no subscriptions, premium tiers, or hidden paywalls.\n                </p>\n            </div>\n\n            <div style=\"background:var(--pkm-bg-3); padding:20px; border-radius:var(--pkm-radius); border:1px solid var(--pkm-border);\">\n                <h3 style=\"font-size:1rem; font-weight:700; color:var(--pkm-text); margin-bottom:8px;\">Can I request a custom calculator or guide?</h3>\n                <p style=\"font-size:0.88rem; color:var(--pkm-text-muted); line-height:1.6;\">\n                    Absolutely! Select \"Feature Request\" in the form above and describe the tool or guide you would like to see. We regularly build features requested by our community.\n                </p>\n            </div>\n        </div>\n    </div>\n\n</div>','Have a question, suggestion, formula discrepancy report, or partnership inquiry? Get in touch with the Pokémon Calculator Hub team.',NULL,'boxed',1120,1,'Contact Us — Pokémon Calculator Hub Support','Contact the Pokemon Calculator Hub team. Submit feedback, report calculation bugs, request new tools, or submit general inquiries.',NULL,0,'2026-09-20 14:55:38','2026-09-20 15:45:10'),
(4,'privacy-policy','Privacy Policy','<div class=\"pkm-legal-content\">\n\n    <p style=\"color:var(--pkm-text-muted); font-size:0.9rem; margin-bottom:24px;\">\n        <strong>Last Updated:</strong> September 20, 2026 &bull; <strong>Effective Date:</strong> September 20, 2026\n    </p>\n\n    <div style=\"background:var(--pkm-bg-3); padding:20px; border-radius:var(--pkm-radius); border-left:4px solid var(--pkm-primary); margin-bottom:32px;\">\n        <p style=\"margin:0; font-size:0.95rem; color:var(--pkm-text);\">\n            At <strong>Pokémon Calculator Hub</strong> (accessible from <a href=\"/\" style=\"color:var(--pkm-primary); font-weight:600;\">pokemoncalculator.site</a>), your privacy is one of our top priorities. This Privacy Policy outlines the types of information we collect, how it is used, and the steps we take to safeguard your personal data in accordance with the <strong>General Data Protection Regulation (GDPR)</strong>, the <strong>California Consumer Privacy Act (CCPA)</strong>, and applicable global privacy regulations.\n        </p>\n    </div>\n\n    <h2 style=\"font-size:1.4rem; color:var(--pkm-text); margin-top:32px; margin-bottom:12px;\">1. Data Controller Information</h2>\n    <p>\n        Pokémon Calculator Hub operates as the Data Controller responsible for the processing of any personal data collected through this website. If you have questions regarding this policy or wish to exercise your legal privacy rights, contact our Data Privacy Officer at <a href=\"mailto:privacy@pokemoncalculator.site\" style=\"color:var(--pkm-primary);\">privacy@pokemoncalculator.site</a>.\n    </p>\n\n    <h2 style=\"font-size:1.4rem; color:var(--pkm-text); margin-top:32px; margin-bottom:12px;\">2. Information We Collect</h2>\n    <p>We collect information in three main categories:</p>\n\n    <h3 style=\"font-size:1.15rem; color:var(--pkm-text); margin-top:20px; margin-bottom:8px;\">A. Information You Voluntarily Provide</h3>\n    <ul style=\"padding-left:24px; margin-bottom:16px;\">\n        <li><strong>Contact Inquiries:</strong> When you submit a message through our Contact Us form, we collect your name, email address, chosen subject, and message content. This data is used solely to respond to your inquiry and is never sold or repurposed.</li>\n    </ul>\n\n    <h3 style=\"font-size:1.15rem; color:var(--pkm-text); margin-top:20px; margin-bottom:8px;\">B. Automatically Collected Technical Data (Server Logs)</h3>\n    <ul style=\"padding-left:24px; margin-bottom:16px;\">\n        <li>Like most web applications, our web servers automatically log standard technical data when you visit our pages, including: your Internet Protocol (IP) address (anonymized), browser type and version, referring/exit pages, operating system, date and time stamps, and requested resource paths.</li>\n        <li>This data is used strictly for server diagnostics, detecting denial-of-service threats, and ensuring high-availability site performance.</li>\n    </ul>\n\n    <h3 style=\"font-size:1.15rem; color:var(--pkm-text); margin-top:20px; margin-bottom:8px;\">C. Browser LocalStorage Data</h3>\n    <ul style=\"padding-left:24px; margin-bottom:16px;\">\n        <li><strong>Theme Preferences:</strong> We use HTML5 LocalStorage to save your light or dark mode visual preference under the key <code>pkm_theme</code>. This data remains on your local device and is never transmitted to our servers.</li>\n    </ul>\n\n    <h2 style=\"font-size:1.4rem; color:var(--pkm-text); margin-top:32px; margin-bottom:12px;\">3. Legal Basis for Data Processing (GDPR)</h2>\n    <p>We process personal information under the following legal bases recognized by the GDPR:</p>\n    <ul style=\"padding-left:24px; margin-bottom:20px;\">\n        <li><strong>Legitimate Interests:</strong> To deliver, optimize, and maintain our calculators, protect server infrastructure against abusive traffic, and analyze aggregated usage patterns.</li>\n        <li><strong>Consent:</strong> Where you have explicitly provided consent, such as submitting a message via our contact form or accepting optional analytics cookies.</li>\n    </ul>\n\n    <h2 style=\"font-size:1.4rem; color:var(--pkm-text); margin-top:32px; margin-bottom:12px;\">4. Third-Party Services & Cookies</h2>\n    <p>We work with trusted third-party service providers to deliver and monetize our website:</p>\n    <ul style=\"padding-left:24px; margin-bottom:20px; display:flex; flex-direction:column; gap:8px;\">\n        <li><strong>Google Analytics:</strong> We use Google Analytics to monitor aggregated, non-personally identifiable site traffic. IP addresses are anonymized before processing.</li>\n        <li><strong>Google AdSense:</strong> We may display non-intrusive advertisements served by Google. Google uses cookies (such as DoubleClick) to serve ads based on prior visits to this or other websites. You may opt out of personalized advertising by visiting <a href=\"https://adssettings.google.com\" target=\"_blank\" rel=\"noopener\" style=\"color:var(--pkm-primary);\">Google Ads Settings</a>.</li>\n        <li><strong>Cloudflare CDN:</strong> Cloudflare provides content delivery and DDoS mitigation, utilizing security cookies to manage network traffic securely.</li>\n    </ul>\n    <p>For detailed information on how cookies operate on our platform, please consult our dedicated <a href=\"/cookie-policy\" style=\"color:var(--pkm-primary); font-weight:600;\">Cookie Policy</a>.</p>\n\n    <h2 style=\"font-size:1.4rem; color:var(--pkm-text); margin-top:32px; margin-bottom:12px;\">5. Your Rights Under GDPR and CCPA</h2>\n    <p>Depending on your location, you hold the following rights regarding your personal information:</p>\n    <ul style=\"padding-left:24px; margin-bottom:20px; display:flex; flex-direction:column; gap:6px;\">\n        <li><strong>Right to Access:</strong> You may request a copy of any personal data we hold about you.</li>\n        <li><strong>Right to Rectification:</strong> You may request correction of inaccurate or incomplete information.</li>\n        <li><strong>Right to Erasure (\"Right to be Forgotten\"):</strong> You may request that we delete your contact submissions or associated records.</li>\n        <li><strong>Right to Restrict or Object to Processing:</strong> You may object to the processing of your data under legitimate interest provisions.</li>\n        <li><strong>Right to Non-Discrimination (CCPA):</strong> We will never discriminate against you (in pricing, access, or performance) for exercising any of your privacy rights.</li>\n    </ul>\n    <p>To exercise any of these rights, please contact us at <a href=\"mailto:privacy@pokemoncalculator.site\" style=\"color:var(--pkm-primary);\">privacy@pokemoncalculator.site</a>. Requests are answered within 30 days without charge.</p>\n\n    <h2 style=\"font-size:1.4rem; color:var(--pkm-text); margin-top:32px; margin-bottom:12px;\">6. Data Security & Storage Safeguards</h2>\n    <p>\n        We employ robust industry-standard technical measures to secure our systems, including 256-bit SSL/TLS encryption for all data in transit, prepared parameterized SQL queries to eliminate injection vulnerabilities, strict file execution controls, and regular vulnerability scanning.\n    </p>\n\n    <h2 style=\"font-size:1.4rem; color:var(--pkm-text); margin-top:32px; margin-bottom:12px;\">7. Children\'s Privacy (COPPA Compliance)</h2>\n    <p>\n        Pokémon Calculator Hub is designed as a general-audience calculation utility and does not knowingly collect personally identifiable information from children under the age of 13. If a parent or guardian believes their child has submitted personal details through our contact form, please notify us immediately and we will promptly remove the records from our database.\n    </p>\n\n    <h2 style=\"font-size:1.4rem; color:var(--pkm-text); margin-top:32px; margin-bottom:12px;\">8. Updates to this Policy</h2>\n    <p>\n        We reserve the right to update this Privacy Policy to reflect technical, legal, or operational modifications. Any changes will be published on this page with an updated \"Effective Date\".\n    </p>\n\n</div>','Our commitment to protecting your privacy. Detailed disclosures on data collection, local storage, cookies, analytics, and your rights under GDPR and CCPA.',NULL,'boxed',1120,1,'Privacy Policy — Pokémon Calculator Hub','Read the Privacy Policy for Pokemon Calculator Hub. Understand how we handle data, cookies, analytics, and user privacy in compliance with GDPR and CCPA.',NULL,0,'2026-09-20 14:55:38','2026-09-20 15:45:10'),
(5,'cookie-policy','Cookie Policy','<div class=\"pkm-legal-content\">\n\n    <p style=\"color:var(--pkm-text-muted); font-size:0.9rem; margin-bottom:24px;\">\n        <strong>Effective Date:</strong> September 20, 2026 &bull; <strong>Version:</strong> 2.0\n    </p>\n\n    <p>\n        This Cookie Policy explains how <strong>Pokémon Calculator Hub</strong> (\"we\", \"us\", or \"our\") uses cookies, local browser storage, and related technologies when you visit our website at <a href=\"/\" style=\"color:var(--pkm-primary); font-weight:600;\">pokemoncalculator.site</a>.\n    </p>\n\n    <h2 style=\"font-size:1.4rem; color:var(--pkm-text); margin-top:32px; margin-bottom:12px;\">1. What Are Cookies and Local Storage?</h2>\n    <p>\n        <strong>Cookies</strong> are small text files placed on your computer or mobile device by websites that you visit. They are widely used to make websites work efficiently, provide personalized experiences, and supply analytical insights to site operators.\n    </p>\n    <p>\n        <strong>HTML5 Local Storage</strong> is a secure browser technology that allows web applications to store key-value data directly in your browser. Unlike cookies, local storage data is never automatically transmitted to the server with every HTTP request, making it extremely fast and lightweight.\n    </p>\n\n    <h2 style=\"font-size:1.4rem; color:var(--pkm-text); margin-top:32px; margin-bottom:16px;\">2. Overview of Cookies and Storage Keys We Use</h2>\n    \n    <div style=\"overflow-x:auto; margin:20px 0;\">\n        <table style=\"width:100%; border-collapse:collapse; font-size:0.9rem; text-align:left;\">\n            <thead>\n                <tr style=\"background:var(--pkm-bg-3); border-bottom:2px solid var(--pkm-border);\">\n                    <th style=\"padding:12px; color:var(--pkm-text);\">Key / Cookie</th>\n                    <th style=\"padding:12px; color:var(--pkm-text);\">Provider</th>\n                    <th style=\"padding:12px; color:var(--pkm-text);\">Type</th>\n                    <th style=\"padding:12px; color:var(--pkm-text);\">Purpose</th>\n                    <th style=\"padding:12px; color:var(--pkm-text);\">Duration</th>\n                </tr>\n            </thead>\n            <tbody>\n                <tr style=\"border-bottom:1px solid var(--pkm-border);\">\n                    <td style=\"padding:12px;\"><code>pkm_theme</code></td>\n                    <td style=\"padding:12px;\">First-party</td>\n                    <td style=\"padding:12px;\">LocalStorage</td>\n                    <td style=\"padding:12px;\">Stores your chosen color mode (Light vs. Dark theme) so it persists across page visits.</td>\n                    <td style=\"padding:12px;\">Persistent</td>\n                </tr>\n                <tr style=\"border-bottom:1px solid var(--pkm-border);\">\n                    <td style=\"padding:12px;\"><code>PHPSESSID</code></td>\n                    <td style=\"padding:12px;\">First-party</td>\n                    <td style=\"padding:12px;\">Session Cookie</td>\n                    <td style=\"padding:12px;\">Maintains temporary session state for security CSRF token verification and contact notifications.</td>\n                    <td style=\"padding:12px;\">Session (Browser close)</td>\n                </tr>\n                <tr style=\"border-bottom:1px solid var(--pkm-border);\">\n                    <td style=\"padding:12px;\"><code>_ga</code>, <code>_gid</code></td>\n                    <td style=\"padding:12px;\">Google Analytics</td>\n                    <td style=\"padding:12px;\">Analytics Cookie</td>\n                    <td style=\"padding:12px;\">Collects anonymous, aggregated statistics on page views, device types, and calculator traffic.</td>\n                    <td style=\"padding:12px;\">1 day to 2 years</td>\n                </tr>\n                <tr style=\"border-bottom:1px solid var(--pkm-border);\">\n                    <td style=\"padding:12px;\"><code>__cf_bm</code></td>\n                    <td style=\"padding:12px;\">Cloudflare</td>\n                    <td style=\"padding:12px;\">Security Cookie</td>\n                    <td style=\"padding:12px;\">Used by Cloudflare CDN to distinguish humans from automated malicious bot traffic.</td>\n                    <td style=\"padding:12px;\">30 minutes</td>\n                </tr>\n            </tbody>\n        </table>\n    </div>\n\n    <h2 style=\"font-size:1.4rem; color:var(--pkm-text); margin-top:32px; margin-bottom:12px;\">3. Categories of Cookies</h2>\n\n    <h3 style=\"font-size:1.15rem; color:var(--pkm-text); margin-top:20px; margin-bottom:8px;\">A. Strictly Necessary & Security Cookies</h3>\n    <p>\n        These cookies are essential for our website to function securely. They enable core features such as cross-site request forgery (CSRF) protection on forms and secure routing. You cannot disable these cookies without disrupting fundamental site operations.\n    </p>\n\n    <h3 style=\"font-size:1.15rem; color:var(--pkm-text); margin-top:20px; margin-bottom:8px;\">B. Preference & Functional Storage</h3>\n    <p>\n        We use local storage to remember your visual settings (e.g. Dark Theme) so that pages load comfortably without visual flashing. This information is stored exclusively on your local device.\n    </p>\n\n    <h3 style=\"font-size:1.15rem; color:var(--pkm-text); margin-top:20px; margin-bottom:8px;\">C. Performance & Analytics Cookies</h3>\n    <p>\n        These cookies assist us in understanding how trainers interact with our calculation tools, which Pokémon species are most frequently analyzed, and whether any calculator experiences unexpected errors. All data is processed in an aggregated, anonymous format.\n    </p>\n\n    <h2 style=\"font-size:1.4rem; color:var(--pkm-text); margin-top:32px; margin-bottom:12px;\">4. How to Manage and Disable Cookies</h2>\n    <p>\n        You have the right to decide whether to accept or decline cookies. You can adjust your browser settings to reject cookies or prompt you before accepting them. Here is how to access cookie settings in common browsers:\n    </p>\n    <ul style=\"padding-left:24px; margin-bottom:20px; display:flex; flex-direction:column; gap:6px;\">\n        <li><strong>Google Chrome:</strong> Settings &rarr; Privacy and Security &rarr; Third-party cookies.</li>\n        <li><strong>Mozilla Firefox:</strong> Settings &rarr; Privacy & Security &rarr; Enhanced Tracking Protection.</li>\n        <li><strong>Apple Safari:</strong> Preferences &rarr; Privacy &rarr; Manage Website Data.</li>\n        <li><strong>Microsoft Edge:</strong> Settings &rarr; Cookies and site permissions.</li>\n        <li><strong>Mobile Browsers (iOS / Android):</strong> Access browser App Settings &rarr; Clear History & Website Data.</li>\n    </ul>\n\n    <h2 style=\"font-size:1.4rem; color:var(--pkm-text); margin-top:32px; margin-bottom:12px;\">5. Impact of Disabling Cookies</h2>\n    <p>\n        If you choose to block or disable cookies, all calculation formulas and tool functionality will continue to function fully. The only difference is that visual preferences (such as dark mode selection) and contact submission confirmations will not persist after closing your browser.\n    </p>\n\n    <h2 style=\"font-size:1.4rem; color:var(--pkm-text); margin-top:32px; margin-bottom:12px;\">6. Inquiries Regarding Our Cookie Policy</h2>\n    <p>\n        If you have questions about our use of cookies or web technologies, please reach out via email at <a href=\"mailto:privacy@pokemoncalculator.site\" style=\"color:var(--pkm-primary);\">privacy@pokemoncalculator.site</a>.\n    </p>\n\n</div>','Learn how Pokémon Calculator Hub uses cookies, session identifiers, and local storage to deliver fast, reliable, and personalized tool experiences.',NULL,'boxed',1120,1,'Cookie Policy — Pokémon Calculator Hub','Understand how Pokemon Calculator Hub uses cookies, sessions, and browser localStorage for theme preferences and fast calculation performance.',NULL,0,'2026-09-20 14:55:38','2026-09-20 15:45:10'),
(6,'terms-and-conditions','Terms and Conditions of Use','<div class=\"pkm-legal-content\">\n\n    <p style=\"color:var(--pkm-text-muted); font-size:0.9rem; margin-bottom:24px;\">\n        <strong>Effective Date:</strong> September 20, 2026 &bull; <strong>Version:</strong> 2.0\n    </p>\n\n    <div style=\"background:var(--pkm-bg-3); padding:20px; border-radius:var(--pkm-radius); border-left:4px solid var(--pkm-primary); margin-bottom:32px;\">\n        <p style=\"margin:0; font-size:0.95rem; color:var(--pkm-text);\">\n            Welcome to <strong>Pokémon Calculator Hub</strong>. By accessing or using our website located at <a href=\"/\" style=\"color:var(--pkm-primary); font-weight:600;\">pokemoncalculator.site</a> (along with all subdomains, tools, and calculators), you agree to be bound by these Terms and Conditions. If you do not agree with any part of these terms, please discontinue use of the site.\n        </p>\n    </div>\n\n    <h2 style=\"font-size:1.4rem; color:var(--pkm-text); margin-top:32px; margin-bottom:12px;\">1. Intellectual Property & Non-Affiliation Disclaimer</h2>\n    <div style=\"background:rgba(239, 68, 68, 0.08); border:1px solid rgba(239, 68, 68, 0.25); padding:20px; border-radius:var(--pkm-radius); margin-bottom:20px;\">\n        <p style=\"font-size:0.92rem; color:var(--pkm-text); line-height:1.6; margin:0;\">\n            <strong>Trademark & Copyright Notice:</strong><br>\n            Pokémon and Pokémon character names, artwork, sprites, trademarks, and logos are registered trademarks of <strong>Nintendo, Creatures Inc., GAME FREAK inc., and The Pokémon Company</strong>. Pokémon GO is a registered trademark of <strong>Niantic, Inc.</strong>\n            <br><br>\n            <strong>Pokémon Calculator Hub</strong> is an independent, unofficial, fan-created strategy resource operated under <strong>Fair Use provisions</strong> for educational, analytical, and entertainment purposes. We are <strong>not affiliated with, endorsed by, or sponsored by</strong> Nintendo, Game Freak, Creatures, The Pokémon Company, or Niantic, Inc.\n        </p>\n    </div>\n\n    <h2 style=\"font-size:1.4rem; color:var(--pkm-text); margin-top:32px; margin-bottom:12px;\">2. Permitted Use & Community Guidelines</h2>\n    <p>You are granted a revocable, non-exclusive license to use our calculators and content for personal, non-commercial gameplay strategy. You agree that you will not:</p>\n    <ul style=\"padding-left:24px; margin-bottom:20px; display:flex; flex-direction:column; gap:8px;\">\n        <li>Use automated scripts, bots, spiders, or scrapers to perform high-frequency scraping that degrades server performance or consumes excessive bandwidth.</li>\n        <li>Attempt to compromise the security, integrity, or availability of the website or connected databases.</li>\n        <li>Redistribute, sell, or license calculation output as a proprietary commercial service without express written permission.</li>\n        <li>Transmit any malicious code, viruses, Trojan horses, or harmful automated scripts.</li>\n    </ul>\n\n    <h2 style=\"font-size:1.4rem; color:var(--pkm-text); margin-top:32px; margin-bottom:12px;\">3. Calculation Accuracy & Disclaimer of Warranties</h2>\n    <p>\n        While we make every effort to ensure that all formulas, Combat Power Multipliers (CPM), base stats, catch probabilities, and damage matrices accurately mirror official game data, all tools and content on Pokémon Calculator Hub are provided on an <strong>\"as is\" and \"as available\"</strong> basis without warranties of any kind, whether express or implied.\n    </p>\n    <p>\n        Niantic and The Pokémon Company periodically update server-side constants, movesets, and mechanics. We do not guarantee that calculations will be error-free or uninterrupted, and we disclaim liability for in-game decisions, including stardust investments, candy expenditures, or battle outcomes.\n    </p>\n\n    <h2 style=\"font-size:1.4rem; color:var(--pkm-text); margin-top:32px; margin-bottom:12px;\">4. Limitation of Liability</h2>\n    <p>\n        To the fullest extent permitted by applicable law, in no event shall Pokémon Calculator Hub, its developers, contributors, or affiliates be liable for any direct, indirect, incidental, consequential, or punitive damages arising from your access to, use of, or inability to use the site or its calculators.\n    </p>\n\n    <h2 style=\"font-size:1.4rem; color:var(--pkm-text); margin-top:32px; margin-bottom:12px;\">5. External Links & Third-Party Content</h2>\n    <p>\n        Our website may contain links to external third-party websites or resources. We do not endorse and are not responsible for the availability, content, accuracy, or privacy practices of external websites.\n    </p>\n\n    <h2 style=\"font-size:1.4rem; color:var(--pkm-text); margin-top:32px; margin-bottom:12px;\">6. Modifications to Terms</h2>\n    <p>\n        We reserve the right to revise or modify these Terms and Conditions at any time. Continued use of Pokémon Calculator Hub following the publication of updated terms constitutes your acceptance of such modifications.\n    </p>\n\n    <h2 style=\"font-size:1.4rem; color:var(--pkm-text); margin-top:32px; margin-bottom:12px;\">7. Contact Information</h2>\n    <p>\n        If you have any questions or concerns regarding these Terms and Conditions, please reach out to us at <a href=\"mailto:admin@pokemoncalculator.site\" style=\"color:var(--pkm-primary);\">admin@pokemoncalculator.site</a> or submit an inquiry through our <a href=\"/contact\" style=\"color:var(--pkm-primary); font-weight:600;\">Contact Us</a> page.\n    </p>\n\n</div>','Terms of service, fair use policy, intellectual property rights, non-affiliation disclaimers, and guidelines for using Pokémon Calculator Hub.',NULL,'boxed',1120,1,'Terms and Conditions — Pokémon Calculator Hub','Read the Terms and Conditions of Pokemon Calculator Hub. Understand our fair use policy, intellectual property disclaimers, and terms of service.',NULL,0,'2026-09-20 14:55:38','2026-09-20 15:45:10');
/*!40000 ALTER TABLE `pages` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `post_tags`
--

DROP TABLE IF EXISTS `post_tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `post_tags` (
  `post_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  PRIMARY KEY (`post_id`,`tag_id`),
  KEY `tag_id` (`tag_id`),
  CONSTRAINT `post_tags_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  CONSTRAINT `post_tags_ibfk_2` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `post_tags`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `post_tags` WRITE;
/*!40000 ALTER TABLE `post_tags` DISABLE KEYS */;
/*!40000 ALTER TABLE `post_tags` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `slug` varchar(150) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` longtext DEFAULT NULL,
  `excerpt` text DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `author_id` int(11) DEFAULT NULL,
  `featured_image` varchar(255) DEFAULT NULL,
  `status` enum('draft','published','scheduled') DEFAULT 'published',
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_desc` text DEFAULT NULL,
  `og_image` varchar(255) DEFAULT NULL,
  `views_count` int(11) DEFAULT 0,
  `published_at` datetime DEFAULT current_timestamp(),
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`),
  KEY `category_id` (`category_id`),
  KEY `author_id` (`author_id`),
  CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL,
  CONSTRAINT `posts_ibfk_2` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `setting_key` varchar(100) NOT NULL,
  `setting_value` longtext DEFAULT NULL,
  `setting_group` varchar(50) DEFAULT 'general',
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `setting_key` (`setting_key`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` VALUES
(1,'site_name','Pokemon Calculator Hub','general','2026-09-20 13:48:24','2026-09-20 15:32:02'),
(2,'site_tagline','Ultimate Pokemon GO & Competitive Toolset','general','2026-09-20 13:48:24','2026-09-20 15:32:02'),
(3,'site_description','Free, accurate Pokemon calculators and competitive tools for trainers worldwide. Calculate CP, IVs, Stardust, Evolutions, Speed Tiers, and Damage.','general','2026-09-20 13:48:24','2026-09-20 13:48:24'),
(4,'site_url','https://pokemoncalculator.site','general','2026-09-20 13:48:24','2026-09-20 15:45:10'),
(5,'admin_email','admin@pokemoncalculator.site','general','2026-09-20 13:48:24','2026-09-20 15:45:10'),
(6,'default_theme','light','theme','2026-09-20 13:48:24','2026-09-20 13:48:24'),
(7,'primary_color','#0D9488','theme','2026-09-20 13:48:24','2026-09-20 13:48:24'),
(8,'secondary_color','#134E4A','theme','2026-09-20 13:48:24','2026-09-20 13:48:24'),
(9,'accent_color','#F4D03F','theme','2026-09-20 13:48:24','2026-09-20 13:48:24'),
(10,'light_bg','#F4F6F9','theme','2026-09-20 13:48:24','2026-09-20 13:48:24'),
(11,'dark_bg','#0D1117','theme','2026-09-20 13:48:24','2026-09-20 13:48:24'),
(12,'meta_title_suffix',' | Pokemon Calculator Hub','seo','2026-09-20 13:48:24','2026-09-20 13:48:24'),
(13,'default_og_image','/assets/img/og-default.png','seo','2026-09-20 13:48:24','2026-09-20 13:48:24'),
(14,'social_twitter','https://twitter.com','social','2026-09-20 13:48:24','2026-09-20 13:48:24'),
(15,'social_discord','https://discord.gg','social','2026-09-20 13:48:24','2026-09-20 13:48:24'),
(16,'social_github','https://github.com/laheef/pokemoncalculators','social','2026-09-20 13:48:24','2026-09-20 13:48:24'),
(19,'theme_default_mode','light','theme','2026-09-20 14:46:50','2026-09-20 14:46:50'),
(20,'theme_primary_color','#3B82F6','theme','2026-09-20 14:46:50','2026-09-20 14:46:50'),
(21,'theme_light_bg','#F4F6F9','theme','2026-09-20 14:46:50','2026-09-20 14:46:50'),
(22,'theme_light_text','#1A1F2E','theme','2026-09-20 14:46:50','2026-09-20 14:46:50'),
(23,'theme_dark_bg','#0D1117','theme','2026-09-20 14:46:50','2026-09-20 14:46:50'),
(24,'theme_dark_text','#E6EDF3','theme','2026-09-20 14:46:50','2026-09-20 14:46:50'),
(25,'meta_title_default','Pokemon Calculator Hub Pro - Best GO & VGC Tools','seo','2026-09-20 14:46:50','2026-09-20 14:46:50'),
(28,'site_alternate_names','Pokémon Calculator Hub, PokemonCalculators, PKM Calc Hub','general','2026-09-20 15:23:01','2026-09-20 15:32:02'),
(29,'custom_header_code','<meta name=\"google-site-verification\" content=\"test-gsc-verification-code-xyz\" />','custom_code','2026-09-20 15:23:01','2026-09-20 15:32:02'),
(30,'custom_footer_code','<!-- Custom Footer Tracking Script -->','custom_code','2026-09-20 15:23:01','2026-09-20 15:32:02'),
(31,'adsense_client_id','ca-pub-9876543210123456','monetization','2026-09-20 15:23:01','2026-09-20 15:32:02'),
(32,'analytics_id','G-PKMCALC123','monetization','2026-09-20 15:23:01','2026-09-20 15:32:02'),
(33,'ad_slot_top','<div id=\"test-google-ad-top\"><!-- Top Banner --></div>','monetization','2026-09-20 15:23:01','2026-09-20 15:32:02'),
(34,'ad_slot_below_result','<div id=\"test-google-ad-result\"><!-- Result Banner --></div>','monetization','2026-09-20 15:23:01','2026-09-20 15:32:02'),
(35,'ad_slot_mid_faq','','monetization','2026-09-20 15:23:01','2026-09-20 15:23:01'),
(45,'ad_slot_sky_left','<div id=\"test-sky-left\"><!-- Left Skyscraper 160x600 --></div>','monetization','2026-09-20 15:32:02','2026-09-20 15:32:02'),
(46,'ad_slot_sky_right','<div id=\"test-sky-right\"><!-- Right Skyscraper 160x600 --></div>','monetization','2026-09-20 15:32:02','2026-09-20 15:32:02'),
(47,'google_service_account_json','{\n    \"type\": \"service_account\",\n    \"project_id\": \"pokemon-calculators-prod\",\n    \"private_key_id\": \"key-1234567890\",\n    \"private_key\": \"-----BEGIN PRIVATE KEY-----\\nMIIEvQIBADANBgkqhkiG9w0BAQEFAASCBKcwggSjAgEAAoIBAQCdYP+Pmh\\/XtLDF\\ncIhUVOgccFRQY0Dgn61fZCB3om6y\\/T3hjm8\\/QWFkxKNt\\/uLWJGMEMgqou9DWlTag\\ncbrxDzQc84KR5npD\\/72koHAxFge+be1bBfVVL3FzItvoXfc6sTfc4H9KAn3RvFBw\\nxBPmtehP8B51mqcPvKIHZHHIbOlb\\/mIs3WK\\/\\/uc\\/28CX4ntaDrnImlj\\/7K+8071t\\noZhYUS\\/hZQ\\/swOaNslUH5aRFyW9++1bhOsL+F2CthJyuifFq7s9OEn5Fx8g0CY92\\nkbMJhssoblIlpMbAdg4pIhodv0q28a\\/pDHqlVWBbb7VHhQ5Y8Bykb0tIzeaeNRZG\\nOL3SbgKLAgMBAAECggEAGbScuYdqmRCF6RHq6p9dtDtywhicIbRjHJgdp3zMCQdN\\nIrjhmdrjfhKSQSanRWP3GlnUHOBkiZAgto8tAi\\/CCtKJaqxTHyU4BBpCiPn4tNV+\\nteXgvxO7O5ufgLJMbfVBUx4GHIAQrf\\/MwcZ9G6ttsRTe3MWwcOUWMA\\/rd9m2OhSu\\nu6OlYDXferceNaRBITrTTixlgNC6wHbTW0deLiTXOkjKUBaEf88KSb3pbS0ZEr7+\\nEdsoWGoEGEO8T9fs8ZgWiF+kA5D9DTHtNb4k5KtXw9+SyEp2Taq9VlGmuVTn+BIp\\nIzWeYS4sPsMstW16shMUj1aaVVs7eXkUS6N2ASPo7QKBgQDOCLx0fqeNl0OmMkuc\\n8lcxJFBJRvIRPW1RhUXy1bOzL87\\/r8BrcLZtMGsF5GyKq5wPRMkGWG+cS+0xJNV0\\n4JmdGLj3h8PfkxYOE7Zv4cTCup04JkAn04AJ890tJ64ZVfyJqSLTaSJZk\\/bqxi9h\\nvFo68ji74LqAoC6NCQhhRY+TXwKBgQDDi5atO7omt5YuA1WudKHXg5epdMqPWs7Z\\n9nl7T8Vhc4mvXF7lXExp6+vy28vIVZ\\/nJyKJd4a6Y9HUwDbIDVPRZpMwQpConYgn\\nB9OtjvI\\/W2HO\\/a1hZpex5AF4yywUDB2Mkud5j92FAUnn8T3BknBX8lmIMnTVN4Qu\\nFMQhRipsVQKBgCtzQjMbJsDAfr7E6pdNsD+n1dquQIyMNMq1XXwJv1zxnyji6qR9\\n36sFQ\\/y5IH7aFA5QRki1S8xdYsczamS8nQi5VwC0vAUhYsxTMe1EYpdifZeC0ZLU\\nkrMGn8VPEfM75AcwCS0mhdz4TGFUrFdjPnAh9v8ANLS9kzOhDQhegBnnAoGAfJwg\\nacZM6s1E649+c0ypsa+O3xKo3k+Mz4LsiTMdYeuBivk\\/E8QMgdcwpbOBGenOmzvq\\nG1XKyk4\\/8eaHQlaT2jYWh8Nzca\\/pio3HS6tzHgK6wnAPo6j\\/9AGLGpHGRgQudF1N\\nGr8d99sJYL\\/vjcImyzSJ72vP3euh1Mew8E9JS30CgYEAmBzLJYhUhy23eJll5dJO\\n7wKYHyNorJU\\/nNsTgmKxivRW7zaQiFvFPk342Boj+ZwKDN3Jucy7l45msRsRUHDx\\nhKlMxmoAI3yAYxerl48tTrn5sLHuFXw1+si2cXnjP+d0OlFnO\\/\\/oDZ107P7zyPDw\\nkbUuLA4rWf95aZFC10Oh2Rw=\\n-----END PRIVATE KEY-----\\n\",\n    \"client_email\": \"pkm-indexing-bot@pokemon-calculators-prod.iam.gserviceaccount.com\",\n    \"client_id\": \"10987654321\",\n    \"auth_uri\": \"https:\\/\\/accounts.google.com\\/o\\/oauth2\\/auth\",\n    \"token_uri\": \"https:\\/\\/oauth2.googleapis.com\\/token\",\n    \"auth_provider_x509_cert_url\": \"https:\\/\\/www.googleapis.com\\/oauth2\\/v1\\/certs\"\n}','google_api','2026-09-20 15:40:14','2026-09-20 15:40:14');
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `tags`
--

DROP TABLE IF EXISTS `tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `slug` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tags`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `tags` WRITE;
/*!40000 ALTER TABLE `tags` DISABLE KEYS */;
INSERT INTO `tags` VALUES
(1,'iv','IV','2026-09-20 14:46:50'),
(2,'pvp','PvP','2026-09-20 14:46:50'),
(3,'great-league','Great League','2026-09-20 14:46:50'),
(4,'guide','Guide','2026-09-20 14:46:50');
/*!40000 ALTER TABLE `tags` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `tools`
--

DROP TABLE IF EXISTS `tools`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tools` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `slug` varchar(100) NOT NULL,
  `name` varchar(150) NOT NULL,
  `short_name` varchar(50) DEFAULT NULL,
  `icon_svg` text DEFAULT NULL,
  `short_description` varchar(255) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `file_path` varchar(255) NOT NULL,
  `menu_order` int(11) DEFAULT 0,
  `is_active` tinyint(1) DEFAULT 1,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_desc` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `tools_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tools`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `tools` WRITE;
/*!40000 ALTER TABLE `tools` DISABLE KEYS */;
INSERT INTO `tools` VALUES
(1,'pokemon-go-cp-calculator','Pokemon GO CP Calculator','CP Calculator','<svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><line x1=\"18\" y1=\"20\" x2=\"18\" y2=\"10\"/><line x1=\"12\" y1=\"20\" x2=\"12\" y2=\"4\"/><line x1=\"6\" y1=\"20\" x2=\"6\" y2=\"14\"/></svg>','Calculate Combat Power, max CP, HP, power-up costs, and IV combinations for any PokÃ©mon in PokÃ©mon GO.',1,'app/tools/cp-calculator.php',1,1,'Pokemon GO CP Calculator [2026] â€” Combat Power, IVs & Stats','Calculate CP, HP, and power-up costs for all Pokemon in Pokemon GO. Interactive sliders, IV matrix, and Great/Ultra League ratings.','2026-09-20 13:48:24','2026-09-20 13:48:24'),
(2,'pokemon-go-iv-calculator','Pokemon GO IV Calculator & Appraisal Matrix','IV Calculator','<svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><polyline points=\"23 6 13.5 15.5 8.5 10.5 1 18\"/><polyline points=\"17 6 23 6 23 12\"/></svg>','Accurately calculate PokÃ©mon GO IVs (Individual Values), appraisal percentages, and PvP stat product rankings.',1,'app/tools/iv-calculator.php',2,1,'Pokemon GO IV Calculator [2026] â€” Appraisal & PvP Rank Checker','Find exact IV percentages, star ratings, and PvP stat product rankings for Pokemon GO. Fast, accurate, and updated with Gen 1â€“9 data.','2026-09-20 13:48:24','2026-09-20 13:48:24'),
(3,'pokemon-go-evolution-cp-calculator','Pokemon GO Evolution CP Calculator','Evolution CP Calculator','<svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><polygon points=\"13 2 3 14 12 14 11 22 21 10 12 10 13 2\"/></svg>','Predict CP ranges after evolution, candy requirements, evolution items, and Great/Ultra League eligibility.',1,'app/tools/evolution-cp.php',3,1,'Pokemon GO Evolution CP Calculator [2026] â€” CP Range & Candy Predictor','Predict the exact CP of your Pokemon after evolving. Check Great League & Ultra League CP caps, candy costs, and evolution item requirements.','2026-09-20 13:48:24','2026-09-20 13:48:24'),
(4,'stardust-calculator','Pokemon GO Stardust & Power-Up Calculator','Stardust Calculator','<svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><path d=\"m9.5 7.5-2 2a4.95 4.95 0 1 0 7 7l2-2a4.95 4.95 0 1 0-7-7Z\"/><path d=\"M14 6.5v10\"/><path d=\"M10 7.5v10\"/><path d=\"m16 7 1-5 1.37.68A3 3 0 0 0 19.7 3H21v1.3a3 3 0 0 0 .32 1.33L22 7l-5 1Z\"/><path d=\"m8 17-1 5-1.37-.68A3 3 0 0 0 4.3 21H3v-1.3a3 3 0 0 0-.32-1.33L2 17l5-1Z\"/></svg>','Calculate exact Stardust, Candy, and XL Candy needed to power up PokÃ©mon from any level to level 50.',1,'app/tools/stardust-calculator.php',4,1,'Pokemon GO Stardust Calculator [2026] â€” Power-Up & Trade Cost Guide','Calculate total Stardust, Regular Candy, and XL Candy needed to level up any Pokemon in Pokemon GO up to level 50. Includes Shadow, Purified, and Lucky discounts.','2026-09-20 13:48:24','2026-09-20 13:48:24'),
(5,'pokemon-go-stat-calculator','Pokemon GO Stat Calculator','GO Stat Calculator','<svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><circle cx=\"12\" cy=\"12\" r=\"10\"/><circle cx=\"12\" cy=\"12\" r=\"6\"/><circle cx=\"12\" cy=\"12\" r=\"2\"/></svg>','Calculate effective Attack, Defense, Stamina, CP, and HP across all levels (1 to 50+) with exact CPM multipliers.',1,'app/tools/go-stat-calculator.php',5,1,'Pokemon GO Stat Calculator [2026] â€” Base & In-Game Stats','Compute effective Attack, Defense, Stamina, CP, and HP stats for Pokemon GO across levels 1â€“50 using exact CPM scaling formulas.','2026-09-20 13:48:24','2026-09-20 13:48:24'),
(6,'pokemon-go-catch-rate-calculator','Pokemon GO Catch Rate Calculator','Catch Rate Calculator','<svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><circle cx=\"12\" cy=\"12\" r=\"10\"/><circle cx=\"12\" cy=\"12\" r=\"3\"/><line x1=\"12\" y1=\"2\" x2=\"12\" y2=\"9\"/><line x1=\"12\" y1=\"15\" x2=\"12\" y2=\"22\"/></svg>','Calculate exact catch probability, required throws, and difficulty rating with Pokeball, Berry, Medal, and Weather modifiers.',1,'app/tools/catch-rate-calculator.php',6,1,'Pokemon GO Catch Rate Calculator [2026] â€” Catch Probability & Ball Guide','Calculate catch rate percentages for any Pokemon in Pokemon GO with Poke Ball types, Razz/Silver/Golden berries, type medals, and weather boost.','2026-09-20 13:48:24','2026-09-20 13:48:24'),
(7,'pokemon-damage-calculator','Pokemon Battle Damage Calculator','Damage Calculator','<svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><path d=\"m14.5 12.5-8 8a2.119 2.119 0 0 1-3-3l8-8\"/><path d=\"m16 16 6-6\"/><path d=\"m8 8 6-6\"/></svg>','Comprehensive competitive damage calculator with Gens 1â€“9, natures, EVs/IVs, items, weather, and KO rolls.',2,'app/tools/damage-calculator.php',7,1,'Pokemon Damage Calculator [2026] â€” Gen 1â€“9 Competitive Battle Damage','Calculate exact battle damage, OHKO chances, stat stages, abilities, items, and weather modifiers for competitive Pokemon battling.','2026-09-20 13:48:24','2026-09-20 13:48:24'),
(8,'speed-tiers','Pokemon Speed Tier Calculator & Benchmark','Speed Tiers','<svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><path d=\"M12 2v4M12 18v4M4.93 4.93l2.83 2.83M16.24 16.24l2.83 2.83M2 12h4M18 12h4M4.93 19.07l2.83-2.83M16.24 7.76l2.83-2.83\"/></svg>','Interactive speed tier matrix for VGC & Smogon formats with Choice Scarf, Booster Energy, and Tailwind modifiers.',3,'app/tools/speed-tiers.php',8,1,'Pokemon Speed Tiers [2026] â€” Competitive Speed Benchmark & VGC Matrix','Interactive Pokemon Speed Tiers list for Gen 9 VGC and Smogon tiers. Compare real speed values with Choice Scarf, Tailwind, and Booster Energy boosts.','2026-09-20 13:48:24','2026-09-20 13:48:24');
/*!40000 ALTER TABLE `tools` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `role` enum('admin','editor','author') NOT NULL DEFAULT 'editor',
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES
(1,'admin','admin@pokemoncalculator.site','$2y$12$EiTtbhorTRlDhk1auOAvKubt3oTMTKbeW5XQnsBNMOpqyjmhv7tLm','admin','2026-09-20 13:48:24','2026-09-20 15:45:10');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*M!100616 SET NOTE_VERBOSITY=@OLD_NOTE_VERBOSITY */;

-- Dump completed on 2026-09-20 15:46:15
