<?
if(!defined('_INPLUS_')) { exit; } 

unset($menu);

$menu[] = array(
	'title'	=> '가맹점관리',
	'sub'	=> array(
		array('title' => '가맹점목록',		'uri' => '/webadmin/shop/list.html',		'auth_key' => 'shop',	'no_complete' => true),
		array('title' => 'SMS/메일설정',	'uri' => '#',	'auth_key' => 'shop',	'no_complete' => true),
		array('title' => '신청현황',		'uri' => '/webadmin/application/list.html',	'auth_key' => 'shop',	'no_complete' => true),
		array('title' => '커뮤니티/문의',	'uri' => '#',	'auth_key' => 'shop',	'no_complete' => true),
		array('title' => '가맹점부가관리',	'uri' => '#',	'auth_key' => 'shop',	'no_complete' => true)
	),	'no_complete' => true
);


?>
