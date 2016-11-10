<?
if(!defined('_INPLUS_')) { exit; } 

unset($menu);

$menu[] = array(
	'title'	=> '계정관리',	
	'sub'	=> array(
		array('title' => '총괄운영자',		'uri' => '/webadmin/admin/list.html',				'auth_key' => 'admin'),
		array('title' => '가맹점관리자',	'uri' => '/webadmin/manager/list.html',				'auth_key' => 'admin')
	)
);


$menu[] = array(
	'title'	=> '가맹점관리',
	'sub'	=> array(
		array('title' => '가맹점목록',		'uri' => '/webadmin/shop/list.html',				'auth_key' => 'shop'),
		array('title' => '신청현황',		'uri' => '/webadmin/application/list.html',			'auth_key' => 'shop'),
		array('title' => '담당자',			'uri' => '/webadmin/staff/list.html',				'auth_key' => 'shop'),
		array('title' => '포트폴리오',		'uri' => '/webadmin/portfolio/list.html',			'auth_key' => 'shop')

	)
);

$menu[] = array(
	'title'	=> '예약관리',
	'sub'	=> array(
		array('title' => '진행중인예약',	'uri' => '/webadmin/reserve/wait_list.html',		'auth_key' => 'shop'),
		array('title' => '완료된예약',		'uri' => '/webadmin/reserve/finish_list.html',		'auth_key' => 'shop'),
		array('title' => '취소된예약',		'uri' => '/webadmin/reserve/cancel_list.html',		'auth_key' => 'shop')
	)
);

$menu[] = array(
	'title'	=> '고객관리',
	'sub'	=> array(
		array('title' => '고객목록',		'uri' => '/webadmin/user/list.html',				'auth_key' => 'member'),
		array('title' => '예약한고객',		'uri' => '/webadmin/user/reserve_list.html',		'auth_key' => 'member'),
		array('title' => '즐겨찾기한고객',	'uri' => '/webadmin/user/favorite_list.html',		'auth_key' => 'member'),
		array('title' => '탈퇴관리',		'uri' => '/webadmin/user/leave_list.html',			'auth_key' => 'member'),
		array('title' => '닉네임필터링',	'uri' => '/webadmin/ban_id/user_nick.html',			'auth_key' => 'member')
	)
);

$menu[] = array(
	'title'	=> '콘텐츠관리',
	'sub'	=> array(
		//array('title' => '푸시메시지',		'uri' => '/webadmin/push/config.html',				'auth_key' => 'contents'),
		array('title' => '메인비주얼',		'uri' => '/webadmin/visual/list.html',				'auth_key' => 'contents'),
		array('title' => '메인추천샵',		'uri' => '/webadmin/recommend/list.html',			'auth_key' => 'contents'),
		array('title' => '쿠폰관리',		'uri' => '/webadmin/coupon/list.html',				'auth_key' => 'contents'),
		array('title' => '블로그포스팅',	'uri' => '/webadmin/blog/list.html',				'auth_key' => 'contents'),
	)
);

$menu[] = array(
	'title'	=> '게시판관리',
	'sub'	=> array(
		array('title' => '공지사항',		'uri' => '/webadmin/notice/list.html',				'auth_key' => 'boards'),
		array('title' => '이벤트',			'uri' => '/webadmin/event/list.html',				'auth_key' => 'boards'),
		array('title' => '1:1문의',			'uri' => '/webadmin/qna/list.html',					'auth_key' => 'boards'),
		array('title' => 'FAQ',				'uri' => '/webadmin/faq/list.html',					'auth_key' => 'boards'),
		array('title' => '제휴문의',		'uri' => '/webadmin/alliance/list.html',			'auth_key' => 'boards')
	)
);

$menu[] = array(
	'title'	=> '통계',
	'sub'	=> array(
		array('title' => '회원가입통계',	'uri' => '/webadmin/stats/user_join.html',			'auth_key' => 'stats'),
		array('title' => '가맹점가입통계',	'uri' => '/webadmin/stats/shop_join.html',			'auth_key' => 'stats'),
		array('title' => '예약통계',		'uri' => '/webadmin/stats/user_reserve.html',		'auth_key' => 'stats')
	)
);

$menu[] = array(
	'title'	=> '환경설정',
	'sub'	=> array(
		array('title' => '비밀번호변경',	'uri' => '/webadmin/member/modify_password.html')
	)
);
?>
