<?
if(!defined('_INPLUS_')) { exit; }

function dbConnect() {
	if(!$conn = mysql_connect(_MYSQL_HOST_, _MYSQL_USER_, _MYSQL_PASSWORD_)) {
		printError('DB Connection Error');
		exit;
	}

	if(!$mysql = mysql_select_db(_MYSQL_DB_, $conn)) {
		printError('DB Selection Error');
		exit;
	}

	return $conn;
}

function dbQuery($query) {

	// DB 로그 기록
	if(defined('_FLAG_LOG_') && _FLAG_LOG_) { 

		if(!is_dir(_LOG_PATH_)) {
			@mkdir(_LOG_PATH_, 0707);
			@chmod(_LOG_PATH_, 0707);
		}
		$log_file = _LOG_PATH_.'/'.date('Y.m.d').'.txt';

		global $member;
		$mb_id = $member['mb_id'];
		if(!$mb_id) { $mb_id = 'guest'; }
		$time = date('Y-m-d H:i:s');
		$ip = $_SERVER['REMOTE_ADDR'];

		$content = '';
		if(file_exists($log_file)) {
			$content .= file_get_contents($log_file);
		}
		$content.= '['.$time.']['.$ip.']['.$mb_id.']	'.$query."\n";

		file_put_contents($log_file, $content);
	}
	
	$result = mysql_query($query, dbConnect());
	return $result;
}

function dbSelect($table, $field, $where, $order, $limit, $flag_debug = false) {
	$query = "SELECT $field FROM $table $where $order $limit;";
	if($flag_debug) { echo $query; }

	// 캐시 사용 여부
	$flag_use_cache = false;
	$flag_save_cache = false;
	
	if(defined('_FLAG_CACHE_') && _FLAG_CACHE_ && strpos($table, ' ') == '') { 	
		$dir_path = _CACHE_PATH_.'/'.$table;
		if(!is_dir($dir_path)) 		{
			@mkdir($dir_path, 0707);
			@chmod($dir_path, 0707);
		}

		$file_path = $dir_path.'/'.md5($query);
		if(file_exists($file_path) && time() - filemtime($file_path) < _FLAG_CACHE_TIME_) {
			$flag_load_cache = true;
			$flag_save_cache = false;
		}
		else {
			$flag_load_cache = false;
			$flag_save_cache = true;
		}
	}

	// 읽기 캐시
	if($flag_load_cache) {
		$content = file_get_contents($file_path);
		$content = base64_decode($content);
	    $list = unserialize($content);
	} 
	else {
		$result = dbQuery($query);	
		unset($list);
		while($data = mysql_fetch_array($result, MYSQL_ASSOC)) {
			$list[] = $data;
		}
	}

	// 저장 캐시
	if($flag_save_cache) {
		$content = serialize($list);
	    $content = base64_encode($content);

		file_put_contents($file_path, $content);
		@chmod($file_path, 0707);
	}
	
	return $list;
}

function dbOnce($table, $field, $where, $order, $flag_debug = false) {

	$query = "SELECT $field FROM $table $where $order limit 1;";
	if($flag_debug) { echo $query; }

	// 캐시 사용 여부
	$flag_use_cache = false;
	$flag_save_cache = false;
	
	if(defined('_FLAG_CACHE_') && _FLAG_CACHE_ && strpos($table, ' ') == '') { 	
		$dir_path = _CACHE_PATH_.'/'.$table;
		if(!is_dir($dir_path)) 		{
			@mkdir($dir_path, 0707);
			@chmod($dir_path, 0707);
		}

		$file_path = $dir_path.'/'.md5($query);
		if(file_exists($file_path) && time() - filemtime($file_path) < _FLAG_CACHE_TIME_) {
			$flag_load_cache = true;
			$flag_save_cache = false;
		}
		else {
			$flag_load_cache = false;
			$flag_save_cache = true;
		}
	}

	// 읽기 캐시
	if($flag_load_cache) {
		$content = file_get_contents($file_path);
		$content = base64_decode($content);
	    $data = unserialize($content);
	} 
	else {
		$result = dbQuery($query);	
		$data = mysql_fetch_array($result, MYSQL_ASSOC);
	}

	// 저장 캐시
	if($flag_save_cache) {
		$content = serialize($data);
	    $content = base64_encode($content);

		file_put_contents($file_path, $content);
		@chmod($file_path, 0707);
	}

	return $data;
}

function dbOnceByArray($table, $field, $arr, $order) {
	$where = "where 1 = 1 ";
	foreach($arr as $key => $val) {
		$where .= "and $key = '$val' ";
	}
	return dbOnce($table, $field, $where, $order);
}

function dbCount($table, $where, $group_field = '', $having = '') {
	$group = '';
	if($group_field) { 
		$query = "SELECT COUNT(*) AS cnt FROM (SELECT count($group_field) FROM $table $where group by $group_field $having) T ;";
	} else {
		$query = "SELECT count(*) AS cnt FROM $table $where ;";
	}

	// 캐시 사용 여부
	$flag_use_cache = false;
	$flag_save_cache = false;
	
	if(defined('_FLAG_CACHE_') && _FLAG_CACHE_ && strpos($table, ' ') == '') { 	
		$dir_path = _CACHE_PATH_.'/'.$table;
		if(!is_dir($dir_path)) 		{
			@mkdir($dir_path, 0707);
			@chmod($dir_path, 0707);
		}

		$file_path = $dir_path.'/'.md5($query);
		if(file_exists($file_path) && time() - filemtime($file_path) < _FLAG_CACHE_TIME_) {
			$flag_load_cache = true;
			$flag_save_cache = false;
		}
		else {
			$flag_load_cache = false;
			$flag_save_cache = true;
		}
	}

	// 읽기 캐시
	if($flag_load_cache) {
		$content = file_get_contents($file_path);
		$content = base64_decode($content);
	    $data = unserialize($content);
	} 
	else {
		$result = dbQuery($query);	
		$data = mysql_fetch_array($result);
	}

	// 저장 캐시
	if($flag_save_cache) {
		$content = serialize($data);
	    $content = base64_encode($content);

		file_put_contents($file_path, $content);
		@chmod($file_path, 0707);
	}
	
	return $data['cnt'];
}

function dbInsert($table, $field, $value) {
	$query = "INSERT INTO $table ($field) VALUES($value);";

	// 캐시 삭제
	if(defined('_FLAG_CACHE_') && _FLAG_CACHE_) { 	
		$dir_path = _CACHE_PATH_.'/'.$table;
		@unlink($dir_path);
	}

	$result = dbQuery($query);
}

function dbInsertByArray($table, $arr) {
	$field = '';
	$value = '';

	$seq = 0;
	foreach($arr as $key => $val) {
		if($seq > 0) { $field .= ','; $value .= ','; }
		$field .= $key;
		$value .= "'$val'";
		$seq++;
	}

	dbInsert($table, $field, $value);
}

function dbUpdate($table, $upt_str, $where) {
	$query = "UPDATE $table SET $upt_str $where;";

	// 캐시 삭제
	if(defined('_FLAG_CACHE_') && _FLAG_CACHE_) { 	
		$dir_path = _CACHE_PATH_.'/'.$table;
		@unlink($dir_path);
	}

	$result = dbQuery($query);
}

function dbUpdateByArray($table, $arr, $where) {
	$upt_str = '';

	$seq = 0;
	foreach($arr as $key => $val)
	{
		if(!$key) { continue; }
		if($seq > 0) { $upt_str .= ','; }
		$upt_str .= "$key = '$val'";
		$seq++;
	}
	dbUpdate($table, $upt_str, $where);
}
	
function dbDelete($table, $where) {
	$query = "delete from $table $where;";

	// 캐시 삭제
	if(defined('_FLAG_CACHE_') && _FLAG_CACHE_) { 	
		$dir_path = _CACHE_PATH_.'/'.$table;
		@unlink($dir_path);
	}

	$result = dbQuery($query);
}

function dbPassword($str) {
	$query = "SELECT PASSWORD('$str') AS pass;";
	$result = dbQuery($query);

	$data = mysql_fetch_array($result);

	return $data['pass'];
}

function putLog($str) {
	ob_start();
	print_r($str);
	$log_data = ob_get_contents();
	ob_end_clean();
	$log_path = $_SERVER['DOCUMENT_ROOT'].'/data/error_log/test';
	if(!is_dir($log_path)) {
		@mkdir($log_path, 0707);
		@chmod($log_path, 0707);
	}
	$log_file = $log_path.'/'.date('Y.m.d').'.txt';

	$time = date('Y-m-d H:i:s');
	$ip = $_SERVER['REMOTE_ADDR'];

	$content = '';
	if(file_exists($log_file)) {
		$content .= file_get_contents($log_file);
	}
	$content.= '['.$time.']['.$ip.']'.$log_data."\n";

	file_put_contents($log_file, $content);
}
?>