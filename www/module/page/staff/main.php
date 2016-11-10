<?
if(!defined('_INPLUS_')) { exit; } 

// welcome 사용 금지
if(!strpos($this_uri, 'page/main.html')) {
	movePage($base_uri.'/page/main.html');
}

$flag_use_header = false;
$footer_nav['1'] = true;

$oPage = new PageStaff();
$oPage->init();

/* reserve */
include_once(_MODULE_PATH_.'/reserve/reserve.staff.class.php');
$oReserve = new ReserveStaff();
$oReserve->init();
$cnt_wait = $oReserve->countByStaffId($member['mb_id'], 'W,A,P');
$cnt_total = $oReserve->countByStaffId($member['mb_id'], 'W,A,P,E,C,B');

$oReserve->set('cnt_rows', 3);
$list_mode = 'wait';
$sch_order_field = 'concat(rs_date, rs_time)';
$flag_no_state = true;

/* notice */
include_once(_MODULE_PATH_.'/notice/notice.staff.class.php');
$oNotice = new NoticeStaff();
$oNotice->init();
$oNotice->set('cnt_rows', 3);
?>
<style type="text/css">
div.member_info div.btn_open_gnb { position:absolute; top:0; left:0; }
div.member_info div.btn_open_gnb > button { width:40px; height:50px; line-height:50px; margin:0; padding:0; background:none; border:0; color:#58585a; font-size:24px;}

/* header > gnb */
#gnb { position:fixed; top:0; left:-300px; z-index:910; width:265px; height:100%; background:#ffffff; 
	transition:all 300ms ease; -webkit-transition:all 300ms ease; }
#wrap.open #gnb { left:0; }
#wrap.open {position:absolute; width:100%; height:100%; overflow:hidden;}

#gnb div.btn_close_gnb {position:absolute; top:0px; right:0; height:50px; text-align:right;z-index:50; }
#gnb div.btn_close_gnb button { width:50px; height:50px; margin:0; padding:0; background:none; border:0; }
#gnb div.btn_close_gnb button i {color:#fff; font-size:28px; color:#58585a;}

#gnb div.gnb_top_area {height:140px; background:#ffea00; padding-top:20px; box-sizing:border-box;}
#gnb div.gnb_top_area a {display:block; position:absolute; top:5px; left:0; width:50px; height:50px; line-height:50px; text-align:center; }
#gnb div.gnb_top_area a i {color:#58585a; font-size:28px;}
#gnb div.gnb_top_area div.img_profile {display:block; position:relative; overflow:hidden;  width:80px; height:80px; border-radius:80px; left:50%; margin-left:-40px; box-sizing:border-box; text-align:center;}
#gnb div.gnb_top_area div.img_profile img { width:100%; height:100%; }
#gnb div.gnb_top_area div.img_profile.no_img {display:block; width:80px; height:80px; background:#fff;line-height:80px;padding-top:10px; box-sizing:border-box; }
#gnb div.gnb_top_area div.img_profile.no_img img {text-align:center; width:60px; height:60px;  }
#gnb div.gnb_top_area p {text-align:center; color:#3c3c3c; font-weight:bold; margin-top:10px; line-height:1.5em}


#gnb div.login_area {top:0; width:100%; height:66px; background:#3c3c3c;line-height:1.5em }
#gnb div.login_area ul { height:100%; }
#gnb div.login_area ul:after { clear:both; display:block; content:""; }
#gnb div.login_area ul li {float:left; width:50%; height:100%; }
#gnb div.login_area ul li a { display:block; width:100%; height:100%; box-sizing:border-box; padding-top:16px; text-align:center; font-size:12px; color:#acacac; }
#gnb div.login_area ul li a span {display:block; font-size:14px; color:#fff;}
#gnb div.login_area p a {display:block; line-height:66px; padding-left:20px; color:#fff; box-sizing:border-box; font-size:16px; }
#gnb div.login_area p a span {float:right; padding-right:20px;}

#gnb div.gnb_more {position:absolute; top:0; height:100%; width:100%; box-sizing:border-box; padding-top:140px; overflow:hidden;}
#gnb div.gnb_more div.section { height:100%; overflow-y:auto; overflow-x:hidden; }
#gnb div.gnb_more div.gnb p {height:60px; line-height:60px; padding:0 20px; border-bottom:1px solid #d2d2d2; font-size:18px; font-weight:bold;color:#3c3c3c; }
#gnb div.gnb_more div.gnb p a {display:block; width:100%;}
#gnb div.gnb_more div.gnb p a span {float:right;}
#gnb div.gnb_more div.gnb ul {padding:8px 0;}
#gnb div.gnb_more div.gnb ul li {height:44px; padding-left:20px; line-height:44px; font-size:14px; box-sizing:border-box;}
#gnb div.gnb_more div.gnb ul li a {display:block; width:100%; }
#gnb div.gnb_more div.gnb ul li a i {font-size:18px;}

#gnb div.gnb_more div.side_menu {border-top:1px #d2d2d2 solid; border-bottom:1px #d2d2d2 solid}
#gnb div.gnb_more div.side_menu ul:after { clear:both; display:block; content:""; }
#gnb div.gnb_more div.side_menu ul li {float:left; width:50%; height:68px; border-left:1px #d2d2d2 solid; text-align:center; padding-top:14px; box-sizing:border-box;  }
#gnb div.gnb_more div.side_menu ul li:first-child {border-left:0;  }
#gnb div.gnb_more div.side_menu ul li a {display:block; width:100%; font-size:11px; color:#58585a; line-height:1.5em}
#gnb div.gnb_more div.side_menu ul li a i {display:block; padding-bottom:5px; font-size:18px;  color:#acacac;}

#gnb div.gnb_more div.gnb_quick_menu {}
#gnb div.gnb_more div.gnb_quick_menu ul:after { clear:both; display:block; content:""; }
#gnb div.gnb_more div.gnb_quick_menu ul li { width:100%; height:40px; line-height:40px; box-sizing:border-box; border-bottom:1px #d2d2d2 solid; background:#f6f6f6;  }
#gnb div.gnb_more div.gnb_quick_menu ul li a {display:block; width:100%; font-size:11px; color:#58585a; padding-left:20px;}

#gnb a:hover, #gnb a:active, #gnb a:focus {background:##f6f6f6;  color:#000;}

div.main {background:#f6f6f6;}
div.main_list01{ background:#fff; border-bottom:0; position:relative; margin-bottom:20px;}
div.main_list01:after{display:block;content:''; width:100%;height:0; background:none; position:relative; bottom:0;left:0}
div.main_list01 h4{height:50px; line-height:50px; padding-left:10px; border-bottom:4px solid #f6f6f6;font-size:14px;color:#000}
div.main_list01 h4 .txt{color:#888;font-weight:normal}
div.main_list01 a.view_more{font-size:12px; position:absolute;top:17px;right:10px;color:#888}
div.main_list01 div.list ul li { position:relative; border:0; border-bottom:4px solid #f6f6f6; }
div.main_list01 div.list ul li strong.user_name {display:block; margin-bottom:16px; padding-right:100px; color:#333; font-weight:bold;} 
div.main_list01 div.list ul li > a span.ico_reservation{ border-radius:0;font-size:11px;border:0; font-weight:normal; background:none;color:#f06e58;}

div.main_list01 div.list ul li > a {display:block; position:relative;  padding:15px 10px;color:#333}
div.main_list01 div.list ul li > a ul.res_info {position:relative; line-height:1.0em;}
div.main_list01 div.list ul li > a ul.res_info li {padding:4px 0 4px 80px; border:0; }
div.main_list01 div.list ul li > a ul.res_info li em {position:absolute; top:4px; left:0; border-bottom:0; font-size:12px; font-weight:normal;color:#999;}


div.main_list01 div.list ul li > a ul.res_info li em.state_W {font-size:14px; font-weight:bold; color:#12aec3;} /* 신청중 */
div.main_list01 div.list ul li > a ul.res_info li em.state_F {font-size:14px; font-weight:bold; color:#9e6eaf;} /* 담당자확정 */
div.main_list01 div.list ul li > a ul.res_info li em.state_P {font-size:14px; font-weight:bold; color:#f06e58;} /* 진행중 */
div.main_list01 div.list ul li > a ul.res_info li em.state_E {font-size:14px; font-weight:bold; color:#12aec3;} /* 완료 */
div.main_list01 div.list ul li > a ul.res_info li em.state_C {font-size:14px; font-weight:bold; color:#888;} /* 정상취소 */
div.main_list01 div.list ul li > a ul.res_info li em.state_B {font-size:14px; font-weight:bold; color:#f06e58;} /* 비정상취소 */
div.main_list01 div.list ul li > a ul.res_info li span {position:relative; font-size:12px;}
div.main_list01 div.list ul li > a ul.res_info li.res_state { min-height:14px;margin-bottom:8px; }
div.main_list01 div.list ul li > a ul.res_info li.res_state em {font-size:14px;}
div.main_list01 div.list ul li > a ul.res_info li.res_state span {font-size:11px; }
div.main_list01 div.list ul li > a ul.res_info li span strong {font-weight:normal;}
div.main_list01 div.list ul li > a ul.res_info li span.service strong {display:block; padding-top:4px; overflow:hidden; white-space:nowrap; text-overflow:ellipsis; }
div.main_list01 div.list ul li > a ul.res_info li span.service strong:first-child {padding-top:0; }

/* 버튼 아이콘 */
div.main_list01 div.ico_info {position:absolute; top:10px; right:10px; padding:0;}
div.main_list01 div.ico_info ul:after { clear:both; display:block; content:""; }
div.main_list01 div.ico_info ul li {float:left; position:relative; top:0; right:0; padding:0; margin:0 0 0 4px; width:44px; height:44px; border-radius:44px; border-bottom:0;  text-align:center; font-size:11px; box-sizing:border-box;  line-height:1.25em; }
div.main_list01 div.ico_info ul li.icon_info {padding-top:8px;border:2px solid #ececec; background:#fff; }
div.main_list01 div.ico_info ul li.icon_info a {display:block; width:100%; padding:0; color:#555; }
div.main_list01 div.ico_info ul li.basic_info { background:#cccccc; color:#fff;  }
div.main_list01 div.ico_info ul li.basic_info.on { background:#58585a; }
div.main_list01 div.ico_info ul li.basic_info a {display:block; width:100%; padding:8px 0 0 0; color:#fff; }
div.main_list01 div.ico_info ul li.basic_info a i {display:block; position:relative; font-size:11px; height:auto; color:#fff; line-height:1.25em; top:0; right:0; }
div.main_list01 div.ico_info ul li.icon { padding-top:8px;background:#ff3f1e; color:#fff;  }
div.main_list01 div.ico_info ul li.icon i {display:block;}
/* 버튼 아이콘 끝 */
</style>
<script type="text/javascript">
$(document).ready(function() {
//	callNative("storeMemberId/<?=$member['mb_id']?>");
	callNative("checkAppVersion/validateUpdate");

// GNB
	$("#layer_back").on("click", function() {
		closeGnb();
	});

	function openGnb() {
	$("#layer_back").show();
	$("#wrap").addClass("open");
}

function closeGnb() {
	$("#layer_back").hide();	
	$("#wrap").removeClass("open");
}



});
</script>
</head>
<body>
<div id="wrap" class="wrap">

	<div class="member_info">   	
    	<h3><?=$sh_data['sh_name']?></h3>
		<div class="btn_open_gnb">
			<button type="button" onclick="openGnb()" title="주메뉴 열기"><i class="xi-bars"></i></button>
		</div>

		<!-- gnb -->
        <div id="gnb">
			<div class="gnb_top_area">
				<div class="img_profile"><img src="<?=$member['thumb']?>" alt="<?=$user_photo?> profile image" /></div>
				<p><?=$member['mb_nick']?></p>
			</div>

			<div class="btn_close_gnb">
				<button type="button" onclick="closeGnb()" title="주메뉴 닫기"><i class="xi-close"></i></button>
			</div>

			<div class="gnb_more">

				<div class="section">	

					<div class="login_area">
						<ul>
						<li><a href="<?=$base_uri?>/reserve/wait_list.html">현재 진행<span><?=number_format($cnt_wait)?></span></a></li>
						<li><a href="<?=$base_uri?>/reserve/end_list.html">누적<span><?=number_format($cnt_total)?></span></a></li>
						</ul>
					</div>

					<div class="gnb">
						<p><a href="">예약관리 <span><i class="xi-angle-right"></i></span></a></p>
						<ul>
						<li><a href="<?=$base_uri?>/member/profile.html"><i class="xi-pen"></i> 프로필관리</a></li>
						<li><a href="<?=$base_uri?>/page/ready_sms.html" class="btn_no_complete"><i class="xi-coupon"></i> 쿠폰보내기</a></li>
						<li><a href="<?=$base_uri?>/page/ready_sms.html" class="btn_no_complete"><i class="xi-mobile"></i> SMS보내기</a></li>
						</ul>
					</div>

					<div class="side_menu">
						<ul>
						<li><a href="<?=$base_uri?>/notice/list.html"><i class="xi-announce"></i> 공지사항</a></li>
						<li><a href="<?=$base_uri?>/config/setting.html"><i class="xi-cog"></i> 설정</a></li>
						</ul>
					</div>

					<!--div class="gnb_quick_menu">
						<ul>	
						<li><a href="<?=$base_uri?>/notice/list.html"><i class="xi-announce"></i> 공지사항</a></li>
						<li><a href="#"><i class="xi-cog"></i> 설정</a></li>
						</ul>
					</div-->
				</div>
				<!-- //gnb -->  
			</div>
		</div>

		<a href="<?=$base_uri?>/reserve/write.html" class="btn_layer_page btn_reservation" target="#layer_page5">담당자예약등록</a>
    </div>

	<div class="staff_info">
		<ul>
		<li>담당자<strong><?=$member['mb_name']?></strong></li>
		<li>현재 진행<strong><?=number_format($cnt_wait)?>건</strong></li>
		<li>누적<strong><?=number_format($cnt_total)?>건</strong></li>
		</ul>
	</div>

	<div id="container" class="container">
		<div class="main">
			<div class="main_list01">
				<h4>현재 진행중 예약 <span class="col_orange"><?=number_format($cnt_wait)?></span>명</h4>
				<a href="<?=$base_uri?>/reserve/wait_list.html" class="view_more">전체보기 <i class="xi-angle-right"></i></a>
				

				<div class="list">
					<ul>
					<? include_once(_MODULE_PATH_.'/reserve/staff/ajax.list.php'); ?>
					</ul>
				</div>
			</div>
			
			
			
			<div class="main_list03">
				<h4>공지사항</h4>
				<a href="<?=$base_uri?>/notice/list.html" class="view_more">전체보기 <i class="xi-angle-right"></i></a>
				<ul class="board_list">
				<? include_once(_MODULE_PATH_.'/notice/staff/ajax.list.php'); ?>
			</ul>
			</div>
		</div>
	</div>