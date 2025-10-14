<?php
require_once __DIR__ . '/helpers.php';
requireLogin();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit;
}

$user_id = isset($_POST['user_id']) ? (int)$_POST['user_id'] : 0;
$rating = isset($_POST['rating']) ? (int)$_POST['rating'] : 0;
$comment = trim($_POST['comment'] ?? '');

if ($user_id <= 0 || $rating < 1 || $rating > 5) {
    http_response_code(400);
    echo 'Invalid input.';
    exit;
}

$pdo = getPDO();
$stmt = $pdo->prepare('INSERT INTO ratings (user_id, rater_id, rating, comment) VALUES (:uid, :rid, :rating, :comment)');
$stmt->execute([':uid' => $user_id, ':rid' => $_SESSION['user_id'], ':rating' => $rating, ':comment' => $comment ?: null]);

redirect('/profile.php?id=' . $user_id);
