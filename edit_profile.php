<?php
require_once __DIR__ . '/helpers.php';
requireLogin();

$user = getCurrentUser();
if (!$user) redirect('/login.php');

$pageTitle = 'Edit Profile';
include __DIR__ . '/templates/header.php';
include __DIR__ . '/templates/navbar.php';

$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $full_name = trim($_POST['full_name'] ?? '');
    $bio = trim($_POST['bio'] ?? '');
    $category = in_array($_POST['category'] ?? '', ['java','python','c']) ? $_POST['category'] : $user['category'];
    $google_classroom = trim($_POST['google_classroom'] ?? '');

    if ($full_name === '') $errors[] = 'Full name is required.';

    if (empty($errors)) {
        $pdo = getPDO();

        // handle image
        $profile_image = $user['profile_image'];
        if (!empty($_FILES['profile_image']['name'])) {
            $up = $_FILES['profile_image'];
            $ext = pathinfo($up['name'], PATHINFO_EXTENSION);
            $allowed = ['jpg','jpeg','png','gif'];
            if (!in_array(strtolower($ext), $allowed)) {
                $errors[] = 'Invalid image type.';
            } else {
                $dir = __DIR__ . '/uploads';
                if (!is_dir($dir)) mkdir($dir, 0755, true);
                $filename = uniqid('p_', true) . '.' . $ext;
                if (move_uploaded_file($up['tmp_name'], $dir . '/' . $filename)) {
                    $profile_image = 'uploads/' . $filename;
                }
            }
        }

        if (empty($errors)) {
            $stmt = $pdo->prepare('UPDATE users SET full_name = :fn, bio = :bio, category = :cat, google_classroom = :gc, profile_image = :img WHERE id = :id');
            $stmt->execute([
                ':fn' => $full_name,
                ':bio' => $bio,
                ':cat' => $category,
                ':gc' => $google_classroom ?: null,
                ':img' => $profile_image,
                ':id' => $user['id'],
            ]);
            redirect('/profile.php?id=' . $user['id']);
        }
    }
}

?>
<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-8 col-lg-6">
      <div class="card">
        <div class="card-body">
          <h2 class="mb-3">Edit Profile</h2>
          <?php if (!empty($errors)): ?>
            <div class="alert alert-danger"><?php echo implode('<br>', array_map('htmlspecialchars', $errors)); ?></div>
          <?php endif; ?>

          <form method="post" enctype="multipart/form-data">
            <div class="mb-3">
              <label class="form-label">Full name</label>
              <input class="form-control" name="full_name" value="<?php echo htmlspecialchars($user['full_name']); ?>">
            </div>
            <div class="mb-3">
              <label class="form-label">Bio</label>
              <textarea class="form-control" name="bio"><?php echo htmlspecialchars($user['bio']); ?></textarea>
            </div>
            <div class="mb-3">
              <label class="form-label">Category</label>
              <select name="category" class="form-select">
                <option value="python" <?php if($user['category']==='python') echo 'selected'; ?>>Python</option>
                <option value="java" <?php if($user['category']==='java') echo 'selected'; ?>>Java</option>
                <option value="c" <?php if($user['category']==='c') echo 'selected'; ?>>C</option>
              </select>
            </div>
            <div class="mb-3">
              <label class="form-label">Google Classroom</label>
              <input class="form-control" name="google_classroom" value="<?php echo htmlspecialchars($user['google_classroom']); ?>">
            </div>
            <div class="mb-3">
              <label class="form-label">Profile image</label>
              <input class="form-control" type="file" name="profile_image" accept="image/*">
            </div>
            <div class="d-grid">
              <button class="btn btn-accent">Save</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include __DIR__ . '/templates/footer.php'; ?>
