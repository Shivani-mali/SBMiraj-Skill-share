<?php
require_once __DIR__ . '/db-connection.php';

$q = isset($_GET['q']) ? trim($_GET['q']) : '';

// Basic page title and include header/footer if present
$pageTitle = 'Search: ' . ($q ?: '');
$baseUrl = '/';
include __DIR__ . '/templates/header.php';
include __DIR__ . '/templates/navbar.php';

echo '<div class="container mt-4">';
echo '<h1>Search results</h1>';

if ($q === '') {
    echo '<p>Please enter a search query.</p>';
} else {
    try {
        $results = searchProfiles($q, 100);
    } catch (Exception $e) {
        echo '<div class="alert alert-danger">Search failed: ' . htmlspecialchars($e->getMessage()) . '</div>';
        $results = [];
    }

    if (count($results) === 0) {
        echo '<p>No profiles found for <strong>' . htmlspecialchars($q) . '</strong>.</p>';
    } else {
        echo '<p>Found ' . count($results) . ' profiles for <strong>' . htmlspecialchars($q) . '</strong>:</p>';
        echo '<div class="list-group">';
        foreach ($results as $row) {
            $name = htmlspecialchars($row['full_name'] ?? $row['username'] ?? 'Unknown');
            $username = htmlspecialchars($row['username'] ?? '');
            $bio = htmlspecialchars($row['bio'] ?? '');
            $id = (int)($row['id'] ?? 0);

            echo '<a class="list-group-item list-group-item-action" href="' . rtrim($baseUrl, '/') . '/profile.php?id=' . $id . '">';
            echo '<div class="fw-bold">' . $name . ' <small class="text-muted">@' . $username . '</small></div>';
            if ($bio !== '') {
                echo '<div class="small text-truncate" style="max-width:60%">' . $bio . '</div>';
            }
            echo '</a>';
        }
        echo '</div>';
    }
}

echo '</div>';

include __DIR__ . '/templates/footer.php';

?>
