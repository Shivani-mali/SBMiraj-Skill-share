<?php
// Auto-detect a sensible base URL (root-relative) so the project works in a subfolder.
$scriptDir = rtrim(dirname($_SERVER['SCRIPT_NAME']), '\\/');
$baseUrl = $scriptDir === '' || $scriptDir === '/' ? '/' : $scriptDir;
$pageTitle = 'Skill Share - Connect with Instructors';
include __DIR__ . '/templates/header.php';
include __DIR__ . '/templates/navbar.php';
?>

<header class="bg-primary text-white py-5">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-md-7">
        <h1 class="display-5 fw-bold">Skill Share</h1>
        <p class="lead">Find and connect with instructors for Java, Python, and C. Browse profiles, join classrooms, and manage tasks.</p>
        <p class="mb-4">
          <a class="btn btn-light btn-lg me-2" href="<?php echo rtrim($baseUrl, '/'); ?>/register.php">Get Started</a>
          <a class="btn btn-outline-light btn-lg" href="<?php echo rtrim($baseUrl, '/'); ?>/login.php">Sign in</a>
        </p>
      </div>
      <div class="col-md-5">
        <div class="card shadow-sm">
          <div class="card-body">
            <h5 class="card-title">Search instructors</h5>
            <form method="get" action="<?php echo rtrim($baseUrl, '/'); ?>/search.php">
              <div class="mb-3">
                <input type="search" name="q" class="form-control form-control-lg" placeholder="Search by name, username or email" required>
              </div>
              <div class="d-grid">
                <button class="btn btn-primary btn-lg">Search</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</header>

<main class="container my-5">
  <div class="row">
    <div class="col-md-8">
      <h2>Why Skill Share?</h2>
      <p>Connect with skilled instructors, check ratings, join their Google Classroom, and manage your study tasks — all in one place.</p>
      <div class="row">
        <div class="col-sm-4">
          <div class="p-3 border rounded text-center">
            <h3>Java</h3>
            <p class="small text-muted">In-depth Java instructors and resources.</p>
          </div>
        </div>
        <div class="col-sm-4">
          <div class="p-3 border rounded text-center">
            <h3>Python</h3>
            <p class="small text-muted">Practical Python tutors and classes.</p>
          </div>
        </div>
        <div class="col-sm-4">
          <div class="p-3 border rounded text-center">
            <h3>C</h3>
            <p class="small text-muted">Systems and C programming experts.</p>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Join a classroom</h5>
          <p class="card-text">Register and add your Google Classroom link so students can join your classes directly.</p>
          <a href="<?php echo rtrim($baseUrl, '/'); ?>/register.php" class="btn btn-primary">Become an instructor</a>
        </div>
      </div>
    </div>
  </div>
</main>

<?php include __DIR__ . '/templates/footer.php'; ?>
