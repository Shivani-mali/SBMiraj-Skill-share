<?php
require_once __DIR__ . '/helpers.php';
requireLogin();

$user = getCurrentUser();
$pdo = getPDO();

// Basic actions: add, toggle, delete
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    if ($action === 'add') {
        $title = trim($_POST['title'] ?? '');
        $notes = trim($_POST['notes'] ?? '');
        $due = $_POST['due_date'] ?? null;
        if ($title !== '') {
            $stmt = $pdo->prepare('INSERT INTO todos (user_id, title, notes, due_date) VALUES (:uid, :title, :notes, :due)');
            $stmt->execute([':uid' => $user['id'], ':title' => $title, ':notes' => $notes ?: null, ':due' => $due ?: null]);
        }
    } elseif ($action === 'toggle') {
        $id = (int)($_POST['id'] ?? 0);
        $t = $pdo->prepare('UPDATE todos SET is_done = 1 - is_done WHERE id = :id AND user_id = :uid');
        $t->execute([':id' => $id, ':uid' => $user['id']]);
    } elseif ($action === 'delete') {
        $id = (int)($_POST['id'] ?? 0);
        $d = $pdo->prepare('DELETE FROM todos WHERE id = :id AND user_id = :uid');
        $d->execute([':id' => $id, ':uid' => $user['id']]);
    }
    redirect('/todos.php');
}

$pageTitle = 'My Todos';
include __DIR__ . '/templates/header.php';
include __DIR__ . '/templates/navbar.php';

$stmt = $pdo->prepare('SELECT * FROM todos WHERE user_id = :uid ORDER BY created_at DESC');
$stmt->execute([':uid' => $user['id']]);
$todos = $stmt->fetchAll();

?>
<div class="container mt-4">
  <h1>My Todos</h1>

  <form method="post" class="mb-4">
    <input type="hidden" name="action" value="add">
    <div class="row g-2">
      <div class="col-md-6">
        <input class="form-control" name="title" placeholder="New task title" required>
      </div>
      <div class="col-md-4">
        <input class="form-control" name="due_date" type="datetime-local">
      </div>
      <div class="col-md-2 d-grid">
        <button class="btn btn-accent">Add</button>
      </div>
      <div class="col-12 mt-2">
        <textarea class="form-control" name="notes" placeholder="Notes (optional)"></textarea>
      </div>
    </div>
  </form>

  <div class="list-group">
    <?php foreach ($todos as $t): ?>
      <div class="list-group-item d-flex justify-content-between align-items-start">
        <div>
          <div class="d-flex align-items-center mb-1">
            <form method="post" style="display:inline-block; margin-right:8px;">
              <input type="hidden" name="action" value="toggle">
              <input type="hidden" name="id" value="<?php echo (int)$t['id']; ?>">
              <button class="btn btn-sm <?php echo $t['is_done'] ? 'btn-success' : 'btn-outline-secondary'; ?>"><?php echo $t['is_done'] ? 'Done' : 'Mark'; ?></button>
            </form>
            <strong><?php echo htmlspecialchars($t['title']); ?></strong>
          </div>
          <?php if ($t['due_date']): ?>
            <div class="small text-muted">Due: <?php echo htmlspecialchars($t['due_date']); ?></div>
          <?php endif; ?>
          <?php if ($t['notes']): ?>
            <div class="small mt-1"><?php echo htmlspecialchars($t['notes']); ?></div>
          <?php endif; ?>
        </div>
        <div>
          <form method="post" style="display:inline-block;">
            <input type="hidden" name="action" value="delete">
            <input type="hidden" name="id" value="<?php echo (int)$t['id']; ?>">
            <button class="btn btn-sm btn-danger">Delete</button>
          </form>
        </div>
      </div>
    <?php endforeach; ?>
  </div>

</div>

<?php include __DIR__ . '/templates/footer.php'; ?>
