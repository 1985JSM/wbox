<?
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

include_once($_SERVER['DOCUMENT_ROOT'].'/lib/object.class.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/lib/stdController.class.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/lib/time.lib.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/lib/html.lib.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/lib/db.lib.php');

# 리뷰
/*
$list = dbSelect("tbl_review", "*", "where rv_type = 'U'", "", "");
for($i = 0 ; $i < sizeof($list) ; $i++) {

	$rv_id = $list[$i]['rv_id'];
	$mb_id = $list[$i]['reg_id'];
	$data = dbOnce("tbl_user", "mb_nick", "where mb_id = '$mb_id'", "", 1);

	$mb_nick = $data['mb_nick'];
	dbUpdate("tbl_review", "rv_name = '$mb_nick'", "where rv_id = '$rv_id'");
}
*/

# 갤러리
/*
$list = dbSelect("tbl_gallery", "*", "", "", "");
for($i = 0 ; $i < sizeof($list) ; $i++) {

	$gl_id = $list[$i]['gl_id'];
	$mb_id = $list[$i]['mb_id'];
	$data = dbOnce("tbl_staff", "mb_nick", "where mb_id = '$mb_id'", "");
	$mb_nick = $data['mb_nick'];

	dbUpdate("tbl_gallery", "gl_name = '$mb_nick'", "where gl_id = '$gl_id'");
}
*/
?>