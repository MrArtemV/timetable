<?php
	$dsn = 'mysql:host=localhost;dbname=timetable';
	$user = 'root';
	$pass = '';

	try {
		$pdo = new PDO($dsn, $user, $pass);	
	} catch (PDOException $e) {
		echo 'ERROR!! ' . $e->getMessage();
	}
?>