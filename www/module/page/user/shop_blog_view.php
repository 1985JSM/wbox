<?
if(!defined('_INPLUS_')) { exit; } 

$doc_title = '블로그리뷰 전체보기';
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
div.blog_board_all {padding:20px 0; background:#fff;}
div.blog_board ul li {padding:10px 10px; border-top:1px #f6f6f6 solid;}
div.blog_board ul li:first-child {padding-top:0; border-top:0; }
div.blog_board ul li a {display:block; overflow:hidden; position:relative; height:90px; padding-left:100px;}
div.blog_board ul li a span.img {position:absolute; left:0; top:0; }
div.blog_board ul li a span.img img{width:90px; height:90px;}
div.blog_board ul li a strong {display:block; overflow:hidden; padding-bottom:4px; text-overflow:ellipsis; white-space:nowrap;}
div.blog_board ul li a span.text {display:block; padding-bottom:6px; font-size:12px; overflow:hidden; max-height:32px;}
div.blog_board ul li a span.date {display:block; font-size:12px; color:#888888;}
</style>


<div id="container" class="container">
	<div class="blog_board_all">
		<div class="blog_board">
			<ul>
			<li>
				<a>
					<span class="img"><img src="http://wbox.inplus21.com/img/mobile/common/s_logo2.png" alt="no_img" /></span>
					<strong>네일아트샵을 소개해요! 엄청 추천 강추!</strong>
					<span class="text">세련되고 고급스러운 뷰티샵이에요. 다만 예약시간보다 20분 더 일찍가면 좋을것같아요. 이것저것 다른 서비스들도 함께 챙겨줍니다.</span>
					<span class="date">2016.01.05</span>
				</a>
			</li>
			<li>
				<a>
					<span class="img"><img src="http://wbox.inplus21.com/img/mobile/common/s_logo2.png" alt="no_img" /></span>
					<strong>네일아트샵을 소개해요! 엄청 추천 강추!</strong>
					<span class="text">세련되고 고급스러운 뷰티샵이에요. 다만 예약시간보다 20분 더 일찍가면 좋을것같아요. 이것저것 다른 서비스들도 함께 챙겨줍니다.</span>
					<span class="date">2016.01.05</span>
				</a>
			</li>
			</ul>
		</div>
	</div>
</div>
<!-- //container -->

