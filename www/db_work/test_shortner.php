<?
Header("Content-type: text/html; charset=UTF-8");

define('_INPLUS_', true);

if(!$_SERVER['DOCUMENT_ROOT']) {
	$_SERVER['DOCUMENT_ROOT'] = '/home1/wbox/www';
}

include_once($_SERVER['DOCUMENT_ROOT'].'/lib/shortner.lib.php');

$result = getShortUrl('http://www.inplusweb.com');
print_r($result);