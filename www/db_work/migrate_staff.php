<?
exit;

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

$sh_list = dbSelect("tbl_shop", "sh_code", "", "order by sh_code asc", "");
for($i = 0 ; $i < sizeof($sh_list) ; $i++) {

	$sh_code = $sh_list[$i]['sh_code'];	
	$st_list = dbSelect("tbl_staff", "mb_id", "where sh_code = '$sh_code'", "order by st_order asc", "");
	for($j = 0 ; $j < sizeof($st_list) ; $j++) {

		$st_order = $j + 1;
		$mb_id = $st_list[$j]['mb_id'];
		dbUpdate("tbl_staff", "st_order = '$st_order'", "where mb_id = '$mb_id'");



	}

}
?>