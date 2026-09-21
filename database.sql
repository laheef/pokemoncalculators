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
(1,'pokemon-go','Pokemon GO','Calculators and tools tailored for Pokémon GO mobile trainers','tool',1,'2026-09-20 13:48:24'),
(2,'main-series','Main Series','Generations 1–9 battle, breeding, and mechanics tools','tool',2,'2026-09-20 13:48:24'),
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
(1,'https://pokemoncalculator.site/pokemon-go-cp-calculator','URL_UPDATED',401,'ERROR',NULL,NULL,NULL,NULL,NULL,NULL,'Auth Error','Google Service Account credentials missing, invalid, or authentication failed with Google OAuth2.','2026-09-20 15:40:43'),
(2,'https://pokemoncalculator.site/pokemon-go-iv-calculator','URL_UPDATED',401,'ERROR',NULL,NULL,NULL,NULL,NULL,NULL,'Auth Error','Google Service Account credentials missing, invalid, or authentication failed with Google OAuth2.','2026-09-20 15:40:43'),
(3,'https://pokemoncalculator.site/speed-tiers','URL_UPDATED',401,'ERROR',NULL,NULL,NULL,NULL,NULL,NULL,'Auth Error','Google Service Account credentials missing, invalid, or authentication failed with Google OAuth2.','2026-09-20 15:40:43'),
(4,'https://pokemoncalculator.site/pokemon-go-cp-calculator','INSPECT',401,'ERROR','Not Verified','FAIL',NULL,NULL,NULL,NULL,'Auth Error','Google Service Account credentials missing, invalid, or authentication failed with Google OAuth2.','2026-09-20 15:40:43');
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
(2, 'about-us', 'About Us — Pokémon Calculator Hub', '<div class="pkm-prose">
    <div style="background: var(--pkm-bg-3, #F8FAFC); border: 1px solid var(--pkm-border, #E2E8F0); border-left: 5px solid var(--pkm-primary, #0D9488); border-radius: 14px; padding: 24px 28px; margin-bottom: 36px;">
        <p style="font-size: 1.15rem; font-weight: 600; color: var(--pkm-text); margin: 0; line-height: 1.75;">
            <strong>Pokémon Calculator Hub</strong> was created by dedicated competitive trainers, math enthusiasts, and software engineers with a single objective: to deliver instant, 100% accurate, and distraction-free calculation tools for the global Pokémon GO and competitive VGC communities.
        </p>
    </div>

    <h2>1. Our Mission: Precision Without Compromise</h2>
    <p>
        Whether you are preparing for a high-stakes Pokémon GO Championship Series tournament, optimizing stat products for Great and Ultra League battles, or calculating the exact stardust required to power a shadow Legendary Pokémon from Level 8 to Level 50, precision matters. A single miscalculated IV threshold or unoptimized stat spread can mean the difference between a decisive charge move tie-break (CMP tie) victory or defeat.
    </p>
    <p>
        Most existing calculator sites suffer from excessive popups, intrusive video overlays, outdated Game Master formulas, or paywalls. Pokémon Calculator Hub was architected from the ground up to solve these frustrations. We deliver lightweight, server-side and client-side calculators that execute instantly across desktop, tablet, and mobile devices without tracking bloat.
    </p>

    <div class="pkm-feature-grid-4">
        <div class="pkm-feature-box">
            <div class="pkm-feature-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 14 14"/></svg>
            </div>
            <h3 class="pkm-feature-title">100% Math Precision</h3>
            <p class="pkm-feature-desc">All algorithms are mathematically derived directly from Game Master CPM constants and Gen 9 damage formulas.</p>
        </div>
        <div class="pkm-feature-box">
            <div class="pkm-feature-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/></svg>
            </div>
            <h3 class="pkm-feature-title">Real-Time Data Sync</h3>
            <p class="pkm-feature-desc">Our database syncs with Niantic APK changes and Pokemon Scarlet/Violet patches to guarantee accuracy.</p>
        </div>
        <div class="pkm-feature-box">
            <div class="pkm-feature-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
            </div>
            <h3 class="pkm-feature-title">Privacy Focused</h3>
            <p class="pkm-feature-desc">No accounts, passwords, or personal data required. All calculations execute anonymously.</p>
        </div>
        <div class="pkm-feature-box">
            <div class="pkm-feature-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
            </div>
            <h3 class="pkm-feature-title">100% Free Always</h3>
            <p class="pkm-feature-desc">Every calculator, chart, and guide is completely free for every trainer worldwide.</p>
        </div>
    </div>

    <h2>2. Interactive Calculators Portfolio</h2>
    <p>Our platform includes 8 comprehensive, specialized calculation engines designed for every aspect of training and battling:</p>
    
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 16px; margin: 24px 0 32px;">
        <div style="background: var(--pkm-bg-3, #F8FAFC); border: 1px solid var(--pkm-border, #E2E8F0); border-radius: 12px; padding: 20px;">
            <strong style="color: var(--pkm-primary, #0D9488); font-size: 1.05rem; display: block; margin-bottom: 6px;">⚡ Pokémon GO CP & IV Calculator</strong>
            <p style="font-size: 0.92rem; color: var(--pkm-text-muted); margin: 0; line-height: 1.6;">Calculate exact Combat Power across Levels 1 to 50 with custom Attack, Defense, and Stamina IV inputs.</p>
        </div>
        <div style="background: var(--pkm-bg-3, #F8FAFC); border: 1px solid var(--pkm-border, #E2E8F0); border-radius: 12px; padding: 20px;">
            <strong style="color: var(--pkm-primary, #0D9488); font-size: 1.05rem; display: block; margin-bottom: 6px;">🧬 Evolution CP Predictor</strong>
            <p style="font-size: 0.92rem; color: var(--pkm-text-muted); margin: 0; line-height: 1.6;">Forecast the exact CP of your Pokémon after evolution to verify eligibility for Great (1500 CP) and Ultra (2500 CP) Leagues.</p>
        </div>
        <div style="background: var(--pkm-bg-3, #F8FAFC); border: 1px solid var(--pkm-border, #E2E8F0); border-radius: 12px; padding: 20px;">
            <strong style="color: var(--pkm-primary, #0D9488); font-size: 1.05rem; display: block; margin-bottom: 6px;">✨ Stardust & Candy Optimizer</strong>
            <p style="font-size: 0.92rem; color: var(--pkm-text-muted); margin: 0; line-height: 1.6;">Compute cumulative Stardust, Regular Candy, and XL Candy power-up costs with Shadow and Purified multipliers.</p>
        </div>
        <div style="background: var(--pkm-bg-3, #F8FAFC); border: 1px solid var(--pkm-border, #E2E8F0); border-radius: 12px; padding: 20px;">
            <strong style="color: var(--pkm-primary, #0D9488); font-size: 1.05rem; display: block; margin-bottom: 6px;">🎯 Catch Rate Probability Engine</strong>
            <p style="font-size: 0.92rem; color: var(--pkm-text-muted); margin: 0; line-height: 1.6;">Compute per-throw capture odds factoring Pokéballs, Great/Ultra Balls, Razz/Golden Razz Berries, curveballs, and medals.</p>
        </div>
        <div style="background: var(--pkm-bg-3, #F8FAFC); border: 1px solid var(--pkm-border, #E2E8F0); border-radius: 12px; padding: 20px;">
            <strong style="color: var(--pkm-primary, #0D9488); font-size: 1.05rem; display: block; margin-bottom: 6px;">⚔️ Damage Calculator</strong>
            <p style="font-size: 0.92rem; color: var(--pkm-text-muted); margin: 0; line-height: 1.6;">Simulate Physical and Special damage rolls, STAB bonuses, weather multipliers, critical hits, and Terastallization.</p>
        </div>
        <div style="background: var(--pkm-bg-3, #F8FAFC); border: 1px solid var(--pkm-border, #E2E8F0); border-radius: 12px; padding: 20px;">
            <strong style="color: var(--pkm-primary, #0D9488); font-size: 1.05rem; display: block; margin-bottom: 6px;">⚡ VGC Speed Tiers Benchmark</strong>
            <p style="font-size: 0.92rem; color: var(--pkm-text-muted); margin: 0; line-height: 1.6;">Compare active Speed stats with Tailwind, Choice Scarf, Booster Energy, Trick Room, and stat stage modifiers.</p>
        </div>
    </div>

    <h2>3. Mathematical Standards & Data Integrity</h2>
    <p>
        All formulas on Pokémon Calculator Hub are cross-checked against official game mechanics and community standards. For Pokémon GO, we utilize exact CP Multiplier (CPM) arrays across all 100 half-levels (Level 1.0 to 50.0). For main series titles (Generation IX Scarlet &amp; Violet), damage calculations adhere strictly to the standardized 16-step formula including base power modifiers, attack/defense stage truncation, STAB multipliers, weather boosts, and randomized damage roll intervals (0.85 to 1.00).
    </p>

    <h2>4. Editorial & Fact-Checking Policy</h2>
    <p>
        Every formula update, stat adjustment, and guide is reviewed by our editorial team prior to publication. Whenever Niantic releases a Game Master update or The Pokémon Company announces a VGC Regulation change (such as Regulation G/H), our data pipelines extract and verify the updated values within 24 hours.
    </p>

    <h2>5. Community Feedback & Suggestions</h2>
    <p>
        Pokémon Calculator Hub is an independent, community-driven resource. If you notice a stat discrepancy, have an edge-case calculation, or would like to request a new tool, please reach out through our <a href="/contact" style="color:var(--pkm-primary); font-weight:600; text-decoration:underline;">Contact Us</a> page.
    </p>

    <div style="margin-top: 40px; padding: 24px; background: var(--pkm-bg-3, #F8FAFC); border: 1px solid var(--pkm-border, #E2E8F0); border-radius: 14px; text-align: center;">
        <h3 style="font-size: 1.25rem; font-weight: 700; margin-bottom: 8px; color: var(--pkm-text);">Ready to optimize your battle team?</h3>
        <p style="color: var(--pkm-text-muted); margin-bottom: 18px; font-size: 0.95rem;">Explore all 8 calculation engines with instant search and real-time outputs.</p>
        <a href="/calculators" style="display: inline-block; background: var(--pkm-primary, #0D9488); color: #FFFFFF; padding: 12px 28px; border-radius: 10px; font-weight: 700; text-decoration: none; transition: background 0.2s ease;">Explore All Calculators &rarr;</a>
    </div>
</div>', 'Discover our mission to empower Pokemon trainers worldwide with real-time, mathematically rigorous, and community-verified calculation tools for Pokémon GO and competitive VGC battles.', 'About Us — Pokémon Calculator Hub', 'Learn about Pokemon Calculator Hub, our mission, 100% accurate mathematical models, and the team building free tools for Pokemon trainers.', 'boxed', 1080, 5, 1, '2026-09-21 00:00:00', '2026-09-21 00:00:00'),
(3, 'contact-us', 'Contact Us — Pokémon Calculator Hub', '<div class="pkm-prose">
    <div style="display: grid; grid-template-columns: 1fr 340px; gap: 40px; align-items: start;">
        
        <!-- Left: Form Card -->
        <div style="background: var(--pkm-bg-3, #F8FAFC); border: 1px solid var(--pkm-border, #E2E8F0); border-radius: 16px; padding: 32px;">
            <h2 style="font-size: 1.4rem; font-weight: 800; margin-top: 0; margin-bottom: 8px; color: var(--pkm-text);">Send Us a Message</h2>
            <p style="color: var(--pkm-text-muted); font-size: 0.95rem; margin-bottom: 24px; line-height: 1.6;">
                Have a question, feedback, bug report, or feature request? Fill out the form below and our team will get back to you within 24 to 48 hours.
            </p>

            <form action="/contact/submit" method="POST" style="display: flex; flex-direction: column; gap: 18px;">
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                    <div>
                        <label style="display: block; font-weight: 700; font-size: 0.85rem; margin-bottom: 6px; color: var(--pkm-text);">Your Name <span style="color: #EF4444;">*</span></label>
                        <input type="text" name="name" required placeholder="e.g. Red Trainer" style="width: 100%; padding: 12px 14px; border: 1.5px solid var(--pkm-border, #CBD5E1); border-radius: 8px; background: var(--pkm-bg-card, #FFF); color: var(--pkm-text); font-size: 0.95rem; outline: none; box-sizing: border-box;">
                    </div>
                    <div>
                        <label style="display: block; font-weight: 700; font-size: 0.85rem; margin-bottom: 6px; color: var(--pkm-text);">Email Address <span style="color: #EF4444;">*</span></label>
                        <input type="email" name="email" required placeholder="trainer@example.com" style="width: 100%; padding: 12px 14px; border: 1.5px solid var(--pkm-border, #CBD5E1); border-radius: 8px; background: var(--pkm-bg-card, #FFF); color: var(--pkm-text); font-size: 0.95rem; outline: none; box-sizing: border-box;">
                    </div>
                </div>

                <div>
                    <label style="display: block; font-weight: 700; font-size: 0.85rem; margin-bottom: 6px; color: var(--pkm-text);">Subject / Topic</label>
                    <select name="subject" style="width: 100%; padding: 12px 14px; border: 1.5px solid var(--pkm-border, #CBD5E1); border-radius: 8px; background: var(--pkm-bg-card, #FFF); color: var(--pkm-text); font-size: 0.95rem; outline: none; box-sizing: border-box;">
                        <option value="General Inquiry">General Inquiry</option>
                        <option value="Bug Report">Bug Report / Calculation Discrepancy</option>
                        <option value="Feature Request">Feature / New Tool Request</option>
                        <option value="Data Correction">Pokemon Data / Stat Correction</option>
                        <option value="Advertising / Partnership">Advertising / Partnership</option>
                    </select>
                </div>

                <div>
                    <label style="display: block; font-weight: 700; font-size: 0.85rem; margin-bottom: 6px; color: var(--pkm-text);">Your Message <span style="color: #EF4444;">*</span></label>
                    <textarea name="message" rows="5" required placeholder="Describe your inquiry, calculator feedback, or formula observation..." style="width: 100%; padding: 12px 14px; border: 1.5px solid var(--pkm-border, #CBD5E1); border-radius: 8px; background: var(--pkm-bg-card, #FFF); color: var(--pkm-text); font-size: 0.95rem; outline: none; resize: vertical; box-sizing: border-box;"></textarea>
                </div>

                <button type="submit" style="background: var(--pkm-primary, #0D9488); color: #FFFFFF; font-weight: 700; font-size: 1rem; padding: 14px 24px; border: none; border-radius: 8px; cursor: pointer; transition: background 0.2s ease; display: inline-flex; align-items: center; justify-content: center; gap: 8px;">
                    Send Message &rarr;
                </button>
            </form>
        </div>

        <!-- Right: Info Sidebar -->
        <div style="display: flex; flex-direction: column; gap: 20px;">
            <div style="background: var(--pkm-bg-3, #F8FAFC); border: 1px solid var(--pkm-border, #E2E8F0); border-radius: 16px; padding: 24px;">
                <h3 style="font-size: 1.1rem; font-weight: 700; margin-top: 0; margin-bottom: 12px; color: var(--pkm-text);">Direct Support</h3>
                <p style="font-size: 0.9rem; color: var(--pkm-text-muted); margin-bottom: 16px; line-height: 1.6;">
                    For urgent formula edge-cases or partnership inquiries, reach out directly:
                </p>
                <div style="padding: 10px 14px; background: var(--pkm-bg-card, #FFF); border: 1px solid var(--pkm-border, #E2E8F0); border-radius: 8px; font-family: monospace; font-size: 0.9rem; color: var(--pkm-primary, #0D9488); font-weight: 700;">
                    support@pokemoncalculator.site
                </div>
            </div>

            <div style="background: var(--pkm-bg-3, #F8FAFC); border: 1px solid var(--pkm-border, #E2E8F0); border-radius: 16px; padding: 24px;">
                <h3 style="font-size: 1.1rem; font-weight: 700; margin-top: 0; margin-bottom: 12px; color: var(--pkm-text);">Response Time</h3>
                <p style="font-size: 0.9rem; color: var(--pkm-text-muted); margin: 0; line-height: 1.6;">
                    Our team reviews submissions continuously. Expect a personalized response within <strong>24 to 48 business hours</strong>.
                </p>
            </div>

            <div style="background: var(--pkm-bg-3, #F8FAFC); border: 1px solid var(--pkm-border, #E2E8F0); border-radius: 16px; padding: 24px;">
                <h3 style="font-size: 1.1rem; font-weight: 700; margin-top: 0; margin-bottom: 12px; color: var(--pkm-text);">Frequently Asked</h3>
                <div style="font-size: 0.88rem; color: var(--pkm-text-muted); line-height: 1.5; display: flex; flex-direction: column; gap: 10px;">
                    <div>
                        <strong style="color: var(--pkm-text); display: block;">Q: Are calculations free?</strong>
                        <span>Yes, 100% free with no registration or subscriptions.</span>
                    </div>
                    <div>
                        <strong style="color: var(--pkm-text); display: block;">Q: When are new Pokemon added?</strong>
                        <span>Within 24 hours of official Niantic Game Master / Pokemon Scarlet &amp; Violet updates.</span>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>', 'Get in touch with the Pokemon Calculator Hub team for feature requests, bug reports, formula feedback, or general inquiries.', 'Contact Us — Pokémon Calculator Hub', 'Have questions, feedback, or calculator feature requests? Contact the Pokemon Calculator Hub team directly.', 'boxed', 1080, 5, 1, '2026-09-21 00:00:00', '2026-09-21 00:00:00'),
(4, 'privacy-policy', 'Privacy Policy — Pokémon Calculator Hub', '<div class="pkm-prose">
    <div style="background: var(--pkm-bg-3, #F8FAFC); border: 1px solid var(--pkm-border, #E2E8F0); border-left: 5px solid var(--pkm-primary, #0D9488); border-radius: 14px; padding: 20px 24px; margin-bottom: 32px;">
        <strong style="color: var(--pkm-text); display: block; font-size: 1.05rem; margin-bottom: 4px;">Privacy Summary &amp; Commitment</strong>
        <p style="margin: 0; font-size: 0.93rem; color: var(--pkm-text-muted); line-height: 1.6;">
            We respect your digital privacy. Pokémon Calculator Hub does NOT require user accounts, does NOT sell personal data, and processes all calculator inputs anonymously. This policy outlines how anonymous usage data and cookies are handled in accordance with GDPR, CCPA, and Google AdSense compliance requirements.
        </p>
    </div>

    <p style="font-size:0.9rem; color:var(--pkm-text-muted);"><strong>Effective Date:</strong> September 21, 2026 | <strong>Last Updated:</strong> September 21, 2026</p>

    <h2>1. Information We Collect</h2>
    <p>Pokémon Calculator Hub is designed to be fully functional without requiring user registration, logins, or submission of personally identifiable information (PII). We collect information in two limited contexts:</p>
    <ul>
        <li><strong>Voluntary Contact Information:</strong> When you voluntarily submit a message via our Contact Form, we receive your name, email address, and message text solely to respond to your inquiry.</li>
        <li><strong>Automated Technical Logs:</strong> Like standard web servers, our host automatically collects standard technical data (IP addresses, browser type, referring URL, operating system, timestamp) in server access logs for DDoS mitigation, system security, and performance optimization.</li>
        <li><strong>Calculator Input Data:</strong> All Pokémon calculations (IV values, CP inputs, move selections, speed tier filters) are processed in real-time in your browser or through stateless API calls without being saved to user profiles.</li>
    </ul>

    <h2>2. Use of Cookies &amp; Local Storage</h2>
    <p>We use lightweight cookies and browser local storage strictly for functional, analytical, and advertising purposes:</p>
    <ul>
        <li><strong>Functional Local Storage:</strong> To remember your chosen theme preference (Dark Mode or Light Mode) across page visits.</li>
        <li><strong>Security Tokens:</strong> Temporary session cookies to prevent Cross-Site Request Forgery (CSRF) on contact form submissions.</li>
        <li><strong>Google Analytics:</strong> Anonymous, aggregated website traffic statistics to help us understand which calculators are most popular and improve user experience.</li>
        <li><strong>Google AdSense Advertising:</strong> Third-party vendors, including Google, use cookies to serve ads based on prior visits to this website or other websites.</li>
    </ul>

    <h2>3. Third-Party Advertising &amp; Google AdSense</h2>
    <p>
        We partner with Google AdSense to display contextual advertisements that fund server hosting and ongoing development of free calculation tools.
    </p>
    <ul>
        <li>Google&#39;s use of advertising cookies enables it and its partners to serve ads to users based on their visit to our site and/or other sites on the Internet.</li>
        <li>Users may opt out of personalized advertising by visiting <a href="https://www.google.com/settings/ads" target="_blank" rel="noopener" style="color:var(--pkm-primary); text-decoration:underline;">Google Ads Settings</a> or by visiting <a href="https://www.aboutads.info/choices/" target="_blank" rel="noopener" style="color:var(--pkm-primary); text-decoration:underline;">www.aboutads.info</a>.</li>
    </ul>

    <h2>4. Data Protection &amp; Security Measures</h2>
    <p>
        We employ robust technical safeguards to protect server integrity and user communications:
    </p>
    <ul>
        <li><strong>SSL/TLS Encryption:</strong> All traffic between your browser and our servers is encrypted using 256-bit HTTPS encryption.</li>
        <li><strong>Strict Access Controls:</strong> Database credentials and backend source code are shielded by multi-tier Apache access control barriers.</li>
        <li><strong>SQLi &amp; XSS Hardening:</strong> 100% of database queries utilize parameterized PDO prepared statements, and user inputs are strictly sanitized.</li>
    </ul>

    <h2>5. Your Rights Under GDPR &amp; CCPA</h2>
    <p>Depending on your geographic location, you possess statutory rights regarding your personal data:</p>
    <ul>
        <li><strong>Right to Access:</strong> You may request a copy of any personal data we hold about you (e.g. historical contact inquiries).</li>
        <li><strong>Right to Rectification &amp; Erasure:</strong> You may request that we correct inaccurate data or delete your contact form records.</li>
        <li><strong>Right to Opt-Out:</strong> You may disable non-essential cookies through your browser settings or opt out of personalized ad tracking.</li>
    </ul>

    <h2>6. Contact Our Privacy Team</h2>
    <p>
        For any privacy inquiries, data deletion requests, or compliance questions, please contact our Data Protection Officer at:
    </p>
    <p style="background:var(--pkm-bg-3); padding:16px 20px; border-radius:10px; border:1px solid var(--pkm-border); font-weight:600;">
        Email: <a href="mailto:privacy@pokemoncalculator.site" style="color:var(--pkm-primary);">privacy@pokemoncalculator.site</a><br>
        Website: <a href="https://pokemoncalculator.site" style="color:var(--pkm-primary);">https://pokemoncalculator.site</a>
    </p>
</div>', 'Our commitment to protecting trainer privacy, anonymous calculator usage, cookie policies, and data protection compliance.', 'Privacy Policy — Pokémon Calculator Hub', 'Read our Privacy Policy to understand how Pokemon Calculator Hub protects your data, uses cookies, and complies with GDPR & CCPA.', 'boxed', 1080, 5, 1, '2026-09-21 00:00:00', '2026-09-21 00:00:00'),
(5, 'cookie-policy', 'Cookie Policy — Pokémon Calculator Hub', '<div class="pkm-prose">
    <div style="background: var(--pkm-bg-3, #F8FAFC); border: 1px solid var(--pkm-border, #E2E8F0); border-left: 5px solid var(--pkm-primary, #0D9488); border-radius: 14px; padding: 20px 24px; margin-bottom: 32px;">
        <strong style="color: var(--pkm-text); display: block; font-size: 1.05rem; margin-bottom: 4px;">Cookie Policy Summary</strong>
        <p style="margin: 0; font-size: 0.93rem; color: var(--pkm-text-muted); line-height: 1.6;">
            This Cookie Policy explains how Pokémon Calculator Hub uses cookies, local storage, and similar technologies to remember your preferences, ensure site security, and deliver relevant advertisements.
        </p>
    </div>

    <p style="font-size:0.9rem; color:var(--pkm-text-muted);"><strong>Effective Date:</strong> September 21, 2026 | <strong>Last Updated:</strong> September 21, 2026</p>

    <h2>1. What Are Cookies?</h2>
    <p>
        Cookies are small text files placed on your computer, smartphone, or tablet when you visit websites. They are widely used to make websites work efficiently, store user preferences (such as Dark/Light theme), and provide reporting data to site operators.
    </p>

    <h2>2. Categories of Cookies We Use</h2>
    
    <div style="overflow-x: auto; margin: 24px 0 32px;">
        <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 0.92rem;">
            <thead>
                <tr style="background: var(--pkm-bg-3, #F8FAFC); border-bottom: 2px solid var(--pkm-border, #CBD5E1);">
                    <th style="padding: 12px 16px; color: var(--pkm-text); font-weight: 700;">Cookie / Storage Key</th>
                    <th style="padding: 12px 16px; color: var(--pkm-text); font-weight: 700;">Type</th>
                    <th style="padding: 12px 16px; color: var(--pkm-text); font-weight: 700;">Purpose</th>
                    <th style="padding: 12px 16px; color: var(--pkm-text); font-weight: 700;">Duration</th>
                </tr>
            </thead>
            <tbody>
                <tr style="border-bottom: 1px solid var(--pkm-border, #E2E8F0);">
                    <td style="padding: 12px 16px; font-family: monospace; color: var(--pkm-primary);">pkm-theme</td>
                    <td style="padding: 12px 16px;">Local Storage</td>
                    <td style="padding: 12px 16px;">Saves your chosen Light / Dark theme mode preference.</td>
                    <td style="padding: 12px 16px;">Persistent</td>
                </tr>
                <tr style="border-bottom: 1px solid var(--pkm-border, #E2E8F0);">
                    <td style="padding: 12px 16px; font-family: monospace; color: var(--pkm-primary);">PHPSESSID</td>
                    <td style="padding: 12px 16px;">Essential Session</td>
                    <td style="padding: 12px 16px;">Secures contact form submissions with CSRF tokens.</td>
                    <td style="padding: 12px 16px;">Session</td>
                </tr>
                <tr style="border-bottom: 1px solid var(--pkm-border, #E2E8F0);">
                    <td style="padding: 12px 16px; font-family: monospace; color: var(--pkm-primary);">_ga, _gid</td>
                    <td style="padding: 12px 16px;">Analytics</td>
                    <td style="padding: 12px 16px;">Google Analytics anonymous website visitor measurement.</td>
                    <td style="padding: 12px 16px;">Up to 2 years</td>
                </tr>
                <tr style="border-bottom: 1px solid var(--pkm-border, #E2E8F0);">
                    <td style="padding: 12px 16px; font-family: monospace; color: var(--pkm-primary);">__gads, IDE</td>
                    <td style="padding: 12px 16px;">Advertising</td>
                    <td style="padding: 12px 16px;">Google AdSense ad personalization and frequency capping.</td>
                    <td style="padding: 12px 16px;">Up to 13 months</td>
                </tr>
            </tbody>
        </table>
    </div>

    <h2>3. Managing &amp; Disabling Cookies</h2>
    <p>
        You can control and manage cookies through your web browser settings. Most browsers allow you to view stored cookies, delete individual cookies, or block third-party cookies altogether.
    </p>
    <ul>
        <li><strong>Google Chrome:</strong> Settings &rarr; Privacy and security &rarr; Third-party cookies.</li>
        <li><strong>Mozilla Firefox:</strong> Settings &rarr; Privacy &amp; Security &rarr; Enhanced Tracking Protection.</li>
        <li><strong>Apple Safari:</strong> Preferences &rarr; Privacy &rarr; Prevent cross-site tracking.</li>
        <li><strong>Microsoft Edge:</strong> Settings &rarr; Cookies and site permissions &rarr; Manage and delete cookies.</li>
    </ul>

    <h2>4. Updates to This Cookie Policy</h2>
    <p>
        We may update this policy periodically to reflect changes in our technology stack or legal requirements. Any modifications will be posted with an updated revision date.
    </p>

    <h2>5. Contact Us</h2>
    <p>
        If you have questions about our use of cookies or tracking technologies, please reach out via email at <a href="mailto:privacy@pokemoncalculator.site" style="color:var(--pkm-primary); font-weight:600;">privacy@pokemoncalculator.site</a>.
    </p>
</div>', 'Detailed information regarding the cookies, local storage keys, and analytics technologies used on Pokemon Calculator Hub.', 'Cookie Policy — Pokémon Calculator Hub', 'Learn how cookies and browser storage are utilized on Pokemon Calculator Hub to save theme settings and deliver relevant ads.', 'boxed', 1080, 5, 1, '2026-09-21 00:00:00', '2026-09-21 00:00:00'),
(6, 'terms-and-conditions', 'Terms & Conditions — Pokémon Calculator Hub', '<div class="pkm-prose">
    <div style="background: var(--pkm-bg-3, #F8FAFC); border: 1px solid var(--pkm-border, #E2E8F0); border-left: 5px solid var(--pkm-primary, #0D9488); border-radius: 14px; padding: 20px 24px; margin-bottom: 32px;">
        <strong style="color: var(--pkm-text); display: block; font-size: 1.05rem; margin-bottom: 4px;">Terms Overview</strong>
        <p style="margin: 0; font-size: 0.93rem; color: var(--pkm-text-muted); line-height: 1.6;">
            By accessing or using Pokémon Calculator Hub, you agree to be bound by these Terms and Conditions. Please review them carefully before using our calculation engines, guides, or API endpoints.
        </p>
    </div>

    <p style="font-size:0.9rem; color:var(--pkm-text-muted);"><strong>Effective Date:</strong> September 21, 2026 | <strong>Last Updated:</strong> September 21, 2026</p>

    <h2>1. Acceptance of Terms</h2>
    <p>
        These Terms and Conditions govern your access to and use of <strong>Pokémon Calculator Hub</strong> (located at <code>https://pokemoncalculator.site</code>). By accessing any calculator, reading strategy guides, or interacting with our services, you acknowledge that you have read, understood, and agreed to these terms. If you do not agree, you must discontinue using the site.
    </p>

    <h2>2. Intellectual Property &amp; Fair Use Disclaimer</h2>
    <p>
        Pokémon Calculator Hub is an unofficial, community-created analytical resource. 
    </p>
    <ul>
        <li><strong>Pokémon Trademark:</strong> Pokémon and Pokémon character names, sprites, artwork, Game Master constants, and related assets are trademarks and copyrights of <strong>Nintendo</strong>, <strong>Creatures Inc.</strong>, <strong>GAME FREAK inc.</strong>, and <strong>Niantic, Inc.</strong></li>
        <li><strong>Non-Affiliation:</strong> Pokémon Calculator Hub is not affiliated with, endorsed by, sponsored by, or associated with Nintendo, Niantic, The Pokémon Company, or Game Freak.</li>
        <li><strong>Fair Use:</strong> All Pokémon imagery, base stats, and move data are utilized strictly under Fair Use for non-commercial educational, informational, and competitive analytical purposes.</li>
        <li><strong>Proprietary Code:</strong> The underlying custom PHP source code, user interface designs, mathematical calculation algorithms, and database structures are the exclusive intellectual property of Pokémon Calculator Hub.</li>
    </ul>

    <h2>3. Accuracy of Calculations &amp; "As-Is" Disclaimer</h2>
    <p>
        While we strive for 100% mathematical precision and continuous synchronization with Game Master updates, all calculations, stat projections, evolution CP predictions, and damage estimates are provided on an <strong>"AS IS" and "AS AVAILABLE"</strong> basis without warranties of any kind.
    </p>
    <p>
        Pokémon Calculator Hub shall not be liable for in-game resource expenditures (such as Stardust, Rare Candy, or Elite TMs), tournament battle outcomes, or unforeseen Game Master rebalances enacted by game publishers.
    </p>

    <h2>4. Acceptable Use Policy</h2>
    <p>When using Pokémon Calculator Hub, you agree to abide by the following standards:</p>
    <ul>
        <li>You will not execute automated scraping bots, high-frequency crawl scripts, or DDoS attacks that degrade server performance for other trainers.</li>
        <li>You will not attempt to bypass security barriers, probe protected directories (<code>/app/</code>, <code>/config/</code>, <code>.env</code>), or inject malicious scripts.</li>
        <li>You will not frame or mirror our calculators on third-party commercial domains without prior written authorization.</li>
    </ul>

    <h2>5. Modifications &amp; Termination</h2>
    <p>
        We reserve the right to modify, update, or discontinue any feature, calculator, or content at any time without prior notice. We may update these Terms periodically, and continued use of the website constitutes acceptance of any revised terms.
    </p>

    <h2>6. Contact Information</h2>
    <p>
        For inquiries regarding these Terms and Conditions or intellectual property notices, please contact us at:
    </p>
    <p style="background:var(--pkm-bg-3); padding:16px 20px; border-radius:10px; border:1px solid var(--pkm-border); font-weight:600;">
        Email: <a href="mailto:legal@pokemoncalculator.site" style="color:var(--pkm-primary);">legal@pokemoncalculator.site</a><br>
        Web: <a href="https://pokemoncalculator.site/contact" style="color:var(--pkm-primary);">https://pokemoncalculator.site/contact</a>
    </p>
</div>', 'Terms of service, intellectual property fair use disclaimers, and user conduct guidelines for Pokemon Calculator Hub.', 'Terms & Conditions — Pokémon Calculator Hub', 'Review the Terms and Conditions governing use of Pokemon Calculator Hub calculation tools, strategy guides, and content.', 'boxed', 1080, 5, 1, '2026-09-21 00:00:00', '2026-09-21 00:00:00'); padding:24px; background:var(--pkm-bg-3); border-radius:var(--pkm-radius); border-left:4px solid var(--pkm-primary);">\n        <p style="font-size:1.15rem; font-weight:600; color:var(--pkm-text); margin:0; line-height:1.7;">\n            <strong>Pokémon Calculator Hub</strong> was built by dedicated competitive trainers, math enthusiasts, and software engineers to deliver instant, 100% accurate, and ad-uncluttered calculation tools for the global Pokémon community.\n        </p>\n    </div>\n\n    <h2>1. Our Mission: Precision Without Compromise</h2>\n    <p>\n        Whether preparing for a high-stakes Pokémon GO Championship Series tournament, optimizing stat products for Great and Ultra League battles, or calculating the exact stardust required to power a shadow Legendary Pokémon from Level 8 to Level 50, precision matters. A single miscalculated IV threshold or unoptimized stat spread can mean the difference between a decisive charge move tie-break (CMP tie) victory or defeat.\n    </p>\n    <p>\n        Most existing calculator sites suffer from excessive popups, intrusive video overlays, outdated Game Master formulas, or paywalls. <strong>Pokémon Calculator Hub</strong> was architected from the ground up to solve these frustrations. We deliver lightweight, server-side and client-side calculators that execute instantly across both desktop and mobile devices without tracking bloat.\n    </p>\n\n    <h2>2. Mathematical Fidelity &amp; Game Master Parity</h2>\n    <p>Our calculation engines mirror official in-game mechanics with rigorous mathematical parity:</p>\n    <ul>\n        <li><strong>Combat Power Multipliers (CPM):</strong> We maintain the complete, exact CPM curve from Level 1.0 to Level 51.5 (including half-level steps and the Level 51 Best Buddy boost) calibrated directly to Niantic\'s server-side constants.</li>\n        <li><strong>Stat Floor &amp; Formula Parity:</strong> All CP calculations utilize standard floor transformations <code>CP = max(10, floor(0.1 * (BaseAtk + AtkIV) * sqrt(BaseDef + DefIV) * sqrt(BaseSta + StaIV) * CPM^2))</code>.</li>\n        <li><strong>PvP Stat Product Optimization:</strong> Our algorithms simulate all 4,096 possible IV combinations (and relevant raid/egg 10/10/10 floors or weather boost 4/4/4 floors) to rank effective PvP stat products and bulk distribution against official Great League (1,500 CP) and Ultra League (2,500 CP) caps.</li>\n        <li><strong>Core Series Damage Formula:</strong> Our VGC damage calculator models the full Generation 9 Scarlet &amp; Violet damage formula, factoring in STAB, weather effects, terrain bonuses, stat stages (-6 to +6), screens, and 16 discrete damage rolls.</li>\n    </ul>\n\n    <h2>3. The 8 Core Battle &amp; Optimization Tools</h2>\n    <p>Our suite covers the full spectrum of Pokémon GO and competitive battle mechanics:</p>\n    <ul>\n        <li><strong>CP Calculator:</strong> Computes exact Combat Power, HP, and stats at any level with interactive IV matrix sliders.</li>\n        <li><strong>IV Calculator &amp; Appraisal Matrix:</strong> Decodes Team Leader appraisal appraisals into exact IV percentages and PvP league rankings.</li>\n        <li><strong>Evolution CP Calculator:</strong> Accurately predicts post-evolution CP, evolution item requirements, and league eligibility before spending candy.</li>\n        <li><strong>Stardust &amp; Power-Up Calculator:</strong> Detailed breakdown of Stardust, Regular Candy, and XL Candy needed for power-ups, incorporating Lucky (50% discount), Purified (10% discount), and Shadow (20% surcharge) rules.</li>\n        <li><strong>GO Stat Calculator:</strong> Real-time visualization of scaled Attack, Defense, and Stamina for all 1,025 Pokémon species.</li>\n        <li><strong>Catch Rate Calculator:</strong> Computes exact single-throw capture probabilities using official Base Catch Rates (BCR), Poké Ball multipliers, berries, and throw accuracy.</li>\n        <li><strong>Damage Calculator:</strong> Competitive battle workbench featuring Attacker vs. Defender spreads, move categories, weather, and OHKO/2HKO percentages.</li>\n        <li><strong>Speed Tiers:</strong> Real-time speed comparison engine with Tailwind, Choice Scarf, Paralysis, and Trick Room modifiers.</li>\n    </ul>\n\n    <h2>4. Privacy-First &amp; Community-Driven</h2>\n    <p>\n        Pokémon Calculator Hub operates with a strict privacy-first philosophy. All calculation data runs locally in your browser or through stateless endpoints. We do not store personal team rosters or track personal user data.\n    </p>\n    <p>\n        Have suggestions, discovered an edge-case discrepancy, or want to request a new feature? Reach out directly to our team via our <a href="/contact">Contact Us</a> page.\n    </p>\n</div>', 'Discover our mission to empower Pokemon trainers worldwide with real-time, mathematically rigorous, and community-verified calculation tools for Pokémon GO and competitive VGC battles.', NULL, 'boxed', 1080, 1, 'About Us — Pokémon Calculator Hub', 'Learn about Pokemon Calculator Hub mission, calculation fidelity, math models, and our team of competitive trainers and developers.', NULL, 0, '2026-09-20 14:00:00', '2026-09-20 14:00:00'),
(3, 'contact-us', 'Contact Us — Feedback, Suggestions & Inquiries', '<div class="pkm-contact-wrapper">\n\n    <div class="pkm-contact-grid">\n        \n        <!-- LEFT: Contact Form -->\n        <div class="pkm-contact-form-card" style="background:var(--pkm-bg-2); border:1px solid var(--pkm-border); border-radius:var(--pkm-radius-lg); padding:32px; box-shadow:var(--pkm-shadow-sm);">\n            <div style="margin-bottom:24px;">\n                <h2 style="font-size:1.4rem; font-family:var(--pkm-font-heading); color:var(--pkm-text); margin:0 0 8px;">Send Us a Message</h2>\n                <p style="color:var(--pkm-text-muted); font-size:0.95rem; margin:0; line-height:1.6;">\n                    Fill out the form below and our team will review your inquiry. We typically respond within 24 to 48 hours.\n                </p>\n            </div>\n\n            <form method="POST" action="/contact/submit" style="display:flex; flex-direction:column; gap:18px;">\n                \n                <div>\n                    <label style="display:block; font-weight:700; font-size:0.85rem; margin-bottom:6px; color:var(--pkm-text); text-transform:uppercase; letter-spacing:0.5px;" for="contact_name">Your Name / Trainer Handle *</label>\n                    <input type="text" id="contact_name" name="name" required placeholder="e.g. Red / TrainerAsh">\n                </div>\n\n                <div>\n                    <label style="display:block; font-weight:700; font-size:0.85rem; margin-bottom:6px; color:var(--pkm-text); text-transform:uppercase; letter-spacing:0.5px;" for="contact_email">Email Address *</label>\n                    <input type="email" id="contact_email" name="email" required placeholder="name@example.com">\n                </div>\n\n                <div>\n                    <label style="display:block; font-weight:700; font-size:0.85rem; margin-bottom:6px; color:var(--pkm-text); text-transform:uppercase; letter-spacing:0.5px;" for="contact_subject">Subject / Inquiry Type *</label>\n                    <select id="contact_subject" name="subject" required>\n                        <option value="Formula / Calculation Bug Report">Bug Report (Formula or CP Discrepancy)</option>\n                        <option value="New Calculator / Feature Suggestion">Feature Request (Suggest a New Tool)</option>\n                        <option value="Pokemon Data Update Request">Data Update (New Pokémon / Move / Form)</option>\n                        <option value="Partnership & Advertising">Partnership / Advertising / Collaboration</option>\n                        <option value="General Feedback">General Feedback &amp; Other Inquiries</option>\n                    </select>\n                </div>\n\n                <div>\n                    <label style="display:block; font-weight:700; font-size:0.85rem; margin-bottom:6px; color:var(--pkm-text); text-transform:uppercase; letter-spacing:0.5px;" for="contact_message">Message Details *</label>\n                    <textarea id="contact_message" name="message" required rows="5" placeholder="Please provide clear details, including Pokémon species, levels, IVs, or specific device information..."></textarea>\n                </div>\n\n                <button type="submit" class="pkm-btn pkm-btn-primary" style="padding:14px 28px; font-size:1rem; justify-content:center; cursor:pointer; font-weight:700; width:100%;">\n                    Send Message &rarr;\n                </button>\n            </form>\n        </div>\n\n        <!-- RIGHT: Direct Contact Information -->\n        <div style="display:flex; flex-direction:column; gap:20px;">\n            <div style="background:var(--pkm-bg-3); padding:28px; border-radius:var(--pkm-radius-lg); border:1px solid var(--pkm-border);">\n                <h3 style="font-size:1.15rem; font-family:var(--pkm-font-heading); color:var(--pkm-text); margin:0 0 14px;">Direct Contact Information</h3>\n                <p style="font-size:0.9rem; color:var(--pkm-text-muted); line-height:1.6; margin-bottom:16px;">\n                    Prefer email? You can contact our engineering and content team directly:\n                </p>\n                <div style="display:flex; flex-direction:column; gap:12px; font-size:0.9rem;">\n                    <div>\n                        <strong style="color:var(--pkm-text);">General &amp; Support:</strong><br>\n                        <a href="mailto:support@pokemoncalculator.site" style="color:var(--pkm-primary); text-decoration:none; font-weight:600;">support@pokemoncalculator.site</a>\n                    </div>\n                    <div>\n                        <strong style="color:var(--pkm-text);">Admin &amp; Partnerships:</strong><br>\n                        <a href="mailto:admin@pokemoncalculator.site" style="color:var(--pkm-primary); text-decoration:none; font-weight:600;">admin@pokemoncalculator.site</a>\n                    </div>\n                    <div>\n                        <strong style="color:var(--pkm-text);">Typical Response Time:</strong><br>\n                        <span style="color:var(--pkm-text-muted);">24–48 hours (Monday–Friday)</span>\n                    </div>\n                </div>\n            </div>\n\n            <div style="background:var(--pkm-bg-3); padding:24px; border-radius:var(--pkm-radius-lg); border:1px solid var(--pkm-border);">\n                <h4 style="font-size:1.05rem; font-family:var(--pkm-font-heading); color:var(--pkm-text); margin:0 0 10px;">Bug Report Tips</h4>\n                <p style="font-size:0.88rem; color:var(--pkm-text-muted); line-height:1.6; margin:0;">\n                    When reporting calculation anomalies, including the exact <strong>Pokémon Species, Level, IVs (Attack/Defense/Stamina), and CP</strong> helps us diagnose and deploy fixes quickly.\n                </p>\n            </div>\n        </div>\n\n    </div>\n\n    <!-- FAQ SECTION -->\n    <div style="border-top:1px solid var(--pkm-border); padding-top:40px; margin-top:40px;">\n        <h2 style="font-size:1.5rem; font-family:var(--pkm-font-heading); color:var(--pkm-text); text-align:center; margin-bottom:28px;">Frequently Asked Questions</h2>\n        \n        <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(300px, 1fr)); gap:20px;">\n            <div style="background:var(--pkm-bg-3); padding:20px; border-radius:var(--pkm-radius); border:1px solid var(--pkm-border);">\n                <h3 style="font-size:1rem; font-weight:700; color:var(--pkm-text); margin:0 0 8px;">How often is Pokémon data updated?</h3>\n                <p style="font-size:0.88rem; color:var(--pkm-text-muted); line-height:1.6; margin:0;">\n                    Our database syncs with official Game Master updates and APK pushes within 24 hours of new Pokémon, movesets, or CP rebalances being pushed to live servers.\n                </p>\n            </div>\n\n            <div style="background:var(--pkm-bg-3); padding:20px; border-radius:var(--pkm-radius); border:1px solid var(--pkm-border);">\n                <h3 style="font-size:1rem; font-weight:700; color:var(--pkm-text); margin:0 0 8px;">Are these calculators free to use?</h3>\n                <p style="font-size:0.88rem; color:var(--pkm-text-muted); line-height:1.6; margin:0;">\n                    Yes, 100% free! Every tool on Pokémon Calculator Hub is publicly accessible with no subscriptions, premium tiers, or hidden paywalls.\n                </p>\n            </div>\n\n            <div style="background:var(--pkm-bg-3); padding:20px; border-radius:var(--pkm-radius); border:1px solid var(--pkm-border);">\n                <h3 style="font-size:1rem; font-weight:700; color:var(--pkm-text); margin:0 0 8px;">Can I request a custom calculator or guide?</h3>\n                <p style="font-size:0.88rem; color:var(--pkm-text-muted); line-height:1.6; margin:0;">\n                    Absolutely! Select "Feature Request" in the form above and describe the tool or guide you would like to see. We regularly build features requested by our community.\n                </p>\n            </div>\n        </div>\n    </div>\n\n</div>', 'Have a question, suggestion, formula discrepancy report, or partnership inquiry? Get in touch with the Pokémon Calculator Hub team.', NULL, 'boxed', 1080, 1, 'Contact Us — Pokémon Calculator Hub Support', 'Contact the Pokemon Calculator Hub team. Submit feedback, report calculation bugs, request new tools, or submit general inquiries.', NULL, 0, '2026-09-20 14:00:00', '2026-09-20 14:00:00'),
(4, 'privacy-policy', 'Privacy Policy', '<div class="pkm-prose">\n    <div style="margin-bottom:28px; padding:20px; background:var(--pkm-bg-3); border-radius:var(--pkm-radius); border-left:4px solid var(--pkm-primary);">\n        <p style="margin:0; font-size:1rem; line-height:1.7; color:var(--pkm-text);">\n            At <strong>Pokémon Calculator Hub</strong> (accessible from <a href="https://pokemoncalculator.site">pokemoncalculator.site</a>), your privacy is one of our top priorities. This Privacy Policy outlines the types of information we collect, how it is used, and the steps we take to safeguard your personal data in accordance with the <strong>General Data Protection Regulation (GDPR)</strong>, the <strong>California Consumer Privacy Act (CCPA)</strong>, and applicable global privacy regulations.\n        </p>\n    </div>\n\n    <h2>1. Data Controller Information</h2>\n    <p>\n        Pokémon Calculator Hub operates as the Data Controller responsible for the processing of any personal data collected through this website. If you have questions regarding this policy or wish to exercise your legal privacy rights, contact our Data Privacy Officer at <a href="mailto:privacy@pokemoncalculator.site">privacy@pokemoncalculator.site</a>.\n    </p>\n\n    <h2>2. Information We Collect</h2>\n    <p>We collect information in three main categories:</p>\n    <ul>\n        <li><strong>Contact Inquiries:</strong> When you submit a message through our Contact Us form, we collect your name, email address, chosen subject, and message content. This data is used solely to respond to your inquiry and is never sold or repurposed.</li>\n        <li><strong>Automatically Collected Technical Data (Server Logs):</strong> Standard technical data including your Internet Protocol (IP) address (anonymized), browser type and version, referring/exit pages, operating system, date and time stamps, and requested resource paths. This data is used strictly for server diagnostics, detecting denial-of-service threats, and ensuring high-availability site performance.</li>\n        <li><strong>Local Storage (Client-Side Preferences):</strong> We store your chosen theme preference (Light vs. Dark mode) in your browser\'s local storage (<code>pkm_theme</code>). This data remains entirely on your device.</li>\n    </ul>\n\n    <h2>3. How We Use Your Information</h2>\n    <p>We process collected data exclusively for legitimate operational purposes:</p>\n    <ul>\n        <li>To operate, maintain, and optimize our calculators and web application.</li>\n        <li>To respond to your inquiries, bug reports, and customer service requests.</li>\n        <li>To monitor traffic aggregate metrics and prevent malicious bot abuse or DDoS attacks.</li>\n        <li>To comply with applicable legal obligations and enforce our Terms and Conditions.</li>\n    </ul>\n\n    <h2>4. Third-Party Analytics &amp; Advertising</h2>\n    <p>\n        We may partner with third-party service providers such as Google Analytics and Google AdSense to analyze website traffic and serve non-intrusive advertisements. These third parties may use cookies and web beacons to serve ads based on prior visits. You can learn more about how Google uses data at <a href="https://policies.google.com/technologies/ads" target="_blank" rel="noopener">Google\'s Advertising Privacy Policies</a>.\n    </p>\n\n    <h2>5. Your Rights Under GDPR &amp; CCPA</h2>\n    <p>Depending on your geographic location, you have statutory rights concerning your personal data:</p>\n    <ul>\n        <li><strong>Right to Access:</strong> Request a copy of personal information we maintain about you.</li>\n        <li><strong>Right to Rectification:</strong> Request correction of inaccurate or incomplete personal records.</li>\n        <li><strong>Right to Erasure ("Right to Be Forgotten"):</strong> Request deletion of your personal contact data.</li>\n        <li><strong>Right to Restrict Processing:</strong> Request restrictions on how your data is processed.</li>\n        <li><strong>Right to Non-Discrimination:</strong> We will never discriminate against you for exercising your privacy rights.</li>\n    </ul>\n    <p>\n        To exercise any of these rights, contact us at <a href="mailto:privacy@pokemoncalculator.site">privacy@pokemoncalculator.site</a>. We respond to all verified requests within 30 days.\n    </p>\n\n    <h2>6. Data Security &amp; Retention</h2>\n    <p>\n        We implement industry-standard SSL/TLS encryption across all connections (HTTPS), hardened server firewalls, and strict database access controls. Contact messages are retained for a maximum of 12 months for record-keeping before being permanently purged.\n    </p>\n</div>', 'Our commitment to protecting your privacy. Detailed disclosures on data collection, local storage, analytics, and your rights under GDPR and CCPA.', NULL, 'boxed', 1080, 1, 'Privacy Policy — Pokémon Calculator Hub', 'Privacy Policy for Pokemon Calculator Hub. Explaining data practices, local storage usage, and GDPR/CCPA consumer rights.', NULL, 0, '2026-09-20 14:00:00', '2026-09-20 14:00:00'),
(5, 'cookie-policy', 'Cookie Policy', '<div class="pkm-prose">\n    <div style="margin-bottom:28px; padding:20px; background:var(--pkm-bg-3); border-radius:var(--pkm-radius); border-left:4px solid var(--pkm-primary);">\n        <p style="margin:0; font-size:1rem; line-height:1.7; color:var(--pkm-text);">\n            This Cookie Policy explains how <strong>Pokémon Calculator Hub</strong> ("we", "us", or "our") uses cookies, local browser storage, and related technologies when you visit our website at <a href="https://pokemoncalculator.site">pokemoncalculator.site</a>.\n        </p>\n    </div>\n\n    <h2>1. What Are Cookies and Local Storage?</h2>\n    <p>\n        <strong>Cookies</strong> are small text files placed on your computer or mobile device by websites that you visit. They are widely used to make websites work efficiently, provide personalized experiences, and supply analytical insights to site operators.\n    </p>\n    <p>\n        <strong>HTML5 Local Storage</strong> is a secure browser technology that allows web applications to store key-value data directly in your browser. Unlike cookies, local storage data is never automatically transmitted to the server with every HTTP request, making it extremely fast and lightweight.\n    </p>\n\n    <h2>2. Overview of Cookies and Storage Keys We Use</h2>\n    <p>Below is a complete inventory of storage keys and cookies utilized on our site:</p>\n    <table>\n        <thead>\n            <tr>\n                <th>Key / Cookie Provider</th>\n                <th>Type</th>\n                <th>Purpose</th>\n                <th>Duration</th>\n            </tr>\n        </thead>\n        <tbody>\n            <tr>\n                <td><code>pkm_theme</code></td>\n                <td>LocalStorage</td>\n                <td>Stores your chosen color mode (Light vs. Dark theme) so it persists across page visits.</td>\n                <td>Persistent</td>\n            </tr>\n            <tr>\n                <td><code>PHPSESSID</code></td>\n                <td>First-party Cookie</td>\n                <td>Maintains temporary session state for security CSRF token verification and contact notifications.</td>\n                <td>Session (Browser close)</td>\n            </tr>\n            <tr>\n                <td><code>_ga</code>, <code>_gid</code></td>\n                <td>Google Analytics</td>\n                <td>Collects anonymous, aggregated statistics on page views, device types, and calculator traffic.</td>\n                <td>1 day to 2 years</td>\n            </tr>\n            <tr>\n                <td><code>__cf_bm</code></td>\n                <td>Cloudflare</td>\n                <td>Security Cookie used by Cloudflare CDN to distinguish humans from automated malicious bot traffic.</td>\n                <td>30 minutes</td>\n            </tr>\n        </tbody>\n    </table>\n\n    <h2>3. Categories of Cookies</h2>\n    <ul>\n        <li><strong>Strictly Necessary Cookies:</strong> Essential for you to browse the website and use its core features (such as secure session management and contact form validation).</li>\n        <li><strong>Preference &amp; Functionality Storage:</strong> Remembers choices you make (such as dark mode preferences) to provide a tailored, smooth user experience.</li>\n        <li><strong>Performance &amp; Analytics Cookies:</strong> Helps us understand how visitors interact with our calculators so we can optimize performance, reduce load times, and fix calculation edge cases.</li>\n    </ul>\n\n    <h2>4. Managing and Disabling Cookies</h2>\n    <p>\n        You can control or disable cookies through your browser settings. Most web browsers allow you to manage cookie preferences directly:\n    </p>\n    <ul>\n        <li><a href="https://support.google.com/chrome/answer/95647" target="_blank" rel="noopener">Google Chrome Cookie Settings</a></li>\n        <li><a href="https://support.mozilla.org/en-US/kb/enhanced-tracking-protection-firefox-desktop" target="_blank" rel="noopener">Mozilla Firefox Cookie Settings</a></li>\n        <li><a href="https://support.apple.com/guide/safari/manage-cookies-sfri11471/mac" target="_blank" rel="noopener">Apple Safari Cookie Settings</a></li>\n        <li><a href="https://support.microsoft.com/en-us/windows/manage-cookies-in-microsoft-edge" target="_blank" rel="noopener">Microsoft Edge Cookie Settings</a></li>\n    </ul>\n    <p>\n        Please note that disabling strictly necessary cookies may impact certain interactive features of our application.\n    </p>\n\n    <h2>5. Contact Us</h2>\n    <p>\n        If you have any questions about our use of cookies or local storage, please email our Data Privacy Officer at <a href="mailto:privacy@pokemoncalculator.site">privacy@pokemoncalculator.site</a>.\n    </p>\n</div>', 'Learn how Pokémon Calculator Hub uses cookies, session identifiers, and local storage to deliver fast, reliable, and personalized tool experiences.', NULL, 'boxed', 1080, 1, 'Cookie Policy — Pokémon Calculator Hub', 'Cookie Policy for Pokemon Calculator Hub detailing all first-party and third-party cookies, local storage keys, and opt-out controls.', NULL, 0, '2026-09-20 14:00:00', '2026-09-20 14:00:00'),
(6, 'terms-and-conditions', 'Terms and Conditions of Use', '<div class="pkm-prose">\n    <div style="margin-bottom:28px; padding:20px; background:var(--pkm-bg-3); border-radius:var(--pkm-radius); border-left:4px solid var(--pkm-primary);">\n        <p style="margin:0; font-size:1rem; line-height:1.7; color:var(--pkm-text);">\n            Welcome to <strong>Pokémon Calculator Hub</strong>. By accessing or using our website located at <a href="https://pokemoncalculator.site">pokemoncalculator.site</a> (along with all subdomains, tools, and calculators), you agree to be bound by these Terms and Conditions. If you do not agree with any part of these terms, please discontinue use of the site.\n        </p>\n    </div>\n\n    <h2>1. Intellectual Property &amp; Non-Affiliation Disclaimer</h2>\n    <div style="background:rgba(239, 68, 68, 0.08); border:1px solid rgba(239, 68, 68, 0.3); border-radius:var(--pkm-radius); padding:20px; margin:20px 0;">\n        <p style="font-weight:700; color:var(--pkm-text); margin:0 0 8px;">Trademark &amp; Copyright Notice:</p>\n        <p style="font-size:0.92rem; color:var(--pkm-text-muted); margin:0 0 10px; line-height:1.6;">\n            Pokémon and Pokémon character names, artwork, sprites, trademarks, and logos are registered trademarks of <strong>Nintendo, Creatures Inc., GAME FREAK inc., and The Pokémon Company</strong>. Pokémon GO is a registered trademark of <strong>Niantic, Inc.</strong>\n        </p>\n        <p style="font-size:0.92rem; color:var(--pkm-text-muted); margin:0; line-height:1.6;">\n            <strong>Pokémon Calculator Hub</strong> is an independent, unofficial, fan-created strategy resource operated under <strong>Fair Use</strong> provisions for educational, analytical, and entertainment purposes. We are <strong>not affiliated with, endorsed by, or sponsored by</strong> Nintendo, Game Freak, Creatures, The Pokémon Company, or Niantic, Inc.\n        </p>\n    </div>\n\n    <h2>2. Permitted Use &amp; Community Guidelines</h2>\n    <p>You are granted a revocable, non-exclusive license to use our calculators and content for personal, non-commercial gameplay strategy. You agree that you will not:</p>\n    <ul>\n        <li>Use automated scripts, bots, spiders, or scrapers to perform high-frequency scraping that degrades server performance or consumes excessive bandwidth.</li>\n        <li>Attempt to compromise the security, integrity, or availability of the website or connected databases.</li>\n        <li>Redistribute, sell, or license calculation output as a proprietary commercial service without express written permission.</li>\n    </ul>\n\n    <h2>3. Calculation Accuracy &amp; Gameplay Simulation</h2>\n    <p>\n        Our calculation engines are meticulously calibrated against verified Game Master parameters and mathematical formulas. However, in-game mechanics (such as latent network latency in Trainer Battles, undocumented server-side rounding, or mid-season balance updates by Niantic) may introduce minor variances. All calculation tools are provided on an <strong>"as-is" and "as-available"</strong> basis without warranties of any kind.\n    </p>\n\n    <h2>4. Limitation of Liability</h2>\n    <p>\n        In no event shall Pokémon Calculator Hub, its operators, or contributors be liable for any indirect, incidental, special, consequential, or punitive damages arising from your use of or inability to use our tools or content.\n    </p>\n\n    <h2>5. Modifications to Terms</h2>\n    <p>\n        We reserve the right to update or modify these Terms and Conditions at any time. Changes become effective immediately upon posting to this page. Your continued use of the website following any modifications constitutes acceptance of the updated terms.\n    </p>\n\n    <h2>6. Contact Information</h2>\n    <p>\n        If you have questions regarding these Terms and Conditions, contact us via email at <a href="mailto:admin@pokemoncalculator.site">admin@pokemoncalculator.site</a>.\n    </p>\n</div>', 'Terms of service, fair use policy, intellectual property rights, non-affiliation disclaimers, and community guidelines for using Pokémon Calculator Hub.', NULL, 'boxed', 1080, 1, 'Terms and Conditions of Use — Pokémon Calculator Hub', 'Terms and Conditions of Use for Pokemon Calculator Hub. Fair use provisions, intellectual property notices, and user guidelines.', NULL, 0, '2026-09-20 14:00:00', '2026-09-20 14:00:00');
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
INSERT INTO `posts` VALUES 
(1, 'pokemon-go-iv-chart-guide', 'Pokémon GO IV Calculator & Appraisal Guide (2026): How to Find 100% IVs and Rank 1 PvP Spreads', '<p>In Pokémon GO, Individual Values (IVs) are hidden stat bonuses ranging from 0 to 15 that permanently increase your Pokémon\'s Attack, Defense, and Stamina (HP). Understanding how IVs interact with base stats and Combat Power (CP) is the foundation of competitive team building.</p><h2>What Are IVs in Pokémon GO?</h2><p>Every Pokémon species has fixed base stats. For example, Mewtwo has a Base Attack of 300. An Attack IV of 15 increases Mewtwo\'s total attack stat to 315. In raids and gym battles, a 15/15/15 "Hundo" (100% IV) provides maximum DPS and survivability.</p><h2>Why Lower Attack is Better in Great & Ultra League</h2><p>In CP-capped leagues like Great League (1500 CP cap) and Ultra League (2500 CP cap), Attack is weighted heavily in the CP formula. A Pokémon with low Attack (e.g. 0/15/15) can be powered up to a much higher level, yielding higher overall bulk and higher total stat product.</p>', 'Master the Pokémon GO IV appraisal system, learn how to calculate exact stat percentages, and discover why 0/15/15 spreads dominate PvP Great and Ultra Leagues.', 4, 1, '', 'published', 'Pokémon GO IV Calculator & Appraisal Guide [2026]', 'Complete guide to Pokémon GO IVs, appraisal stars, and PvP stat product rankings.', '', 320, '2026-09-20 10:00:00', '2026-09-20 10:00:00', '2026-09-20 10:00:00'),
(2, 'pokemon-go-evolution-cp-guide', 'How Evolution CP Works in Pokémon GO: Multipliers, Formulas & League CP Caps', '<p>Evolving your Pokémon in Pokémon GO applies an exact multiplier to its base stats while preserving its level and IVs. Before spending rare candy, predicting the evolved CP ensures your Pokémon stays under league eligibility thresholds.</p><h2>Understanding Evolution Multipliers</h2><p>Because CP depends directly on Base Attack, Defense, and Stamina, evolving a Magikarp (Base Attack 29) into Gyarados (Base Attack 237) results in a massive CP increase (approx. 10x to 11x multiplier).</p><h2>Preventing League Over-Cap Errors</h2><p>Always check your Pokémon\'s expected evolved CP before evolving to prevent accidentally crossing 1500 CP or 2500 CP thresholds.</p>', 'Learn how Pokémon GO evolution CP multipliers work, how base stat changes impact CP, and how to avoid over-capping Pokémon for Great and Ultra Leagues.', 4, 1, '', 'published', 'Pokémon GO Evolution CP Multipliers & Formula Guide [2026]', 'Predict evolved CP accurately before spending candy in Pokémon GO.', '', 280, '2026-09-20 11:30:00', '2026-09-20 11:30:00', '2026-09-20 11:30:00'),
(3, 'pokemon-go-catch-rate-mechanics', 'Pokémon GO Catch Rate Mechanics: Base Catch Rates, Curveballs, and Golden Razz Math', '<p>Every wild Pokémon and Raid Boss encounter in Pokémon GO is governed by a mathematical capture probability formula combining Base Catch Rate (BCR), Combat Power Multiplier (CPM), ball types, berries, medal tiers, and throw accuracy.</p><h2>The Core Catch Rate Formula</h2><p>The probability of catching a Pokémon on a single throw is calculated as:<br><code>Catch Rate = 1 - (1 - BCR / (2 * CPM)) ^ Multiplier</code></p><h2>Top Catch Rate Multipliers</h2><ul><li><strong>Curveball:</strong> 1.7x flat multiplier on every throw.</li><li><strong>Golden Razz Berry:</strong> 2.5x multiplier (crucial for Legendary Raids).</li><li><strong>Platinum Type Medals:</strong> 1.4x multiplier.</li><li><strong>Excellent Throw:</strong> 1.85x multiplier.</li></ul>', 'Detailed breakdown of the Niantic catch formula: Base Catch Rates (BCR), CPM factors, curveball multipliers, and Golden Razz strategies for Raid Bosses.', 4, 1, '', 'published', 'Pokémon GO Catch Rate Formula & Raid Mechanics [2026]', 'Official Niantic catch formula explained: BCR, CPM, ball bonuses, and throw multipliers.', '', 410, '2026-09-20 12:00:00', '2026-09-20 12:00:00', '2026-09-20 12:00:00'),
(4, 'pokemon-damage-calculator-vgc-guide', 'Competitive Pokémon Damage Calculation Guide: How Damage, Weather, and STAB are Calculated', '<p>In competitive Pokémon (VGC and Smogon singles), damage calculation determines whether an attack secures a crucial One-Hit Knockout (OHKO) or Two-Hit Knockout (2HKO).</p><h2>The Official Damage Formula</h2><p>Damage is computed using the standard core series formula:<br><code>Damage = ((((2 * Level / 5 + 2) * Power * Attack / Defense) / 50) + 2) * Targets * Weather * Critical * Random * STAB * Type</code></p><h2>Key Multipliers</h2><p>Same Type Attack Bonus (STAB) increases power by 1.5x (or 2.0x with Adaptability or matching Terastallization). Weather effects like Sun and Rain boost matching elemental moves by 1.5x while reducing opposing types by 0.5x.</p>', 'A complete competitive trainer\'s guide to the Pokémon damage calculation formula, STAB modifiers, stat stages, damage rolls, and defensive EV optimization.', 4, 1, '', 'published', 'Competitive Pokémon Damage Calculation & Formula Guide [2026]', 'Learn how competitive damage rolls, EV spreads, weather, and STAB modifiers work in VGC.', '', 350, '2026-09-20 13:15:00', '2026-09-20 13:15:00', '2026-09-20 13:15:00'),
(5, 'stardust-power-up-efficiency-guide', 'Pokémon GO Stardust & Candy Efficiency: Powering Up to Level 40 vs Level 50', '<p>Powering up Pokémon from Level 1 to Level 50 requires massive investments of Stardust, Regular Candy, and XL Candy. Knowing when to stop powering up at Level 40 versus pushing to Level 50 is key to resource management.</p><h2>The Diminishing Returns Past Level 40</h2><p>From Level 1 to Level 40, each power-up increases CPM significantly. Past Level 40, stat gains per half-level are halved while Stardust and XL Candy costs scale exponentially. For raids, multiple Level 40 counters often outperform a single Level 50 Pokémon.</p><h2>Lucky & Shadow Discounts</h2><p>Lucky Pokémon receive a permanent 50% discount on all Stardust costs, making them the most cost-effective investments in the game.</p>', 'Learn the true Stardust and Candy XL costs of leveling Pokémon in Pokémon GO, including Lucky discounts, Purified bonuses, and Level 40 vs 50 benchmarks.', 4, 1, '', 'published', 'Pokémon GO Stardust & Power-Up Efficiency Guide [2026]', 'Optimal resource guide for Stardust, Candy XL, and Lucky Pokémon power-up costs.', '', 295, '2026-09-20 14:00:00', '2026-09-20 14:00:00', '2026-09-20 14:00:00'),
(6, 'pokemon-speed-tiers-vgc-guide', 'Pokémon VGC Speed Tiers Explained: Tailwind, Choice Scarf, and Trick Room Math', '<p>Speed is the single most decisive stat in competitive Pokémon battles. Moving first allows trainers to inflict status conditions, set screens, or eliminate opposing threats before taking damage.</p><h2>Speed Tiers Benchmarks</h2><p>Speed Tiers classify every competitive Pokémon based on its Maximum Speed at Level 50 with a Positive Nature (+Spe, 252 EVs), Neutral Nature (252 EVs), and Speed Modifiers.</p><h2>Speed Modifiers in VGC</h2><ul><li><strong>Tailwind:</strong> Doubles the Speed of all allied Pokémon for 4 turns (2.0x multiplier).</li><li><strong>Choice Scarf:</strong> Boosts Speed by 1.5x locked into one move.</li><li><strong>Paralysis:</strong> Reduces Speed by 50% (0.5x multiplier).</li><li><strong>Trick Room:</strong> Inverts turn order so the slowest Pokémon moves first.</li></ul>', 'Complete competitive VGC Speed Tiers guide: Speed calculations, Tailwind math, Choice Scarf benchmarks, and Trick Room speed creeping.', 4, 1, '', 'published', 'Pokémon VGC Speed Tiers & Turn Order Mechanics [2026]', 'Interactive Speed Tiers guide for competitive VGC, Tailwind, Choice Scarf, and Trick Room.', '', 380, '2026-09-20 15:00:00', '2026-09-20 15:00:00', '2026-09-20 15:00:00');
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
) ENGINE=InnoDB AUTO_INCREMENT=111 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` VALUES
(1,'site_name','Pokemon Calculator Hub','general','2026-09-20 13:48:24','2026-09-20 17:19:04'),
(2,'site_tagline','Ultimate Pokemon GO & Competitive Toolset','general','2026-09-20 13:48:24','2026-09-20 17:19:04'),
(3,'site_description','Free, accurate Pokemon calculators and competitive tools for trainers worldwide. Calculate CP, IVs, Stardust, Evolutions, Speed Tiers, and Damage.','general','2026-09-20 13:48:24','2026-09-20 13:48:24'),
(4,'site_url','https://pokemoncalculator.site','general','2026-09-20 13:48:24','2026-09-20 15:45:10'),
(5,'admin_email','admin@pokemoncalculator.site','general','2026-09-20 13:48:24','2026-09-20 17:19:04'),
(6,'default_theme','light','theme','2026-09-20 13:48:24','2026-09-20 13:48:24'),
(7,'primary_color','#0D9488','theme','2026-09-20 13:48:24','2026-09-20 13:48:24'),
(8,'secondary_color','#134E4A','theme','2026-09-20 13:48:24','2026-09-20 13:48:24'),
(9,'accent_color','#F4D03F','theme','2026-09-20 13:48:24','2026-09-20 13:48:24'),
(10,'light_bg','#F4F6F9','theme','2026-09-20 13:48:24','2026-09-20 13:48:24'),
(11,'dark_bg','#0D1117','theme','2026-09-20 13:48:24','2026-09-20 13:48:24'),
(12,'meta_title_suffix',' | Pokemon Calculator Hub','seo','2026-09-20 13:48:24','2026-09-20 13:48:24'),
(13,'default_og_image','/assets/img/og-default.png','seo','2026-09-20 13:48:24','2026-09-20 13:48:24'),
(14,'social_twitter','https://twitter.com','social','2026-09-20 13:48:24','2026-09-20 17:19:04'),
(15,'social_discord','https://discord.gg','social','2026-09-20 13:48:24','2026-09-20 17:19:04'),
(16,'social_github','https://github.com/laheef/pokemoncalculators','social','2026-09-20 13:48:24','2026-09-20 17:19:04'),
(19,'theme_default_mode','light','theme','2026-09-20 14:46:50','2026-09-20 17:19:04'),
(20,'theme_primary_color','#0D9488','theme','2026-09-20 14:46:50','2026-09-20 17:19:04'),
(21,'theme_light_bg','#F4F6F9','theme','2026-09-20 14:46:50','2026-09-20 17:19:04'),
(22,'theme_light_text','#1A1F2E','theme','2026-09-20 14:46:50','2026-09-20 17:19:04'),
(23,'theme_dark_bg','#0D1117','theme','2026-09-20 14:46:50','2026-09-20 17:19:04'),
(24,'theme_dark_text','#E6EDF3','theme','2026-09-20 14:46:50','2026-09-20 17:19:04'),
(25,'meta_title_default','Pokemon Calculator Hub Pro - Best GO & VGC Tools','seo','2026-09-20 14:46:50','2026-09-20 17:19:04'),
(28,'site_alternate_names','Pokémon Calculator Hub, PokemonCalculators, PKM Calc Hub','general','2026-09-20 15:23:01','2026-09-20 17:19:04'),
(29,'custom_header_code','<meta name=\"google-site-verification\" content=\"test-gsc-verification-code-xyz\" />','custom_code','2026-09-20 15:23:01','2026-09-20 17:19:04'),
(30,'custom_footer_code','<!-- Custom Footer Tracking Script -->','custom_code','2026-09-20 15:23:01','2026-09-20 17:19:04'),
(31,'adsense_client_id','','monetization','2026-09-20 15:23:01','2026-09-20 17:19:04'),
(32,'analytics_id','','monetization','2026-09-20 15:23:01','2026-09-20 17:19:04'),
(33,'ad_slot_top','','monetization','2026-09-20 15:23:01','2026-09-20 17:19:04'),
(34,'ad_slot_below_result','','monetization','2026-09-20 15:23:01','2026-09-20 17:19:04'),
(35,'ad_slot_mid_faq','','monetization','2026-09-20 15:23:01','2026-09-20 17:19:04'),
(45,'ad_slot_sky_left','','monetization','2026-09-20 15:32:02','2026-09-20 17:19:04'),
(46,'ad_slot_sky_right','','monetization','2026-09-20 15:32:02','2026-09-20 17:19:04'),
(47,'google_service_account_json','{\n    \"type\": \"service_account\",\n    \"project_id\": \"pokemon-calculators-prod\",\n    \"private_key_id\": \"key-1234567890\",\n    \"private_key\": \"-----BEGIN PRIVATE KEY-----\\nMIIEvQIBADANBgkqhkiG9w0BAQEFAASCBKcwggSjAgEAAoIBAQCdYP+Pmh\\/XtLDF\\ncIhUVOgccFRQY0Dgn61fZCB3om6y\\/T3hjm8\\/QWFkxKNt\\/uLWJGMEMgqou9DWlTag\\ncbrxDzQc84KR5npD\\/72koHAxFge+be1bBfVVL3FzItvoXfc6sTfc4H9KAn3RvFBw\\nxBPmtehP8B51mqcPvKIHZHHIbOlb\\/mIs3WK\\/\\/uc\\/28CX4ntaDrnImlj\\/7K+8071t\\noZhYUS\\/hZQ\\/swOaNslUH5aRFyW9++1bhOsL+F2CthJyuifFq7s9OEn5Fx8g0CY92\\nkbMJhssoblIlpMbAdg4pIhodv0q28a\\/pDHqlVWBbb7VHhQ5Y8Bykb0tIzeaeNRZG\\nOL3SbgKLAgMBAAECggEAGbScuYdqmRCF6RHq6p9dtDtywhicIbRjHJgdp3zMCQdN\\nIrjhmdrjfhKSQSanRWP3GlnUHOBkiZAgto8tAi\\/CCtKJaqxTHyU4BBpCiPn4tNV+\\nteXgvxO7O5ufgLJMbfVBUx4GHIAQrf\\/MwcZ9G6ttsRTe3MWwcOUWMA\\/rd9m2OhSu\\nu6OlYDXferceNaRBITrTTixlgNC6wHbTW0deLiTXOkjKUBaEf88KSb3pbS0ZEr7+\\nEdsoWGoEGEO8T9fs8ZgWiF+kA5D9DTHtNb4k5KtXw9+SyEp2Taq9VlGmuVTn+BIp\\nIzWeYS4sPsMstW16shMUj1aaVVs7eXkUS6N2ASPo7QKBgQDOCLx0fqeNl0OmMkuc\\n8lcxJFBJRvIRPW1RhUXy1bOzL87\\/r8BrcLZtMGsF5GyKq5wPRMkGWG+cS+0xJNV0\\n4JmdGLj3h8PfkxYOE7Zv4cTCup04JkAn04AJ890tJ64ZVfyJqSLTaSJZk\\/bqxi9h\\nvFo68ji74LqAoC6NCQhhRY+TXwKBgQDDi5atO7omt5YuA1WudKHXg5epdMqPWs7Z\\n9nl7T8Vhc4mvXF7lXExp6+vy28vIVZ\\/nJyKJd4a6Y9HUwDbIDVPRZpMwQpConYgn\\nB9OtjvI\\/W2HO\\/a1hZpex5AF4yywUDB2Mkud5j92FAUnn8T3BknBX8lmIMnTVN4Qu\\nFMQhRipsVQKBgCtzQjMbJsDAfr7E6pdNsD+n1dquQIyMNMq1XXwJv1zxnyji6qR9\\n36sFQ\\/y5IH7aFA5QRki1S8xdYsczamS8nQi5VwC0vAUhYsxTMe1EYpdifZeC0ZLU\\nkrMGn8VPEfM75AcwCS0mhdz4TGFUrFdjPnAh9v8ANLS9kzOhDQhegBnnAoGAfJwg\\nacZM6s1E649+c0ypsa+O3xKo3k+Mz4LsiTMdYeuBivk\\/E8QMgdcwpbOBGenOmzvq\\nG1XKyk4\\/8eaHQlaT2jYWh8Nzca\\/pio3HS6tzHgK6wnAPo6j\\/9AGLGpHGRgQudF1N\\nGr8d99sJYL\\/vjcImyzSJ72vP3euh1Mew8E9JS30CgYEAmBzLJYhUhy23eJll5dJO\\n7wKYHyNorJU\\/nNsTgmKxivRW7zaQiFvFPk342Boj+ZwKDN3Jucy7l45msRsRUHDx\\nhKlMxmoAI3yAYxerl48tTrn5sLHuFXw1+si2cXnjP+d0OlFnO\\/\\/oDZ107P7zyPDw\\nkbUuLA4rWf95aZFC10Oh2Rw=\\n-----END PRIVATE KEY-----\\n\",\n    \"client_email\": \"pkm-indexing-bot@pokemon-calculators-prod.iam.gserviceaccount.com\",\n    \"client_id\": \"10987654321\",\n    \"auth_uri\": \"https:\\/\\/accounts.google.com\\/o\\/oauth2\\/auth\",\n    \"token_uri\": \"https:\\/\\/oauth2.googleapis.com\\/token\",\n    \"auth_provider_x509_cert_url\": \"https:\\/\\/www.googleapis.com\\/oauth2\\/v1\\/certs\"\n}','google_api','2026-09-20 15:40:14','2026-09-20 15:40:14'),
(48,'enable_multilingual','0','general','2026-09-20 17:18:02','2026-09-20 17:19:04'),
(53,'footer_copyright','© 2026 Pokemon Calculator Hub. Pokemon and Pokemon character names are trademarks of Nintendo.','general','2026-09-20 17:19:01','2026-09-20 17:19:04'),
(62,'meta_description_default','Accurate Pokemon GO and VGC calculators for IVs, CP, evolution, stardust costs, damage calculation, speed tiers, and catch rate.','seo','2026-09-20 17:19:01','2026-09-20 17:19:04'),
(63,'og_image_default','','seo','2026-09-20 17:19:01','2026-09-20 17:19:04'),
(68,'social_youtube','https://youtube.com','social','2026-09-20 17:19:01','2026-09-20 17:19:04'),
(74,'ad_slot_mid_content','','monetization','2026-09-20 17:19:01','2026-09-20 17:19:04'),
(78,'ad_slot_sidebar','','monetization','2026-09-20 17:19:01','2026-09-20 17:19:04'),
(79,'ad_slot_bottom','','monetization','2026-09-20 17:19:01','2026-09-20 17:19:04');
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
(1,'pokemon-go-cp-calculator','Pokemon GO CP Calculator','CP Calculator','<svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><line x1=\"18\" y1=\"20\" x2=\"18\" y2=\"10\"/><line x1=\"12\" y1=\"20\" x2=\"12\" y2=\"4\"/><line x1=\"6\" y1=\"20\" x2=\"6\" y2=\"14\"/></svg>','Calculate Combat Power, max CP, HP, power-up costs, and IV combinations for any Pokémon in Pokémon GO.',1,'app/tools/cp-calculator.php',1,1,'Pokemon GO CP Calculator [2026] — Combat Power, IVs & Stats','Calculate CP, HP, and power-up costs for all Pokemon in Pokemon GO. Interactive sliders, IV matrix, and Great/Ultra League ratings.','2026-09-20 13:48:24','2026-09-20 13:48:24'),
(2,'pokemon-go-iv-calculator','Pokemon GO IV Calculator & Appraisal Matrix','IV Calculator','<svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><polyline points=\"23 6 13.5 15.5 8.5 10.5 1 18\"/><polyline points=\"17 6 23 6 23 12\"/></svg>','Accurately calculate Pokémon GO IVs (Individual Values), appraisal percentages, and PvP stat product rankings.',1,'app/tools/iv-calculator.php',2,1,'Pokemon GO IV Calculator [2026] — Appraisal & PvP Rank Checker','Find exact IV percentages, star ratings, and PvP stat product rankings for Pokemon GO. Fast, accurate, and updated with Gen 1–9 data.','2026-09-20 13:48:24','2026-09-20 13:48:24'),
(3,'pokemon-go-evolution-cp-calculator','Pokemon GO Evolution CP Calculator','Evolution CP Calculator','<svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><polygon points=\"13 2 3 14 12 14 11 22 21 10 12 10 13 2\"/></svg>','Predict CP ranges after evolution, candy requirements, evolution items, and Great/Ultra League eligibility.',1,'app/tools/evolution-cp.php',3,1,'Pokemon GO Evolution CP Calculator [2026] — CP Range & Candy Predictor','Predict the exact CP of your Pokemon after evolving. Check Great League & Ultra League CP caps, candy costs, and evolution item requirements.','2026-09-20 13:48:24','2026-09-20 13:48:24'),
(4,'stardust-calculator','Pokemon GO Stardust & Power-Up Calculator','Stardust Calculator','<svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><path d=\"m9.5 7.5-2 2a4.95 4.95 0 1 0 7 7l2-2a4.95 4.95 0 1 0-7-7Z\"/><path d=\"M14 6.5v10\"/><path d=\"M10 7.5v10\"/><path d=\"m16 7 1-5 1.37.68A3 3 0 0 0 19.7 3H21v1.3a3 3 0 0 0 .32 1.33L22 7l-5 1Z\"/><path d=\"m8 17-1 5-1.37-.68A3 3 0 0 0 4.3 21H3v-1.3a3 3 0 0 0-.32-1.33L2 17l5-1Z\"/></svg>','Calculate exact Stardust, Candy, and XL Candy needed to power up Pokémon from any level to level 50.',1,'app/tools/stardust-calculator.php',4,1,'Pokemon GO Stardust Calculator [2026] — Power-Up & Trade Cost Guide','Calculate total Stardust, Regular Candy, and XL Candy needed to level up any Pokemon in Pokemon GO up to level 50. Includes Shadow, Purified, and Lucky discounts.','2026-09-20 13:48:24','2026-09-20 13:48:24'),
(5,'pokemon-go-stat-calculator','Pokemon GO Stat Calculator','GO Stat Calculator','<svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><circle cx=\"12\" cy=\"12\" r=\"10\"/><circle cx=\"12\" cy=\"12\" r=\"6\"/><circle cx=\"12\" cy=\"12\" r=\"2\"/></svg>','Calculate effective Attack, Defense, Stamina, CP, and HP across all levels (1 to 50+) with exact CPM multipliers.',1,'app/tools/go-stat-calculator.php',5,1,'Pokemon GO Stat Calculator [2026] — Base & In-Game Stats','Compute effective Attack, Defense, Stamina, CP, and HP stats for Pokemon GO across levels 1–50 using exact CPM scaling formulas.','2026-09-20 13:48:24','2026-09-20 13:48:24'),
(6,'pokemon-go-catch-rate-calculator','Pokemon GO Catch Rate Calculator','Catch Rate Calculator','<svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><circle cx=\"12\" cy=\"12\" r=\"10\"/><circle cx=\"12\" cy=\"12\" r=\"3\"/><line x1=\"12\" y1=\"2\" x2=\"12\" y2=\"9\"/><line x1=\"12\" y1=\"15\" x2=\"12\" y2=\"22\"/></svg>','Calculate exact catch probability, required throws, and difficulty rating with Pokeball, Berry, Medal, and Weather modifiers.',1,'app/tools/catch-rate-calculator.php',6,1,'Pokemon GO Catch Rate Calculator [2026] — Catch Probability & Ball Guide','Calculate catch rate percentages for any Pokemon in Pokemon GO with Poke Ball types, Razz/Silver/Golden berries, type medals, and weather boost.','2026-09-20 13:48:24','2026-09-20 13:48:24'),
(7,'pokemon-damage-calculator','Pokemon Battle Damage Calculator','Damage Calculator','<svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><path d=\"m14.5 12.5-8 8a2.119 2.119 0 0 1-3-3l8-8\"/><path d=\"m16 16 6-6\"/><path d=\"m8 8 6-6\"/></svg>','Comprehensive competitive damage calculator with Gens 1–9, natures, EVs/IVs, items, weather, and KO rolls.',2,'app/tools/damage-calculator.php',7,1,'Pokemon Damage Calculator [2026] — Gen 1–9 Competitive Battle Damage','Calculate exact battle damage, OHKO chances, stat stages, abilities, items, and weather modifiers for competitive Pokemon battling.','2026-09-20 13:48:24','2026-09-20 13:48:24'),
(8,'speed-tiers','Pokemon Speed Tier Calculator & Benchmark','Speed Tiers','<svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><path d=\"M12 2v4M12 18v4M4.93 4.93l2.83 2.83M16.24 16.24l2.83 2.83M2 12h4M18 12h4M4.93 19.07l2.83-2.83M16.24 7.76l2.83-2.83\"/></svg>','Interactive speed tier matrix for VGC & Smogon formats with Choice Scarf, Booster Energy, and Tailwind modifiers.',3,'app/tools/speed-tiers.php',8,1,'Pokemon Speed Tiers [2026] — Competitive Speed Benchmark & VGC Matrix','Interactive Pokemon Speed Tiers list for Gen 9 VGC and Smogon tiers. Compare real speed values with Choice Scarf, Tailwind, and Booster Energy boosts.','2026-09-20 13:48:24','2026-09-20 13:48:24');
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

-- Dump completed on 2026-09-20 17:19:15
