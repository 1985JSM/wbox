<?
if(!defined('_INPLUS_')) { exit; } 

unset($menu);

$menu[] = array(
	'title'	=> '고객관리',
	'sub'	=> array(
		array('title' => '고객목록',			'uri' => '/webmanager/customer/list.html')
	)
);

$menu[] = array(
	'title'	=> '예약관리',
	'sub'	=> array(
		array('title' => '진행중인예약',		'uri' => '/webmanager/reserve/wait_list.html'),
		array('title' => '완료된예약',			'uri' => '/webmanager/reserve/finish_list.html'),
		array('title' => '취소된예약',			'uri' => '/webmanager/reserve/cancel_list.html')
	)
);

$menu[] = array(
	'title'	=> '가맹점관리',
	'sub'	=> array(
		array('title' => '가맹점정보'	,		'uri' => '/webmanager/shop/write.html'),
		array('title' => '요금관리',			'uri' => '/webmanager/service/list.html'),
		array('title' => '담당자',				'uri' => '/webmanager/staff/list.html'),
		array('title' => '포트폴리오',			'uri' => '/webmanager/portfolio/list.html'),
		array('title' => '선불제',				'uri' => '/webmanager/advance/list.html'),
		array('title' => '쿠폰관리',			'uri' => '/webmanager/coupon/list.html'),
		array('title' => '블로그포스팅',		'uri' => '/webmanager/blog/list.html')
	)
);

$menu[] = array(
	'title'	=> '정산관리',
	'sub'	=> array(
		array('title' => '매출내역',			'uri' => '/webmanager/reserve/sales_list.html'),
		array('title' => '정산권한관리',		'uri' => '/webmanager/member/sales_auth.html')
	)
);
/*
$menu[] = array(
	'title'	=> '통계',
	'sub'	=> array(	
		array('title' => '예약통계',			'uri' => '/webmanager/stats/user_reserve.html')
	)
);
*/
$menu[] = array(
	'title'	=> '게시판관리',
	'sub'	=> array(
		array('title' => '공지사항			',	'uri' => '/webmanager/notice/list.html'),
		array('title' => 'FAQ',					'uri' => '/webmanager/faq/list.html'),
		array('title' => '1:1문의',				'uri' => '/webmanager/qna/list.html')
	)
);
//if ($_SERVER['REMOTE_ADDR'] == '58.149.89.146') {
	$menu[] = array(
		'title' => 'SMS',
		'sub'	=> array(
			array('title'	=> '메시지충전',			'uri' => '/webmanager/sms/sms_charge.html'),
			array('title'	=> '메시지충전내역',			'uri' => '/webmanager/sms/sms_charge_list.html'),
			array('title'	=> 'SMS/LMS전송',			'uri' => '/webmanager/sms/sms_send.html'),
			array('title'	=> 'MMS전송(준비중)',			'uri' => '/webmanager/sms/sms_send_mms.html'),
			array('title'	=> '메시지 보관함',   	'uri' => '/webmanager/sms_box/list.html'),
			array('title'	=> '메시지 전송내역',   	'uri' => '/webmanager/sms/sms_send_list.html'),
			array('title'	=> '메시지 자동발송 설정',   	'uri' => '/webmanager/sms_auto/list.html'),
			array('title'   => '알림문자수신설정',      'uri' => '/webmanager/sms_auto/report_list.html'),
		)
	);
 if ($member['mb_id'] == 'mongdol') {
	$menu[] = array(
		'title' => 'SMS',
		'sub'	=> array(
			array('title'	=> '메시지충전',			'uri' => '/webmanager/sms/sms_charge.html'),
			array('title'	=> '메시지충전내역',			'uri' => '/webmanager/sms/sms_charge_list.html'),
			array('title'	=> 'SMS/LMS전송',			'uri' => '/webmanager/sms/sms_send.html'),
			//array('title'	=> 'MMS전송(준비중)',			'uri' => '/webmanager/sms/sms_send_mms.html'),
			array('title'	=> '메시지 보관함',   	'uri' => '/webmanager/sms_box/list.html'),
			array('title'	=> '메시지 전송내역',   	'uri' => '/webmanager/sms/sms_send_list.html'),
			array('title'	=> '메시지 자동발송 설정',   	'uri' => '/webmanager/sms_auto/list.html'),
			array('title'   => '알림문자수신설정',      'uri' => '/webmanager/sms_auto/report_list.html'),
		)
	);
}


$menu[] = array(
	'title'	=> '환경설정',
	'sub'	=> array(	
		array('title' => '비밀번호변경',		'uri' => '/webmanager/member/modify_password.html')
	)
);

?>
