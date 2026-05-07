<?php
/**
 * Database connection helpers for XAMPP (MySQL on localhost).
 *
 * Defaults assume XAMPP local development environment:
 *  - host: 127.0.0.1
 *  - user: root
 *  - password: (empty)
 *  - database: skill_share
 *
 * Update the variables below to match your environment.
 */

$DB_HOST = '127.0.0.1';
$DB_NAME = 'skill_share';
$DB_USER = 'root';
$DB_PASS = '';

/**
 * Return a PDO instance (singleton).
 * Dies with an error message if connection fails (suitable for local dev).
 */
function getPDO()
{
    global $DB_HOST, $DB_NAME, $DB_USER, $DB_PASS;
    static $pdo = null;
    if ($pdo instanceof PDO) {
        return $pdo;
    }

    $dsn = "mysql:host={$DB_HOST};dbname={$DB_NAME};charset=utf8mb4";
    try {
        $pdo = new PDO($dsn, $DB_USER, $DB_PASS, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]);
    } catch (PDOException $e) {
        // In production you should log instead of echoing the error.
        http_response_code(500);
        die('Database connection failed: ' . $e->getMessage());
    }

    return $pdo;
}

/**
 * Simple helper to search user profiles by name, username or email.
 * Returns an array of associative rows (id, full_name, username, email, bio).
 */
function searchProfiles(string $term, int $limit = 50): array
{
    $pdo = getPDO();
    $sql = "SELECT id, full_name, username, bio FROM users
            WHERE full_name LIKE :q OR username LIKE :q
            LIMIT :limit";

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':q', '%' . $term . '%', PDO::PARAM_STR);
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll();
}

?>
