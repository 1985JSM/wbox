<?
if(!defined('_INPLUS_')) { exit; } 

$oReserve = new ReserveStaff();
$oReserve->init();

/* insert or update */
$pk = $oReserve->get('pk');
$uid = $oReserve->get('uid');
$data = $oReserve->selectDetail($uid);
?>
<style type="text/css">
div.admin_memo {position:relative; padding:20px 10px;}
div.admin_memo div.layer_textarea{padding:10px;border:1px solid #ccc; border-radius:2px; margin-bottom:5px; background:#fff;}
div.admin_memo div.layer_textarea textarea{ border:0;width:100%;height:200px}
</style>
<script type="text/javascript">
$(document).ready(function() {

});
</script>

<div class="location">
	<h2>관리자메모</h2>
	<button type="button" onclick="closeLayerPage('6')" class="location_prev"><i class="xi-angle-left"></i></a>	
</div>

<div id="container6" class="container">

	<div class="admin_memo">
		<form name="memo_form" method="post" action="../reserve/process.html" onsubmit="return submitMemoForm(this)">
		<input type="hidden" name="flag_json" value="1" />	
		<input type="hidden" name="mode" value="update_memo" />
		<input type="hidden" name="<?=$pk?>" value="<?=$uid?>" />

		<div class="layer_textarea">
			<textarea name="rs_pay_memo" placeholder="고객관리를 위한 관리자 메모입니다. 해당 메모는 관리자만 확인 가능합니다." title="고객관리용 관리자메모"><?=$data['rs_pay_memo']?></textarea>
		</div>

		<ul class="layer_btn">
		<li><div><button type="submit" class="btn_orange">저장</button></div></li>	
		</ul>

		</form>
	</div>
</div>