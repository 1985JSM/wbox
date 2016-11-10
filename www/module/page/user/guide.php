<?
if(!defined('_INPLUS_')) { exit; } 

$doc_title = '이용안내';
$footer_nav['1'] = true;
$back_url = '../page/main.html';

$oPage = new PageUser();
$oPage->init();
?>
<script type="text/javascript">
$(document).ready(function() {

});
</script>
<style type="text/css">
div.guide {background:#fff;}
div.guide_main img { max-width:640px; width:100%;}
div.box {}

div.box {padding: 40px 0; box-sizing:border-box;}
div.box p {font-size:18px; padding-bottom:10px;font-weight:bold; color:#3c3c3c;}
div.box img { max-width:640px; width:100%;}
div.box div.text {text-align:center; padding:0 10px;}
</style>
	
<div id="container" class="container">
	<div class="guide">
		
		<div class="guide_main"><img src="/img/mobile/sub/img_guide1.png" alt="" /></div>

		<div class="box">
			<img src="/img/mobile/sub/img_guide2.png" alt="" />
			<div class="text">
				<p>진정한 단골이라면?</p>
				예약박스를 통해서 단골매장을 등록하면 나의 단골매장<br />
				직원리스트, 포트폴리오, 이벤트 등 심지어 예약스케줄까지<br />
				볼 수 있어요
			</div>
		</div>

		<div class="box">
			<img src="/img/mobile/sub/img_guide3.png" alt="" />
			<div class="text">
				<p>언제까지 통화를 하실건가요?</p>
				내가 필요한 시간에는 항상 예약이 안되고 <br />
				예약시간변경을 하려면 다시 전화하고 <br />
				취소한다고 말하기 미안해서 통화를 망설이고 <br />
				업무 중에 눈치보며 전화하고 영업마감 이후에는 <br />
				연락이 힘들고 이제는 쉽고 빠르게 예약하세요!<br />
			</div>
		</div>

	</div>
</div>

        
