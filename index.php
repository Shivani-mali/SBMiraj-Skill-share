<?php
// Auto-detect a sensible base URL (root-relative) so the project works in a subfolder.
$scriptDir = rtrim(dirname($_SERVER['SCRIPT_NAME']), '\\/');
$baseUrl = $scriptDir === '' || $scriptDir === '/' ? '/' : $scriptDir;
$pageTitle = 'Skill Share - Connect with Instructors';
// Ensure helpers/session available so we can show personalized content on the landing page
require_once __DIR__ . '/helpers.php';
$currentUser = getCurrentUser();
include __DIR__ . '/templates/header.php';
include __DIR__ . '/templates/navbar.php';
?>

<header class="hero hero-large">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-md-7">
        <h1 class="display-3 fw-bold hero-title">Skill Share</h1>
        <p class="lead hero-lead">Find and connect with instructors for Java, Python, and C. Browse profiles, join classrooms, and manage tasks. Skill Share is a community-first platform focused on mutual learning — you can add your Google Classroom link when registering.</p>
        <p class="mb-4">
          <?php if ($currentUser): ?>
            <span class="d-block mb-2">Welcome back, <?php echo htmlspecialchars($currentUser['full_name']); ?>.</span>
            <a class="btn btn-accent btn-lg me-2" href="<?php echo rtrim($baseUrl, '/'); ?>/profile.php?id=<?php echo (int)$currentUser['id']; ?>">My Profile</a>
            <a class="btn btn-outline-light btn-lg" href="<?php echo rtrim($baseUrl, '/'); ?>/logout.php">Logout</a>
          <?php else: ?>
            <a class="btn btn-accent btn-lg me-2" href="<?php echo rtrim($baseUrl, '/'); ?>/register.php">Get Started</a>
            <a class="btn btn-outline-light btn-lg" href="<?php echo rtrim($baseUrl, '/'); ?>/login.php">Sign in</a>
          <?php endif; ?>
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
                <button class="btn btn-accent btn-lg">Search</button>
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
      <h2 class="section-title">Why Skill Share?</h2>
      <p class="lead">Connect with peers, check ratings, join Google Classrooms, and manage your study tasks — all in one community-first place.</p>

      <div class="row categories g-4">
        <div class="col-sm-4">
          <div class="category-card text-center p-4">
            <div class="category-icon">J</div>
              <h3>Java</h3>
              <p class="small ">In-depth Java instructors, patterns, and resources for building robust applications.</p>
              <div class="mt-3"><a class="btn btn-outline-light btn-sm" href="<?php echo rtrim($baseUrl, '/'); ?>/category.php?cat=java">View Java</a></div>
          </div>
        </div>
        <div class="col-sm-4">
          <div class="category-card text-center p-4">
            <div class="category-icon">P</div>
            <h3>Python</h3>
            <p class="small">Practical Python tutors, scripting, data, and web frameworks for hands-on learning.</p>
            <div class="mt-3"><a class="btn btn-outline-light btn-sm" href="<?php echo rtrim($baseUrl, '/'); ?>/category.php?cat=python">View Python</a></div>
          </div>
        </div>
        <div class="col-sm-4">
          <div class="category-card text-center p-4">
            <div class="category-icon">C</div>
            <h3>C</h3>
            <p class="small">Systems programming and C fundamentals — memory, performance and low-level design.</p>
            <div class="mt-3"><a class="btn btn-outline-light btn-sm" href="<?php echo rtrim($baseUrl, '/'); ?>/category.php?cat=c">View C</a></div>
          </div>
        </div>
      </div>

      <section class="about-us mt-5">
        <h2 class="section-title">About Us</h2>
        <div class="card p-4">
          <p>
            Skill Share is a community-led platform built for learners and educators to discover one another, share resources, and manage study tasks collaboratively. We believe that learning is most effective when it's social — when knowledge is exchanged, context is shared, and practical tasks are assigned and tracked.
          </p>
          <p>
            Our core principles are:
          </p>
          <ul>
            <li><strong>Mutual connection:</strong> There is no separate "instructor" onboarding — anyone can register and optionally provide a Google Classroom link so that learners can connect directly.</li>
            <li><strong>Transparency:</strong> Profiles surface experience, categories, and classroom links so students can make informed choices.</li>
            <li><strong>Task-driven learning:</strong> Built-in todo lists let learners and instructors coordinate learning objectives, schedule tasks, and mark progress.</li>
            <li><strong>Privacy and safety:</strong> We ask for minimal data — only what helps people connect and learn. Classroom links are optional and stored as provided by the user.</li>
          </ul>
          <p>
            We’re focused on practical outcomes: helping you find a study partner, a tutor, or a small classroom where you can apply what you learn. Whether you’re preparing for exams, building a portfolio project, or exploring a new language, Skill Share brings community and structure together.
          </p>
        </div>
      </section>
    </div>
    <div class="col-md-4">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Join a classroom</h5>
          <p class="card-text">Register and add your Google Classroom link so students can join your classes directly.</p>
          <a href="<?php echo rtrim($baseUrl, '/'); ?>/register.php" class="btn btn-primary">Register</a>
        </div>
      </div>
      <div class="card mt-4">
        <div class="card-body">
          <h5 class="card-title">YouTube Channels</h5>
          <p class="card-text">Curated list of helpful YouTube channels and playlists collected for each subject. Open the channel collection to explore video tutorials and walkthroughs.</p>
          <a href="<?php echo rtrim($baseUrl, '/'); ?>/youtube.html" class="btn btn-outline-light">Open YouTube list</a>
        </div>
      </div>
    </div>
  </div>
</main>

<?php include __DIR__ . '/templates/footer.php'; ?>
