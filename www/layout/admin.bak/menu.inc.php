<?
if(!defined('_INPLUS_')) { exit; } 

unset($menu);

$menu[] = array('title'	=> '운영자관리',	'uri' => '/webadmin/admin/list.html',	'auth_key' => 'admin');

$menu[] = array(
	'title'	=> '가맹점관리',
	'sub'	=> array(
		array('title' => '가맹점목록',		'uri' => '/webadmin/shop/list.html',		'auth_key' => 'shop',	'no_complete' => true),
		array('title' => 'SMS/메일설정',	'uri' => '#',	'auth_key' => 'shop',	'no_complete' => true),
		array('title' => '신청현황',		'uri' => '/webadmin/application/list.html',	'auth_key' => 'shop'),
		array('title' => '커뮤니티/문의',	'uri' => '#',	'auth_key' => 'shop',	'no_complete' => true),
		array('title' => '가맹점부가관리',	'uri' => '#',	'auth_key' => 'shop',	'no_complete' => true)
	),	'no_complete' => true
);

$menu[] = array(
	'title'	=> '회원관리',
	'sub'	=> array(
		array('title' => '회원목록',	'uri' => '/webadmin/member/list.html',	'auth_key' => 'member',	'no_complete' => true),
		array('title' => '회원문의',	'uri' => '#',							'auth_key' => 'member',	'no_complete' => true)
	)
);

$menu[] = array(
	'title'	=> '콘텐츠관리',
	'sub'	=> array(
		array('title' => '공지사항',		'uri' => 'admin/board/list.html?bo_id=notice',	'auth_key' => 'contents',	'no_complete' => true),
		array('title' => '자주묻는질문',	'uri' => '#',	'auth_key' => 'contents',	'no_complete' => true),
		array('title' => '배너/광고관리',	'uri' => '#',	'auth_key' => 'contents',	'no_complete' => true),
		array('title' => '마일리지관리',	'uri' => '#',	'auth_key' => 'contents',	'no_complete' => true),
		array('title' => '설문조사관리',	'uri' => '#',	'auth_key' => 'contents',	'no_complete' => true),
		array('title' => '이벤트관리',		'uri' => '#',	'auth_key' => 'contents',	'no_complete' => true),
		array('title' => '안내/약관관리',	'uri' => '#',	'auth_key' => 'contents',	'no_complete' => true)
	)
);

$menu[] = array('title'	=> '제휴/제안문의',	'uri' => '#',	'no_complete' => true);

$menu[] = array('title'	=> '게시판관리',	'uri' => '#',	'no_complete' => true);

$menu[] = array('title'	=> '사이트환경설정',	'uri' => '#',	'no_complete' => true);
?>
