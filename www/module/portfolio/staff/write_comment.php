<?
if(!defined('_INPLUS_')) { exit; } 

$oPortfolio = new PortfolioStaff();
$oPortfolio->init();

$pk = $oPortfolio->get('pk');
$uid = $oPortfolio->get('uid');
?>
<style type="text/css">
div.review_add_area {background:#fff;}
div.review_add_area div.staff_name {margin-bottom:10px;}
div.review_add_area div input.input_txt
{border:1px solid #ccc;border-radius:3px; height:40px; line-height:40px; font-size:14px;color:#555;width:100%; text-indent:10px;box-sizing:border-box}


div.review_add_area {position:relative; padding:20px 10px;}
div.review_add_area div.layer_textarea{padding:10px;border:1px solid #ccc; border-radius:2px; margin-bottom:5px; background:#fff;}
div.review_add_area div.layer_textarea textarea{ border:0;width:100%;height:200px}
</style>

<div class="location">
	<h2>댓글쓰기</h2>
	<button type="button" onclick="closeLayerPage('6')" class="location_close"><i class="xi-close"></i></a>	
</div>

<div id="container6" class="container">

	<div class="review_add_area">

		<form name="write_comment_form" method="post" action="../portfolio/process.html" onsubmit="return submitWritePortfolioCommentForm(this)" target="#comment_list">
		<input type="hidden" name="flag_json" value="1" />
		<input type="hidden" name="mode" value="insert_comment" />
		<input type="hidden" name="sh_code" value="<?=$sh_code?>" />
		<input type="hidden" name="<?=$pk?>" value="<?=$uid?>" />

		<div class="staff_name">
			<div><input type="text" name="cm_name" class="input_txt required" value="" placeholder="작성자명" title="작성자명" /></div>
		</div>

		<div class="layer_textarea">
			<textarea name="cm_content" title="내용" class="required" placeholder="내용을 입력해주세요."></textarea>
		</div>

		<ul class="layer_btn">
		<li><div><input type="submit" value="등록하기" class="btn_orange"></div></li>
		</ul>

		</form>
	</div> 
</div>