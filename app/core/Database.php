<?php
/**
 * Database Connection & Query Helper (PDO Singleton)
 * Pokemon Calculator Hub
 */

namespace App\Core;

use PDO;
use PDOException;

class Database {
    private static ?PDO $instance = null;

    /**
     * Get or create PDO connection
     */
    public static function getInstance(): PDO {
        if (self::$instance === null) {
            try {
                $dsn = sprintf(
                    'mysql:host=%s;port=%s;dbname=%s;charset=%s',
                    DB_HOST,
                    DB_PORT,
                    DB_NAME,
                    DB_CHARSET
                );

                $options = [
                    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES   => false,
                    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES " . DB_CHARSET
                ];

                self::$instance = new PDO($dsn, DB_USER, DB_PASS, $options);
            } catch (PDOException $e) {
                // Fallback / Log error
                if (defined('APP_DEBUG') && APP_DEBUG) {
                    die('Database connection error: ' . $e->getMessage());
                } else {
                    die('Database connection could not be established. Please check settings.');
                }
            }
        }

        return self::$instance;
    }

    /**
     * Run a parameterized query and return all results
     */
    public static function fetchAll(string $sql, array $params = []): array {
        $stmt = self::getInstance()->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    /**
     * Run a parameterized query and return single row
     */
    public static function fetchOne(string $sql, array $params = []): ?array {
        $stmt = self::getInstance()->prepare($sql);
        $stmt->execute($params);
        $res = $stmt->fetch();
        return $res ?: null;
    }

    /**
     * Run a parameterized query and return single scalar value
     */
    public static function fetchColumn(string $sql, array $params = [], int $column = 0) {
        $stmt = self::getInstance()->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchColumn($column);
    }

    /**
     * Execute an INSERT, UPDATE, or DELETE query
     */
    public static function execute(string $sql, array $params = []): bool {
        $stmt = self::getInstance()->prepare($sql);
        return $stmt->execute($params);
    }

    /**
     * Get last insert ID
     */
    public static function lastInsertId(): string {
        return self::getInstance()->lastInsertId();
    }
}
