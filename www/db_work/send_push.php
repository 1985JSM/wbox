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
include_once($_SERVER['DOCUMENT_ROOT'].'/module/push/push.class.php');

$oPush = new Push();
$oPush->init();

// reserve
include_once($_SERVER['DOCUMENT_ROOT'].'/module/reserve/reserve.class.php');
$oReserve = new Reserve();
$oReserve->init();

$oPush->set('reserve_table',	$oReserve->get('data_table'));
$oPush->set('reserve_pk',		$oReserve->get('pk'));
$oPush->set('process_hour',		$oReserve->get('process_hour'));


/**
* 1. 예약시간알림
* 기존 상태 : P, A, W
* 예약일시와 10, 20, 30, 40, 50, 60분 차이가 생길 경우
*/

/**
* 2. 예약경과
* 기존 상태 : P
* 예약일시와 30분 차이가 날 경우
*/

/**
* 3. 비정상취소
* 기존 상태 : W
* 예약일시가 1분이라도 지났을 경우
*/
$oPush->sendPushList();
?>