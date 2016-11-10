<?
if(!defined('_INPLUS_')) { exit; } 

$doc_title = '가맹점명';
$footer_nav['4'] = true;

$oPage = new PageUser();
$oPage->init();

?>
<script type="text/javascript">
$(document).ready(function() {

	// 가맹점 탭 변경
	$("#shop_tab > li").not(":eq(1)").removeClass("on").end().eq(1).addClass("on");
});
</script>
<style type="text/css">
div.coupon {margin-bottom:20px; background:#fff;}
div.coupon h4 {padding:10px; font-size:14px; border-bottom:4px solid #f6f6f6; color:#000;}
div.coupon > ul > li {border-bottom:1px solid #f6f6f6}
div.coupon_area a {display:block;padding:20px 10px;}
div.coupon_area div.coupon_info {position:relative;}
div.coupon_area div.coupon_info span.tit {display:block; margin-right:92px; font-size:16px; font-weight:bold; text-overflow:ellipsis; white-space:nowrap; overflow:hidden;}
div.coupon_area div.coupon_info span.btn_use {display:block; width:80px; height:24px; margin:10px 0 12px 0;  line-height:24px; font-size:14px; text-align:center; border:1px solid #f06e58; border-radius:24px; color:#f06e58}
div.coupon_area div.coupon_info span.benefit {display:block; position:absolute; top:0; right:0; width:80px; height:80px; line-height:80px; font-weight:bold;text-align:center;  box-sizing:border-box;border-radius:60px; background:#f06e58; color:#fff;}
div.coupon_area div.coupon_info span.benefit i  {display:block; padding-bottom:2px;}
div.coupon_area div.coupon_guide {font-size:12px; color:#888888}
div.coupon_area div.coupon_guide span {display:block;}
div.coupon_area div.coupon_guide ul {margin-top:6px;}
div.coupon_area div.coupon_guide ul li {padding-left:16px; background:url("/img/mobile/ico/ico_belit.png") 6px 6px no-repeat; background-size:3px;}

div.coupon_area.disable div.coupon_info span.btn_use {border-color:#999999; color:#999999; }
div.coupon_area.disable div.coupon_info span.benefit {background-color:#999999; }

div.coupon li.no_data p { padding:15px 10px; text-align:center;color:#888;}
div.coupon li.no_data p i {display:block; margin-bottom:10px; font-size:40px; color:#cccccc }


div.board {margin-bottom:20px; background:#fff;}
div.board h4 {padding:10px; font-size:14px; border-bottom:4px solid #f6f6f6; color:#000;}

div.board ul.board_list li button{ border-bottom:1px solid #f6f6f6; }
div.board ul.board_list {border-bottom:0;}

div.board ul li.on i {-webkit-transform: rotate(180deg);transform: rotate(180deg)}

div.board li.no_data p { padding:15px 10px; border-bottom:0; text-align:center;color:#888;}
div.board li.no_data p i {display:block; margin-bottom:10px; font-size:40px; color:#cccccc }


</style>

<div class="tab">
	<ul id="shop_tab" class="tab_list tab_list05">
	<li><a href="#" class="btn_ajax" target="#container2">기본정보</a></li>
	<li><a href="#" class="btn_ajax" target="#container2">서비스</a></li>
	<li><a href="#" class="btn_ajax" target="#container2">담당자</a></li>
	<li class="on"><a href="#" class="go_hash btn_ajax" target="#container2">공지쿠폰</a></li>
	<li><a href="#" class="btn_ajax" target="#container2">포트폴리오</a></li>
	</ul>
</div>

<div id="container" class="container">
	<div class="view_detail">

		<div class="coupon">
			<h4><i class="xi-coupon"></i> 매장 쿠폰 안내입니다.</h4>

			<ul>
			<li>

				<div class="coupon_area"> <!-- 사용시 class="disable" 추가 -->
					<a href="#">					
						<div class="coupon_info">
							<span class="tit">쿠폰명이들어갑니다길어지면이렇게됩니다</span>
							<span class="btn_use">사용하기</span>
							<span class="benefit">쿠폰</span>
						</div>
						<div class="coupon_guide">
							<span><i class="xi-info-circle"></i> <strong>쿠폰 사용 수</strong> <strong class="col_aqua">1</strong> / 무제한</span>
							<span><i class="xi-medal"></i>  <strong>사용등급</strong> 일반, 브론즈, 실버, 골드, VIP </span>
							<ul>
							<li>설명이들어가게됩니다.설명이길어지게된다면 이렇게됩니다</li>
							<li>설명이들어가게됩니다.</li>
							<li>설명이들어가게됩니다.</li>
							</ul>
						</div>				
					</a>
				</div>
				<!-- //coupon_area -->

			</li>
			<li>

				<div class="coupon_area disable"><!-- 사용시 class="disable" 추가 -->
					<a href="#">					
						<div class="coupon_info">
							<span class="tit">쿠폰명이들어갑니다길어지면이렇게됩니다</span>
							<span class="btn_use">사용불가</span>
							<span class="benefit">90,000원</span>
						</div>
						<div class="coupon_guide">
							<span><i class="xi-info-circle"></i> <strong>쿠폰 사용 수</strong> <strong class="col_aqua">1</strong> / 무제한</span>
							<span><i class="xi-medal"></i>  <strong>사용등급</strong> 일반, 브론즈, 실버, 골드, VIP </span>
							<!-- 설명이 들어가지 않은 경우 -->
						</div>				
					</a>
				</div>
				<!-- //coupon_area -->

			</li>
			<li class="no_data">
				<p><i class="xi-close-circle"></i> 등록된 쿠폰이 없습니다.</p>
			</li>

			</ul>
		</div>

		<div class="board">
			<h4><i class="xi-notice"></i> 매장 공지 입니다.</h4>
			<ul id="board_list" class="board_list">
			<li class="on">
				<button type="button" onclick="toggleArticle(this)" />
					가맹점 공지내용이 들어가게됩니다.<span class="data">2016.06.01</span>
					<i class="xi-angle-down"></i>
				</button>
				<div class="cont">
					콘텐츠 내용이 들어갑니다.
				</div>
			</li>	
			<li>
				<button type="button" onclick="toggleArticle(this)" />
					가맹점 공지내용이 들어가게됩니다.<span class="data">2016.06.01</span>
					<i class="xi-angle-down"></i>
				</button>
				<div class="cont">
					콘텐츠 내용이 들어갑니다.
				</div>
			</li>	
			<li class="no_data">
				<p><i class="xi-close-circle"></i> 등록된 공지사항이 없습니다.</p>
			</li>
			</ul> 
		</div>
		

	</div>        
</div>
<!-- //container -->

