<?php
	$host  = $_SERVER['HTTP_HOST'];
	$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
	session_start();
	if ($_SESSION['user'] == NULL) {
		$extra = 'login.php';
		header("Location: http://$host$uri/$extra");
	}
	else {
		$extra = 'index.php';
		session_destroy();
		header("Location: http://$host$uri/$extra");	
	}

?>