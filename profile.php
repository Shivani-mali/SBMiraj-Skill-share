<?php
require_once __DIR__ . '/helpers.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id <= 0) {
    http_response_code(400);
    echo 'Invalid profile id.';
    exit;
}

$pdo = getPDO();
$stmt = $pdo->prepare('SELECT id, username, full_name, bio, category, google_classroom, profile_image, created_at FROM users WHERE id = :id');
$stmt->execute([':id' => $id]);
$user = $stmt->fetch();
if (!$user) {
    http_response_code(404);
    echo 'User not found.';
    exit;
}

$pageTitle = htmlspecialchars($user['full_name']) . ' (@' . htmlspecialchars($user['username']) . ')';
include __DIR__ . '/templates/header.php';
include __DIR__ . '/templates/navbar.php';

// Fetch average rating
$r = $pdo->prepare('SELECT AVG(rating) AS avg_rating, COUNT(*) AS cnt FROM ratings WHERE user_id = :id');
$r->execute([':id' => $id]);
$ratingStats = $r->fetch();

?>
<div class="container mt-4">
  <div class="profile-header">
    <div>
      <?php if (!empty($user['profile_image'])): ?>
        <img src="<?php echo htmlspecialchars($user['profile_image']); ?>" alt="Profile" class="profile-avatar">
      <?php else: ?>
        <div class="profile-avatar d-flex align-items-center justify-content-center bg-secondary text-white">No image</div>
      <?php endif; ?>
    </div>
    <div>
      <h2><?php echo htmlspecialchars($user['full_name']); ?> <h4 class="small ">@<?php echo htmlspecialchars($user['username']); ?></h4></h2>
      <p><?php echo nl2br(htmlspecialchars($user['bio'])); ?></p>
      <div class="mb-2"><strong>Category:</strong> <?php echo htmlspecialchars($user['category']); ?></div>
      <div class="d-flex gap-2 mb-3">
        <?php if (!empty($user['google_classroom'])): ?>
          <a class="btn btn-outline-light btn-sm" href="<?php echo htmlspecialchars($user['google_classroom']); ?>" target="_blank">Open Google Classroom</a>
        <?php endif; ?>
        <a class="btn btn-accent btn-sm" href="<?php echo rtrim($baseUrl, '/'); ?>/todos.php?user_id=<?php echo (int)$user['id']; ?>">View todos</a>
      </div>

      <?php if (!empty($_SESSION['user_id']) && $_SESSION['user_id'] !== $user['id']): ?>
        <?php if (!empty($_GET['msg_sent'])): ?>
          <div class="alert alert-success">Message sent.</div>
        <?php endif; ?>
        <form method="post" action="<?php echo rtrim($baseUrl, '/'); ?>/send_message.php" class="mt-3">
          <input type="hidden" name="recipient_id" value="<?php echo (int)$user['id']; ?>">
          <div class="mb-2">
            <label class="form-label">Chat link (optional)</label>
            <input class="form-control" name="chat_link" placeholder="https://... (e.g., Landbot link)">
          </div>
          <div class="mb-2">
            <label class="form-label">Message (optional)</label>
            <textarea class="form-control" name="body" placeholder="Hi, I'd like to connect..."></textarea>
          </div>
          <div>
            <button class="btn btn-sm btn-accent" type="submit">Send chat link</button>
          </div>
        </form>
      <?php endif; ?>

      <p><strong>Rating:</strong> <?php echo $ratingStats['cnt'] ? number_format($ratingStats['avg_rating'],1) . ' / 5 (' . $ratingStats['cnt'] . ' reviews)' : 'No ratings yet'; ?></p>

      <?php if (!empty($_SESSION['user_id'])): ?>
        <form method="post" action="/rate.php" class="d-flex align-items-center gap-2">
          <input type="hidden" name="user_id" value="<?php echo (int)$user['id']; ?>">
          <label class="small mb-0">Rate:</label>
          <select name="rating" class="form-select form-select-sm" style="width:120px; display:inline-block;">
            <?php for ($i=5;$i>=1;$i--): ?>
              <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
            <?php endfor; ?>
          </select>
          <button class="btn btn-sm btn-accent">Submit</button>
        </form>
      <?php endif; ?>
    </div>
  </div>

  <hr>
  <h3>To-do list</h3>
  <p><a class="btn btn-sm btn-accent" href="<?php echo rtrim($baseUrl, '/'); ?>/todos.php?user_id=<?php echo (int)$user['id']; ?>">View todos</a></p>

</div>

<?php include __DIR__ . '/templates/footer.php'; ?>
