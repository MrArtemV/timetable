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
			<?php if (@$_REQUEST['date'] == NULL) {
				echo "<h1 class='text-center title'>Панель управления</h1><form action='admin.php' class='form-inline text-center mr-3 ml-3' method='POST'><div class='container'><div class='row'><div class='col-lg'><p class='point_desc'>отредактировать день (выберите дату):</p></div><div class='col-lg'><input type='date' class='form-control' name='date'></div><div class='col-lg'><button type='submit' class='btn btn-primary'>Отправить</button></div></div></form></div>";
				echo "<form action='delete.php' class='form-inline text-center mr-3 ml-3 mt-4' method='POST'><div class='container'><div class='row'><div class='col-lg'><p class='point_desc'>удалить день (выберите дату):</p></div><div class='col-lg'><input type='date' class='form-control' name='date'></div><div class='col-lg'><button type='submit' class='btn btn-primary'>Отправить</button></div></div></form></div>";
			}

			else {
				echo "<h1 class='text-center title'>Изменение дня</h1>";
				print_day_edit_menu($pdo, check_day($pdo, $_REQUEST['date']), $sublist, $_REQUEST['date']);
				
			}?>
			</div>
		</div>
	</div>
</main>
<script type="text/javascript" src="admin.js"></script>
<?php
	include 'footer.php';
?>