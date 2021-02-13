<?php
	session_start();
	if ($_SESSION['user'] == NULL) {
		$host  = $_SERVER['HTTP_HOST'];
		$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		$extra = 'index.php';
		header("Location: http://$host$uri/$extra");
	}
	include 'header.php';
	require_once 'db_connect.php';
	require_once 'query.php';
?>
<main class="container">
	<div class="row">
		<div class="col-lg-12">
			<div class="main round pad_b_10">
			<?php if ($_REQUEST['date'] == NULL) 
				echo "<h1 class='text-center title'>Панель управления</h1><div class='container'><div class='row'><form action='admin.php' class='form-inline text-center mr-auto ml-auto'><div class='col-lg-4'><p class='point_desc'>отредактировать день (выберите дату):</p></div><div class='col-lg-5'><input type='date' class='form-control' name='date'></div><div class='col-lg-3'><button type='submit' class='btn btn-primary'>Отправить</button></div></form></div></div>";
			else {
				print_day_edit_menu($pdo, $_REQUEST['date']);
			}?>
			</div>
		</div>
	</div>
</main>
<?php
	include 'footer.php';
?>