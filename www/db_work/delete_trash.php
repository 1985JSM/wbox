<?
exit; 

/**
* 서버 상에 업로드된 첨부파일 목록을 조회하여
* 해당 첨부파일의 데이터가 DB에서 존재하는지 검사하고
* DB에 존재하지 않는 첨부파일은 삭제 처리
*/

Header("Content-type: text/html; charset=UTF-8");

define('_INPLUS_', true);

if(!$_SERVER['DOCUMENT_ROOT']) {
	$_SERVER['DOCUMENT_ROOT'] = '/home1/wbox/www';
}
define('_MODULE_PATH_', $_SERVER['DOCUMENT_ROOT'].'/module');

include_once($_SERVER['DOCUMENT_ROOT'].'/config/db.config.php');
define('_MYSQL_HOST_', $db['HOST']);
define('_MYSQL_USER_', $db['USER']);
define('_MYSQL_PASSWORD_', $db['PASSWORD']);
define('_MYSQL_DB_', $db['DB']);
unset($db);

include_once($_SERVER['DOCUMENT_ROOT'].'/lib/db.lib.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/lib/file.lib.php');

function convertListToArray($list, $key) {

	unset($arr);
	for($i = 0 ; $i < sizeof($list) ; $i++) {
		$arr[$i] = $list[$i][$key];
	}

	return $arr;
}

function checkAndDelete($module, $pk, $group_arr) {

	$list = dbSelect("tbl_$module", $pk, "", "", "");
	$arr = convertListToArray($list, $pk);

	$dir_path = $_SERVER['DOCUMENT_ROOT'].'/data/upload/'.$module;	
	foreach($group_arr as $key) {
		$group_path = $dir_path.'/'.$key;
		$dir_list = selectDirectoryList($group_path);	

		for($i = 0 ; $i < sizeof($dir_list) ; $i++) {
			$uid = $dir_list[$i];
			if(!in_array($uid, $arr)) {	

				$del_path = $group_path.'/'.$uid;				
				echo "del_path : $del_path \n";

				deleteAll($del_path);
			}
		}
	}
}

# 0. config
$chr_arr = explode(',', 'A,B,C,D,E,F,G,H,I,J,K,L,M,N,O,P,Q,R,S,T,U,V,W,X,Y,Z');
$num_arr = explode(',', '1,2,3,4,5,6,7,8,9');

# 1. shop
$module = 'shop';
$pk = 'sh_code';
checkAndDelete($module, $pk, $chr_arr);

# 2. service
$module = 'service';
$pk = 'sv_id';
checkAndDelete($module, $pk, $num_arr);

# 3. staff
$module = 'staff';
$pk = 'mb_id';
checkAndDelete($module, $pk, $chr_arr);

# 4. user
$module = 'user';
$pk = 'mb_id';
checkAndDelete($module, $pk, $chr_arr);

# 9. tbl_file에 있지만 서버상에 존재하지 않는 정보 삭제
$list = dbSelect("tbl_file", "file_id, file_path", "", "", "");
for($i = 0 ; $i < sizeof($list) ; $i++) {
	$file_id = $list[$i]['file_id'];
	$file_path = $list[$i]['file_path'];

	if(!file_exists($file_path)) {		
		echo "$file_path \n";
		dbDelete("tbl_file", "where file_id = '$file_id'");
	}

}


echo '종료 : '.date('Y-m-d H:i:s');

?>