<?
if(!defined('_INPLUS_')) { exit; }
error_reporting(E_CORE_ERROR | E_CORE_WARNING | E_COMPILE_ERROR | E_ERROR | E_WARNING | E_PARSE | E_USER_ERROR | E_USER_WARNING);
# magic_quotes
if(!get_magic_quotes_gpc()) {
	$escape_function = 'addslashes($value)';
	$addslashes_deep = create_function('&$value, $fn', '
		if(is_string($value)) { $value = ' . $escape_function . '; }
		else if(is_array($value)) { foreach($value as &$v) $fn($v, $fn); }');

	// Escape data
	$addslashes_deep($_POST, $addslashes_deep);
	$addslashes_deep($_GET, $addslashes_deep);
	$addslashes_deep($_COOKIE, $addslashes_deep);
	$addslashes_deep($_REQUEST, $addslashes_deep);
}

# get 변수 unset
$ext_arr = array('PHP_SELF', '_ENV', '_GET', '_POST', '_FILES', '_SERVER', '_COOKIE', '_SESSION', '_REQUEST',
                  'HTTP_ENV_VARS', 'HTTP_GET_VARS', 'HTTP_POST_VARS', 'HTTP_POST_FILES', 'HTTP_SERVER_VARS',
                  'HTTP_COOKIE_VARS', 'HTTP_SESSION_VARS', 'GLOBALS');

$ext_cnt = sizeof($ext_arr);
for($i = 0 ; $i < $ext_cnt ; $i++) { if(isset($_GET[$ext_arr[$i]])) unset($_GET[$ext_arr[$i]]); }

# XSS 관련
function removeXss($val) { 
	// remove all non-printable characters. CR(0a) and LF(0b) and TAB(9) are allowed 
	// this prevents some character re-spacing such as <java\0script> 
	// note that you have to handle splits with \n, \r, and \t later since they *are* 
	// allowed in some inputs 
	$val = preg_replace('/([\x00-\x08][\x0b-\x0c][\x0e-\x20])/', '', $val); 

	// straight replacements, the user should never need these since they're normal characters 
	// this prevents like <IMG SRC=&#X40&#X61&#X76&#X61&#X73&#X63&#X72&#X69&#X70&#X74&
	// #X3A&#X61&#X6C&#X65&#X72&#X74&#X28&#X27&#X58&#X53&#X53&#X27&#X29> 
	$search = 'abcdefghijklmnopqrstuvwxyz'; 
	$search .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
	$search .= '1234567890!@#$%^&*()'; 
	$search .= '~`";:?+/={}[]-_|\'\\'; 
	for($i = 0; $i < strlen($search); $i++) { 
		// ;? matches the ;, which is optional 
		// 0{0,7} matches any padded zeros, which are optional and go up to 8 chars 

		// &#x0040 @ search for the hex values 
		$val = preg_replace('/(&#[x|X]0{0,8}'.dechex(ord($search[$i])).';?)/i', $search[$i], $val); 
		// with a ; 

		// &#00064 @ 0{0,7} matches '0' zero to seven times 
		$val = preg_replace('/(&#0{0,8}'.ord($search[$i]).';?)/', $search[$i], $val); // with a ; 
	} 

	// now the only remaining whitespace attacks are \t, \n, and \r 
	$ra1 = array('javascript', 'vbscript', 'expression', 'applet', 'meta', 'xml', 'blink', 'link', 
	'script', 'embed', 'object', 'iframe', 'frame', 'frameset', 'ilayer', 'layer', 'bgsound', 'base'); 
	$ra2 = array('onabort', 'onactivate', 'onafterprint', 'onafterupdate', 'onbeforeactivate', 'onbeforecopy', 'onbeforecut', 'onbeforedeactivate', 'onbeforeeditfocus', 'onbeforepaste', 'onbeforeprint', 'onbeforeunload', 'onbeforeupdate', 'onblur', 'onbounce', 'oncellchange', 'onchange', 'onclick', 'oncontextmenu', 'oncontrolselect', 'oncopy', 'oncut', 'ondataavailable', 'ondatasetchanged', 'ondatasetcomplete', 'ondblclick', 'ondeactivate', 'ondrag', 'ondragend', 'ondragenter', 'ondragleave', 'ondragover', 'ondragstart', 'ondrop', 'onerror', 'onerrorupdate', 'onfilterchange', 'onfinish', 'onfocus', 'onfocusin', 'onfocusout', 'onhelp', 'onkeydown', 'onkeypress', 'onkeyup', 'onlayoutcomplete', 'onload', 'onlosecapture', 'onmousedown', 'onmouseenter', 'onmouseleave', 'onmousemove', 'onmouseout', 'onmouseover', 'onmouseup', 'onmousewheel', 'onmove', 'onmoveend', 'onmovestart', 'onpaste', 'onpropertychange', 'onreadystatechange', 'onreset', 'onresize', 'onresizeend', 'onresizestart', 'onrowenter', 'onrowexit', 'onrowsdelete', 'onrowsinserted', 'onscroll', 'onselect', 'onselectionchange', 'onselectstart', 'onstart', 'onstop', 'onsubmit', 'onunload'); 
	$ra = array_merge($ra1, $ra2); 

	$found = true; // keep replacing as long as the previous round replaced something 
	while($found == true) { 
		$val_before = $val; 
		for($i = 0; $i < sizeof($ra); $i++) { 
			$pattern = '/'; 
			for($j = 0; $j < strlen($ra[$i]); $j++) { 
				if($j > 0) { 
					$pattern .= '('; 
					$pattern .= '(&#[x|X]0{0,8}([9][a][b]);?)?'; 
					$pattern .= '|(&#0{0,8}([9][10][13]);?)?'; 
					$pattern .= ')?'; 
				} 
				$pattern .= $ra[$i][$j]; 
			} 
			$pattern .= '/i'; 
			$replacement = substr($ra[$i], 0, 2).'-xss-'.substr($ra[$i], 2); // add in <> to nerf the tag 
			$val = preg_replace($pattern, $replacement, $val); // filter out the hex tags 
			if($val_before == $val) { 
				// no replacements were made, so exit the loop 
				$found = false; 
			} 
		} 
	} 
	return $val; 
} 

function getPureData($arr) {
	foreach($arr as $key => $val) {
		if(is_array($val)) { $val = getPureData($val); }
		else {
			if($key == 'file_content') { continue; }
			else if($key == 'wr_content') { $val = str_replace('<br>', '<br />', removeXss($val)); }
			else { $val = strip_tags($val); }
			$arr[$key] = removeXss($val);
		}
	}
	return $arr;
}

$_GET = getPureData($_GET);
$_POST = getPureData($_POST);

# register_globals
@extract($_GET);
@extract($_POST);
@extract($_SERVER);

# 시간대 설정
if(PHP_VERSION >= '5.3.0') { date_default_timezone_set("Asia/Seoul"); }

# 경로 결정
unset($config);
$root_path = str_replace($_SERVER['SCRIPT_NAME'], '', $_SERVER['SCRIPT_FILENAME']);
define('_ROOT_PATH_', $root_path);
unset($root_path);

# 홈페이지 환경설정
include_once(_ROOT_PATH_.'/config/homepage.config.php');
foreach($homepage as $key => $val) {
	define('_HOMEPAGE_'.$key.'_', $val);
}
unset($homepage);

# URI 설정
if(defined('_HOMEPAGE_DOMAIN_')) { $base_uri = 'http://'._HOMEPAGE_DOMAIN_; }
else { $base_uri = 'http://'.$_SERVER['HTTP_HOST']; }
define('_BASE_URI_', $base_uri);
unset($base_uri);

# 경로 정보
include_once(_ROOT_PATH_.'/config/dir.config.php');
foreach($dir as $key => $val) {
	define('_'.$key.'_PATH_', _ROOT_PATH_.'/'.$val);
	define('_'.$key.'_URI_', _BASE_URI_.'/'.$val);
}
unset($dir);

# DB 정보
include_once(_ROOT_PATH_.'/config/db.config.php');
foreach($db as $key => $val) {
	define('_MYSQL_'.$key.'_', $val);
}
unset($db);

# flag 정보
include_once(_ROOT_PATH_.'/config/flag.config.php');
foreach($flag as $key => $val) {
	define('_FLAG_'.$key.'_', $val);
}
unset($flag);

# 세션 설정
ini_set("session.use_trans_sid", 0);
ini_set("url_rewriter.tags","");

session_save_path(_SESSION_PATH_);

if(isset($SESSION_CACHE_LIMITER)) { @session_cache_limiter($SESSION_CACHE_LIMITER); }
else { 
	@session_cache_limiter("no-cache, must-revalidate");
	header("Pragma: no-cache");							// HTTP/1.0
	header("Cache-Control:no-cache,must-revalidate");	// HTTP/1.1
	header("Expires: 0");								// rfc2616 - Section 14.21	
}

ini_set("session.cache_expire", 180);
ini_set("session.gc_maxlifetime", 10800);
ini_set("session.gc_probability", 1);
ini_set("session.gc_divisor", 100);

session_set_cookie_params(0, '/');
ini_set("session.cookie_domain", '');

@session_start();

# include
include_once(_LIB_PATH_.'/object.class.php');
include_once(_LIB_PATH_.'/stdController.class.php');
include_once(_LIB_PATH_.'/html.lib.php');
include_once(_LIB_PATH_.'/time.lib.php');
include_once(_LIB_PATH_.'/session.lib.php');
include_once(_LIB_PATH_.'/json.lib.php');
include_once(_LIB_PATH_.'/db.lib.php');
include_once(_LIB_PATH_.'/file.lib.php');
include_once(_LIB_PATH_.'/thumbnail.lib.php');
include_once(_LIB_PATH_.'/random.lib.php');
include_once(_LIB_PATH_.'/addr.lib.php');
include_once(_LIB_PATH_.'/shortener.lib.php');

# PHPSESSID 다르면 로그아웃
if(isset($_REQUEST['PHPSESSID']) && $_REQUEST['PHPSESSID'] != session_id()) {
	printError('Session Error');
	exit;
}

# 모바일 디바이스 검사
$is_mobile = preg_match('/phone|samsung|lgtel|mobile|skt|nokia|blackberry|android|sony/i', $_SERVER['HTTP_USER_AGENT']);

# 관리자 권한 검사
function checkAdminAuth($auth_key, $data = '') {
	
	global $member;

	$result = false;
	if(!$data) { $data = $member; }

	if($data['mb_level'] > 9) {
		$result = true;
	}
	
	if(strpos($data['mb_auth_list'], $auth_key) > -1) {
		$result = true;
	}
	
	return $result;
}

# 환경설정
$config = array(
	'exp_day'	=> '7'
);

# 지역
$area_arr = array(
	'02'	=> '서울특별시',
	'051'	=> '부산광역시',
	'053'	=> '대구광역시',
	'032'	=> '인천광역시',
	'062'	=> '광주광역시',	
	'042'	=> '대전광역시',
	'052'	=> '울산광역시',
//	'044'	=> '세종특별자치시',
	'031'	=> '경기도',
	'033'	=> '강원도',	
	'043'	=> '충청북도',	
	'041'	=> '충청남도',
	'063'	=> '전라북도',	
	'061'	=> '전라남도',	
	'054'	=> '경상북도',
	'055'	=> '경상남도',
	'064'	=> '제주특별자치도'
);

# 성별
$gender_arr = array(
	'M'	=> '남',
	'F'	=> '여'
);

# 양력/음력
$birth_type_arr = array(
	'S'	=> '양력',
	'L'	=> '음력'
);

# 요일
$week_arr = array(
	'0'	=> '일',
	'1'	=> '월',
	'2'	=> '화',
	'3'	=> '수',
	'4'	=> '목',
	'5'	=> '금',
	'6'	=> '토'
);

# 통신사
$hp_comp_arr = explode(',', 'SKT,KT,LGT');

# Device 정보
if(preg_match('/android/i', $_SERVER['HTTP_USER_AGENT'])) {
	$device_os = 'android';
}
else if(preg_match('/ipod|ipad|iphone/i', $_SERVER['HTTP_USER_AGENT'])) {
	$device_os = 'ios';
}
define('_DEVICE_OS_', $device_os);

# 웹뷰 실행 여부
$is_webview = false;
if(strpos($_SERVER['HTTP_USER_AGENT'], 'WEBVIEW') > -1) {
	$is_webview = true;
}
define('_IS_WEBVIEW_', $is_webview);

# 위치 정보
$lat = getCookieValue('ck_lat');
$lng = getCookieValue('ck_lng');
$dong = getCookieValue('ck_dong');
$addr = getCookieValue('ck_addr');
if(!$addr) {
	$addr = '위치를 찾을 수 없습니다.';
}

if(!$dong) { $dong = '0'; }

define('_LAT_', $lat);
define('_LNG_', $lng);
define('_DONG_', $dong);
define('_ADDR_', $addr);

//echo $_SERVER['HTTP_USER_AGENT'];
?>