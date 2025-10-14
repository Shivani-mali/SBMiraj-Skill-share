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
$baseUrl = '/';
include __DIR__ . '/templates/header.php';
include __DIR__ . '/templates/navbar.php';

// Fetch average rating
$r = $pdo->prepare('SELECT AVG(rating) AS avg_rating, COUNT(*) AS cnt FROM ratings WHERE user_id = :id');
$r->execute([':id' => $id]);
$ratingStats = $r->fetch();

?>
<div class="container mt-4">
  <div class="row">
    <div class="col-md-4">
      <?php if (!empty($user['profile_image'])): ?>
        <img src="<?php echo htmlspecialchars($user['profile_image']); ?>" alt="Profile" class="img-fluid rounded">
      <?php else: ?>
        <div class="bg-secondary text-white p-4 text-center">No image</div>
      <?php endif; ?>
    </div>
    <div class="col-md-8">
      <h2><?php echo htmlspecialchars($user['full_name']); ?> <small class="text-muted">@<?php echo htmlspecialchars($user['username']); ?></small></h2>
      <p><?php echo nl2br(htmlspecialchars($user['bio'])); ?></p>
      <p><strong>Category:</strong> <?php echo htmlspecialchars($user['category']); ?></p>
      <?php if (!empty($user['google_classroom'])): ?>
        <p><a class="btn btn-outline-primary" href="<?php echo htmlspecialchars($user['google_classroom']); ?>" target="_blank">Open Google Classroom</a></p>
      <?php endif; ?>

      <p><strong>Rating:</strong> <?php echo $ratingStats['cnt'] ? number_format($ratingStats['avg_rating'],1) . ' / 5 (' . $ratingStats['cnt'] . ' reviews)' : 'No ratings yet'; ?></p>

      <?php if (!empty($_SESSION['user_id'])): ?>
        <form method="post" action="/rate.php">
          <input type="hidden" name="user_id" value="<?php echo (int)$user['id']; ?>">
          <div class="mb-2">Rate this user:</div>
          <div class="mb-2">
            <select name="rating" class="form-select" style="width:120px; display:inline-block;">
              <?php for ($i=5;$i>=1;$i--): ?>
                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
              <?php endfor; ?>
            </select>
            <button class="btn btn-sm btn-primary ms-2">Submit</button>
          </div>
        </form>
      <?php endif; ?>

    </div>
  </div>

  <hr>
  <h3>To-do list</h3>
  <p><a class="btn btn-sm btn-secondary" href="/todos.php?user_id=<?php echo (int)$user['id']; ?>">View todos</a></p>

</div>

<?php include __DIR__ . '/templates/footer.php'; ?>
