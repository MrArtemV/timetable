<?php
	require_once 'db_connect.php';
    require_once 'query.php';
    include 'header.php';
    if ($_SESSION['user'] == NULL) {
		$host  = $_SERVER['HTTP_HOST'];
		$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		$extra = 'index.php';
		header("Location: http://$host$uri/$extra");
	}
?>
<main class='container'>
	<div class='row'>
		<div class='col-lg-12'>
			<div class='main round pad_b_10'>
				<div class='ml-3 mr-3'>
					<?php
						if (@$_REQUEST['pass']) {
							$name = $_SESSION['user'];
							$newpass = md5($_REQUEST['pass']);
							$query = "UPDATE `users` SET `password` = '$newpass' WHERE `name` = '$name'";
							$cat = $pdo->prepare($query);
							$cat->execute();
							echo "<h1 class='text-center title'> Пароль успешно изменён</h1><p class='point_desc'>Теперь вы можете перейти <a href='http://{$_SERVER['HTTP_HOST']}'>на главную</a></p>";
						}
						else {
							echo "<h1 class='text-center title'>Смена пароля</h1><form action='' class='form-inline text-center mr-3 ml-3' method='POST'><div class='container'><div class='row'><div class='col-lg'><p class='point_desc'>Новый пароль:</p></div><div class='col-lg'><input type='text' class='form-control' name='pass'></div><div class='col-lg'><button type='submit' class='btn btn-primary'>Отправить</button></div></div></div></form>";
						}
					?>
				</div>
			</div>
		</div>
	</div>
</main>
<?
	include 'footer.php';
?>