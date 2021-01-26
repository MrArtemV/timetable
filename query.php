<?php
	require_once 'db_connect.php';

	function get_now_day($pdo)
	{
		$now = date('Y-m-d', time());
		$query = "SELECT * FROM day";
		$cat = $pdo->query($query);
		while ($res = $cat->fetch()) {
			if ($res['date'] == $now) {
				$lid = $res['id'];
				return $lid;
			}
		}
	}

	function get_subject($pdo, $id)
	{
		$query = "SELECT * FROM subject";
		$cat = $pdo->query($query);
		while ($subject = $cat->fetch()) {
			$name[] = $subject['name'];
			$iddb[] = $subject['id'];
		}
		foreach ($id as $value) {
			for ($i=0; $i < count($iddb); $i++) {
				if ($value == $iddb[$i]) {
					$subjlist[] = $name[$value -1];
				}
			}
		}
		return $subjlist;
	}

	function get_dow($pdo, $id) {
		$query = "SELECT DAYOFWEEK(date) as dow FROM day";
		$cat = $pdo->query($query);
		while ($date = $cat->fetch()) {
			switch ($date['dow']) {
				case '1': $dow[] = "Понедельник"; 	break;
				case '2': $dow[] = "Вторник"; 		break;
				case '3': $dow[] = "Среда"; 		break;
				case '4': $dow[] = "Четверг"; 		break;
				case '5': $dow[] = "Пятница"; 		break;
				case '6': $dow[] = "Суббота"; 		break;
				case '7': $dow[] = "Воскресенье"; 	break;
				default:  $dow[] = "NULL"; 		break;
			}
		}
		return $dow[$id - 1];
	}
?>
