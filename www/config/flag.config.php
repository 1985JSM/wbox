<?
if(!defined('_INPLUS_')) { exit; }

unset($flag);

// DB 캐시 사용 여부
$flag['CACHE']	= false;
$flag['CACHE_TIME'] = 300;

// DB 로그 사용 여부
$flag['LOG']	= true;

// 오류 출력 여부
$flag['DEBUG']	= true;

// 레이아웃마다 다른 사용자 세션 사용 여부
$flag['OTHER_SESSION'] = true;
?>