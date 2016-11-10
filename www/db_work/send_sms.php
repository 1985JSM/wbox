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
include_once($_SERVER['DOCUMENT_ROOT'].'/lib/thumbnail.lib.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/module/sms/sms.class.php');

$oSms = new Sms();

/*
 * 상태표
 * --------------
 * | W | 등록됨; 전송 대기중
 * | A | 대기; 제한시간 등으로 인해서
 * | E | 완료
 * | C | 취소됨; 삭제됨
 * | B | 비정상; 아무런 처리가 되지 않음
 */

// 특정 기간에
$oSms->auto();

// 등록된 SMS들 처리
//$oSms->processingEnrolled();
?>