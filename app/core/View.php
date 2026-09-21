<?php
/**
 * View & Template Rendering Engine
 * Pokemon Calculator Hub
 */

namespace App\Core;

class View {
    /**
     * Render a view within a layout
     */
    public static function render(string $viewPath, array $data = [], string $layout = 'main'): void {
        $viewFile = VIEWS_DIR . '/' . trim($viewPath, '/') . '.php';
        
        if (!file_exists($viewFile)) {
            throw new \RuntimeException("View file not found: {$viewFile}");
        }

        // Extract variables to view scope
        extract($data);

        // Capture view content
        ob_start();
        require $viewFile;
        $content = ob_get_clean();

        // Render inside layout
        if ($layout) {
            $layoutCandidates = [
                VIEWS_DIR . '/layouts/' . $layout . '.php',
                VIEWS_DIR . '/admin/layouts/' . $layout . '.php',
            ];

            foreach ($layoutCandidates as $layoutFile) {
                if (file_exists($layoutFile)) {
                    require $layoutFile;
                    return;
                }
            }
        }

        echo $content;
    }

    /**
     * Include a partial template
     */
    public static function partial(string $partialPath, array $data = []): void {
        $file = VIEWS_DIR . '/partials/' . trim($partialPath, '/') . '.php';
        if (file_exists($file)) {
            extract($data);
            require $file;
        }
    }
}
