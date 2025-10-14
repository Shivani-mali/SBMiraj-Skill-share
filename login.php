<?php
require_once __DIR__ . '/helpers.php';

if (!empty($_SESSION['user_id'])) {
    redirect('/profile.php?id=' . $_SESSION['user_id']);
}

$pageTitle = 'Login';
$baseUrl = '/';
include __DIR__ . '/templates/header.php';
include __DIR__ . '/templates/navbar.php';

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    $pdo = getPDO();
    $stmt = $pdo->prepare('SELECT id, password_hash FROM users WHERE username = :u');
    $stmt->execute([':u' => $username]);
    $user = $stmt->fetch();
    if ($user && password_verify($password, $user['password_hash'])) {
        $_SESSION['user_id'] = (int)$user['id'];
        redirect('/profile.php?id=' . $_SESSION['user_id']);
    } else {
        $error = 'Invalid username or password.';
    }
}

?>
<div class="container mt-4">
  <h1>Login</h1>
  <?php if ($error): ?>
    <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
  <?php endif; ?>
  <form method="post">
    <div class="mb-3">
      <label class="form-label">Username</label>
      <input class="form-control" name="username" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Password</label>
      <input class="form-control" name="password" type="password" required>
    </div>
    <button class="btn btn-primary" type="submit">Login</button>
  </form>
</div>

<?php include __DIR__ . '/templates/footer.php'; ?>
