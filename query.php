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



	function get_main ($pdo, $day_id) {
		$query = "SELECT * FROM `subjects_in_day` WHERE `day_id` = $day_id";
		$cat = $pdo->query($query);
		while ($res = $cat->fetch()) {
			$data[] = $res;
		}
		return $data;
	}
	$main = get_main($pdo, $nday);



	function get_sid($c)
	{
		foreach ($c as $value) {
			$sid[] = $value['subject_id'];
		}
		return $sid;
	};
	$sid = get_sid($main);



	function get_tid($c)
	{
		foreach ($c as $value) {
			$tid[] = $value['time_id'];
		}
		return $tid;
	}
	$tid = get_tid($main);



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



	function get_homework($pdo, $day_id)
	{
		$query = "SELECT homework FROM day WHERE id = $day_id";
		$cat = $pdo->query($query);
		while ($data = $cat->fetch()) {
			$homework = $data['homework'];
		}
		$exp = explode('^^^', $homework);
		for ($i=0; $i < count($exp); $i++) { 
			$exp2[] = explode(':::', $exp[$i]);
		}
		foreach ($exp2 as $value) {
			$complete[$value['0']] = $value['1'];
		}
		return $complete;
	}
	$hw = get_homework($pdo, $nday);



	function processing_homework($pdo, $homework)
	{
		$query = "SELECT * FROM subject";
		$cat = $pdo->query($query);

		while ($data = $cat->fetch()) {
			foreach ($homework as $key => $value) {
				if ($key == $data['id']) {
					$proc[$data['name']] = $value;
				}
			}
		}
		return $proc;
	}
	$homework = processing_homework($pdo, $hw);



	function print_subjects($subjlist, $time, $homework)
	{
		if ($subjlist == NULL) {
			echo "<div class='point'><div class='point_title'><p class='name'> Выходной </p><i class='time'></i></div><div class='point_desc'><p></p></div></div>";
		}
		else {
			$count = count($subjlist);
			for ($i=0; $i < $count; $i++) {
				$data[$i]['subject'] = $subjlist[$i];
				$data[$i]['start'] = $time['start'][$i];
				$data[$i]['end'] = $time['end'][$i];
				$data[$i]['homework'] = $homework[$data[$i]['subject']];
			}
			//echo "<pre>"; print_r($data); echo "</pre>";
			foreach ($data as $value) {
            	echo "<div class='point'><div class='point_title'><p class='name'>" . $value['subject'] . "</p><i class='time'>" . $value['start'] . " - " .$value['end'] . "</i></div><div class='point_desc'><p>" . $value['homework'] . "</p></div></div>";
        	};
		}
	}
?>