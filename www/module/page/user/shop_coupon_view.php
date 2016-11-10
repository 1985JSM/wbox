<?
if(!defined('_INPLUS_')) { exit; } 

$doc_title = '쿠폰사용';
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

div.coupon_detail {display:block;padding:20px 10px;}
div.coupon_detail div.coupon_info {position:relative;}
div.coupon_detail div.coupon_info span.tit {display:block; padding:92px 0 20px 0; font-size:18px; font-weight:bold; text-align:center;}
div.coupon_detail div.coupon_info span.benefit {display:block; position:absolute; top:0; right:50%; margin-right:-40px; width:80px; height:80px; line-height:80px; font-weight:bold;text-align:center;  box-sizing:border-box;border-radius:60px; background:#f06e58; color:#fff;}
div.coupon_detail div.coupon_info span.benefit i  {display:block; padding-bottom:2px;}
div.coupon_detail div.coupon_guide {margin-bottom:20px;font-size:12px; color:#888888;}
div.coupon_detail div.coupon_guide span {display:block;}
div.coupon_detail div.coupon_guide ul {margin-top:6px;}
div.coupon_detail div.coupon_guide ul li {padding-left:16px; background:url("/img/mobile/ico/ico_belit.png") 6px 6px no-repeat; background-size:3px;}

div.coupon_area.disable div.coupon_info span.btn_use {border-color:#999999; color:#999999; }
div.coupon_area.disable div.coupon_info span.benefit {background-color:#999999; }

div.coupon_detail.disable div.coupon_info span.benefit {background-color:#999999; }
div.coupon_detail.disable button.btn_orange {background-color:#888; }


</style>


<div id="container" class="container">
	<div class="view_detail">

		<div class="coupon_detail disable"> <!-- 쿠폰사용누르면 class="disable" -->
			<div class="coupon_info">
				<span class="benefit">90,000원</span>
				<span class="tit">쿠폰명이들어갑니다</span>				
			</div>
			<div class="coupon_guide">
				
				<span><i class="xi-info-circle"></i> <strong>쿠폰 사용 수</strong> <strong class="col_aqua">1</strong> / 무제한</span>
				<span><i class="xi-medal"></i>  <strong>사용등급</strong> 일반, 브론즈, 실버, 골드, VIP </span>
				<span class="col_orange"><i class="xi-check-circleout"></i> <strong>직원이 쿠폰을 확인할 수 있도록 보여주세요.</strong></span>
				<ul>
				<li>설명이들어가게됩니다.설명이길어지게된다면 이렇게됩니다</li>
				<li>설명이들어가게됩니다.</li>
				<li>설명이들어가게됩니다.</li>
				</ul>
			</div>
			
			<button type="button" class="btn_orange">쿠폰사용완료</button>
		</div>
		

	</div>        
</div>
<!-- //container -->

