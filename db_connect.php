<?php
	$dsn = 'mysql:host=t92139pd.beget.tech;dbname=t92139pd_imetabl';
	$user = 't92139pd_imetabl';
	$pass = 'K_rZ2aVV!';

	try {
		$pdo = new PDO($dsn, $user, $pass);	
	} catch (PDOException $e) {
		echo 'ERROR!! ' . $e->getMessage();
	}
?>