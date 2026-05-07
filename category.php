<?php
require_once __DIR__ . '/helpers.php';

$cat = strtolower(trim($_GET['cat'] ?? ''));
if (!in_array($cat, ['java','python','c'])) {
    http_response_code(400);
    echo 'Invalid category';
    exit;
}

$pageTitle = 'Category: ' . ucfirst($cat);
include __DIR__ . '/templates/header.php';
include __DIR__ . '/templates/navbar.php';

$pdo = getPDO();
$stmt = $pdo->prepare('SELECT id, full_name, username, bio, profile_image FROM users WHERE category = :cat ORDER BY full_name');
$stmt->execute([':cat' => $cat]);
$users = $stmt->fetchAll();

?>
<main class="container my-5">
  <h1>People in <?php echo htmlspecialchars(ucfirst($cat)); ?></h1>
  <p class="lead">Browse profiles for the selected category. Click a profile to view details or connect.</p>

  <div class="row g-3">
    <?php if (empty($users)): ?>
      <div class="col-12">
        <div class="alert alert-info">No users found in this category yet.</div>
      </div>
    <?php endif; ?>

    <?php foreach ($users as $u): ?>
      <div class="col-md-6 col-lg-4">
        <div class="card p-3">
          <div class="d-flex gap-3 align-items-start">
            <img src="<?php echo htmlspecialchars($u['profile_image'] ?: 'assets/images/avatar-placeholder.png'); ?>" alt="avatar" style="width:72px;height:72px;object-fit:cover;border-radius:8px;border:1px solid rgba(255,255,255,0.04)">
            <div>
              <h5 class="mb-1"><?php echo htmlspecialchars($u['full_name']); ?></h5>
              <div class="small text-muted">@<?php echo htmlspecialchars($u['username']); ?></div>
              <p class="small mt-2 text-truncate" style="max-width:100%"><?php echo htmlspecialchars($u['bio'] ?? ''); ?></p>
              <div class="mt-2">
                <a class="btn btn-sm btn-accent" href="<?php echo rtrim($baseUrl, '/'); ?>/profile.php?id=<?php echo (int)$u['id']; ?>">View profile</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>

</main>

<?php include __DIR__ . '/templates/footer.php'; ?>
