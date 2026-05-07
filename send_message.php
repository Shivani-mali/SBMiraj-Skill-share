<?php
require_once __DIR__ . '/helpers.php';

if (empty($_SESSION['user_id'])) {
    redirect('/login.php');
}

$sender = getCurrentUser();
if (!$sender) redirect('/login.php');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo 'Method not allowed';
    exit;
}

$recipient_id = (int)($_POST['recipient_id'] ?? 0);
$chat_link = trim($_POST['chat_link'] ?? '');
$body = trim($_POST['body'] ?? '');

if ($recipient_id <= 0) {
    redirect('/profile.php?id=' . $recipient_id);
}

$pdo = getPDO();

// Create messages table if not exists (safe to run repeatedly)
$pdo->exec("CREATE TABLE IF NOT EXISTS messages (
  id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  sender_id INT UNSIGNED NOT NULL,
  recipient_id INT UNSIGNED NOT NULL,
  chat_link VARCHAR(255) DEFAULT NULL,
  body TEXT DEFAULT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  INDEX(recipient_id),
  INDEX(sender_id),
  CONSTRAINT fk_messages_sender FOREIGN KEY (sender_id) REFERENCES users(id) ON DELETE CASCADE,
  CONSTRAINT fk_messages_recipient FOREIGN KEY (recipient_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");

$stmt = $pdo->prepare('INSERT INTO messages (sender_id, recipient_id, chat_link, body) VALUES (:s,:r,:link,:body)');
$stmt->execute([
    ':s' => $sender['id'],
    ':r' => $recipient_id,
    ':link' => $chat_link ?: null,
    ':body' => $body ?: null,
]);

// Redirect back to profile with a success indicator
redirect('/profile.php?id=' . $recipient_id . '&msg_sent=1');
