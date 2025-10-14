<?php
/**
 * Site navbar. Expects $baseUrl to be set by including page (or header.php sets it).
 */
if (!isset($baseUrl)) {
    $baseUrl = '/';
}
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="<?php echo rtrim($baseUrl, '/'); ?>/">skill-share</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="mainNavbar">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="<?php echo rtrim($baseUrl, '/'); ?>/">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo rtrim($baseUrl, '/'); ?>/about.php">About Us</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo rtrim($baseUrl, '/'); ?>/subjects.php">Subjects</a>
        </li>
      </ul>

      <form class="d-flex" method="get" action="<?php echo rtrim($baseUrl, '/'); ?>/search.php">
        <input class="form-control me-2" type="search" name="q" placeholder="Search profiles" aria-label="Search" required>
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>

<!-- end navbar -->
