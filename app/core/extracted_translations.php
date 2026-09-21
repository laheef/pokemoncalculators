<?php
function pkm_get_translations($lang = 'en') {
    $translations = array(
        // ========================================
        // ENGLISH (Default)
        // ========================================
        'en' => array(
            // Site Info
            'site_name' => 'Pokemon Calculator',
            'site_tagline' => 'Free Pokemon Calculators for Every Trainer',
            
            // Navigation
            'nav_home' => 'Home',
            'nav_pokemon_go' => 'Pokemon GO',
            'nav_main_series' => 'Main Series',
            'nav_competitive' => 'Competitive',
            'nav_blog' => 'Blog',
            'nav_about' => 'About',
            'nav_contact' => 'Contact',
            'nav_all_tools' => 'All Tools',
            'nav_aria_label' => 'Main Navigation',
            
            // Pokemon GO Dropdown
            'nav_cp_calculator' => 'CP Calculator',
            'nav_iv_calculator' => 'IV Calculator',
            'nav_catch_rate' => 'Catch Rate Calculator',
            'nav_raid_guide' => 'Raid Guide',
            
            // Main Series Dropdown
            'nav_type_chart' => 'Type Chart',
            'nav_evolution_calc' => 'Evolution Calculator',
            'nav_natures_guide' => 'Natures Guide',
            'nav_damage_calc' => 'Damage Calculator',
            
            // Competitive Dropdown
            'nav_team_builder' => 'Team Builder',
            'nav_speed_tiers' => 'Speed Tiers',
            'nav_coverage_calc' => 'Coverage Calculator',
            
            // Hero Section
            'hero_title' => 'Master Every Pokemon Battle',
            'hero_subtitle' => 'Free, accurate Pokemon calculators for trainers worldwide. Calculate CP, IVs, type matchups, and more.',
            'hero_cta_primary' => 'Explore Calculators',
            'hero_cta_secondary' => 'Most Popular Tool',
            'hero_stats_tools' => 'Calculator Tools',
            'hero_stats_languages' => 'Languages',
            'hero_stats_trainers' => 'Trainers Helped',
            
            // Calculator Categories
            'cat_pokemon_go_title' => 'Pokemon GO',
            'cat_pokemon_go_desc' => 'Maximize your mobile trainer potential',
            'cat_main_series_title' => 'Main Series Games',
            'cat_main_series_desc' => 'Tools for every generation',
            'cat_competitive_title' => 'Competitive',
            'cat_competitive_desc' => 'Dominate VGC and Smogon battles',
            
            // Popular Calculators Section
            'popular_title' => 'Most Popular Calculators',
            'popular_subtitle' => 'Trusted by millions of trainers worldwide',
            'popular_cp_desc' => 'Calculate Combat Power after evolution',
            'popular_iv_desc' => 'Find perfect IVs for any Pokemon',
            'popular_type_desc' => 'Master type matchups instantly',
            'popular_evolution_desc' => 'Plan evolutions with candy costs',
            'popular_damage_desc' => 'Calculate battle damage accurately',
            'popular_catch_desc' => 'Improve your catch success rate',
            
            // How It Works
            'how_title' => 'How It Works',
            'how_step1_title' => 'Choose Your Tool',
            'how_step1_desc' => 'Select from our collection of specialized calculators',
            'how_step2_title' => 'Enter Data',
            'how_step2_desc' => 'Input your Pokemon stats and battle conditions',
            'how_step3_title' => 'Get Results',
            'how_step3_desc' => 'Receive accurate calculations instantly',
            
            // Trust Section
            'trust_title' => 'Why Trainers Trust Us',
            'trust_accuracy_title' => '100% Accurate',
            'trust_accuracy_desc' => 'Formulas verified against official game data',
            'trust_free_title' => 'Always Free',
            'trust_free_desc' => 'No paywalls, no subscriptions, no limits',
            'trust_fast_title' => 'Lightning Fast',
            'trust_fast_desc' => 'Results in milliseconds, not seconds',
            'trust_updated_title' => 'Always Updated',
            'trust_updated_desc' => 'New Pokemon and features added immediately',
            
            // Blog Section
            'blog_title' => 'Latest Tips & Guides',
            'blog_subtitle' => 'Level up your trainer knowledge',
            'blog_read_more' => 'Read More',
            'blog_view_all' => 'View All Articles',
            
            // FAQ Section
            'faq_title' => 'Frequently Asked Questions',
            'faq_q1' => 'Are these calculators accurate?',
            'faq_a1' => 'Yes! All our calculators use official game formulas and are regularly tested against in-game results. We update immediately when game mechanics change.',
            'faq_q2' => 'Do I need to create an account?',
            'faq_a2' => 'Never. All calculators work instantly without registration, email, or any personal information.',
            'faq_q3' => 'Which games are supported?',
            'faq_a3' => 'We support Pokemon GO, all main series games from Gen 1-9, and competitive formats including VGC and Smogon.',
            'faq_q4' => 'How often is the data updated?',
            'faq_a4' => 'We update our database within hours of new Pokemon releases, game patches, or mechanic changes.',
            'faq_q5' => 'Can I use these for competitive battles?',
            'faq_a5' => 'Absolutely! Our competitive calculators are trusted by VGC players and Smogon community members worldwide.',
            
            // CTA Section
            'cta_title' => 'Ready to Become a Pokemon Master?',
            'cta_subtitle' => 'Join millions of trainers using our free calculators',
            'cta_button' => 'Start Calculating Now',
            
            // Footer
            'footer_description' => 'The ultimate free resource for Pokemon trainers. Calculate CP, IVs, type matchups, and more with our accurate, up-to-date tools.',
            'footer_popular' => 'Popular Tools',
            'footer_categories' => 'Categories',
            'footer_resources' => 'Resources',
            'footer_social' => 'Follow Us',
            'footer_copyright' => '© %year% Pokemon Calculator. All rights reserved.',
            'footer_made_with' => 'Made with ❤️ for Pokemon trainers worldwide',
            'footer_back_to_top' => 'Back to Top',
            'footer_privacy' => 'Privacy Policy',
            'footer_terms' => 'Terms of Service',
            'footer_contact' => 'Contact Us',
            
            // Theme Toggle
            'theme_toggle_dark' => 'Switch to dark mode',
            'theme_toggle_light' => 'Switch to light mode',
            
            // Language Switcher
            'lang_switcher_label' => 'Select Language',
            'lang_current' => 'English',
            
            // Search
            'search_placeholder' => 'Search calculators...',
            'search_button' => 'Search',
            
            // Calculator Labels
            'calc_calculate' => 'Calculate',
            'calc_reset' => 'Reset',
            'calc_result' => 'Result',
            'calc_level' => 'Level',
            'calc_cp' => 'CP',
            'calc_hp' => 'HP',
            'calc_attack' => 'Attack',
            'calc_defense' => 'Defense',
            'calc_stamina' => 'Stamina',
            'calc_iv_percent' => 'IV %',
            'calc_perfect' => 'Perfect!',
            'calc_type' => 'Type',
            'calc_super_effective' => 'Super Effective',
            'calc_not_very_effective' => 'Not Very Effective',
            'calc_immune' => 'No Effect',
            
            // Meta
            'meta_description_home' => 'Free Pokemon calculators for GO, main series games, and competitive battles. Calculate CP, IVs, type matchups, damage, and more. Available in 5 languages.',
            'meta_keywords' => 'pokemon calculator, pokemon go calculator, iv calculator, cp calculator, type chart, damage calculator',
        ),
        
        // ========================================
        // SPANISH
        // ========================================
        'es' => array(
            'site_name' => 'Pokemon Calculator',
            'site_tagline' => 'Calculadoras Pokemon Gratis para Cada Entrenador',
            
            'nav_home' => 'Inicio',
            'nav_pokemon_go' => 'Pokemon GO',
            'nav_main_series' => 'Juegos Principales',
            'nav_competitive' => 'Competitivo',
            'nav_blog' => 'Blog',
            'nav_about' => 'Nosotros',
            'nav_contact' => 'Contacto',
            'nav_all_tools' => 'Todas las Herramientas',
            'nav_aria_label' => 'Navegación Principal',
            
            'nav_cp_calculator' => 'Calculadora de PC',
            'nav_iv_calculator' => 'Calculadora de IV',
            'nav_catch_rate' => 'Calculadora de Captura',
            'nav_raid_guide' => 'Guía de Incursiones',
            
            'nav_type_chart' => 'Tabla de Tipos',
            'nav_evolution_calc' => 'Calculadora de Evolución',
            'nav_natures_guide' => 'Guía de Naturalezas',
            'nav_damage_calc' => 'Calculadora de Daño',
            
            'nav_team_builder' => 'Creador de Equipos',
            'nav_speed_tiers' => 'Niveles de Velocidad',
            'nav_coverage_calc' => 'Calculadora de Cobertura',
            
            'hero_title' => 'Domina Cada Batalla Pokemon',
            'hero_subtitle' => 'Calculadoras Pokemon gratuitas y precisas para entrenadores de todo el mundo. Calcula PC, IVs, matchups de tipos y más.',
            'hero_cta_primary' => 'Explorar Calculadoras',
            'hero_cta_secondary' => 'Herramienta Más Popular',
            'hero_stats_tools' => 'Herramientas',
            'hero_stats_languages' => 'Idiomas',
            'hero_stats_trainers' => 'Entrenadores',
            
            'cat_pokemon_go_title' => 'Pokemon GO',
            'cat_pokemon_go_desc' => 'Maximiza tu potencial como entrenador móvil',
            'cat_main_series_title' => 'Juegos Principales',
            'cat_main_series_desc' => 'Herramientas para cada generación',
            'cat_competitive_title' => 'Competitivo',
            'cat_competitive_desc' => 'Domina batallas VGC y Smogon',
            
            'popular_title' => 'Calculadoras Más Populares',
            'popular_subtitle' => 'Confiadas por millones de entrenadores',
            'popular_cp_desc' => 'Calcula el Poder de Combate después de la evolución',
            'popular_iv_desc' => 'Encuentra IVs perfectos para cualquier Pokemon',
            'popular_type_desc' => 'Domina los matchups de tipos al instante',
            'popular_evolution_desc' => 'Planifica evoluciones con costos de caramelos',
            'popular_damage_desc' => 'Calcula daño de batalla con precisión',
            'popular_catch_desc' => 'Mejora tu tasa de captura',
            
            'how_title' => 'Cómo Funciona',
            'how_step1_title' => 'Elige tu Herramienta',
            'how_step1_desc' => 'Selecciona de nuestra colección de calculadoras especializadas',
            'how_step2_title' => 'Ingresa Datos',
            'how_step2_desc' => 'Introduce las stats de tu Pokemon y condiciones de batalla',
            'how_step3_title' => 'Obtén Resultados',
            'how_step3_desc' => 'Recibe cálculos precisos al instante',
            
            'trust_title' => 'Por Qué los Entrenadores Confían',
            'trust_accuracy_title' => '100% Preciso',
            'trust_accuracy_desc' => 'Fórmulas verificadas contra datos oficiales del juego',
            'trust_free_title' => 'Siempre Gratis',
            'trust_free_desc' => 'Sin paywalls, sin suscripciones, sin límites',
            'trust_fast_title' => 'Ultra Rápido',
            'trust_fast_desc' => 'Resultados en milisegundos, no segundos',
            'trust_updated_title' => 'Siempre Actualizado',
            'trust_updated_desc' => 'Nuevos Pokemon y características agregadas inmediatamente',
            
            'blog_title' => 'Últimos Consejos y Guías',
            'blog_subtitle' => 'Mejora tu conocimiento de entrenador',
            'blog_read_more' => 'Leer Más',
            'blog_view_all' => 'Ver Todos los Artículos',
            
            'faq_title' => 'Preguntas Frecuentes',
            'faq_q1' => '¿Estas calculadoras son precisas?',
            'faq_a1' => '¡Sí! Todas nuestras calculadoras usan fórmulas oficiales del juego y se prueban regularmente contra resultados en el juego. Actualizamos inmediatamente cuando cambian las mecánicas.',
            'faq_q2' => '¿Necesito crear una cuenta?',
            'faq_a2' => 'Nunca. Todas las calculadoras funcionan instantáneamente sin registro, correo o información personal.',
            'faq_q3' => '¿Qué juegos son compatibles?',
            'faq_a3' => 'Soportamos Pokemon GO, todos los juegos principales de Gen 1-9, y formatos competitivos incluyendo VGC y Smogon.',
            'faq_q4' => '¿Con qué frecuencia se actualizan los datos?',
            'faq_a4' => 'Actualizamos nuestra base de datos dentro de horas de nuevos lanzamientos de Pokemon, parches o cambios de mecánicas.',
            'faq_q5' => '¿Puedo usar estas para batallas competitivas?',
            'faq_a5' => '¡Absolutamente! Nuestras calculadoras competitivas son confiadas por jugadores VGC y miembros de la comunidad Smogan en todo el mundo.',
            
            'cta_title' => '¿Listo para Convertirte en Maestro Pokemon?',
            'cta_subtitle' => 'Únete a millones de entrenadores usando nuestras calculadoras gratuitas',
            'cta_button' => 'Comenzar Ahora',
            
            'footer_description' => 'El recurso gratuito definitivo para entrenadores Pokemon. Calcula PC, IVs, matchups de tipos y más con nuestras herramientas precisas y actualizadas.',
            'footer_popular' => 'Herramientas Populares',
            'footer_categories' => 'Categorías',
            'footer_resources' => 'Recursos',
            'footer_social' => 'Síguenos',
            'footer_copyright' => '© %year% Pokemon Calculator. Todos los derechos reservados.',
            'footer_made_with' => 'Hecho con ❤️ para entrenadores Pokemon de todo el mundo',
            'footer_back_to_top' => 'Volver Arriba',
            'footer_privacy' => 'Política de Privacidad',
            'footer_terms' => 'Términos de Servicio',
            'footer_contact' => 'Contáctanos',
            
            'theme_toggle_dark' => 'Cambiar a modo oscuro',
            'theme_toggle_light' => 'Cambiar a modo claro',
            
            'lang_switcher_label' => 'Seleccionar Idioma',
            'lang_current' => 'Español',
            
            'search_placeholder' => 'Buscar calculadoras...',
            'search_button' => 'Buscar',
            
            'calc_calculate' => 'Calcular',
            'calc_reset' => 'Reiniciar',
            'calc_result' => 'Resultado',
            'calc_level' => 'Nivel',
            'calc_cp' => 'PC',
            'calc_hp' => 'PS',
            'calc_attack' => 'Ataque',
            'calc_defense' => 'Defensa',
            'calc_stamina' => 'Vigor',
            'calc_iv_percent' => '% IV',
            'calc_perfect' => '¡Perfecto!',
            'calc_type' => 'Tipo',
            'calc_super_effective' => 'Súper Efectivo',
            'calc_not_very_effective' => 'Poco Efectivo',
            'calc_immune' => 'Sin Efecto',
            
            'meta_description_home' => 'Calculadoras Pokemon gratuitas para GO, juegos principales y batallas competitivas. Calcula PC, IVs, matchups de tipos, daño y más. Disponible en 5 idiomas.',
            'meta_keywords' => 'calculadora pokemon, calculadora pokemon go, calculadora iv, calculadora pc, tabla de tipos, calculadora de daño',
        ),
        
        // ========================================
        // PORTUGUESE (BRAZIL)
        // ========================================
        'pt-br' => array(
            'site_name' => 'Pokemon Calculator',
            'site_tagline' => 'Calculadoras Pokemon Grátis para Cada Treinador',
            
            'nav_home' => 'Início',
            'nav_pokemon_go' => 'Pokemon GO',
            'nav_main_series' => 'Jogos Principais',
            'nav_competitive' => 'Competitivo',
            'nav_blog' => 'Blog',
            'nav_about' => 'Sobre',
            'nav_contact' => 'Contato',
            'nav_all_tools' => 'Todas as Ferramentas',
            'nav_aria_label' => 'Navegação Principal',
            
            'nav_cp_calculator' => 'Calculadora de PC',
            'nav_iv_calculator' => 'Calculadora de IV',
            'nav_catch_rate' => 'Calculadora de Captura',
            'nav_raid_guide' => 'Guia de Raids',
            
            'nav_type_chart' => 'Tabela de Tipos',
            'nav_evolution_calc' => 'Calculadora de Evolução',
            'nav_natures_guide' => 'Guia de Naturezas',
            'nav_damage_calc' => 'Calculadora de Dano',
            
            'nav_team_builder' => 'Montador de Times',
            'nav_speed_tiers' => 'Níveis de Velocidade',
            'nav_coverage_calc' => 'Calculadora de Cobertura',
            
            'hero_title' => 'Domine Cada Batalha Pokemon',
            'hero_subtitle' => 'Calculadoras Pokemon gratuitas e precisas para treinadores do mundo todo. Calcule PC, IVs, matchups de tipos e mais.',
            'hero_cta_primary' => 'Explorar Calculadoras',
            'hero_cta_secondary' => 'Ferramenta Mais Popular',
            'hero_stats_tools' => 'Ferramentas',
            'hero_stats_languages' => 'Idiomas',
            'hero_stats_trainers' => 'Treinadores',
            
            'cat_pokemon_go_title' => 'Pokemon GO',
            'cat_pokemon_go_desc' => 'Maximize seu potencial como treinador móvel',
            'cat_main_series_title' => 'Jogos Principais',
            'cat_main_series_desc' => 'Ferramentas para cada geração',
            'cat_competitive_title' => 'Competitivo',
            'cat_competitive_desc' => 'Domine batalhas VGC e Smogon',
            
            'popular_title' => 'Calculadoras Mais Populares',
            'popular_subtitle' => 'Confiadas por milhões de treinadores',
            'popular_cp_desc' => 'Calcule o Poder de Combate após a evolução',
            'popular_iv_desc' => 'Encontre IVs perfeitos para qualquer Pokemon',
            'popular_type_desc' => 'Domine matchups de tipos instantaneamente',
            'popular_evolution_desc' => 'Planeje evoluções com custos de doces',
            'popular_damage_desc' => 'Calcule dano de batalha com precisão',
            'popular_catch_desc' => 'Melhore sua taxa de captura',
            
            'how_title' => 'Como Funciona',
            'how_step1_title' => 'Escolha Sua Ferramenta',
            'how_step1_desc' => 'Selecione de nossa coleção de calculadoras especializadas',
            'how_step2_title' => 'Insira os Dados',
            'how_step2_desc' => 'Digite as stats do seu Pokemon e condições de batalha',
            'how_step3_title' => 'Obtenha Resultados',
            'how_step3_desc' => 'Receba cálculos precisos instantaneamente',
            
            'trust_title' => 'Por Que os Treinadores Confiam',
            'trust_accuracy_title' => '100% Preciso',
            'trust_accuracy_desc' => 'Fórmulas verificadas contra dados oficiais do jogo',
            'trust_free_title' => 'Sempre Grátis',
            'trust_free_desc' => 'Sem paywalls, sem assinaturas, sem limites',
            'trust_fast_title' => 'Ultra Rápido',
            'trust_fast_desc' => 'Resultados em milissegundos, não segundos',
            'trust_updated_title' => 'Sempre Atualizado',
            'trust_updated_desc' => 'Novos Pokemon e recursos adicionados imediatamente',
            
            'blog_title' => 'Últimas Dicas e Guias',
            'blog_subtitle' => 'Aumente seu conhecimento de treinador',
            'blog_read_more' => 'Ler Mais',
            'blog_view_all' => 'Ver Todos os Artigos',
            
            'faq_title' => 'Perguntas Frequentes',
            'faq_q1' => 'Essas calculadoras são precisas?',
            'faq_a1' => 'Sim! Todas as nossas calculadoras usam fórmulas oficiais do jogo e são testadas regularmente contra resultados no jogo. Atualizamos imediatamente quando as mecânicas mudam.',
            'faq_q2' => 'Preciso criar uma conta?',
            'faq_a2' => 'Nunca. Todas as calculadoras funcionam instantaneamente sem registro, email ou qualquer informação pessoal.',
            'faq_q3' => 'Quais jogos são suportados?',
            'faq_a3' => 'Suportamos Pokemon GO, todos os jogos principais da Gen 1-9, e formatos competitivos incluindo VGC e Smogon.',
            'faq_q4' => 'Com que frequência os dados são atualizados?',
            'faq_a4' => 'Atualizamos nosso banco de dados dentro de horas de novos lançamentos de Pokemon, patches ou mudanças de mecânicas.',
            'faq_q5' => 'Posso usar estas para batalhas competitivas?',
            'faq_a5' => 'Absolutamente! Nossas calculadoras competitivas são confiadas por jogadores VGC e membros da comunidade Smogon em todo o mundo.',
            
            'cta_title' => 'Pronto para se Tornar um Mestre Pokemon?',
            'cta_subtitle' => 'Junte-se a milhões de treinadores usando nossas calculadoras gratuitas',
            'cta_button' => 'Começar Agora',
            
            'footer_description' => 'O recurso gratuito definitivo para treinadores Pokemon. Calcule PC, IVs, matchups de tipos e mais com nossas ferramentas precisas e atualizadas.',
            'footer_popular' => 'Ferramentas Populares',
            'footer_categories' => 'Categorias',
            'footer_resources' => 'Recursos',
            'footer_social' => 'Siga-nos',
            'footer_copyright' => '© %year% Pokemon Calculator. Todos os direitos reservados.',
            'footer_made_with' => 'Feito com ❤️ para treinadores Pokemon do mundo todo',
            'footer_back_to_top' => 'Voltar ao Topo',
            'footer_privacy' => 'Política de Privacidade',
            'footer_terms' => 'Termos de Serviço',
            'footer_contact' => 'Fale Conosco',
            
            'theme_toggle_dark' => 'Mudar para modo escuro',
            'theme_toggle_light' => 'Mudar para modo claro',
            
            'lang_switcher_label' => 'Selecionar Idioma',
            'lang_current' => 'Português',
            
            'search_placeholder' => 'Buscar calculadoras...',
            'search_button' => 'Buscar',
            
            'calc_calculate' => 'Calcular',
            'calc_reset' => 'Resetar',
            'calc_result' => 'Resultado',
            'calc_level' => 'Nível',
            'calc_cp' => 'PC',
            'calc_hp' => 'PS',
            'calc_attack' => 'Ataque',
            'calc_defense' => 'Defesa',
            'calc_stamina' => 'Vigor',
            'calc_iv_percent' => '% IV',
            'calc_perfect' => 'Perfeito!',
            'calc_type' => 'Tipo',
            'calc_super_effective' => 'Super Efetivo',
            'calc_not_very_effective' => 'Pouco Efetivo',
            'calc_immune' => 'Sem Efeito',
            
            'meta_description_home' => 'Calculadoras Pokemon gratuitas para GO, jogos principais e batalhas competitivas. Calcule PC, IVs, matchups de tipos, dano e mais. Disponível em 5 idiomas.',
            'meta_keywords' => 'calculadora pokemon, calculadora pokemon go, calculadora iv, calculadora pc, tabela de tipos, calculadora de dano',
        ),
        
        // ========================================
        // FRENCH
        // ========================================
        'fr' => array(
            'site_name' => 'Pokemon Calculator',
            'site_tagline' => 'Calculateurs Pokemon Gratuits pour Chaque Dresseur',
            
            'nav_home' => 'Accueil',
            'nav_pokemon_go' => 'Pokemon GO',
            'nav_main_series' => 'Jeux Principaux',
            'nav_competitive' => 'Compétitif',
            'nav_blog' => 'Blog',
            'nav_about' => 'À Propos',
            'nav_contact' => 'Contact',
            'nav_all_tools' => 'Tous les Outils',
            'nav_aria_label' => 'Navigation Principale',
            
            'nav_cp_calculator' => 'Calculateur de PC',
            'nav_iv_calculator' => 'Calculateur d\'IV',
            'nav_catch_rate' => 'Calculateur de Capture',
            'nav_raid_guide' => 'Guide de Raids',
            
            'nav_type_chart' => 'Table des Types',
            'nav_evolution_calc' => 'Calculateur d\'Évolution',
            'nav_natures_guide' => 'Guide des Nature',
            'nav_damage_calc' => 'Calculateur de Dégâts',
            
            'nav_team_builder' => 'Créateur d\'Équipe',
            'nav_speed_tiers' => 'Niveaux de Vitesse',
            'nav_coverage_calc' => 'Calculateur de Couverture',
            
            'hero_title' => 'Maîtrisez Chaque Combat Pokemon',
            'hero_subtitle' => 'Calculateurs Pokemon gratuits et précis pour les dresseurs du monde entier. Calculez les PC, IV, matchups de types et plus.',
            'hero_cta_primary' => 'Explorer les Calculateurs',
            'hero_cta_secondary' => 'Outil le Plus Populaire',
            'hero_stats_tools' => 'Outils',
            'hero_stats_languages' => 'Langues',
            'hero_stats_trainers' => 'Dresseurs',
            
            'cat_pokemon_go_title' => 'Pokemon GO',
            'cat_pokemon_go_desc' => 'Maximisez votre potentiel de dresseur mobile',
            'cat_main_series_title' => 'Jeux Principaux',
            'cat_main_series_desc' => 'Outils pour chaque génération',
            'cat_competitive_title' => 'Compétitif',
            'cat_competitive_desc' => 'Dominez les combats VGC et Smogon',
            
            'popular_title' => 'Calculateurs les Plus Populaires',
            'popular_subtitle' => 'Approuvés par des millions de dresseurs',
            'popular_cp_desc' => 'Calculez les Points de Combat après évolution',
            'popular_iv_desc' => 'Trouvez les IV parfaits pour chaque Pokemon',
            'popular_type_desc' => 'Maîtrisez les matchups de types instantanément',
            'popular_evolution_desc' => 'Planifiez les évolutions avec les coûts de bonbons',
            'popular_damage_desc' => 'Calculez les dégâts de combat avec précision',
            'popular_catch_desc' => 'Améliorez votre taux de capture',
            
            'how_title' => 'Comment Ça Marche',
            'how_step1_title' => 'Choisissez Votre Outil',
            'how_step1_desc' => 'Sélectionnez parmi notre collection de calculateurs spécialisés',
            'how_step2_title' => 'Entrez les Données',
            'how_step2_desc' => 'Saisissez les stats de votre Pokemon et conditions de combat',
            'how_step3_title' => 'Obtenez les Résultats',
            'how_step3_desc' => 'Recevez des calculs précis instantanément',
            
            'trust_title' => 'Pourquoi les Dresseurs Nous Font Confiance',
            'trust_accuracy_title' => '100% Précis',
            'trust_accuracy_desc' => 'Formules vérifiées contre les données officielles du jeu',
            'trust_free_title' => 'Toujours Gratuit',
            'trust_free_desc' => 'Sans paywall, sans abonnement, sans limites',
            'trust_fast_title' => 'Ultra Rapide',
            'trust_fast_desc' => 'Résultats en millisecondes, pas en secondes',
            'trust_updated_title' => 'Toujours à Jour',
            'trust_updated_desc' => 'Nouveaux Pokemon et fonctionnalités ajoutés immédiatement',
            
            'blog_title' => 'Derniers Conseils et Guides',
            'blog_subtitle' => 'Améliorez vos connaissances de dresseur',
            'blog_read_more' => 'Lire la Suite',
            'blog_view_all' => 'Voir Tous les Articles',
            
            'faq_title' => 'Questions Fréquentes',
            'faq_q1' => 'Ces calculateurs sont-ils précis?',
            'faq_a1' => 'Oui! Tous nos calculateurs utilisent les formules officielles du jeu et sont régulièrement testés contre les résultats en jeu. Nous mettons à jour immédiatement lorsque les mécaniques changent.',
            'faq_q2' => 'Dois-je créer un compte?',
            'faq_a2' => 'Jamais. Tous les calculateurs fonctionnent instantanément sans inscription, email ou information personnelle.',
            'faq_q3' => 'Quels jeux sont supportés?',
            'faq_a3' => 'Nous supportons Pokemon GO, tous les jeux principaux des Gen 1-9, et les formats compétitifs incluant VGC et Smogon.',
            'faq_q4' => 'À quelle fréquence les données sont-elles mises à jour?',
            'faq_a4' => 'Nous mettons à jour notre base de données dans les heures suivant les nouvelles sorties de Pokemon, patches ou changements de mécaniques.',
            'faq_q5' => 'Puis-je les utiliser pour les combats compétitifs?',
            'faq_a5' => 'Absolument! Nos calculateurs compétitifs sont approuvés par les joueurs VGC et membres de la communauté Smogan du monde entier.',
            
            'cta_title' => 'Prêt à Devenir un Maître Pokemon?',
            'cta_subtitle' => 'Rejoignez des millions de dresseurs utilisant nos calculateurs gratuits',
            'cta_button' => 'Commencer Maintenant',
            
            'footer_description' => 'La ressource gratuite ultime pour les dresseurs Pokemon. Calculez les PC, IV, matchups de types et plus avec nos outils précis et à jour.',
            'footer_popular' => 'Outils Populaires',
            'footer_categories' => 'Catégories',
            'footer_resources' => 'Ressources',
            'footer_social' => 'Suivez-nous',
            'footer_copyright' => '© %year% Pokemon Calculator. Tous droits réservés.',
            'footer_made_with' => 'Fait avec ❤️ pour les dresseurs Pokemon du monde entier',
            'footer_back_to_top' => 'Retour en Haut',
            'footer_privacy' => 'Politique de Confidentialité',
            'footer_terms' => 'Conditions d\'Utilisation',
            'footer_contact' => 'Contactez-nous',
            
            'theme_toggle_dark' => 'Passer en mode sombre',
            'theme_toggle_light' => 'Passer en mode clair',
            
            'lang_switcher_label' => 'Choisir la Langue',
            'lang_current' => 'Français',
            
            'search_placeholder' => 'Rechercher des calculateurs...',
            'search_button' => 'Rechercher',
            
            'calc_calculate' => 'Calculer',
            'calc_reset' => 'Réinitialiser',
            'calc_result' => 'Résultat',
            'calc_level' => 'Niveau',
            'calc_cp' => 'PC',
            'calc_hp' => 'PV',
            'calc_attack' => 'Attaque',
            'calc_defense' => 'Défense',
            'calc_stamina' => 'Endurance',
            'calc_iv_percent' => '% IV',
            'calc_perfect' => 'Parfait!',
            'calc_type' => 'Type',
            'calc_super_effective' => 'Super Efficace',
            'calc_not_very_effective' => 'Peu Efficace',
            'calc_immune' => 'Sans Effet',
            
            'meta_description_home' => 'Calculateurs Pokemon gratuits pour GO, jeux principaux et combats compétitifs. Calculez PC, IV, matchups de types, dégâts et plus. Disponible en 5 langues.',
            'meta_keywords' => 'calculateur pokemon, calculateur pokemon go, calculateur iv, calculateur pc, table des types, calculateur de dégâts',
        ),
        
        // ========================================
        // GERMAN
        // ========================================
        'de' => array(
            'site_name' => 'Pokemon Calculator',
            'site_tagline' => 'Kostenlose Pokemon-Rechner für jeden Trainer',
            
            'nav_home' => 'Startseite',
            'nav_pokemon_go' => 'Pokemon GO',
            'nav_main_series' => 'Hauptspiele',
            'nav_competitive' => 'Kompetitiv',
            'nav_blog' => 'Blog',
            'nav_about' => 'Über Uns',
            'nav_contact' => 'Kontakt',
            'nav_all_tools' => 'Alle Tools',
            'nav_aria_label' => 'Hauptnavigation',
            
            'nav_cp_calculator' => 'WP-Rechner',
            'nav_iv_calculator' => 'IV-Rechner',
            'nav_catch_rate' => 'Fangraten-Rechner',
            'nav_raid_guide' => 'Raid-Guide',
            
            'nav_type_chart' => 'Typentabelle',
            'nav_evolution_calc' => 'Entwicklungsrechner',
            'nav_natures_guide' => 'Wesen-Guide',
            'nav_damage_calc' => 'Schadensrechner',
            
            'nav_team_builder' => 'Team-Builder',
            'nav_speed_tiers' => 'Geschwindigkeitsstufen',
            'nav_coverage_calc' => 'Deckungsrechner',
            
            'hero_title' => 'Beherrsche jeden Pokemon-Kampf',
            'hero_subtitle' => 'Kostenlose, genaue Pokemon-Rechner für Trainer weltweit. Berechne WP, IVs, Typ-Matchups und mehr.',
            'hero_cta_primary' => 'Rechner Entdecken',
            'hero_cta_secondary' => 'Beliebtestes Tool',
            'hero_stats_tools' => 'Rechner-Tools',
            'hero_stats_languages' => 'Sprachen',
            'hero_stats_trainers' => 'Trainer',
            
            'cat_pokemon_go_title' => 'Pokemon GO',
            'cat_pokemon_go_desc' => 'Maximiere dein mobiles Trainer-Potenzial',
            'cat_main_series_title' => 'Hauptspiele',
            'cat_main_series_desc' => 'Tools für jede Generation',
            'cat_competitive_title' => 'Kompetitiv',
            'cat_competitive_desc' => 'Dominiere VGC- und Smogon-Kämpfe',
            
            'popular_title' => 'Beliebteste Rechner',
            'popular_subtitle' => 'Vertraut von Millionen Trainern weltweit',
            'popular_cp_desc' => 'Berechne Wettkampfpunkte nach Entwicklung',
            'popular_iv_desc' => 'Finde perfekte IVs für jedes Pokemon',
            'popular_type_desc' => 'Beherrsche Typ-Matchups sofort',
            'popular_evolution_desc' => 'Plane Entwicklungen mit Bonbon-Kosten',
            'popular_damage_desc' => 'Berechne Kampfschaden genau',
            'popular_catch_desc' => 'Verbessere deine Fangrate',
            
            'how_title' => 'So Funktioniert\'s',
            'how_step1_title' => 'Wähle dein Tool',
            'how_step1_desc' => 'Wähle aus unserer Sammlung spezialisierter Rechner',
            'how_step2_title' => 'Daten Eingeben',
            'how_step2_desc' => 'Gib deine Pokemon-Stats und Kampfbedingungen ein',
            'how_step3_title' => 'Ergebnisse Erhalten',
            'how_step3_desc' => 'Erhalte sofort genaue Berechnungen',
            
            'trust_title' => 'Warum Trainer Uns Vertrauen',
            'trust_accuracy_title' => '100% Genau',
            'trust_accuracy_desc' => 'Formeln gegen offizielle Spieldaten verifiziert',
            'trust_free_title' => 'Immer Kostenlos',
            'trust_free_desc' => 'Keine Paywalls, keine Abos, keine Limits',
            'trust_fast_title' => 'Blitzschnell',
            'trust_fast_desc' => 'Ergebnisse in Millisekunden, nicht Sekunden',
            'trust_updated_title' => 'Immer Aktuell',
            'trust_updated_desc' => 'Neue Pokemon und Features sofort hinzugefügt',
            
            'blog_title' => 'Neueste Tipps & Guides',
            'blog_subtitle' => 'Erweitere dein Trainer-Wissen',
            'blog_read_more' => 'Mehr Lesen',
            'blog_view_all' => 'Alle Artikel Ansehen',
            
            'faq_title' => 'Häufig Gestellte Fragen',
            'faq_q1' => 'Sind diese Rechner genau?',
            'faq_a1' => 'Ja! Alle unsere Rechner verwenden offizielle Spielformeln und werden regelmäßig gegen In-Game-Ergebnisse getestet. Wir aktualisieren sofort, wenn sich Mechaniken ändern.',
            'faq_q2' => 'Muss ich ein Konto erstellen?',
            'faq_a2' => 'Niemals. Alle Rechner funktionieren sofort ohne Registrierung, E-Mail oder persönliche Informationen.',
            'faq_q3' => 'Welche Spiele werden unterstützt?',
            'faq_a3' => 'Wir unterstützen Pokemon GO, alle Hauptspiele von Gen 1-9, und kompetitive Formate inklusive VGC und Smogon.',
            'faq_q4' => 'Wie oft werden die Daten aktualisiert?',
            'faq_a4' => 'Wir aktualisieren unsere Datenbank innerhalb von Stunden nach neuen Pokemon-Releases, Patches oder Mechanik-Änderungen.',
            'faq_q5' => 'Kann ich diese für kompetitive Kämpfe nutzen?',
            'faq_a5' => 'Absolut! Unsere kompetitiven Rechner werden von VGC-Spielern und Smogon-Community-Mitgliedern weltweit vertraut.',
            
            'cta_title' => 'Bereit, ein Pokemon-Meister zu Werden?',
            'cta_subtitle' => 'Schließe dich Millionen Trainern an, die unsere kostenlosen Rechner nutzen',
            'cta_button' => 'Jetzt Starten',
            
            'footer_description' => 'Die ultimative kostenlose Ressource fur Pokemon-Trainer. Berechne WP, IVs, Typ-Matchups und mehr mit unseren genauen, aktuellen Tools.',
            'footer_popular' => 'Beliebte Tools',
            'footer_categories' => 'Kategorien',
            'footer_resources' => 'Ressourcen',
            'footer_social' => 'Folge Uns',
            'footer_copyright' => '© %year% Pokemon Calculator. Alle Rechte vorbehalten.',
            'footer_made_with' => 'Gemacht mit ❤️ fur Pokemon-Trainer weltweit',
            'footer_back_to_top' => 'Nach Oben',
            'footer_privacy' => 'Datenschutz',
            'footer_terms' => 'Nutzungsbedingungen',
            'footer_contact' => 'Kontaktiere Uns',
            
            'theme_toggle_dark' => 'Zum Dunkelmodus wechseln',
            'theme_toggle_light' => 'Zum Hellmodus wechseln',
            
            'lang_switcher_label' => 'Sprache Wahlen',
            'lang_current' => 'Deutsch',
            
            'search_placeholder' => 'Rechner suchen...',
            'search_button' => 'Suchen',
            
            'calc_calculate' => 'Berechnen',
            'calc_reset' => 'Zurucksetzen',
            'calc_result' => 'Ergebnis',
            'calc_level' => 'Level',
            'calc_cp' => 'WP',
            'calc_hp' => 'KP',
            'calc_attack' => 'Angriff',
            'calc_defense' => 'Verteidigung',
            'calc_stamina' => 'Ausdauer',
            'calc_iv_percent' => 'IV %',
            'calc_perfect' => 'Perfekt!',
            'calc_type' => 'Typ',
            'calc_super_effective' => 'Sehr Effektiv',
            'calc_not_very_effective' => 'Nicht Sehr Effektiv',
            'calc_immune' => 'Keine Wirkung',
            
            'meta_description_home' => 'Kostenlose Pokemon-Rechner fur GO, Hauptspiele und kompetitive Kampfe. Berechne WP, IVs, Typ-Matchups, Schaden und mehr. Verfugbar in 5 Sprachen.',
            'meta_keywords' => 'pokemon rechner, pokemon go rechner, iv rechner, wp rechner, typentabelle, schadensrechner',
        ),
    );
    
    return isset($translations[$lang]) ? $translations[$lang] : $translations['en'];
}

// Translation helper — English only
