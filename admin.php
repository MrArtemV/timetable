<?php
	session_start();
	if ($_SESSION['user'] == NULL) {
		$host  = $_SERVER['HTTP_HOST'];
		$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		$extra = 'index.php';
		header("Location: http://$host$uri/$extra");
	}
	include 'header.php';
?>
<main class="container">
	<div class="row">
		<div class="col-lg-12">
			<div class="main round">
				<h1 class="text-center title">Панель управления</h1>
				<div class="container">
					<div class="row">
						<div class="col-lg-4"><p>отредактировать день(выберите дату):</p></div>
						<div class="col-lg-5">
							<input type="date" class="form-control"></div>
						<div class="col-lg-3">
							<button type="submit" class="btn btn-primary">Отправить</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>
<?php
	include 'footer.php';
?>