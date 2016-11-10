<?
if(!defined('_INPLUS_')) { exit; }

function setSessionValue($ss_name, $value) {
	if (PHP_VERSION < '5.3.0') { session_register($ss_name); }
	$$ss_name = $_SESSION[$ss_name] = $value;
}

function getSessionValue($ss_name) {
	return isset($_SESSION[$ss_name]) ? $_SESSION[$ss_name] : '';
}

function setCookieValue($ck_name, $value, $expires = 86400) {
	$ck_name = md5($ck_name);
	$value = base64_encode($value);
	//setcookie($ck_name, $value, time() + $expires, '/', _HOMEPAGE_DOMAIN_);	
	//setcookie($ck_name, $value, time() + $expires, '/', 'www.'._HOMEPAGE_DOMAIN_);	
	setcookie($ck_name, $value, time() + $expires, '/');	
}

function getCookieValue($ck_name) {
	$cookie = md5($ck_name);
	if(array_key_exists($cookie, $_COOKIE)) { 
		$value = base64_decode($_COOKIE[$cookie]);
		return $value;
	}
	else { return ''; }
}

function deleteCookieValue($ck_name) {
	setCookieValue($ck_name, '', -1);
}
?>