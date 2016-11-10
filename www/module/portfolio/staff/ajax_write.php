<?
/* init Class */
$oPortfolio = new PortfolioStaff();
$oPortfolio->init();
$module_name = $oPortfolio->get('module_name');	// 모듈명
$pk = $oPortfolio->get('pk');
$uid = $oPortfolio->get('uid');

$oPortfolio->set('thumb_width', '80');
$oPortfolio->set('thumb_height', '80');
$data = $oPortfolio->selectDetail($uid);

$cnt_file = sizeof($data['file_list']);

if($data[$pk]) {
	$mode = 'update';
}
else {
	$mode = 'insert';
}
?>
<div class="portfolio_add_area">
	<form name="portfolio_form" method="post" action="../portfolio/process.html" onsubmit="return submitPortfolioForm(this)">
	<input type="hidden" name="flag_json" value="1" />
	<input type="hidden" name="mode" value="<?=$mode?>" />
	<input type="hidden" name="<?=$pk?>" value="<?=$uid?>" />

	<div class="layer_input">
		<input type="text" name="pf_subject" value="<?=$data['pf_subject']?>" class="required" placeholder="제목을 입력해주세요." title="제목">
	</div>

	<div class="layer_textarea">
		<textarea name="pf_content" title="내용" class="required" placeholder="내용을 입력해주세요."><?=$data['pf_content']?></textarea>
	</div>
	
	<div class="portfolio_upload<? if($cnt_file) { ?> on<? } ?>">
		
		<div id="photo_button">
			<button type="button" onclick="choosePortfolioPhoto()" class="btn_camera">
				<i class="fa fa-camera"></i>
			</button>
		</div>

		<div id="photo_thumb" class="img_area">
			<button type="button" onclick="deletePortfolioPhoto()" class="btn_del_img">
				<img src="<?=$data['thumb']?>" width="40" height="40" >			
				<span><i class="fa fa-close"></i></span>
			</button>
		</div>		
	</div>
	
	<ul class="layer_btn">
	<li><div><input type="submit" value="등록하기" class="btn_orange"></div></li>
	</ul>

	</form>
</div>