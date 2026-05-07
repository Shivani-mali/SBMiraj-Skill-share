<?php
require_once __DIR__ . '/helpers.php';

if (!empty($_SESSION['user_id'])) {
    redirect('/profile.php?id=' . $_SESSION['user_id']);
}

$pageTitle = 'Login';
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
<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-6 col-lg-5">
      <div class="card">
        <div class="card-body">
          <h2 class="mb-3">Sign in</h2>
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
            <?php
            require_once __DIR__ . '/helpers.php';

            if (!empty($_SESSION['user_id'])) {
                redirect('/profile.php?id=' . $_SESSION['user_id']);
            }

            $pageTitle = 'Login';
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

            <div class="container mt-5">
              <div class="row justify-content-center">
                <div class="col-md-6 col-lg-4">
                  <div class="card shadow-sm">
                    <div class="card-body">
                      <div class="text-center mb-3">
                        <h2 class="fw-bold">Welcome back</h2>
                        <p class="small text-muted">Sign in to continue to Skill Share</p>
                      </div>

                      <?php if ($error): ?>
                        <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
                      <?php endif; ?>

                      <form method="post" novalidate>
                        <div class="mb-3">
                          <label class="form-label">Username</label>
                          <input class="form-control" name="username" required placeholder="your.username">
                        </div>
                        <div class="mb-3">
                          <label class="form-label">Password</label>
                          <input class="form-control" name="password" type="password" required placeholder="••••••••">
                        </div>
                        <div class="d-grid mb-2">
                          <button class="btn btn-accent btn-lg" type="submit">Sign in</button>
                        </div>
                        <div class="text-center small text-muted">
                          Don't have an account? <a href="<?php echo rtrim($baseUrl, '/'); ?>/register.php">Create one</a>
                        </div>
                      </form>

                      <hr>
                      <div class="text-center small text-muted">Or sign in with</div>
                      <div class="d-flex gap-2 justify-content-center mt-2">
                        <a class="btn btn-outline-light btn-sm" href="#"><i class="bi bi-google"></i> Google</a>
                        <a class="btn btn-outline-light btn-sm" href="#"><i class="bi bi-github"></i> GitHub</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
