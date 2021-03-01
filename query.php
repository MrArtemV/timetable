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
		$query = "SELECT day.date, subject.name, time.start, time.end, subjects_in_day.homework FROM subjects_in_day INNER JOIN day ON subjects_in_day.day_id = day.id INNER JOIN subject ON subjects_in_day.subject_id = subject.id INNER JOIN time ON subjects_in_day.time_id = time.id WHERE day_id = $day_id";
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



	function get_subject($pdo)
	{
		$query = "SELECT subject.name FROM subject";
		$cat = $pdo->query($query);
		while ($res = $cat->fetch()) {
			$data[] = $res['name'];
		}
		return $data;
	}
	$sublist = get_subject($pdo);



	function get_start_time($pdo)
	{
		$query = "SELECT time.start FROM time";
		$cat = $pdo->query($query);
		while ($res = $cat->fetch()) {
			$data[] = $res['start'];
		}
		return $data;
	}
	$timelist_s = get_start_time($pdo);



	function get_end_time($pdo)
	{
		$query = "SELECT time.end FROM time";
		$cat = $pdo->query($query);
		while ($res = $cat->fetch()) {
			$data[] = $res['end'];
		}
		return $data;
	}
	$timelist_e = get_end_time($pdo);



	// Выводит список информации с применением Bootstrap
	function print_subjects($data)
	{
		if (is_null($data)) {
			echo "<div class='point'><div class='point_title'><p class='name'> Выходной </p></div></div>";			
		}
		else {
			foreach ($data as $value) {
				echo "<div class='point'><div class='point_title'><p class='name'>" . $value['name'] . "</p><i class='time'>" . $value['start'] . " - " .$value['end'] . "</i></div><div class='point_desc'><i>" . $value['homework'] . "</i></div></div>";
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
			if ($name != $res['name'] || md5($pass) != $res['password']) {
				return "Неправильное имя или пароль!";
			}
			else {
				$_SESSION['user'] = $name;
				echo $_SESSION['name'];
				header("Location: http://$host$uri/$extra");
			}
		}
	}



	//Изменение данных введёного дня
	function print_day_edit_menu($pdo, $date, $sublist, $timelist_s, $timelist_e)
	{
		$query = "SELECT COUNT(`subject_id`) as 'count' FROM `subjects_in_day` WHERE `day_id` = (SELECT day.id FROM day WHERE day.date = '$date')";
		$cat = $pdo->query($query);
		$count = $cat->fetch(PDO::FETCH_ASSOC)['count'];
		echo "<form action='insert.php' method='POST'><input type='hidden' name='date' value='$date'>";
		for ($i=0; $i < $count; $i++) {

			echo "<div class='form-group underline'><div class='row ml-1 mr-1'><div class='col-lg-3'><p class='name'>Выберите урок:</p><select class='form-control' name='subject$i'>";
			for ($j=0; $j < count($sublist); $j++) { 
				echo "<option value='";
				echo $j+1;
				echo "'>{$sublist[$j]}</option>";
			}
			echo "</select></div><div class='col-lg-3'><p class='name'>Выберите начало урока:</p><select class='form-control' name='ts$i'>";
			for ($j=0; $j < count($timelist_s); $j++) { 
				echo "<option value='";
				echo $j+1;
				echo "'>{$timelist_s[$j]}</option>";
			}
			echo "</select></div><div class='col-lg-3'><p class='name'>Выберите конец урока:</p><select class='form-control' name='te$i'>";
			for ($j=1; $j <= count($timelist_e); $j++) { 
				echo "<option value='";
				echo $j+1;
				echo "'>{$timelist_e[$j]}</option>";
			}
			echo "</select></div><div class='col-lg-3'><p class='name'>ДЗ</p><textarea class='form-control' name='hw$i'></textarea></div></div></div><br>";

		}
		echo "<button type='submit' class='btn btn-primary mb-1 ml-1 '>отправить</button></form>";
	}



	function insert_data($pdo, $data, $date)
	{
		$check_query = "SELECT * FROM subjects_in_day WHERE day_id = (SELECT id FROM day WHERE day.date = '$date')";
		$cat = $pdo->query($check_query);
		$pre_res = $cat->fetch();

		if ($pre_res) {
			$del_query = "DELETE FROM `subjects_in_day` WHERE `subjects_in_day`.`day_id` = (SELECT day.id FROM day WHERE day.date = '$date');";
			$cat = $pdo->exec($del_query);
			if ($cat) {
				$query = "INSERT INTO subjects_in_day VALUES (NULL, (SELECT day.id FROM day WHERE day.date = '$date'), '', '', '');";
			}
		}
		elseif (!$pre_res) {
			
		}
		
	}
?>