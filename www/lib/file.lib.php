<?
if(!defined('_INPLUS_')) { exit; }

/**
* 디렉토리 생성
*/
function makeDirectory($dir_path) {

	$tmp_path = str_replace(_UPLOAD_PATH_, '', $dir_path);
	$dir_path = _UPLOAD_PATH_;
	$dir_arr = explode('/', $tmp_path);
	for($i = 1 ; $i < sizeof($dir_arr) ; $i++) {
		$dir_name = $dir_arr[$i];
		if($dir_arr) {
			$dir_path .= '/'.$dir_name;
			if(!is_dir($dir_path)) {
				@mkdir($dir_path, 0707);
				@chmod($dir_path, 0707);
			}
		}

	}
}


/**
* 디렉토리 이하 모든 파일 삭제
*/
function deleteAll($dir) {
	if(is_dir($dir)) {
		$handle = opendir($dir); 
		while (false!==($FolderOrFile = readdir($handle))) { 
			if($FolderOrFile != '.' && $FolderOrFile != '..') { 
				if(is_dir("$dir/$FolderOrFile")) { deleteAll("$dir/$FolderOrFile"); }  // recursive 
				else { unlink("$dir/$FolderOrFile"); } 
			}  
		} 
		closedir($handle); 
		if(rmdir($dir)) { $success = true; } 
	}
	return $success;  
} 

/**
* 디렉토리내 하위 디렉토리 탐색
*/
function selectDirectoryList($dir) {

	unset($list);

	if(is_dir($dir)) {
		$handle = opendir($dir);
		while (false!==($dir_name = readdir($handle))) { 
			if($dir_name != '.' && $dir_name != '..') { 
				if(is_dir("$dir/$dir_name")) {
					$list[] = $dir_name;					
				}
			}  
		} 
		closedir($handle); 
	}

	return $list;	
}
?>