<?php
	require_once 'query.php';
	include 'header.php';
	require_once 'db_connect.php';
	$host  = $_SERVER['HTTP_HOST'];
	$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
	$extra = 'index.php';
	if (is_null($_SESSION['user'])) {
		
		header("Location: http://$host$uri/$extra");
	}
	elseif (is_null($_REQUEST['date'])) {
		header("Location: http://$host$uri/$extra");
	}
	else {
		$date = $_REQUEST['date'];
		$query = "DELETE FROM `subjects_in_day` WHERE `subjects_in_day`.`day_id` = (SELECT `day`.`id` FROM `day` WHERE `day`.`date` = '$date')";
		$cat = $pdo->prepare($query);
		$cat->execute();
		echo "<main class='container'><div class='row'><div class='col-lg-12'><div class='main round pad_b_10'><h1 class='text-center title'> День успешно удалён</h1><p class='point_desc'>Теперь вы можете перейти <a href='http://" . $_SERVER['HTTP_HOST'] ."'>на главную</a></p>";
	}
	include_once 'footer.php';
?>