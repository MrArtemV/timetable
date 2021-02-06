<?php
	$dsn = 'mysql:host=t92139pd.beget.tech;dbname=t92139pd_imetabl';
	$user = 't92139pd_imetabl';
	$pass = '';

	try {
		$pdo = new PDO($dsn, $user, $pass);	
	} catch (PDOException $e) {
		echo 'ERROR!! ' . $e->getMessage();
	}
?>
