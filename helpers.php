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
        redirect('/login.php');
    }
}

/**
 * Return the base path where the app is hosted (e.g. '/skill-share').
 * If the app is hosted at webroot this will return an empty string.
 */
function getBaseUrl()
{
    $script = $_SERVER['SCRIPT_NAME'] ?? '';
    // Normalize directory separator and remove trailing slash
    $dir = rtrim(str_replace('\\', '/', dirname($script)), '/');
    return $dir === '/' ? '' : $dir;
}

/**
 * Redirect to a URL. If $url starts with '/' it will be treated as
 * root-relative to the application and the computed base path will be
 * prepended so redirects work when hosted in a subfolder.
 */
function redirect($url)
{
    // If it's an absolute URL (http:// or https://) or protocol-relative, leave it alone
    if (preg_match('#^https?://#i', $url) || strpos($url, '//') === 0) {
        header('Location: ' . $url);
        exit;
    }

    // If it's root-relative, prefix with the app base path
    if (strpos($url, '/') === 0) {
        $base = getBaseUrl();
        $url = ($base === '' ? '' : $base) . $url;
    }

    header('Location: ' . $url);
    exit;
}

?>
