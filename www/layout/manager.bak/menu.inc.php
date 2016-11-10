<?
if(!defined('_INPLUS_')) { exit; } 

unset($menu);

$menu[] = array(
	'title'	=> '가맹점정보관리',
	'sub'	=> array(
		array('title' => '기본정보관리',	'uri' => '/webmanager/shop/write.html'),
		array('title' => '서비스관리',		'uri' => '/webmanager/service/list.html'),
		array('title' => '담당자관리',		'uri' => '/webmanager/staff/list.html'),
		array('title' => '갤러리관리',		'uri' => '/webmanager/gallery/list.html'),
		array('title' => '리뷰관리',		'uri' => '/webmanager/review/list.html')
	)
);



$menu[] = array('title'	=> '제휴/제안문의',	'uri' => '#',	'no_complete' => true);

$menu[] = array('title'	=> '게시판관리',	'uri' => '#',	'no_complete' => true);

$menu[] = array('title'	=> '사이트환경설정',	'uri' => '#',	'no_complete' => true);
?>
