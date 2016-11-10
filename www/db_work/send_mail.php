<?
Header("Content-type: text/html; charset=UTF-8");

define('_INPLUS_', true);

if(!$_SERVER['DOCUMENT_ROOT']) {
	$_SERVER['DOCUMENT_ROOT'] = '/home1/wbox/www';
}

include_once($_SERVER['DOCUMENT_ROOT'].'/config/db.config.php');
define('_MYSQL_HOST_', $db['HOST']);
define('_MYSQL_USER_', $db['USER']);
define('_MYSQL_PASSWORD_', $db['PASSWORD']);
define('_MYSQL_DB_', $db['DB']);
unset($db);

include_once($_SERVER['DOCUMENT_ROOT'].'/lib/object.class.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/lib/stdController.class.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/lib/time.lib.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/lib/db.lib.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/module/mailing/mailing.class.php');

/* init Class */
$oMailing = new Mailing();
$oMailing->init();
$module_name = $oMailing->get('module_name');	// 모듈명

$oMailing->sendWaitList();
?>