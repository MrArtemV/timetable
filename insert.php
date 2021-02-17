<?php
	session_start();
	include 'header.php';
	require_once 'db_connect.php';
	require_once 'query.php';
	if ($_SESSION['user'] == NULL) {
		$host  = $_SERVER['HTTP_HOST'];
		$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		$extra = 'index.php';
		header("Location: http://$host$uri/$extra");
	}
	elseif ($_REQUEST['subject0'] == NULL) {
		$host  = $_SERVER['HTTP_HOST'];
		$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		$extra = 'index.php';
		header("Location: http://$host$uri/$extra");				
	}
	elseif ($_REQUEST['subject0'] != NULL) {
		
	}
	
?>