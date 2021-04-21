<?php
	session_start();
	require_once 'db_connect.php';



	// Находит ID сегодняшнего дня
	function get_now_day($pdo)
	{
		$now = date('Y-m-d'); // сегодняшняя дата в формате SQL
		$query = "SELECT `id` FROM `day` WHERE `date` = '$now'"; // Запрос айди даты в БД
		$cat = $pdo->query($query); //запрос
		return $cat->fetch(PDO::FETCH_ASSOC)['id']; //возвращает айди даты
	}
	$nday = get_now_day($pdo);



	// Собирает нужную информацию: дату, название урока, время начала урока, время конца урока, домашку
	function get_all($pdo, $day_id)
	{
		$query = "SELECT day.date, subject.name, time.start, time.end, subjects_in_day.homework FROM subjects_in_day INNER JOIN day ON subjects_in_day.day_id = day.id INNER JOIN subject ON subjects_in_day.subject_id = subject.id INNER JOIN time ON subjects_in_day.time_id = time.id WHERE day_id = $day_id"; // запрос инфы в БД
		$cat = $pdo->query($query); // запрос
		while ($result = $cat->fetch(PDO::FETCH_ASSOC)) {
			$data[] = $result; // сбор результата запроса в один массив 
		}
		return $data; //возвращает всю инфу
	}
	$data = get_all($pdo, $nday);


	// Находит сегодняшний день недели
	function get_dow($pdo, $day_id) {
		$query = "SELECT DAYOFWEEK(date) as dow FROM day WHERE id = $day_id "; // запрос дня недели в БД
		$cat = $pdo->query($query); //запрос
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
			} // выдаёт название дня недели по айди дня недели
		}
		return $dow; // возвращает название дня недели
	}



	function cache_subject($pdo)
	{
		$query = "SELECT subject.name FROM subject";
		$cat = $pdo->query($query);
		while ($res = $cat->fetch()) {
			$data[] = $res['name']; // $data - массив со всеми уроками
		}
		$time = time();
		$data['timestamp'] = $time;
		$json = json_encode($data, JSON_PRETTY_PRINT);
		$f = fopen('subjects.json', 'w') or die("ERROR");
		fwrite($f, $json);
		fclose($f);		
	}



	function get_subject($pdo)
	{
		$ntime = time();
		$f = fopen('subjects.json', 'r');
		$json = fread($f, filesize('subjects.json'));
		$data = json_decode($json, true);
		$timediff = $ntime - $data['timestamp'];
		if ($timediff > 86400) {
			cache_subject($pdo);
		}
		unset($data['timestamp']);
		return $data;
	}
	$sublist = get_subject($pdo);



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



	// проверка дня на заполненность
	function check_day($pdo, $date)
	{
		$query = "SELECT COUNT(*) > 0 AS 'filled' FROM subjects_in_day WHERE day_id = (SELECT day.id FROM `day` WHERE day.date = '$date') AND subject_id IS NOT NULL";
		$cat = $pdo->query($query);
		$res = $cat->fetch(PDO::FETCH_ASSOC)['filled'];
		return $res;
	}



	// вывод меню для редактирования дня
	function print_day_edit_menu($pdo, $filled, $sublist, $date)
	{
		if (!$filled) {
			echo "
				<p class='point_desc'>Предупреждение: данный день ещё не был заполнен. Вы заполняете этот день впервые!</p>
				<form action='insert.php' method='POST'>
					<input type='hidden' name='date' value='$date'>
					<input type='hidden' name='filled' value='0'>
					<div class='form-group' id='form'>
						<div class='row ml-1 mr-1 underline'>
							<div class='col-lg-6'>
								<p class='name'>Выберите урок:</p>
								<select class='form-control' name='subject[]' id='sub'>";
								for ($i=0; $i < count($sublist); $i++) { 
									echo "<option value='$i'>". $sublist[$i] . "</option>";
								}
								echo "</select>
							</div>
							<div class='col-lg-6'>
								<p class='name'>ДЗ:</p>
								<textarea class='form-control' name='hw[]'></textarea>
							</div>
						</div>
					</div>
					<button type='submit' class='btn btn-primary mb-2 mr-3 float-right'>отправить</button>
				</form>
			<button class='btn btn-primary mb-2 ml-3' id='new_row' title='добавить строку'>+</button>";
		}
		else {
			echo "coming soon...";
		}
	}



	function insert($data, $pdo)
	{
		/*echo "<pre>"; print_r($data); echo "</pre>";*/
		if (!$filled) {
			$query = "INSERT INTO subjects_in_day VALUES";
			for ($i=0; $i < count($data['subject']); $i++) { 
				$query .= "(NULL, (SELECT day.id FROM day WHERE day.date = '{$data['date']}')," . ($data['subject'][$i] +1) . "," . ($i+1) . " , '{$data['hw'][$i]}'),";
			}
			$query = rtrim($query, ',');
			$cat = $pdo->prepare($query);
			$cat->execute();

			/*$host  = $_SERVER['HTTP_HOST'];
			$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
			$extra = 'index.php';
			header("Location: http://$host$uri/$extra");*/
		}
	}
?>