<?php
/**
 * Global header template
 * Usage:
 *   $pageTitle = 'Page title';
 *   $baseUrl = '/'; // optional, set if project is in a subfolder
 *   include __DIR__ . '/header.php';
 */

if (!isset($pageTitle)) {
	$pageTitle = '';
}
if (!isset($baseUrl)) {
	// Derive a safe base URL (root-relative) if not provided
	$baseUrl = '/';
}
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<title><?php echo htmlspecialchars($pageTitle ?: 'Skill Share'); ?></title>

	<!-- Favicon (place a favicon.ico or favicon.png in assets/images/) -->
	<link rel="icon" href="<?php echo rtrim($baseUrl, '/'); ?>/assets/images/favicon.ico" type="image/x-icon">

	<!-- Bootstrap 5 CSS (CDN) -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUa6mY5n3o2Q2Y3V5QZ6m0b8L1QZ2e1Z6k1Yk1r1e1Yk1r1e1Yk1r1e1Yk1" crossorigin="anonymous">

	<!-- Optional: Bootstrap Icons -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

	<!-- Local stylesheet (create assets/css/style.css if you need custom styles) -->
	<link rel="stylesheet" href="<?php echo rtrim($baseUrl, '/'); ?>/assets/css/style.css">

	<!-- Meta for theme color on mobile -->
	<meta name="theme-color" content="#ffffff">

	<!-- Modernizr (optional) - uncomment if needed and add file to assets/js/ -->
	<!-- <script src="<?php echo rtrim($baseUrl, '/'); ?>/assets/js/modernizr.js"></script> -->

	<!-- Place any head-level scripts or tags below -->
	<?php
	// Developers can inject additional head content by setting $headExtra (string)
	if (!empty($headExtra) && is_string($headExtra)) {
		echo $headExtra;
	}
	?>
</head>
<body>

<!-- Begin page wrapper -->

