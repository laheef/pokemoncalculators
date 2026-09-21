<?php
/**
 * Fast & Clean URL Router
 * Pokemon Calculator Hub
 */

namespace App\Core;

class Router {
    private array $routes = [];
    private array $redirects = [];
    private $notFoundHandler = null;

    /**
     * Add GET route
     */
    public function get(string $path, $handler): self {
        return $this->addRoute('GET', $path, $handler);
    }

    /**
     * Add POST route
     */
    public function post(string $path, $handler): self {
        return $this->addRoute('POST', $path, $handler);
    }

    /**
     * Add route for any HTTP method
     */
    public function any(string $path, $handler): self {
        return $this->addRoute('ANY', $path, $handler);
    }

    /**
     * Add a 301 / 302 redirect rule
     */
    public function redirect(string $from, string $to, int $code = 301): self {
        $this->redirects[trim($from, '/')] = ['to' => $to, 'code' => $code];
        return $this;
    }

    /**
     * Set custom 404 handler
     */
    public function setNotFound($handler): self {
        $this->notFoundHandler = $handler;
        return $this;
    }

    /**
     * Register route internally
     */
    private function addRoute(string $method, string $path, $handler): self {
        $cleanPath = trim($path, '/');
        // Convert route pattern {param} to regex named captures
        $pattern = preg_replace('/\{([a-zA-Z0-9_]+)\}/', '(?P<$1>[^/]+)', $cleanPath);
        $pattern = '#^' . $pattern . '$#';

        $this->routes[] = [
            'method'  => $method,
            'path'    => $cleanPath,
            'pattern' => $pattern,
            'handler' => $handler
        ];

        return $this;
    }

    /**
     * Dispatch incoming request
     */
    public function dispatch(Request $request): void {
        $method = $request->getMethod();
        $path = $request->getPath();

        // 1. Check for legacy 301 redirects first
        if (isset($this->redirects[$path])) {
            Response::redirect(home_url($this->redirects[$path]['to']), $this->redirects[$path]['code']);
            return;
        }

        // 2. Handle optional language prefix (e.g. /en/..., /es/...)
        $parts = explode('/', $path);
        $supportedLangs = array_keys(I18n::getSupportedLanguages());
        if (!empty($parts[0]) && in_array($parts[0], $supportedLangs)) {
            I18n::setLang($parts[0]);
            array_shift($parts);
            $path = implode('/', $parts);
        } else {
            I18n::setLang('en');
        }

        // 3. Match registered routes
        foreach ($this->routes as $route) {
            if ($route['method'] !== 'ANY' && $route['method'] !== $method) {
                continue;
            }

            if (preg_match($route['pattern'], $path, $matches)) {
                // Filter out numerical keys from regex matches
                $params = array_filter($matches, function ($k) {
                    return !is_numeric($k);
                }, ARRAY_FILTER_USE_KEY);

                $this->executeHandler($route['handler'], $request, $params);
                return;
            }
        }

        // 4. If no route matched, check if path matches a dynamic DB page or tool slug
        if ($this->dispatchFromDatabase($request, $path)) {
            return;
        }

        // 5. 404 Not Found
        $this->handleNotFound($request);
    }

    /**
     * Attempt to resolve slug from Database (Tools or Pages)
     */
    private function dispatchFromDatabase(Request $request, string $path): bool {
        if (empty($path)) return false;

        // Check tools
        try {
            $tool = Database::fetchOne("SELECT * FROM tools WHERE slug = ? AND is_active = 1", [$path]);
            if ($tool) {
                require_once APP_DIR . '/pages/CalculatorsController.php';
                $controller = new \App\Pages\CalculatorsController();
                $controller->show($request, ['slug' => $path]);
                return true;
            }

            // Check pages
            $page = Database::fetchOne("SELECT * FROM pages WHERE slug = ? AND is_active = 1", [$path]);
            if ($page) {
                require_once APP_DIR . '/pages/PageController.php';
                $controller = new \App\Pages\PageController();
                $controller->show($request, ['slug' => $path]);
                return true;
            }
        } catch (\Exception $e) {
            // DB error fallback
        }

        return false;
    }

    /**
     * Execute matched route handler
     */
    private function executeHandler($handler, Request $request, array $params = []): void {
        if (is_callable($handler)) {
            call_user_func($handler, $request, $params);
            return;
        }

        if (is_array($handler) && count($handler) === 2) {
            [$class, $method] = $handler;
            if (is_string($class)) {
                $controller = new $class();
            } else {
                $controller = $class;
            }
            call_user_func([$controller, $method], $request, $params);
            return;
        }

        if (is_string($handler) && file_exists($handler)) {
            require $handler;
            return;
        }

        throw new \RuntimeException("Invalid route handler provided");
    }

    /**
     * Handle 404 response
     */
    private function handleNotFound(Request $request): void {
        if ($this->notFoundHandler) {
            $this->executeHandler($this->notFoundHandler, $request);
            return;
        }

        http_response_code(404);
        require_once APP_DIR . '/core/View.php';
        View::render('pages/404', [
            'meta_title' => 'Page Not Found — 404',
            'meta_desc' => 'The page you are looking for does not exist.'
        ]);
    }
}
