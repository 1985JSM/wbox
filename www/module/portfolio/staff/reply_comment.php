<?
if(!defined('_INPLUS_')) { exit; } 

$oPortfolio = new PortfolioStaff();
$oPortfolio->init();

$pk = $oPortfolio->get('pk');
$uid = $oPortfolio->get('uid');

$comment_pk = $oPortfolio->get('comment_pk');
$cm_id =($_POST[$comment_pk]) ? $_POST[$comment_pk] : $_GET[$comment_pk];

$data = $oPortfolio->selectCommentDetail($cm_id);
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
	<h2>답변작성</h2>
	<button type="button" onclick="closeLayerPage('6')" class="location_close"><i class="xi-close"></i></a>	
</div>

<div id="container6" class="container">

	<div class="review_add_area">

		<form name="reply_comment_form" method="post" action="../portfolio/process.html" onsubmit="return submitReplyPortfolioCommentForm(this)">
		<input type="hidden" name="flag_json" value="1" />
		<input type="hidden" name="mode" value="reply_comment" />
		<input type="hidden" name="sh_code" value="<?=$sh_code?>" />
		<input type="hidden" name="<?=$pk?>" value="<?=$uid?>" />
		<input type="hidden" name="<?=$comment_pk?>" value="<?=$cm_id?>" />

		<div class="layer_textarea">
			<textarea name="re_content" title="답변 내용" class="required" placeholder="답변 내용을 입력해주세요."><?=$data['re_content']?></textarea>
		</div>

		<ul class="layer_btn">
		<li><div><input type="submit" value="등록하기" class="btn_orange"></div></li>
		</ul>

		</form>
	</div> 
</div>