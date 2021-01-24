<?php
	require_once 'db_connect.php';

	function now_day($pdo)
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
			$name = $subject['name'];
		}
		return $name[$id - 1];

	}

	function get_dow($pdo, $id) {
		$query = "SELECT * FROM day";
		$cat = $pdo->query($query);
		while ($date = $cat->fetch()) {
			$exp = explode('-', $date['date']);
			$year = $exp[0];
			$month = $exp[1];
			$day = $exp[2];
			$dow[] = date('l', mktime(0, 0, 0, $month, $day, $year));
		}
		return $dow[$id - 1];
	}
?>
