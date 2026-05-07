<?php
require_once __DIR__ . '/db-connection.php';
if (file_exists(__DIR__ . '/helpers.php')) {
    require_once __DIR__ . '/helpers.php';
}

$q = isset($_GET['q']) ? trim($_GET['q']) : '';

$pageTitle = 'Search: ' . ($q ?: '');
include __DIR__ . '/templates/header.php';
include __DIR__ . '/templates/navbar.php';
?>

<div class="container mt-4">
    <h1>Search results</h1>

    <?php if ($q === ''): ?>
        <p>Please enter a search query.</p>
    <?php else:
        $errorMsg = '';
        try {
            $results = searchProfiles($q, 100);
        } catch (Exception $e) {
            $results = [];
            $errorMsg = $e->getMessage();
        }
    ?>

        <?php if ($errorMsg): ?>
            <div class="alert alert-danger"><?php echo htmlspecialchars($errorMsg); ?></div>
        <?php elseif (count($results) === 0): ?>
            <p>No profiles found for <strong><?php echo htmlspecialchars($q); ?></strong>.</p>
        <?php else: ?>
            <p>Found <?php echo count($results); ?> profiles for <strong><?php echo htmlspecialchars($q); ?></strong>:</p>
            <div class="list-group">
                <?php foreach ($results as $row):
                    $name = htmlspecialchars($row['full_name'] ?? $row['username'] ?? 'Unknown');
                    $username = htmlspecialchars($row['username'] ?? '');
                    $bio = htmlspecialchars($row['bio'] ?? '');
                    $id = (int)($row['id'] ?? 0);
                ?>
                <a class="list-group-item list-group-item-action" href="<?php echo rtrim($baseUrl, '/') . '/profile.php?id=' . $id; ?>">
                    <div class="fw-bold"><?php echo $name; ?> <small class="text-muted">@<?php echo $username; ?></small></div>
                    <?php if ($bio !== ''): ?><div class="small text-truncate" style="max-width:60%"><?php echo $bio; ?></div><?php endif; ?>
                </a>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

    <?php endif; ?>

</div>

<?php include __DIR__ . '/templates/footer.php'; ?>