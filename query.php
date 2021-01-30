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
	$nday = get_now_day($pdo);



	function get_dow($pdo, $id) {
		$query = "SELECT DAYOFWEEK(date) as dow FROM day";
		$cat = $pdo->query($query);
		while ($date = $cat->fetch()) {
			switch ($date['dow']) {
				case '1': $dow[] = "Воскресенье"; 	break;
				case '2': $dow[] = "Понедельник"; 	break;
				case '3': $dow[] = "Вторник"; 		break;
				case '4': $dow[] = "Среда"; 		break;
				case '5': $dow[] = "Четверг"; 		break;
				case '6': $dow[] = "Пятница"; 		break;
				case '7': $dow[] = "Суббота"; 		break;
				default:  $dow[] = "NULL"; 			break;
			}
		}
		return $dow[$id - 1];
	}



	function get_compare ($pdo, $day_id) {
		$query = "SELECT * FROM `subjects_in_day` WHERE `day_id` = $day_id";
		$cat = $pdo->query($query);
		while ($res = $cat->fetch()) {
			$data[] = $res;
		}
		return $data;
	}
	$compare = get_compare($pdo, $nday);



	function get_sid($c)
	{
		foreach ($c as $value) {
			$sid[] = $value['subject_id'];
		}
		return $sid;
	};
	$sid = get_sid($compare);



	function get_tid($c)
	{
		foreach ($c as $value) {
			$tid[] = $value['time_id'];
		}
		return $tid;
	}
	$tid = get_tid($compare);



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
	$subj = get_subject($pdo, $sid);



	function get_time($pdo, $id)
	{
		$query = "SELECT * FROM time";
		$cat = $pdo->query($query);
		while ($data = $cat->fetch()) {
			$start[] = $data['start'];
			$end[] = $data['end'];
			$iddb[] = $data['id'];
		}
		foreach ($id as $value) {
			for ($i=0; $i < count($iddb); $i++) {
				if ($value == $iddb[$i]) {
					$timelist['start'][] = $start[$value -1];
					$timelist['end'][] = $end[$value - 1];
				}
			}
		}
		return $timelist;
	}
	$time = get_time($pdo, $tid);



	function print_subjects($subjlist, $time)
	{
		
		if ($subjlist == NULL) {
			echo "<div class='point'><div class='point_title'><p class='name'> Выходной </p><i class='time'></i></div><div class='point_desc'><p></p></div></div>";
		}
		else {
			$start = $time['start'];
			$end = $time['end'];
			foreach ($subjlist as $value) {
            	echo "<div class='point'><div class='point_title'><p class='name'>" . $value ."</p><i class='time'>$start[0] - $end[0]</i></div><div class='point_desc'><p>Сделать дз</p></div></div>";
        	};
		}
	}
?>