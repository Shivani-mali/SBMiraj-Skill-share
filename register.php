<?php
require_once __DIR__ . '/helpers.php';

$pageTitle = 'Register';
include __DIR__ . '/templates/header.php';
include __DIR__ . '/templates/navbar.php';

$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    $full_name = trim($_POST['full_name'] ?? '');
    $bio = trim($_POST['bio'] ?? '');
    $category = in_array($_POST['category'] ?? '', ['java','python','c']) ? $_POST['category'] : 'python';
    $google_classroom = trim($_POST['google_classroom'] ?? '');

    if ($username === '' || $password === '' || $full_name === '') {
        $errors[] = 'Username, password and full name are required.';
    }

    if (empty($errors)) {
        $pdo = getPDO();
        // Check unique username
        $stmt = $pdo->prepare('SELECT id FROM users WHERE username = :username');
        $stmt->execute([':username' => $username]);
        if ($stmt->fetch()) {
            $errors[] = 'Username already taken.';
        }
    }

    if (empty($errors)) {
        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        // handle profile image upload
        $profile_image = null;
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
    }

    if (empty($errors)) {
        $stmt = getPDO()->prepare('INSERT INTO users (username, password_hash, full_name, bio, category, google_classroom, profile_image) VALUES (:username, :ph, :fn, :bio, :cat, :gc, :img)');
        $stmt->execute([
            ':username' => $username,
            ':ph' => $password_hash,
            ':fn' => $full_name,
            ':bio' => $bio,
            ':cat' => $category,
            ':gc' => $google_classroom ?: null,
            ':img' => $profile_image,
        ]);
        $_SESSION['user_id'] = getPDO()->lastInsertId();
        redirect('/profile.php?id=' . $_SESSION['user_id']);
    }
}

?>
<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-7 col-lg-6">
      <div class="card">
        <div class="card-body">
          <h2 class="mb-3">Create an account</h2>
          <?php if (!empty($errors)): ?>
            <div class="alert alert-danger"><?php echo implode('<br>', array_map('htmlspecialchars', $errors)); ?></div>
          <?php endif; ?>

          <form method="post" enctype="multipart/form-data">
            <div class="mb-3">
              <label class="form-label">Username</label>
              <input class="form-control" name="username" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Password</label>
              <input class="form-control" name="password" type="password" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Full name</label>
              <input class="form-control" name="full_name" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Bio</label>
              <textarea class="form-control" name="bio"></textarea>
            </div>
            <div class="mb-3">
              <label class="form-label">Category</label>
              <select name="category" class="form-select">
                <option value="python">Python</option>
                <option value="java">Java</option>
                <option value="c">C</option>
              </select>
            </div>
            <div class="mb-3">
              <label class="form-label">Google Classroom (optional)</label>
              <input class="form-control" name="google_classroom" placeholder="https://classroom.google.com/...">
            </div>
            <div class="mb-3">
              <label class="form-label">Profile image (jpg/png)</label>
              <input class="form-control" type="file" name="profile_image" accept="image/*">
            </div>
            <div class="d-grid">
              <button class="btn btn-accent" type="submit">Register</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include __DIR__ . '/templates/footer.php'; ?>
