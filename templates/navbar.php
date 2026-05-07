<?php
if (!isset($baseUrl)) {
  // header.php should set $baseUrl; fallback to '/'
  $baseUrl = '/';
}
// Ensure session helpers available for auth links
if (file_exists(__DIR__ . '/../helpers.php')) {
    require_once __DIR__ . '/../helpers.php';
}
?>
<nav class="navbar navbar-expand-lg navbar-dark">
  <div class="container">
  <a class="navbar-brand fw-bold" href="<?php echo rtrim($baseUrl, '/'); ?>/">Skill Share</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="mainNavbar">
      

      <form class="d-flex me-3" method="get" action="<?php echo rtrim($baseUrl, '/'); ?>/search.php">
        <div class="input-group">
          <input class="form-control" type="search" name="q" placeholder="Search profiles" aria-label="Search" required>
          <button class="btn btn-outline-light" type="submit">Search</button>
        </div>
      </form>

      <div class="d-flex align-items-right">
        <a class="btn btn-outline-info btn-sm me-2" href="https://landbot.online/v3/H-3179163-A23F9XK4G6Q7IGN1/index.html" target="_blank" rel="noopener noreferrer">Chat</a>
        <?php if (!empty($_SESSION['user_id'])): ?>
          <a class="btn btn-outline-light btn-sm me-2" href="<?php echo rtrim($baseUrl, '/'); ?>/profile.php?id=<?php echo (int)$_SESSION['user_id']; ?>">My Profile</a>
          <a class="btn btn-light btn-sm" href="<?php echo rtrim($baseUrl, '/'); ?>/logout.php">Logout</a>
        <?php else: ?>
          <a class="btn btn-outline-light btn-sm me-2" href="<?php echo rtrim($baseUrl, '/'); ?>/login.php">Login</a>
          <a class="btn btn-light btn-sm" href="<?php echo rtrim($baseUrl, '/'); ?>/register.php">Register</a>
        <?php endif; ?>
      </div>

    </div>
  </div>
</nav>

<!-- end navbar -->
