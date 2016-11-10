<?
if(!defined('_INPLUS_')) { exit; } 

$doc_title = '포트폴리오관리';
$footer_nav['5'] = true;
$back_url = '../page/more.html';

$oPortfolio = new PortfolioStaff();
$oPortfolio->init();
?>
<script type="text/javascript">
$(document).ready(function() {
	$("#container").scroll(function() {
		getNextPage();		
	});
});
</script>
<style type="text/css">
div.review_add_area {background:#fff;}
div.review_add_area div.staff_name {margin-bottom:10px;}
div.review_add_area div input.input_txt
{border:1px solid #ccc;border-radius:3px; height:40px; line-height:40px; font-size:14px;color:#555;width:100%; text-indent:10px;box-sizing:border-box}


div.review_add_area {position:relative; padding:20px 10px;}
div.review_add_area div.layer_textarea{padding:10px;border:1px solid #ccc; border-radius:2px; margin-bottom:5px; background:#fff;}
div.review_add_area div.layer_textarea textarea{ border:0;width:100%;height:200px}
</style>


	<div id="container6" class="container">
		<div class="review_add_area">

		<form name="" method="" action="" onsubmit="" target="">
		<div class="staff_name">
			<div><input type="text" name="" class="input_txt required" value="" placeholder="이름" title="이름"></div>
		</div>

		<div class="layer_textarea">
			<textarea name="" title="내용" class="required" placeholder="내용을 입력해주세요."></textarea>
		</div>

		<ul class="layer_btn">
		<li><div><input type="button" value="등록하기" class="btn_orange"></div></li>
		</ul>

		</form>
		</div>
	</div>

