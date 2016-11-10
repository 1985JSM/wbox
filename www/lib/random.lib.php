<?
if(!defined('_INPLUS_')) { exit; }

function makeRandNo($str_len) {
	srand ((double) microtime() * 1000000);

	$str_no = '';
	for($i = 0 ; $i < $str_len ; $i++) {
		$str_no .= mt_rand(0, 9);
	}

	return $str_no;
}

function makeRandChar($str_len, $flag = false) {
	srand ((double) microtime() * 1000000);

	$txt_char = '0123456789abcdefghijklmnopqrstuvwxyz';
	if($flag) { $txt_char .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ'; }

	$txt_arr = str_split($txt_char);
	$last_idx = sizeof($txt_arr) - 1;

	$str_char = '';
	for($i = 0 ; $i < $str_len ; $i++) {
		$str_char .= $txt_arr[mt_rand(0, $last_idx)];
	}

	return $str_char;
}
?>