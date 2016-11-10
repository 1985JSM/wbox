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

//$list = dbSelect("tbl_test", "*", "where 1 = 1", "", "");
//print_r($list);

$content = file_get_contents('./460k.jpg');
$content = base64_encode($content);
echo $content;
?>