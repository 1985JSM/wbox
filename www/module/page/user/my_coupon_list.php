<?
if(!defined('_INPLUS_')) { exit; } 



$doc_title = '나의쿠폰';
$footer_nav['1'] = true;

$oPage = new PageUser();
$oPage->init();

?>

<style type="text/css">
div.coupon {margin-bottom:20px; background:#fff;}
div.coupon h4 {padding:10px; font-size:14px; border-bottom:4px solid #f6f6f6; color:#000;}
div.coupon > ul > li {border-bottom:1px solid #f6f6f6}
div.coupon_area a {display:block;padding:20px 10px;}
div.coupon_area div.coupon_info {position:relative;}
div.coupon_area div.coupon_info span.tit {display:block; margin-right:92px; font-size:16px; font-weight:bold; text-overflow:ellipsis; white-space:nowrap; overflow:hidden;}
div.coupon_area div.coupon_info span.btn_use {display:block; width:80px; height:24px; margin:10px 0 12px 0;  line-height:24px; font-size:14px; text-align:center; border:1px solid #f06e58; border-radius:24px; color:#f06e58}
div.coupon_area div.coupon_info span.benefit {display:block; position:absolute; top:0; right:0; width:80px; height:80px; line-height:80px; font-weight:bold;text-align:center;  box-sizing:border-box;border-radius:60px; background:#f06e58; color:#fff;}
div.coupon_area div.coupon_guide {font-size:12px; color:#888888}
div.coupon_area div.coupon_guide span {display:block;}

div.coupon_area div.coupon_guide ul {margin-top:6px;}
div.coupon_area div.coupon_guide ul li {padding-left:16px; background:url("/img/mobile/ico/ico_belit.png") 6px 6px no-repeat; background-size:3px;}

div.coupon_area.disable div.coupon_info span.btn_use {border-color:#999999; color:#999999; }
div.coupon_area.disable div.coupon_info span.benefit {background-color:#999999; }

div.coupon li.no_data p { padding:15px 10px; text-align:center;color:#888;}
div.coupon li.no_data p i {display:block; margin-bottom:10px; font-size:40px; color:#cccccc }

</style>

	<div id="container" class="container">

		<div class="coupon">
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
							<span class="benefit">이벤트</span>
						</div>
						<div class="coupon_guide">
							<span><i class="xi-info-circle"></i> <strong>쿠폰 사용 수</strong> <strong class="col_aqua">1</strong> / 무제한</span>
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

	</div>
	<!-- container -->