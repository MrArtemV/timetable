<?php
	session_start();
	require_once 'db_connect.php';

	

	// Находит ID сегодняшнего дня
	function get_now_day($pdo)
	{
		$now = date('Y-m-d');
		$query = "SELECT `id` FROM `day` WHERE `date` = '$now'";
		$cat = $pdo->query($query);
		return $cat->fetch(PDO::FETCH_ASSOC)['id'];
	}
	$nday = get_now_day($pdo);



	// Собирает нужную информацию: дату, название урока, время начала урока, время конца урока, домашку
	function get_all($pdo, $day_id)
	{
		$query = "SELECT day.date, subject.name, time.start, time.end, subject.teacher, subjects_in_day.homework FROM subjects_in_day INNER JOIN day ON subjects_in_day.day_id = day.id INNER JOIN subject ON subjects_in_day.subject_id = subject.id INNER JOIN time ON subjects_in_day.time_id = time.id WHERE day_id = $day_id ORDER BY day.id";
		$cat = $pdo->query($query);
		while ($result = $cat->fetch(PDO::FETCH_ASSOC)) {
			$data[] = $result;
		}
		return $data;
	}
	$data = get_all($pdo, $nday);


	// Находит сегодняшний день недели
	function get_dow($pdo, $day_id) {
		$query = "SELECT DAYOFWEEK(date) as dow FROM day WHERE id = $day_id ";
		$cat = $pdo->query($query);
		while ($result = $cat->fetch()) {
			switch ($result['dow']) {
				case '1': $dow = "Воскресенье"; 	break;
				case '2': $dow = "Понедельник"; 	break;
				case '3': $dow = "Вторник"; 		break;
				case '4': $dow = "Среда";			break;
				case '5': $dow = "Четверг"; 		break;
				case '6': $dow = "Пятница"; 		break;
				case '7': $dow = "Суббота"; 		break;
				default:  $dow = "NULL"; 			break;
			}
		}
		return $dow;
	}



	// Выводит список информации с применением Bootstrap
	function print_subjects($data)
	{
		if (is_null($data)) {
			echo "<div class='point'><div class='point_title'><p class='name'> Выходной </p></div></div>";			
		}
		else {
			foreach ($data as $value) {
				echo "<div class='point'><div class='point_title'><p class='name'>" . $value['name'] . "</p><i class='time'>" . $value['start'] . " - " .$value['end'] . "</i></div><div class='point_desc'><p>" . $value['homework'] . "</p></div></div>";
			}
		}
	}



	//Авторизация
	function login($pdo, $name, $pass)
	{
			//переменные для переадресации
		$host  = $_SERVER['HTTP_HOST'];
		$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		$extra = 'index.php';

		$query = "SELECT name, password FROM users WHERE name = '$name'";
		$cat = $pdo->query($query);
		while ($res = $cat->fetch()) {
			if ($name == $res['name'] && md5($pass) == $res['password']) {
				$_SESSION['user'] = $name;
				header("Location: http://$host$uri/$extra");
			}
			else {
				return "Неправильный пароль!";
			}
		}
	}
?>