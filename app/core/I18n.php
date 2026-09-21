<?php
/**
 * Multilingual & Translation Engine
 * Pokemon Calculator Hub
 */

namespace App\Core;

class I18n {
    private static string $currentLang = 'en';
    private static ?array $translations = null;

    /**
     * Check if site is configured in Multilingual mode or English Only
     */
    public static function isMultilingualEnabled(): bool {
        if (function_exists('get_setting')) {
            $val = get_setting('enable_multilingual', '0');
            return ($val === '1' || $val === 'true' || $val === 'yes');
        }
        return false;
    }

    /**
     * Supported languages
     */
    public static function getSupportedLanguages(): array {
        if (!self::isMultilingualEnabled()) {
            return [
                'en' => [
                    'name'        => 'English',
                    'native_name' => 'English',
                    'flag'        => '🇺🇸',
                    'locale'      => 'en_US',
                    'rtl'         => false
                ]
            ];
        }

        return [
            'en' => [
                'name'        => 'English',
                'native_name' => 'English',
                'flag'        => '🇺🇸',
                'locale'      => 'en_US',
                'rtl'         => false
            ],
            'es' => [
                'name'        => 'Spanish',
                'native_name' => 'Español',
                'flag'        => '🇪🇸',
                'locale'      => 'es_ES',
                'rtl'         => false
            ],
            'pt-br' => [
                'name'        => 'Portuguese (Brazil)',
                'native_name' => 'Português (BR)',
                'flag'        => '🇧🇷',
                'locale'      => 'pt_BR',
                'rtl'         => false
            ],
            'fr' => [
                'name'        => 'French',
                'native_name' => 'Français',
                'flag'        => '🇫🇷',
                'locale'      => 'fr_FR',
                'rtl'         => false
            ],
            'de' => [
                'name'        => 'German',
                'native_name' => 'Deutsch',
                'flag'        => '🇩🇪',
                'locale'      => 'de_DE',
                'rtl'         => false
            ]
        ];
    }

    /**
     * Set current language
     */
    public static function setLang(string $lang): void {
        $supported = self::getSupportedLanguages();
        if (isset($supported[$lang])) {
            self::$currentLang = $lang;
        } else {
            self::$currentLang = 'en';
        }
    }

    /**
     * Get current language code (e.g. 'en')
     */
    public static function getCurrentLang(): string {
        return self::$currentLang;
    }

    /**
     * Translate string key
     */
    public static function t(string $key, ?string $default = null): string {
        if (self::$translations === null) {
            self::loadTranslations();
        }

        $lang = self::$currentLang;

        if (isset(self::$translations[$lang][$key])) {
            return self::$translations[$lang][$key];
        }

        if (isset(self::$translations['en'][$key])) {
            return self::$translations['en'][$key];
        }

        return $default !== null ? $default : $key;
    }

    /**
     * Load all translation dictionary strings
     */
    private static function loadTranslations(): void {
        require_once APP_DIR . '/core/extracted_translations.php';
        if (function_exists('pkm_get_translations')) {
            self::$translations = [
                'en'    => pkm_get_translations('en'),
                'es'    => pkm_get_translations('es'),
                'pt-br' => pkm_get_translations('pt-br'),
                'fr'    => pkm_get_translations('fr'),
                'de'    => pkm_get_translations('de')
            ];
        } else {
            self::$translations = ['en' => []];
        }
    }
}
