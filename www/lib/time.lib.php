<?
if(!defined('_INPLUS_')) { exit; }

function makeTimecode($flag = true) {

	$now = date("ymdHis").substr(microtime(), 2, 3);

	if($flag) {	
		// 연
		$tmp = substr($now, 0, 2) * 1 + 65;
		$code = chr($tmp);

		// 월
		$tmp = substr($now, 2, 2) * 1 + 65;
		$code.= chr($tmp);

		// 일
		$code.= substr($now, 4, 2);

		// 시
		$tmp = substr($now, 6, 2) * 1 + 65;
		$code.= chr($tmp);

		// 분
		$code.= substr($now, 8, 1);

		$tmp = substr($now, 9, 1) * 1 + 65;
		$code.= chr($tmp);

		// 초
		$tmp = substr($now, 10, 1) * 1 + 65;
		$code.= chr($tmp);

		$code.= substr($now, 11, 1);

		// 마이크로초
		$tmp = substr($now, 12, 1) * 1 + 65;
		$code.= chr($tmp);

		$code.= substr($now, 13, 2);
	} else { $code = $now; }

	return $code;
}

function getPrevDate($days, $today = '') {
	if(!$today) { $today = date('Y-m-d'); }

	$now_time = strtotime($today.' 00:00:00');
	$prev_time = $now_time - $days * 24 * 3600;
	$prev_date = date('Y-m-d', $prev_time);

	return $prev_date;
}

function getTimeTableArray($s_time = '00:00', $e_time = '24:00', $gap = 30) {

	$arr = explode(':', $s_time);
	$s_time = $arr[0] * 60 + $arr[1];

	$arr = explode(':', $e_time);
	$e_time = $arr[0] * 60 + $arr[1];

	unset($arr);

	if ($s_time < $e_time) {
		while($s_time <= $e_time) {
			$hour = floor($s_time / 60);
			if($hour < 10) { $hour = '0'.$hour; }

			$minute = $s_time % 60;
			if($minute < 10) { $minute = '0'.$minute; }

			$time = $hour.':'.$minute;
			$arr[$time] = $time;

			$s_time += $gap;
		}
	} else if ($s_time > $e_time) {
		// 조건 추가입니다.
		// 일정이 새벽까지 이어지는 경우가 있어서 추가합니다.
		$tmp_time = 0;
		while($tmp_time < $e_time) {
			$hour = floor($tmp_time / 60);
			if($hour < 10) { $hour = '0'.$hour; }

			$minute = $tmp_time % 60;
			if($minute < 10) { $minute = '0'.$minute; }

			$time = $hour.':'.$minute;
			$arr[$time] = $time;

			$tmp_time += $gap;
		}

		while($s_time <= 1440) {
			$hour = floor($s_time / 60);
			if($hour < 10) { $hour = '0'.$hour; }

			$minute = $s_time % 60;
			if($minute < 10) { $minute = '0'.$minute; }

			$time = $hour.':'.$minute;
			$arr[$time] = $time;

			$s_time += $gap;
		}

	}

	return $arr;
}

function makeCalendarArray($date = '', $flag_normal = false) {

	if(!$date) { $date = date('Y-m-d'); }
	$this_time = strtotime($date);
	unset($cal_arr);

	$cal_title = date('Y.m', $this_time);
	$cal_arr['title'] = $cal_title;

	$this_year = date('Y', $this_time);
	$this_month = date('m', $this_time);
	$this_day = '1';

	$start_time = mktime(0, 0, 0, $this_month, 1, $this_year);
	$prev_time = mktime(0, 0, 0, $this_month - 1, $this_day, $this_year);
	$cal_arr['prev_date'] = date('Y-m-d', $prev_time);

	$s_week = date('w', $start_time);

	$next_time = mktime(0, 0, 0, $this_month + 1, $this_day, $this_year);
	$cal_arr['next_date'] = date('Y-m-d', $next_time);
	$last_time = mktime(0, 0, 0, $this_month + 1, 1, $this_year) - 24 * 3600;

	$now_time = strtotime(date('Y-m-d'));
	$seq_time = $start_time - $s_week * 24 * 3600;

	unset($date_arr);
	for($i = 0 ; $i < 6 ; $i++) {
		for($j = 0 ; $j < 7 ; $j++) {
			$day = date('d', $seq_time);
			$week = date('w', $seq_time);

			$class = '';
			if($seq_time > $last_time) {
				$flag_break = true;
				$seq_time -= 24 * 3600;
				break;			
			}
			else if($seq_time < $start_time) {
				$day = '';
				$class = '';
			}
			else if($seq_time < $now_time && !$flag_normal) {
				$class = 'none';
			}
			else if($seq_time == $now_time) {
				$class = 'today on';
			}
			else if($week == 0) {
				$class = 'sun';
			}
			else if($week == 6) {
				$class = 'sat';
			}

			$date_arr[$i][$j] = array(
				'time'	=> $seq_time,
				'date'	=> date('Y-m-d', $seq_time),
				'day'	=> $day,
				'week'	=> $week,
				'class'	=> $class
			);

			//echo "before : ".date('Y-m-d', $seq_time)."\n";
			$seq_time += 24 * 3600;
			//echo "after : ".date('Y-m-d', $seq_time)."\n\n";
		}

		if($flag_break) {

			if($j > 0) {

				for($k = $j ; $k < 7 ; $k++) {
					$seq_time += 24 * 3600;

					$day = '';
					$week = date('w', $seq_time);
					$class = 'none';

					$date_arr[$i][$k] = array(
						'time'	=> $seq_time,
						'date'	=> date('Y-m-d', $seq_time),
						'day'	=> $day,
						'week'	=> $week,
						'class'	=> $class
					);
				}
			}


			break;
		}
	}

	/*
	for($i = $j ; $i < 7 ; $i++) {
		$seq_time += 24 * 3600;

		$day = date('d', $seq_time);
		$week = date('w', $seq_time);
		$class = 'none';

		$date_arr[$i][$j] = array(
			'time'	=> $seq_time,
			'date'	=> date('Y-m-d', $seq_time),
			'day'	=> $day,
			'week'	=> $week,
			'class'	=> $class
		);
	}
	*/


	$cal_arr['date'] = $date_arr;

	return $cal_arr;
}

function makeWeekArray($date = '', $flag_normal = false) {

	if(!$date) { $date = date('Y-m-d'); }
	$this_time = strtotime($date);
	unset($cal_arr);

	// 주의 첫번째 날
	$w = date('w', $this_time);
	$first_time = $this_time - $w * 24 * 3600;
	$last_time = $first_time + 7 * 24 * 3600;

	$wk_title = date('Y년 m월 d일', $first_time).' ~ '.date('Y년 m월 d일', $last_time - 24 * 3600);
	$cal_arr['title'] = $wk_title;

	$prev_time = $this_time - 7 * 24 * 3600;
	$cal_arr['prev_date'] = date('Y-m-d', $prev_time);

	$next_time = $this_time + 7 * 24 * 3600;
	$cal_arr['next_date'] = date('Y-m-d', $next_time);

	global $week_arr;

	unset($date_arr);
	$seq_time = $first_time;
	for($i = 0 ; $i < 7 ; $i++) {

		$class = '';	
		if($i == 0) {
			$class = 'sun';
		}
		else if($i == 6) {
			$class = 'sat';
		}

		

		$date_arr[$i] = array(
			'time'	=> $seq_time,
			'date'	=> date('Y-m-d', $seq_time),
			'date2'	=> date('m.d', $seq_time),
			'txt_week'	=> $week_arr[$i],
			'class'	=> $class
		);

		$seq_time += 24 * 3600;
	}

	$cal_arr['date'] = $date_arr;

	return $cal_arr;
}

function getRemainTime($std_time, $now_time = '') {
	if(!$now_time) {
		$now_time = time();
	}

	$gap_time = $std_time - $now_time;
	if($gap_time < 0) {
		$p = true;
		$gap_time = $gap_time * (-1);
	}

	$d = floor($gap_time / 60 / 60 / 24);
	$h = floor($gap_time / 60 / 60 - $d * 24);
	$m = floor($gap_time / 60 - $d * 24 * 60 - $h * 60);
	$s = floor($gap_time - $d * 24 * 60 * 60 - $h * 60 * 60 - $m * 60);

	$arr = array(
		'p'	=> $p,
		'd'	=> $d,
		'h'	=> $h,
		'm'	=> $m,
		's'	=> $s
	);

	return $arr;
}

function beautifyDateTime($time, $flag_timestamp = false) {

	global $week_arr;

	if(!$flag_timestamp) {
		$time = strtotime($time);
	}

	$week = date('w', $time);
	$result = date('Y년 m월 d일', $time).' ('.$week_arr[$week].') '.date('H:i', $time);

	return $result;
}
?>