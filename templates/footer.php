<?php
if (!isset($baseUrl)) {
	$baseUrl = '/';
}
?>

	<!-- Optional page footer content can go here -->

	<!-- Bootstrap JS (Bundle with Popper) -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76A2z02tK3o2r6JrQ6bMZr3QZ6m0b8L1QZ2e1Z6k1Yk1r1e1Yk1r1e1Yk1r1e1Y" crossorigin="anonymous"></script>

	<!-- Local JS (optional) -->
	<script src="<?php echo rtrim($baseUrl, '/'); ?>/assets/js/main.js"></script>

</body>
</html>

