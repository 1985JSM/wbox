<?
if(!defined('_INPLUS_')) { exit; } 

$oPage = new PageUser();
$oPage->init();
?>
<style>
div.tutorial_detai_img {padding-top:30px; position:relative; overflow:hidden; margin-bottom:20px;background:url("/img/mobile/bg/bg_tutorial.png") 0 0 no-repeat; background-size:100%}
div.tutorial_detai_img  div.tutorial_img_area { }
div.tutorial_detai_img  div.tutorial_img_area div {}
div.tutorial_detai_img .slick-track {left:50%; margin-left:-143px;}

#tutorial_img_area img {width:287px; height:500px;}
#tutorial_img_area .slick-prev { overflow:hidden; position:absolute; top:50%; left:10px; width:17px; height:26px; margin-top:-33px; background:url("/img/mobile/btn/btn_img_control.png") no-repeat 0 0; background-size:14px 50px; text-indent:-9999px; -webkit-background-size:17px 52px; border:0; }
#tutorial_img_area .slick-next { overflow:hidden; position:absolute; top:50%; right:10px; width:17px; height:26px; margin-top:-33px; background:url("/img/mobile/btn/btn_img_control.png") no-repeat 0 -25px; background-size:14px 50px; text-indent:-9999px; -webkit-background-size:17px 52px; border:0;}
/*#tutorial_img_area ul.slick-dots { position:absolute; width:100%; bottom:10px; height:10px; padding:0; text-align:center; } */
#tutorial_img_area ul.slick-dots { height:10px; padding:0 0 20px; text-align:center; } 
#tutorial_img_area ul.slick-dots li { display:inline-block; margin-left:10px; }
#tutorial_img_area ul.slick-dots li:first-child { margin-left:0; }
#tutorial_img_area ul.slick-dots li button { display:block; overflow:hidden; width:10px; height:10px; border:2px solid #ddd; background:none;  border-radius:10px; text-indent:-9999px; }
#tutorial_img_area ul.slick-dots li.slick-active button { border:2px solid #f06e58; background:#f06e58; }

#tutorial_img_area div.main_btn {position:relative; }
#tutorial_img_area div.main_btn button {position:absolute; bottom:20px; left:90px; height:36px; line-height:36px; margin:0; padding:0 20px; text-align:center;  border:0; border-radius:4px; background:#f06e58; color:#fff; cursor:pointer;}
</style>
<script type="text/javascript">
$(document).ready(function() {

	closeGnb();
	
	// 튜토리얼
	$("#tutorial_img_area > div.tutorial_img_area").slick({
		arrows: true,
		infinite: false,
		dots: true,
		slidesToShow: 1,
		slidesToScroll: 1,
		autoplay: false
	});
});
</script>
	
<div id="container6" class="container">
	<div class="tutorial">
	
		<div id="tutorial_img_area" class="tutorial_detai_img">
			<div class="tutorial_img_area">				
				<div><img src="/img/mobile/sub/img_landing1.png" alt="" /></div>
				<div><img src="/img/mobile/sub/img_landing2.png" alt="" /></div>
				<div><img src="/img/mobile/sub/img_landing3.png" alt="" /></div>
				<div>
					<img src="/img/mobile/sub/img_landing4.png" alt="" />
					<div class="main_btn"><button type="button" onclick="closeLayerPage('9')">메인으로 <i class="xi-angle-right"></i></button></div>
				</div>
			</div>
		</div>


	</div>
</div>

        
