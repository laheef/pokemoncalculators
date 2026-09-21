<?php
/**
 * Core Pages Seeder for Pokemon Calculator Hub Custom CMS
 * Seeds detailed, professionally written, SEO-optimized content for:
 * 1. About Us
 * 2. Contact Us
 * 3. Privacy Policy
 * 4. Cookie Policy
 * 5. Terms and Conditions
 */

require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/app/core/Database.php';

use App\Core\Database;

$pages = [
    // -------------------------------------------------------------
    // 1. ABOUT US
    // -------------------------------------------------------------
    [
        'slug'                => 'about-us',
        'title'               => 'About Us — Pokémon Calculator Hub',
        'excerpt'             => 'Discover our mission to empower Pokémon trainers worldwide with real-time, mathematically rigorous, and community-verified calculation tools for Pokémon GO and competitive VGC battles.',
        'page_width_template' => 'boxed',
        'custom_width'        => 1120,
        'category_id'         => null,
        'is_active'           => 1,
        'meta_title'          => 'About Us — Pokémon Calculator Hub & Strategy Suite',
        'meta_desc'           => 'Learn about Pokemon Calculator Hub: our mission, mathematical precision, Game Master parity, 1,025+ Pokemon database, and commitment to free, transparent trainer tools.',
        'content'             => <<<HTML
<div class="pkm-about-content">

    <div style="margin-bottom:36px; padding:24px; background:var(--pkm-bg-3); border-radius:var(--pkm-radius); border-left:4px solid var(--pkm-primary);">
        <p style="font-size:1.15rem; font-weight:600; color:var(--pkm-text); margin:0;">
            <strong>Pokémon Calculator Hub</strong> was built by dedicated competitive trainers, math enthusiasts, and software engineers to deliver instant, 100% accurate, and ad-uncluttered calculation tools for the global Pokémon community.
        </p>
    </div>

    <h2 style="font-size:1.6rem; color:var(--pkm-text); margin-top:32px; margin-bottom:16px; border-bottom:2px solid var(--pkm-border); padding-bottom:8px;">
        1. Our Mission: Precision Without Compromise
    </h2>
    <p>
        Whether preparing for a high-stakes Pokémon GO Championship Series tournament, optimizing stat products for Great and Ultra League battles, or calculating the exact stardust required to power a shadow Legendary Pokémon from Level 8 to Level 50, precision matters. A single miscalculated IV threshold or unoptimized stat spread can mean the difference between a decisive charge move tie-break (CMP tie) victory or defeat.
    </p>
    <p>
        Most existing calculator sites suffer from excessive popups, intrusive video overlays, outdated Game Master formulas, or paywalls. <strong>Pokémon Calculator Hub</strong> was architected from the ground up to solve these frustrations. We deliver lightweight, server-side and client-side calculators that execute instantly across both desktop and mobile devices without tracking bloat.
    </p>

    <h2 style="font-size:1.6rem; color:var(--pkm-text); margin-top:40px; margin-bottom:16px; border-bottom:2px solid var(--pkm-border); padding-bottom:8px;">
        2. Mathematical Fidelity & Game Master Parity
    </h2>
    <p>
        Our calculation engines mirror official in-game mechanics with rigorous mathematical parity:
    </p>
    <ul style="padding-left:24px; margin-bottom:20px; display:flex; flex-direction:column; gap:10px;">
        <li>
            <strong>Combat Power Multipliers (CPM):</strong> We maintain the complete, exact CPM curve from Level 1.0 to Level 51.5 (including half-level steps and the Level 51 Best Buddy boost) calibrated directly to Niantic's server-side constants.
        </li>
        <li>
            <strong>Exact CP & HP Formulas:</strong> CP is calculated via the official integer truncation formula:
            <br>
            <code style="background:var(--pkm-bg-3); padding:4px 8px; border-radius:4px; font-size:0.9rem; display:inline-block; margin:6px 0;">
                CP = max(10, floor((BaseAtk + AtkIV) × sqrt(BaseDef + DefIV) × sqrt(BaseSta + StaIV) × (CPM^2) / 10))
            </code>
        </li>
        <li>
            <strong>PvP Stat Product Optimization:</strong> Real-time rank computation evaluating all 4,096 possible IV combinations (0/0/0 through 15/15/15) against league CP caps (1500 CP for Great League, 2500 CP for Ultra League, and Little Cup 500 CP).
        </li>
        <li>
            <strong>Main Series Damage & Speed Tier Mechanics:</strong> Incorporates generation-specific modifiers, EV/IV allocations, Natures, stat stage stages (-6 to +6), Choice items, weather boosts, and critical hit thresholds.
        </li>
    </ul>

    <h2 style="font-size:1.6rem; color:var(--pkm-text); margin-top:40px; margin-bottom:16px; border-bottom:2px solid var(--pkm-border); padding-bottom:8px;">
        3. Comprehensive 1,025+ Pokémon Database
    </h2>
    <p>
        Our platform integrates a structured database indexing all <strong>1,025 Pokémon species</strong> spanning Generations 1 through 9 (from Bulbasaur to Pecharunt). For every entry, we maintain:
    </p>
    <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(220px, 1fr)); gap:16px; margin:20px 0;">
        <div style="background:var(--pkm-bg-3); padding:16px; border-radius:var(--pkm-radius); border:1px solid var(--pkm-border);">
            <strong style="color:var(--pkm-primary);">Base Stats & Scaling</strong>
            <p style="font-size:0.9rem; color:var(--pkm-text-muted); margin-top:6px;">Official Base Attack, Defense, and Stamina/HP attributes verified from core data files.</p>
        </div>
        <div style="background:var(--pkm-bg-3); padding:16px; border-radius:var(--pkm-radius); border:1px solid var(--pkm-border);">
            <strong style="color:var(--pkm-primary);">Regional & Special Forms</strong>
            <p style="font-size:0.9rem; color:var(--pkm-text-muted); margin-top:6px;">Full coverage of Alolan, Galarian, Hisuian, and Paldean forms plus Mega Evolutions and Primal Reversions.</p>
        </div>
        <div style="background:var(--pkm-bg-3); padding:16px; border-radius:var(--pkm-radius); border:1px solid var(--pkm-border);">
            <strong style="color:var(--pkm-primary);">Evolution Pathways</strong>
            <p style="font-size:0.9rem; color:var(--pkm-text-muted); margin-top:6px;">Exact evolution branches, candy requirements, special item triggers, and evolution CP projections.</p>
        </div>
        <div style="background:var(--pkm-bg-3); padding:16px; border-radius:var(--pkm-radius); border:1px solid var(--pkm-border);">
            <strong style="color:var(--pkm-primary);">Catch Rates & Modifiers</strong>
            <p style="font-size:0.9rem; color:var(--pkm-text-muted); margin-top:6px;">Base Capture Rates (BCR) and Base Flee Rates (BFR) for every wild encounter and raid boss.</p>
        </div>
    </div>

    <h2 style="font-size:1.6rem; color:var(--pkm-text); margin-top:40px; margin-bottom:16px; border-bottom:2px solid var(--pkm-border); padding-bottom:8px;">
        4. Our Core Suite of Calculators
    </h2>
    <p>
        Our custom platform currently powers 8 specialized calculation tools, designed for both casual collectors and master-tier competitive trainers:
    </p>
    <ol style="padding-left:24px; margin-bottom:24px; display:flex; flex-direction:column; gap:12px;">
        <li><strong>Pokémon GO CP Calculator:</strong> Calculate maximum Combat Power, custom level CP, and preview power-up progressions.</li>
        <li><strong>IV Calculator & PvP Ranks:</strong> Check appraisal percentages (0–100%) and determine PvP stat product league rankings.</li>
        <li><strong>Evolution CP Calculator:</strong> Predict the exact CP range of your Pokémon before spending valuable candy to evolve.</li>
        <li><strong>Stardust & Candy Calculator:</strong> Budget exact regular candy, Candy XL, and stardust costs for standard, lucky, shadow, and purified Pokémon.</li>
        <li><strong>GO Stat Calculator:</strong> Real-time calculation of effective Attack, Defense, and Stamina stats across any level.</li>
        <li><strong>Catch Rate Calculator:</strong> Comprehensive catch probability matrix accounting for Ball types, Berries, Curveballs, throw precision (Nice/Great/Excellent), and Type Medals.</li>
        <li><strong>Competitive Damage Calculator:</strong> In-depth damage calculation modeling moves, stat changes, items, and abilities for VGC and main-series battles.</li>
        <li><strong>Speed Tiers Analyzer:</strong> Compare and rank speed thresholds across competitive metagames to determine turn order.</li>
    </ol>

    <h2 style="font-size:1.6rem; color:var(--pkm-text); margin-top:40px; margin-bottom:16px; border-bottom:2px solid var(--pkm-border); padding-bottom:8px;">
        5. Transparency, Privacy & Open Community
    </h2>
    <p>
        We believe that competitive tools should respect user privacy. We do not require mandatory account registration to access any calculator, we store your visual preferences (such as Dark Mode) locally in your browser, and we maintain complete transparency in our calculation formulas.
    </p>
    <p>
        Have feedback, questions, or ideas for new tools? We welcome your input! Reach out anytime via our <a href="/contact" style="color:var(--pkm-primary); font-weight:700;">Contact Us page</a>.
    </p>

</div>
HTML
    ],

    // -------------------------------------------------------------
    // 2. CONTACT US
    // -------------------------------------------------------------
    [
        'slug'                => 'contact-us',
        'title'               => 'Contact Us — Feedback, Suggestions & Inquiries',
        'excerpt'             => 'Have a question, suggestion, formula discrepancy report, or partnership inquiry? Get in touch with the Pokémon Calculator Hub team.',
        'page_width_template' => 'boxed',
        'custom_width'        => 1120,
        'category_id'         => null,
        'is_active'           => 1,
        'meta_title'          => 'Contact Us — Pokémon Calculator Hub Support',
        'meta_desc'           => 'Contact the Pokemon Calculator Hub team. Submit feedback, report calculation bugs, request new tools, or submit general inquiries.',
        'content'             => <<<HTML
<div class="pkm-contact-wrapper">

    <div class="pkm-contact-grid">
        
        <!-- LEFT: Contact Form -->
        <div>
            <div style="margin-bottom:24px;">
                <h2 style="font-size:1.5rem; color:var(--pkm-text); margin-bottom:8px;">Send Us a Message</h2>
                <p style="color:var(--pkm-text-muted); font-size:0.95rem;">
                    Fill out the form below and our team will review your inquiry. We typically respond within 24 to 48 hours.
                </p>
            </div>

            <form method="POST" action="/contact/submit" style="display:flex; flex-direction:column; gap:18px;">
                
                <div>
                    <label style="display:block; font-weight:700; font-size:0.9rem; margin-bottom:6px; color:var(--pkm-text);" for="contact_name">Your Name / Trainer Handle *</label>
                    <input type="text" id="contact_name" name="name" required placeholder="e.g. Red / TrainerAsh" 
                           style="width:100%; padding:12px 14px; border:1px solid var(--pkm-border); border-radius:var(--pkm-radius); background:var(--pkm-bg-3); color:var(--pkm-text); font-size:0.95rem; box-sizing:border-box;">
                </div>

                <div>
                    <label style="display:block; font-weight:700; font-size:0.9rem; margin-bottom:6px; color:var(--pkm-text);" for="contact_email">Email Address *</label>
                    <input type="email" id="contact_email" name="email" required placeholder="name@example.com" 
                           style="width:100%; padding:12px 14px; border:1px solid var(--pkm-border); border-radius:var(--pkm-radius); background:var(--pkm-bg-3); color:var(--pkm-text); font-size:0.95rem; box-sizing:border-box;">
                </div>

                <div>
                    <label style="display:block; font-weight:700; font-size:0.9rem; margin-bottom:6px; color:var(--pkm-text);" for="contact_subject">Subject / Inquiry Type *</label>
                    <select id="contact_subject" name="subject" required 
                            style="width:100%; padding:12px 14px; border:1px solid var(--pkm-border); border-radius:var(--pkm-radius); background:var(--pkm-bg-3); color:var(--pkm-text); font-size:0.95rem; box-sizing:border-box;">
                        <option value="Formula / Calculation Bug Report">Bug Report (Formula or CP Discrepancy)</option>
                        <option value="New Calculator / Feature Suggestion">Feature Request (Suggest a New Tool)</option>
                        <option value="Pokemon Data Update Request">Data Update (New Pokémon / Move / Form)</option>
                        <option value="Partnership & Advertising">Partnership / Advertising / Collaboration</option>
                        <option value="General Feedback">General Feedback & Other Inquiries</option>
                    </select>
                </div>

                <div>
                    <label style="display:block; font-weight:700; font-size:0.9rem; margin-bottom:6px; color:var(--pkm-text);" for="contact_message">Message Details *</label>
                    <textarea id="contact_message" name="message" required rows="6" placeholder="Please provide clear details, including Pokémon name, levels, IVs, or specific browser/device if reporting a bug..." 
                              style="width:100%; padding:12px 14px; border:1px solid var(--pkm-border); border-radius:var(--pkm-radius); background:var(--pkm-bg-3); color:var(--pkm-text); font-size:0.95rem; font-family:inherit; resize:vertical; box-sizing:border-box;"></textarea>
                </div>

                <button type="submit" class="pkm-btn pkm-btn-primary" style="padding:14px 28px; font-size:1rem; justify-content:center; cursor:pointer; font-weight:700;">
                    Send Message &rarr;
                </button>
            </form>
        </div>

        <!-- RIGHT: Contact Info & Guidelines -->
        <div>
            <div style="background:var(--pkm-bg-3); padding:28px; border-radius:var(--pkm-radius-lg); border:1px solid var(--pkm-border); margin-bottom:24px;">
                <h3 style="font-size:1.2rem; color:var(--pkm-text); margin-bottom:14px;">Direct Contact Information</h3>
                <p style="font-size:0.9rem; color:var(--pkm-text-muted); line-height:1.6; margin-bottom:16px;">
                    Prefer email? You can contact our engineering and content team directly:
                </p>
                <div style="display:flex; flex-direction:column; gap:10px; font-size:0.9rem;">
                    <div>
                        <strong style="color:var(--pkm-text);">General & Support:</strong><br>
                        <a href="mailto:support@pokemoncalculator.online" style="color:var(--pkm-primary); text-decoration:none;">support@pokemoncalculator.online</a>
                    </div>
                    <div>
                        <strong style="color:var(--pkm-text);">Admin & Partnerships:</strong><br>
                        <a href="mailto:admin@pokemoncalculator.online" style="color:var(--pkm-primary); text-decoration:none;">admin@pokemoncalculator.online</a>
                    </div>
                    <div>
                        <strong style="color:var(--pkm-text);">Typical Response Time:</strong><br>
                        <span style="color:var(--pkm-text-muted);">24–48 hours (Monday–Friday)</span>
                    </div>
                </div>
            </div>

            <div style="background:var(--pkm-bg-3); padding:24px; border-radius:var(--pkm-radius-lg); border:1px solid var(--pkm-border);">
                <h4 style="font-size:1.05rem; color:var(--pkm-text); margin-bottom:10px;">Bug Report Tips</h4>
                <p style="font-size:0.85rem; color:var(--pkm-text-muted); line-height:1.6;">
                    When reporting calculation anomalies, including the exact <strong>Pokémon Species, Level, IVs (Attack/Defense/Stamina), and CP</strong> helps us diagnose and deploy fixes quickly.
                </p>
            </div>
        </div>

    </div>

    <!-- FAQ SECTION -->
    <div style="border-top:1px solid var(--pkm-border); padding-top:40px; margin-top:40px;">
        <h2 style="font-size:1.5rem; color:var(--pkm-text); text-align:center; margin-bottom:28px;">Frequently Asked Questions</h2>
        
        <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(300px, 1fr)); gap:20px;">
            <div style="background:var(--pkm-bg-3); padding:20px; border-radius:var(--pkm-radius); border:1px solid var(--pkm-border);">
                <h3 style="font-size:1rem; font-weight:700; color:var(--pkm-text); margin-bottom:8px;">How often is Pokémon data updated?</h3>
                <p style="font-size:0.88rem; color:var(--pkm-text-muted); line-height:1.6;">
                    Our database syncs with official Game Master updates and APK pushes within 24 hours of new Pokémon, movesets, or CP rebalances being pushed to the live servers.
                </p>
            </div>

            <div style="background:var(--pkm-bg-3); padding:20px; border-radius:var(--pkm-radius); border:1px solid var(--pkm-border);">
                <h3 style="font-size:1rem; font-weight:700; color:var(--pkm-text); margin-bottom:8px;">Are these calculators free to use?</h3>
                <p style="font-size:0.88rem; color:var(--pkm-text-muted); line-height:1.6;">
                    Yes, 100% free! Every tool on Pokémon Calculator Hub is publicly accessible with no subscriptions, premium tiers, or hidden paywalls.
                </p>
            </div>

            <div style="background:var(--pkm-bg-3); padding:20px; border-radius:var(--pkm-radius); border:1px solid var(--pkm-border);">
                <h3 style="font-size:1rem; font-weight:700; color:var(--pkm-text); margin-bottom:8px;">Can I request a custom calculator or guide?</h3>
                <p style="font-size:0.88rem; color:var(--pkm-text-muted); line-height:1.6;">
                    Absolutely! Select "Feature Request" in the form above and describe the tool or guide you would like to see. We regularly build features requested by our community.
                </p>
            </div>
        </div>
    </div>

</div>
HTML
    ],

    // -------------------------------------------------------------
    // 3. PRIVACY POLICY
    // -------------------------------------------------------------
    [
        'slug'                => 'privacy-policy',
        'title'               => 'Privacy Policy',
        'excerpt'             => 'Our commitment to protecting your privacy. Detailed disclosures on data collection, local storage, cookies, analytics, and your rights under GDPR and CCPA.',
        'page_width_template' => 'boxed',
        'custom_width'        => 1120,
        'category_id'         => null,
        'is_active'           => 1,
        'meta_title'          => 'Privacy Policy — Pokémon Calculator Hub',
        'meta_desc'           => 'Read the Privacy Policy for Pokemon Calculator Hub. Understand how we handle data, cookies, analytics, and user privacy in compliance with GDPR and CCPA.',
        'content'             => <<<HTML
<div class="pkm-legal-content">

    <p style="color:var(--pkm-text-muted); font-size:0.9rem; margin-bottom:24px;">
        <strong>Last Updated:</strong> September 20, 2026 &bull; <strong>Effective Date:</strong> September 20, 2026
    </p>

    <div style="background:var(--pkm-bg-3); padding:20px; border-radius:var(--pkm-radius); border-left:4px solid var(--pkm-primary); margin-bottom:32px;">
        <p style="margin:0; font-size:0.95rem; color:var(--pkm-text);">
            At <strong>Pokémon Calculator Hub</strong> (accessible from <a href="/" style="color:var(--pkm-primary); font-weight:600;">pokemoncalculator.online</a>), your privacy is one of our top priorities. This Privacy Policy outlines the types of information we collect, how it is used, and the steps we take to safeguard your personal data in accordance with the <strong>General Data Protection Regulation (GDPR)</strong>, the <strong>California Consumer Privacy Act (CCPA)</strong>, and applicable global privacy regulations.
        </p>
    </div>

    <h2 style="font-size:1.4rem; color:var(--pkm-text); margin-top:32px; margin-bottom:12px;">1. Data Controller Information</h2>
    <p>
        Pokémon Calculator Hub operates as the Data Controller responsible for the processing of any personal data collected through this website. If you have questions regarding this policy or wish to exercise your legal privacy rights, contact our Data Privacy Officer at <a href="mailto:privacy@pokemoncalculator.online" style="color:var(--pkm-primary);">privacy@pokemoncalculator.online</a>.
    </p>

    <h2 style="font-size:1.4rem; color:var(--pkm-text); margin-top:32px; margin-bottom:12px;">2. Information We Collect</h2>
    <p>We collect information in three main categories:</p>

    <h3 style="font-size:1.15rem; color:var(--pkm-text); margin-top:20px; margin-bottom:8px;">A. Information You Voluntarily Provide</h3>
    <ul style="padding-left:24px; margin-bottom:16px;">
        <li><strong>Contact Inquiries:</strong> When you submit a message through our Contact Us form, we collect your name, email address, chosen subject, and message content. This data is used solely to respond to your inquiry and is never sold or repurposed.</li>
    </ul>

    <h3 style="font-size:1.15rem; color:var(--pkm-text); margin-top:20px; margin-bottom:8px;">B. Automatically Collected Technical Data (Server Logs)</h3>
    <ul style="padding-left:24px; margin-bottom:16px;">
        <li>Like most web applications, our web servers automatically log standard technical data when you visit our pages, including: your Internet Protocol (IP) address (anonymized), browser type and version, referring/exit pages, operating system, date and time stamps, and requested resource paths.</li>
        <li>This data is used strictly for server diagnostics, detecting denial-of-service threats, and ensuring high-availability site performance.</li>
    </ul>

    <h3 style="font-size:1.15rem; color:var(--pkm-text); margin-top:20px; margin-bottom:8px;">C. Browser LocalStorage Data</h3>
    <ul style="padding-left:24px; margin-bottom:16px;">
        <li><strong>Theme Preferences:</strong> We use HTML5 LocalStorage to save your light or dark mode visual preference under the key <code>pkm_theme</code>. This data remains on your local device and is never transmitted to our servers.</li>
    </ul>

    <h2 style="font-size:1.4rem; color:var(--pkm-text); margin-top:32px; margin-bottom:12px;">3. Legal Basis for Data Processing (GDPR)</h2>
    <p>We process personal information under the following legal bases recognized by the GDPR:</p>
    <ul style="padding-left:24px; margin-bottom:20px;">
        <li><strong>Legitimate Interests:</strong> To deliver, optimize, and maintain our calculators, protect server infrastructure against abusive traffic, and analyze aggregated usage patterns.</li>
        <li><strong>Consent:</strong> Where you have explicitly provided consent, such as submitting a message via our contact form or accepting optional analytics cookies.</li>
    </ul>

    <h2 style="font-size:1.4rem; color:var(--pkm-text); margin-top:32px; margin-bottom:12px;">4. Third-Party Services & Cookies</h2>
    <p>We work with trusted third-party service providers to deliver and monetize our website:</p>
    <ul style="padding-left:24px; margin-bottom:20px; display:flex; flex-direction:column; gap:8px;">
        <li><strong>Google Analytics:</strong> We use Google Analytics to monitor aggregated, non-personally identifiable site traffic. IP addresses are anonymized before processing.</li>
        <li><strong>Google AdSense:</strong> We may display non-intrusive advertisements served by Google. Google uses cookies (such as DoubleClick) to serve ads based on prior visits to this or other websites. You may opt out of personalized advertising by visiting <a href="https://adssettings.google.com" target="_blank" rel="noopener" style="color:var(--pkm-primary);">Google Ads Settings</a>.</li>
        <li><strong>Cloudflare CDN:</strong> Cloudflare provides content delivery and DDoS mitigation, utilizing security cookies to manage network traffic securely.</li>
    </ul>
    <p>For detailed information on how cookies operate on our platform, please consult our dedicated <a href="/cookie-policy" style="color:var(--pkm-primary); font-weight:600;">Cookie Policy</a>.</p>

    <h2 style="font-size:1.4rem; color:var(--pkm-text); margin-top:32px; margin-bottom:12px;">5. Your Rights Under GDPR and CCPA</h2>
    <p>Depending on your location, you hold the following rights regarding your personal information:</p>
    <ul style="padding-left:24px; margin-bottom:20px; display:flex; flex-direction:column; gap:6px;">
        <li><strong>Right to Access:</strong> You may request a copy of any personal data we hold about you.</li>
        <li><strong>Right to Rectification:</strong> You may request correction of inaccurate or incomplete information.</li>
        <li><strong>Right to Erasure ("Right to be Forgotten"):</strong> You may request that we delete your contact submissions or associated records.</li>
        <li><strong>Right to Restrict or Object to Processing:</strong> You may object to the processing of your data under legitimate interest provisions.</li>
        <li><strong>Right to Non-Discrimination (CCPA):</strong> We will never discriminate against you (in pricing, access, or performance) for exercising any of your privacy rights.</li>
    </ul>
    <p>To exercise any of these rights, please contact us at <a href="mailto:privacy@pokemoncalculator.online" style="color:var(--pkm-primary);">privacy@pokemoncalculator.online</a>. Requests are answered within 30 days without charge.</p>

    <h2 style="font-size:1.4rem; color:var(--pkm-text); margin-top:32px; margin-bottom:12px;">6. Data Security & Storage Safeguards</h2>
    <p>
        We employ robust industry-standard technical measures to secure our systems, including 256-bit SSL/TLS encryption for all data in transit, prepared parameterized SQL queries to eliminate injection vulnerabilities, strict file execution controls, and regular vulnerability scanning.
    </p>

    <h2 style="font-size:1.4rem; color:var(--pkm-text); margin-top:32px; margin-bottom:12px;">7. Children's Privacy (COPPA Compliance)</h2>
    <p>
        Pokémon Calculator Hub is designed as a general-audience calculation utility and does not knowingly collect personally identifiable information from children under the age of 13. If a parent or guardian believes their child has submitted personal details through our contact form, please notify us immediately and we will promptly remove the records from our database.
    </p>

    <h2 style="font-size:1.4rem; color:var(--pkm-text); margin-top:32px; margin-bottom:12px;">8. Updates to this Policy</h2>
    <p>
        We reserve the right to update this Privacy Policy to reflect technical, legal, or operational modifications. Any changes will be published on this page with an updated "Effective Date".
    </p>

</div>
HTML
    ],

    // -------------------------------------------------------------
    // 4. COOKIE POLICY
    // -------------------------------------------------------------
    [
        'slug'                => 'cookie-policy',
        'title'               => 'Cookie Policy',
        'excerpt'             => 'Learn how Pokémon Calculator Hub uses cookies, session identifiers, and local storage to deliver fast, reliable, and personalized tool experiences.',
        'page_width_template' => 'boxed',
        'custom_width'        => 1120,
        'category_id'         => null,
        'is_active'           => 1,
        'meta_title'          => 'Cookie Policy — Pokémon Calculator Hub',
        'meta_desc'           => 'Understand how Pokemon Calculator Hub uses cookies, sessions, and browser localStorage for theme preferences and fast calculation performance.',
        'content'             => <<<HTML
<div class="pkm-legal-content">

    <p style="color:var(--pkm-text-muted); font-size:0.9rem; margin-bottom:24px;">
        <strong>Effective Date:</strong> September 20, 2026 &bull; <strong>Version:</strong> 2.0
    </p>

    <p>
        This Cookie Policy explains how <strong>Pokémon Calculator Hub</strong> ("we", "us", or "our") uses cookies, local browser storage, and related technologies when you visit our website at <a href="/" style="color:var(--pkm-primary); font-weight:600;">pokemoncalculator.online</a>.
    </p>

    <h2 style="font-size:1.4rem; color:var(--pkm-text); margin-top:32px; margin-bottom:12px;">1. What Are Cookies and Local Storage?</h2>
    <p>
        <strong>Cookies</strong> are small text files placed on your computer or mobile device by websites that you visit. They are widely used to make websites work efficiently, provide personalized experiences, and supply analytical insights to site operators.
    </p>
    <p>
        <strong>HTML5 Local Storage</strong> is a secure browser technology that allows web applications to store key-value data directly in your browser. Unlike cookies, local storage data is never automatically transmitted to the server with every HTTP request, making it extremely fast and lightweight.
    </p>

    <h2 style="font-size:1.4rem; color:var(--pkm-text); margin-top:32px; margin-bottom:16px;">2. Overview of Cookies and Storage Keys We Use</h2>
    
    <div style="overflow-x:auto; margin:20px 0;">
        <table style="width:100%; border-collapse:collapse; font-size:0.9rem; text-align:left;">
            <thead>
                <tr style="background:var(--pkm-bg-3); border-bottom:2px solid var(--pkm-border);">
                    <th style="padding:12px; color:var(--pkm-text);">Key / Cookie</th>
                    <th style="padding:12px; color:var(--pkm-text);">Provider</th>
                    <th style="padding:12px; color:var(--pkm-text);">Type</th>
                    <th style="padding:12px; color:var(--pkm-text);">Purpose</th>
                    <th style="padding:12px; color:var(--pkm-text);">Duration</th>
                </tr>
            </thead>
            <tbody>
                <tr style="border-bottom:1px solid var(--pkm-border);">
                    <td style="padding:12px;"><code>pkm_theme</code></td>
                    <td style="padding:12px;">First-party</td>
                    <td style="padding:12px;">LocalStorage</td>
                    <td style="padding:12px;">Stores your chosen color mode (Light vs. Dark theme) so it persists across page visits.</td>
                    <td style="padding:12px;">Persistent</td>
                </tr>
                <tr style="border-bottom:1px solid var(--pkm-border);">
                    <td style="padding:12px;"><code>PHPSESSID</code></td>
                    <td style="padding:12px;">First-party</td>
                    <td style="padding:12px;">Session Cookie</td>
                    <td style="padding:12px;">Maintains temporary session state for security CSRF token verification and contact notifications.</td>
                    <td style="padding:12px;">Session (Browser close)</td>
                </tr>
                <tr style="border-bottom:1px solid var(--pkm-border);">
                    <td style="padding:12px;"><code>_ga</code>, <code>_gid</code></td>
                    <td style="padding:12px;">Google Analytics</td>
                    <td style="padding:12px;">Analytics Cookie</td>
                    <td style="padding:12px;">Collects anonymous, aggregated statistics on page views, device types, and calculator traffic.</td>
                    <td style="padding:12px;">1 day to 2 years</td>
                </tr>
                <tr style="border-bottom:1px solid var(--pkm-border);">
                    <td style="padding:12px;"><code>__cf_bm</code></td>
                    <td style="padding:12px;">Cloudflare</td>
                    <td style="padding:12px;">Security Cookie</td>
                    <td style="padding:12px;">Used by Cloudflare CDN to distinguish humans from automated malicious bot traffic.</td>
                    <td style="padding:12px;">30 minutes</td>
                </tr>
            </tbody>
        </table>
    </div>

    <h2 style="font-size:1.4rem; color:var(--pkm-text); margin-top:32px; margin-bottom:12px;">3. Categories of Cookies</h2>

    <h3 style="font-size:1.15rem; color:var(--pkm-text); margin-top:20px; margin-bottom:8px;">A. Strictly Necessary & Security Cookies</h3>
    <p>
        These cookies are essential for our website to function securely. They enable core features such as cross-site request forgery (CSRF) protection on forms and secure routing. You cannot disable these cookies without disrupting fundamental site operations.
    </p>

    <h3 style="font-size:1.15rem; color:var(--pkm-text); margin-top:20px; margin-bottom:8px;">B. Preference & Functional Storage</h3>
    <p>
        We use local storage to remember your visual settings (e.g. Dark Theme) so that pages load comfortably without visual flashing. This information is stored exclusively on your local device.
    </p>

    <h3 style="font-size:1.15rem; color:var(--pkm-text); margin-top:20px; margin-bottom:8px;">C. Performance & Analytics Cookies</h3>
    <p>
        These cookies assist us in understanding how trainers interact with our calculation tools, which Pokémon species are most frequently analyzed, and whether any calculator experiences unexpected errors. All data is processed in an aggregated, anonymous format.
    </p>

    <h2 style="font-size:1.4rem; color:var(--pkm-text); margin-top:32px; margin-bottom:12px;">4. How to Manage and Disable Cookies</h2>
    <p>
        You have the right to decide whether to accept or decline cookies. You can adjust your browser settings to reject cookies or prompt you before accepting them. Here is how to access cookie settings in common browsers:
    </p>
    <ul style="padding-left:24px; margin-bottom:20px; display:flex; flex-direction:column; gap:6px;">
        <li><strong>Google Chrome:</strong> Settings &rarr; Privacy and Security &rarr; Third-party cookies.</li>
        <li><strong>Mozilla Firefox:</strong> Settings &rarr; Privacy & Security &rarr; Enhanced Tracking Protection.</li>
        <li><strong>Apple Safari:</strong> Preferences &rarr; Privacy &rarr; Manage Website Data.</li>
        <li><strong>Microsoft Edge:</strong> Settings &rarr; Cookies and site permissions.</li>
        <li><strong>Mobile Browsers (iOS / Android):</strong> Access browser App Settings &rarr; Clear History & Website Data.</li>
    </ul>

    <h2 style="font-size:1.4rem; color:var(--pkm-text); margin-top:32px; margin-bottom:12px;">5. Impact of Disabling Cookies</h2>
    <p>
        If you choose to block or disable cookies, all calculation formulas and tool functionality will continue to function fully. The only difference is that visual preferences (such as dark mode selection) and contact submission confirmations will not persist after closing your browser.
    </p>

    <h2 style="font-size:1.4rem; color:var(--pkm-text); margin-top:32px; margin-bottom:12px;">6. Inquiries Regarding Our Cookie Policy</h2>
    <p>
        If you have questions about our use of cookies or web technologies, please reach out via email at <a href="mailto:privacy@pokemoncalculator.online" style="color:var(--pkm-primary);">privacy@pokemoncalculator.online</a>.
    </p>

</div>
HTML
    ],

    // -------------------------------------------------------------
    // 5. TERMS AND CONDITIONS
    // -------------------------------------------------------------
    [
        'slug'                => 'terms-and-conditions',
        'title'               => 'Terms and Conditions of Use',
        'excerpt'             => 'Terms of service, fair use policy, intellectual property rights, non-affiliation disclaimers, and guidelines for using Pokémon Calculator Hub.',
        'page_width_template' => 'boxed',
        'custom_width'        => 1120,
        'category_id'         => null,
        'is_active'           => 1,
        'meta_title'          => 'Terms and Conditions — Pokémon Calculator Hub',
        'meta_desc'           => 'Read the Terms and Conditions of Pokemon Calculator Hub. Understand our fair use policy, intellectual property disclaimers, and terms of service.',
        'content'             => <<<HTML
<div class="pkm-legal-content">

    <p style="color:var(--pkm-text-muted); font-size:0.9rem; margin-bottom:24px;">
        <strong>Effective Date:</strong> September 20, 2026 &bull; <strong>Version:</strong> 2.0
    </p>

    <div style="background:var(--pkm-bg-3); padding:20px; border-radius:var(--pkm-radius); border-left:4px solid var(--pkm-primary); margin-bottom:32px;">
        <p style="margin:0; font-size:0.95rem; color:var(--pkm-text);">
            Welcome to <strong>Pokémon Calculator Hub</strong>. By accessing or using our website located at <a href="/" style="color:var(--pkm-primary); font-weight:600;">pokemoncalculator.online</a> (along with all subdomains, tools, and calculators), you agree to be bound by these Terms and Conditions. If you do not agree with any part of these terms, please discontinue use of the site.
        </p>
    </div>

    <h2 style="font-size:1.4rem; color:var(--pkm-text); margin-top:32px; margin-bottom:12px;">1. Intellectual Property & Non-Affiliation Disclaimer</h2>
    <div style="background:rgba(239, 68, 68, 0.08); border:1px solid rgba(239, 68, 68, 0.25); padding:20px; border-radius:var(--pkm-radius); margin-bottom:20px;">
        <p style="font-size:0.92rem; color:var(--pkm-text); line-height:1.6; margin:0;">
            <strong>Trademark & Copyright Notice:</strong><br>
            Pokémon and Pokémon character names, artwork, sprites, trademarks, and logos are registered trademarks of <strong>Nintendo, Creatures Inc., GAME FREAK inc., and The Pokémon Company</strong>. Pokémon GO is a registered trademark of <strong>Niantic, Inc.</strong>
            <br><br>
            <strong>Pokémon Calculator Hub</strong> is an independent, unofficial, fan-created strategy resource operated under <strong>Fair Use provisions</strong> for educational, analytical, and entertainment purposes. We are <strong>not affiliated with, endorsed by, or sponsored by</strong> Nintendo, Game Freak, Creatures, The Pokémon Company, or Niantic, Inc.
        </p>
    </div>

    <h2 style="font-size:1.4rem; color:var(--pkm-text); margin-top:32px; margin-bottom:12px;">2. Permitted Use & Community Guidelines</h2>
    <p>You are granted a revocable, non-exclusive license to use our calculators and content for personal, non-commercial gameplay strategy. You agree that you will not:</p>
    <ul style="padding-left:24px; margin-bottom:20px; display:flex; flex-direction:column; gap:8px;">
        <li>Use automated scripts, bots, spiders, or scrapers to perform high-frequency scraping that degrades server performance or consumes excessive bandwidth.</li>
        <li>Attempt to compromise the security, integrity, or availability of the website or connected databases.</li>
        <li>Redistribute, sell, or license calculation output as a proprietary commercial service without express written permission.</li>
        <li>Transmit any malicious code, viruses, Trojan horses, or harmful automated scripts.</li>
    </ul>

    <h2 style="font-size:1.4rem; color:var(--pkm-text); margin-top:32px; margin-bottom:12px;">3. Calculation Accuracy & Disclaimer of Warranties</h2>
    <p>
        While we make every effort to ensure that all formulas, Combat Power Multipliers (CPM), base stats, catch probabilities, and damage matrices accurately mirror official game data, all tools and content on Pokémon Calculator Hub are provided on an <strong>"as is" and "as available"</strong> basis without warranties of any kind, whether express or implied.
    </p>
    <p>
        Niantic and The Pokémon Company periodically update server-side constants, movesets, and mechanics. We do not guarantee that calculations will be error-free or uninterrupted, and we disclaim liability for in-game decisions, including stardust investments, candy expenditures, or battle outcomes.
    </p>

    <h2 style="font-size:1.4rem; color:var(--pkm-text); margin-top:32px; margin-bottom:12px;">4. Limitation of Liability</h2>
    <p>
        To the fullest extent permitted by applicable law, in no event shall Pokémon Calculator Hub, its developers, contributors, or affiliates be liable for any direct, indirect, incidental, consequential, or punitive damages arising from your access to, use of, or inability to use the site or its calculators.
    </p>

    <h2 style="font-size:1.4rem; color:var(--pkm-text); margin-top:32px; margin-bottom:12px;">5. External Links & Third-Party Content</h2>
    <p>
        Our website may contain links to external third-party websites or resources. We do not endorse and are not responsible for the availability, content, accuracy, or privacy practices of external websites.
    </p>

    <h2 style="font-size:1.4rem; color:var(--pkm-text); margin-top:32px; margin-bottom:12px;">6. Modifications to Terms</h2>
    <p>
        We reserve the right to revise or modify these Terms and Conditions at any time. Continued use of Pokémon Calculator Hub following the publication of updated terms constitutes your acceptance of such modifications.
    </p>

    <h2 style="font-size:1.4rem; color:var(--pkm-text); margin-top:32px; margin-bottom:12px;">7. Contact Information</h2>
    <p>
        If you have any questions or concerns regarding these Terms and Conditions, please reach out to us at <a href="mailto:admin@pokemoncalculator.online" style="color:var(--pkm-primary);">admin@pokemoncalculator.online</a> or submit an inquiry through our <a href="/contact" style="color:var(--pkm-primary); font-weight:600;">Contact Us</a> page.
    </p>

</div>
HTML
    ]
];

// Insert or update pages in database
foreach ($pages as $p) {
    $exists = Database::fetchOne("SELECT id FROM pages WHERE slug = ?", [$p['slug']]);
    if ($exists) {
        Database::execute("
            UPDATE pages 
            SET title = ?, excerpt = ?, content = ?, page_width_template = ?, custom_width = ?, is_active = ?, meta_title = ?, meta_desc = ?, updated_at = NOW()
            WHERE slug = ?
        ", [
            $p['title'],
            $p['excerpt'],
            $p['content'],
            $p['page_width_template'],
            $p['custom_width'],
            $p['is_active'],
            $p['meta_title'],
            $p['meta_desc'],
            $p['slug']
        ]);
        echo "Updated page: {$p['slug']}\n";
    } else {
        Database::execute("
            INSERT INTO pages (slug, title, excerpt, content, page_width_template, custom_width, is_active, meta_title, meta_desc, menu_order, created_at, updated_at)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, 0, NOW(), NOW())
        ", [
            $p['slug'],
            $p['title'],
            $p['excerpt'],
            $p['content'],
            $p['page_width_template'],
            $p['custom_width'],
            $p['is_active'],
            $p['meta_title'],
            $p['meta_desc']
        ]);
        echo "Created page: {$p['slug']}\n";
    }
}

echo "All 5 Core Pages seeded successfully!\n";
