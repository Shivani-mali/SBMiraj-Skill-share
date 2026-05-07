<?php
if (!isset($baseUrl)) {
    // header.php should set $baseUrl; fallback to '/'
    $baseUrl = '/';
}
?>

	<!-- Optional page footer content can go here -->

	<!-- Bootstrap JS (Bundle with Popper) -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

	<!-- Local JS (optional) -->
	<script src="<?php echo rtrim($baseUrl, '/'); ?>/assets/js/main.js"></script>

</body>
</html>

