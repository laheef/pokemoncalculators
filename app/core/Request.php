<?php
/**
 * HTTP Request Handler
 * Pokemon Calculator Hub
 */

namespace App\Core;

class Request {
    private string $method;
    private string $uri;
    private string $path;
    private array $queryParams;
    private array $bodyParams;
    private ?array $jsonBody = null;

    public function __construct() {
        $this->method = strtoupper($_SERVER['REQUEST_METHOD'] ?? 'GET');
        $this->uri = $_SERVER['REQUEST_URI'] ?? '/';
        $this->path = trim(parse_url($this->uri, PHP_URL_PATH), '/');
        $this->queryParams = $_GET;
        $this->bodyParams = $_POST;
    }

    public function getMethod(): string {
        return $this->method;
    }

    public function isPost(): bool {
        return $this->method === 'POST';
    }

    public function isGet(): bool {
        return $this->method === 'GET';
    }

    public function isAjax(): bool {
        return (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && 
                strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') ||
               (isset($_SERVER['HTTP_ACCEPT']) && 
                strpos($_SERVER['HTTP_ACCEPT'], 'application/json') !== false);
    }

    public function getPath(): string {
        return $this->path;
    }

    public function getUri(): string {
        return $this->uri;
    }

    public function get(string $key, $default = null) {
        return $this->queryParams[$key] ?? $default;
    }

    public function post(string $key, $default = null) {
        return $this->bodyParams[$key] ?? $default;
    }

    public function input(string $key, $default = null) {
        if ($this->jsonBody === null && $this->isJson()) {
            $input = file_get_contents('php://input');
            $this->jsonBody = json_decode($input, true) ?: [];
        }

        if ($this->jsonBody && isset($this->jsonBody[$key])) {
            return $this->jsonBody[$key];
        }

        return $this->bodyParams[$key] ?? $this->queryParams[$key] ?? $default;
    }

    public function all(): array {
        if ($this->jsonBody === null && $this->isJson()) {
            $input = file_get_contents('php://input');
            $this->jsonBody = json_decode($input, true) ?: [];
        }

        return array_merge($this->queryParams, $this->bodyParams, $this->jsonBody ?: []);
    }

    public function isJson(): bool {
        $contentType = $_SERVER['CONTENT_TYPE'] ?? '';
        return strpos($contentType, 'application/json') !== false;
    }

    public function getIp(): string {
        return $_SERVER['HTTP_X_FORWARDED_FOR'] ?? $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1';
    }
}
