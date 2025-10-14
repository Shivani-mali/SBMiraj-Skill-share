<?php
require_once __DIR__ . '/db-connection.php';

$q = isset($_GET['q']) ? trim($_GET['q']) : '';

// Basic page title and include header/footer if present
$pageTitle = 'Search: ' . ($q ?: '');
$baseUrl = '/';
include __DIR__ . '/templates/header.php';
include __DIR__ . '/templates/navbar.php';

echo '<div class="container mt-4">';
echo '<h1>Search results</h1>';

if ($q === '') {
    echo '<p>Please enter a search query.</p>';
} else {
    try {
        $results = searchProfiles($q, 100);
    } catch (Exception $e) {
        echo '<div class="alert alert-danger">Search failed: ' . htmlspecialchars($e->getMessage()) . '</div>';
        $results = [];
    }

    if (count($results) === 0) {
        echo '<p>No profiles found for <strong>' . htmlspecialchars($q) . '</strong>.</p>';
    } else {
        echo '<p>Found ' . count($results) . ' profiles for <strong>' . htmlspecialchars($q) . '</strong>:</p>';
        echo '<div class="list-group">';
        foreach ($results as $row) {
            $name = htmlspecialchars($row['full_name'] ?? $row['username'] ?? 'Unknown');
            $username = htmlspecialchars($row['username'] ?? '');
            $bio = htmlspecialchars($row['bio'] ?? '');
            $id = (int)($row['id'] ?? 0);

            echo '<a class="list-group-item list-group-item-action" href="' . rtrim($baseUrl, '/') . '/profile.php?id=' . $id . '">';
            echo '<div class="fw-bold">' . $name . ' <small class="text-muted">@' . $username . '</small></div>';
            <?php
            require_once __DIR__ . '/db-connection.php';

            $q = isset($_GET['q']) ? trim($_GET['q']) : '';

            // Basic page title and include header/footer if present
            $pageTitle = 'Search: ' . ($q ?: '');
            $baseUrl = '/';
            include __DIR__ . '/templates/header.php';
            include __DIR__ . '/templates/navbar.php';

            echo '<div class="container mt-4">';
            echo '<h1>Search results</h1>';

            if ($q === '') {
                echo '<p>Please enter a search query.</p>';
            } else {
                try {
                    $results = searchProfiles($q, 100);
                } catch (Exception $e) {
                    echo '<div class="alert alert-danger">Search failed: ' . htmlspecialchars($e->getMessage()) . '</div>';
                    $results = [];
                }

                if (count($results) === 0) {
                    echo '<p>No profiles found for <strong>' . htmlspecialchars($q) . '</strong>.</p>';
                } else {
                    echo '<p>Found ' . count($results) . ' profiles for <strong>' . htmlspecialchars($q) . '</strong>:</p>';
                    echo '<div class="list-group">';
                    foreach ($results as $row) {
                        $name = htmlspecialchars($row['full_name'] ?? $row['username'] ?? 'Unknown');
                        $username = htmlspecialchars($row['username'] ?? '');
                        $bio = htmlspecialchars($row['bio'] ?? '');
                        $id = (int)($row['id'] ?? 0);

                        echo '<a class="list-group-item list-group-item-action" href="' . rtrim($baseUrl, '/') . '/profile.php?id=' . $id . '">';
                        echo '<div class="fw-bold">' . $name . ' <small class="text-muted">@' . $username . '</small></div>';
                        <?php
                        require_once __DIR__ . '/db-connection.php';

                        $q = isset($_GET['q']) ? trim($_GET['q']) : '';

                        // Basic page title and include header/footer if present
                        $pageTitle = 'Search: ' . ($q ?: '');
                        $baseUrl = '/';
                        include __DIR__ . '/templates/header.php';
                        include __DIR__ . '/templates/navbar.php';

                        echo '<div class="container mt-4">';
                        echo '<h1>Search results</h1>';

                        if ($q === '') {
                            echo '<p>Please enter a search query.</p>';
                        } else {
                            try {
                                $results = searchProfiles($q, 100);
                            } catch (Exception $e) {
                                echo '<div class="alert alert-danger">Search failed: ' . htmlspecialchars($e->getMessage()) . '</div>';
                                $results = [];
                            }

                            if (count($results) === 0) {
                                echo '<p>No profiles found for <strong>' . htmlspecialchars($q) . '</strong>.</p>';
                            } else {
                                echo '<p>Found ' . count($results) . ' profiles for <strong>' . htmlspecialchars($q) . '</strong>:</p>';
                                echo '<div class="list-group">';
                                foreach ($results as $row) {
                                    $name = htmlspecialchars($row['full_name'] ?? $row['username'] ?? 'Unknown');
                                    $username = htmlspecialchars($row['username'] ?? '');
                                    $bio = htmlspecialchars($row['bio'] ?? '');
                                    $id = (int)($row['id'] ?? 0);

                                    echo '<a class="list-group-item list-group-item-action" href="' . rtrim($baseUrl, '/') . '/profile.php?id=' . $id . '">';
                                    echo '<div class="fw-bold">' . $name . ' <small class="text-muted">@' . $username . '</small></div>';
                                    <?php
                                    require_once __DIR__ . '/db-connection.php';

                                    $q = isset($_GET['q']) ? trim($_GET['q']) : '';

                                    // Basic page title and include header/footer
                                    $pageTitle = 'Search: ' . ($q ?: '');
                                    $baseUrl = '/';
                                    include __DIR__ . '/templates/header.php';
                                    include __DIR__ . '/templates/navbar.php';

                                    echo '<div class="container mt-4">';
                                    echo '<h1>Search results</h1>';

                                    if ($q === '') {
                                        echo '<p>Please enter a search query.</p>';
                                    } else {
                                        try {
                                            $results = searchProfiles($q, 100);
                                        } catch (Exception $e) {
                                            echo '<div class="alert alert-danger">Search failed: ' . htmlspecialchars($e->getMessage()) . '</div>';
                                            $results = [];
                                        }

                                        if (count($results) === 0) {
                                            echo '<p>No profiles found for <strong>' . htmlspecialchars($q) . '</strong>.</p>';
                                        } else {
                                            echo '<p>Found ' . count($results) . ' profiles for <strong>' . htmlspecialchars($q) . '</strong>:</p>';
                                            echo '<div class="list-group">';
                                            foreach ($results as $row) {
                                                $name = htmlspecialchars($row['full_name'] ?? $row['username'] ?? 'Unknown');
                                                $username = htmlspecialchars($row['username'] ?? '');
                                                $bio = htmlspecialchars($row['bio'] ?? '');
                                                $id = (int)($row['id'] ?? 0);

                                                echo '<a class="list-group-item list-group-item-action" href="' . rtrim($baseUrl, '/') . '/profile.php?id=' . $id . '">';
                                                echo '<div class="fw-bold">' . $name . ' <small class="text-muted">@' . $username . '</small></div>';
                                                <?php
                                                require_once __DIR__ . '/db-connection.php';

                                                $q = isset($_GET['q']) ? trim($_GET['q']) : '';

                                                // Basic page title and include header/footer
                                                $pageTitle = 'Search: ' . ($q ?: '');
                                                $baseUrl = '/';
                                                include __DIR__ . '/templates/header.php';
                                                include __DIR__ . '/templates/navbar.php';

                                                echo '<div class="container mt-4">';
                                                echo '<h1>Search results</h1>';

                                                if ($q === '') {
                                                    echo '<p>Please enter a search query.</p>';
                                                } else {
                                                    try {
                                                        $results = searchProfiles($q, 100);
                                                    } catch (Exception $e) {
                                                        echo '<div class="alert alert-danger">Search failed: ' . htmlspecialchars($e->getMessage()) . '</div>';
                                                        $results = [];
                                                    }

                                                    if (count($results) === 0) {
                                                        echo '<p>No profiles found for <strong>' . htmlspecialchars($q) . '</strong>.</p>';
                                                    } else {
                                                        echo '<p>Found ' . count($results) . ' profiles for <strong>' . htmlspecialchars($q) . '</strong>:</p>';
                                                        echo '<div class="list-group">';
                                                        foreach ($results as $row) {
                                                            $name = htmlspecialchars($row['full_name'] ?? $row['username'] ?? 'Unknown');
                                                            $username = htmlspecialchars($row['username'] ?? '');
                                                            $bio = htmlspecialchars($row['bio'] ?? '');
                                                            $id = (int)($row['id'] ?? 0);

                                                            echo '<a class="list-group-item list-group-item-action" href="' . rtrim($baseUrl, '/') . '/profile.php?id=' . $id . '">';
                                                            echo '<div class="fw-bold">' . $name . ' <small class="text-muted">@' . $username . '</small></div>';
                                                            <?php
                                                            require_once __DIR__ . '/db-connection.php';

                                                            $q = isset($_GET['q']) ? trim($_GET['q']) : '';

                                                            // Basic page title and include header/footer
                                                            $pageTitle = 'Search: ' . ($q ?: '');
                                                            $baseUrl = '/';
                                                            include __DIR__ . '/templates/header.php';
                                                            include __DIR__ . '/templates/navbar.php';

                                                            // Perform search if query provided
                                                            $results = [];
                                                            if ($q !== '') {
                                                                    try {
                                                                            $results = searchProfiles($q, 100);
                                                                    } catch (Exception $e) {
                                                                            $errorMsg = $e->getMessage();
                                                                    }
                                                            }
                                                            ?>

                                                            <div class="container mt-4">
                                                                <h1>Search results</h1>

                                                                <?php if ($q === ''): ?>
                                                                    <p>Please enter a search query in the search box.</p>
                                                                <?php else: ?>
                                                                    <?php if (!empty($errorMsg)): ?>
                                                                        <div class="alert alert-danger"><?php echo htmlspecialchars($errorMsg); ?></div>
                                                                    <?php else: ?>
                                                                        <?php if (count($results) === 0): ?>
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
                                                                <?php endif; ?>

                                                            </div>

                                                            <?php include __DIR__ . '/templates/footer.php'; ?>
