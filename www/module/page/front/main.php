<?
if(!defined('_INPLUS_')) { exit; } 

$oPage = new PageFront();
$oPage->init();

/* notice */
if(!isset($oNotice)) {
	include_once(_MODULE_PATH_.'/notice/notice.front.class.php');
	$oNotice = new NoticeFront();
	$oNotice->init();
}
$nt_list = $oNotice->selectLatest(1);
?>
<script type="text/javascript">
//<![CDATA[
$(document).ready(function() {

	/* main section : S */
	$(window).on("load", function() {
		initMainSection();
	}).on("scroll", function() {
		setMainSectionNo();		
	});		
	/* main section : E */

	/*
	$("a.btn_open_sample").on("click", function(e) {
		$("#layer_back").show();
		$("#layer_popup").show();
		e.preventDefault();
	});
	*/

	/* 주소 */
	$(document).on("change", "select.sido", function(e) {
		changeSigungu($(this).val());
	}).on("change", "select.sigungu", function(e) {
		changeDong($("select.sido").val(), $(this).val());
	});
});

/* main section : S */
var main_section = null;
var main_section_arr = new Array();
var main_section_idx = 0;
var main_section_edge = false;
/* main section : E */

function closeLayerPopup() {
	$("#layer_back").hide();
	$("#layer_popup").hide();
}
//]]>
</script>
<script type="text/javascript">
$(function() {
	var obj1 = $('ul.tab_wrap1');
	$('a.tab_title', obj1).click(function()
	{
		var idx = $('a.tab_title', obj1).index(this);
		$('a.tab_title', obj1).removeClass('hover').eq(idx).addClass('hover');
	
		$('div.tab_content', obj1).hide().eq(idx).show();
	});	
	
});
</script>

<script type="text/javascript" src="<?=$base_uri?>/module/page/front/jquery.fadeVisual-0.3.min.js"></script>
<script type="text/javascript">

$(document).ready(function() {
	

	$("#fade-box").fadeVisual({
		visual_class	: "fade-visual",
		on_class		: "fade-on",

		flag_use_indicator : true,
		flag_auto_pause : false,
		indicator_class	: "fade-indicator",

		prev_class		: "fade-prev",
		next_class		: "fade-next",
		fade_speed		: 0.4
	});


	$("#fade-box2").fadeVisual({
		visual_class	: "fade-visual",
		on_class		: "fade-on",

		flag_use_indicator : true,
		flag_auto_pause : false,
		indicator_class	: "fade-indicator",

		prev_class		: "fade-prev",
		next_class		: "fade-next",
		fade_speed		: 0.4
	});

});	

</script>


<div id="wrap">
	<!-- skipToContent -->
	<ul id="skipToContent">
	<li><a href="#container">본문 바로가기</a></li>
	<li><a href="#gnb">주메뉴 바로가기</a></li>
	<li><a href="#footer">페이지하단 바로가기</a></li>
	</ul>
	<!-- //skipToContent -->

	<!-- header -->
	<div id="header">
		<!-- headerWrap -->
		<div class="headerWrap">			
			<h1><a href="<?=$base_uri?>/page/main.html"><img src="/module/page/front/img/logo.png" alt="예약박스" /></a></h1>
			<p><strong>News</strong><a href="<?=$base_uri?>/notice/view.html?bo_id=<?=$nt_list[0]['bo_id']?>" class="btn_ajax size_800x700" target="#layer_popup" title="공지사항"><em><?=$nt_list[0]['bo_subject']?></em><span><?=$nt_list[0]['reg_date']?></span></a></p>
			<ul class="top_util">			
			<li><a href="https://www.facebook.com/051girl" class="" target="_blank"><img src="/module/page/front/img/ico1.png" alt="페이스북" /></a></li>
			<li><a href="http://instagram.com/reserve_box" class="" target="_blank"><img src="/module/page/front/img/ico3.png" alt="인스타" /></a></li>
			</ul>
		</div>
		<!-- //headerWrap -->
	</div>
	<!-- //header -->

	<!-- container -->
	<div id="container">

		<!-- main_container -->
		<h2 class="hidden">메인본문영역</h2>
		<div id="main_container">

			<!-- m_sec1 -->
			<div id="sec1" class="main_section">
				<h2 class="hidden">메인비주얼영역</h2>
				<div class="m_top_btn">
					<h3 class="hidden">페이지이동</h3>
					<ul>
					<li class="pre"><button type="button" onclick="moveMainSection('prev')"><span>이전</span></button></li>
					<li class="next"><button type="button" onclick="moveMainSection('next')"><span>다음</span></button></li>
					</ul>
				</div>
				<div class="main_visual"><span>Reservations boxes 언제 어디서나, 터치 한번으로 내 삶을 아름답게</span></div>
				<div class="m_sec1_banner">
					<ul>
					<li><a href="#" class="btn_no_complete"><img alt="Open Event 리뷰달고 서비스 받자!" src="/module/page/front/img/banner02.png" /></a></li>
					<li><a href="https://play.google.com/store/apps/details?id=com.inplusweb.wbox" target="_blank" title="새창"><img alt="Android app on google play" src="/module/page/front/img/banner01.png"/></a></li>
					</ul>
				</div>
			</div>
			<!-- //m_sec1 -->

			<!-- m_sec2 -->			
			<div id="sec2" class="main_section">
				<h2 class="hidden">메인바 및 가맹점신청, 제휴제안영역</h2>
				<p class="m_sec2_banner"><img alt="Beta Open 2016가장 진화된 간편 예약서비스 영화예매처럼 빠른 실시간 예약 예약박스 모바일 앱을 다운받아보세요!" src="/module/page/front/img/bg_sec2.png" /></p>
				<div class="request">
				<ul>
				<li>
					<div>
						<strong>가맹점 신청</strong>
						<span>복잡한 매장관리 업무를 심플하게<br/>분산된 관리시스템을 하나로 통합하여<br/>업무를 줄이세요. 자주 쓰던 기능만<br/>사용하다보면자동으로 정리가 됩니다.</span>
						<a href="<?=$base_uri?>/application/write.html" class="btn_ajax size_800x700" target="#layer_popup" title="가맹점 신청">가맹점 신청 바로가기</a>
					</div>
				</li>
				<li>
					<div>
						<strong>제휴문의</strong>
						<span>사람과 사람, 사람과 세상을 이어,<br/>보다 나은 세상을 만들기 위한 다양한<br/>제휴제안을 기다립니다.</span>
						<a href="<?=$base_uri?>/alliance/write.html" class="btn_ajax size_800x700" target="#layer_popup" title="제휴문의">제휴문의 바로가기</a>
					</div>
				</li>
				</ul>
				</div>
			</div>
			<!-- //m_sec2 -->

			<!-- m_sec3 -->			
			<div id="sec3" class="main_section">
				<h2 class="hidden">information</h2>
				
				<div class="con_area">
					<h3><img src="/module/page/front/img/h3_information.png" alt="information" /></h3>
					
					<!-- tab -->
					<div class="tab">		
						<ul class="tab_wrap1">
						<li class="tab01">
							<a class="tab_title hover" href="#this1">예약박스 고객용 App</a>
							<div class="tab_content sub01">
								<!-- slide -->
								<div id="fade-box">
									<div class="fade-visual">
										<ul>
											<li class="bg1"><span></span></li>
											<li class="bg2"><span></span></li>
											<li class="bg3"><span></span></li>
											<li class="bg4"><span></span></li>
											<li class="bg5"><span></span></li>
										</ul>
									</div>

									<div class="fade-indicator">
										<button type="button">1</button>
										<button type="button">2</button>
										<button type="button">3</button>
										<button type="button">4</button>
										<button type="button">5</button>				
									</div>

									<div class="fade-control">
										<button type="button" class="fade-prev">이전</button>
										<button type="button" class="fade-next">다음</button>
									</div>
								</div>									
								<!-- //slide -->
							</div>
						</li>	

						<li class="tab02">
							<a class="tab_title" href="#this2">예약박스 담당자전용 App</a>
							<div class="tab_content sub02">					
								<!-- slide -->
								<div id="fade-box2">
									<div class="fade-visual">
										<ul>
											<li class="bg1"><span></span></li>
											<li class="bg2"><span></span></li>
											<li class="bg3"><span></span></li>
											<li class="bg4"><span></span></li>
											<li class="bg5"><span></span></li>
											<li class="bg6"><span></span></li>
										</ul>
									</div>

									<div class="fade-indicator">
										<button type="button">1</button>
										<button type="button">2</button>
										<button type="button">3</button>
										<button type="button">4</button>
										<button type="button">5</button>
										<button type="button">6</button>
									</div>

									<div class="fade-control">
										<button type="button" class="fade-prev">이전</button>
										<button type="button" class="fade-next">다음</button>
									</div>
								</div>
								<!-- //slide -->
							</div>
						</li>			
						</ul>
					</div>
					<!-- //tab-->
				</div>
			
			</div>
			<!-- //m_sec3 -->

			<!-- m_sec4 -->			
			<div id="sec4" class="main_section">
				<h2 class="hidden">게시물영역</h2>
				<ul>
				<li><a href="<?=$base_uri?>/faq/list.html" class="btn_ajax size_800x700" target="#layer_popup" title="FAQ"><span><i class="fa fa-list-alt"></i></span>FAQ</a></li>
				<li><a href="<?=$base_uri?>/qna/write.html" class="btn_ajax size_800x700" target="#layer_popup" title="1:1문의"><span><i class="fa fa-question-circle"></i></span>1:1문의</a></li>
				<li><a href="<?=$base_uri?>/notice/list.html" class="btn_ajax size_800x700" target="#layer_popup" title="공지사항"><span><i class="fa fa-microphone"></i></span>공지사항</a></li>
				<li><a href="<?=$base_uri?>/blog/list.html" class="btn_ajax size_800x700" target="#layer_popup" title="SNS후기"><span><i class="fa fa-rss"></i></span>SNS후기</a></li>
				<li><a href="#" class="btn_no_complete"><span><i class="fa fa-desktop"></i></span>원격지원서비스</a></li>
				</ul>
			</div>
			<!-- //m_sec4 -->

		</div>
		<!-- //main_container -->
	</div>
	<!-- //container -->

<!-- footer -->
<div id="footer">
	<div class="footerWrap">
		<div class="f_util">
		<p class="logo"><img alt="예약박스로고" src="/module/page/front/img/f_logo.png" /></p>
		<p class="btn_top"><a href="#wrap"><img alt="top" src="/module/page/front/img/btn_top.gif" /></a></p>
		</div>
		<div class="add">
			<ul>
			<li>상호 : (주)로드랩 <span>대표이사 : 오창준</span></li>
			<li>주소 : 부산광역시 해운대구 APEC로 17,3905(우동,센텀리더스마크) <span>T 051-747-0310</span> <span>F 051-745-9277</span></li>
			<li>통신판매업 신고 번호 : 제 2014-부산 해운-0406호</li>
			</ul>
			<p>COPYRIGHT © <span>Road Lab</span> ALL RIGHTS RESERVED</p>
			<p class="f_info"><img alt="051.747.0310 운영시간 9시30분 ~ 오후 6시(공휴일제외)" src="/module/page/front/img/f_info.gif" /></p>
		</div>
		
	</div>
</div>
<!-- //footer -->

<!-- layer popup -->
<div id="layer_back"></div>
<div id="layer_popup">
	<div id="layer_header">
		<h1>레이어팝업</h1>
		<button type="button" onclick="closeLayerPopup()" title="닫기"><img src="/img/common/btn_close_layer.gif" alt="X" /></button>
	</div>

	<div id="layer_content">		
		레이어팝업 내용
	</div>	
</div>
<!-- //layer popup -->
