<?php
// Common helpers: session start, auth helpers, redirects
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/db-connection.php';

function getCurrentUser()
{
    if (!empty($_SESSION['user_id'])) {
        $pdo = getPDO();
        $stmt = $pdo->prepare('SELECT id, username, full_name, bio, category, google_classroom, profile_image FROM users WHERE id = :id');
        $stmt->execute([':id' => $_SESSION['user_id']]);
        return $stmt->fetch();
    }
    return null;
}

function requireLogin()
{
    if (empty($_SESSION['user_id'])) {
        header('Location: /login.php');
        exit;
    }
}

function redirect($url)
{
    header('Location: ' . $url);
    exit;
}

?>
