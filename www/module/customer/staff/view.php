<?
if(!defined('_INPLUS_')) { exit; } 

$oCustomer = new CustomerStaff();
$oCustomer->init();

/* insert or update */
$pk = $oCustomer->get('pk');
$uid = $oCustomer->get('uid');
$data = $oCustomer->selectDetail($uid);

/* advance_purchase */
if(!isset($oAdvancePurchase)) {
	include_once(_MODULE_PATH_.'/advance_purchase/advance_purchase.staff.class.php');
	$oAdvancePurchase = new AdvancePurchaseStaff();
	$oAdvancePurchase->init();
}
$ad_list = $oAdvancePurchase->selectList();
?>
<style type="text/css">
div.basic_info {position:relative; padding:20px 10px; background:#fff;}
div.basic_info ul.info{position:relative; padding-bottom:20px}
div.basic_info ul.info li {position:relative; padding:4px 0 4px 80px;  }
div.basic_info ul.info li em {position:absolute; top:4px; left:0; border-bottom:0; font-size:12px; font-weight:normal;color:#999;}
</style>
<script type="text/javascript">
$(document).ready(function() {

});
</script>

<div class="location">
	<h2>고객정보</h2>
	<button type="button" onclick="closeLayerPage('6')" class="location_prev"><i class="xi-angle-left"></i></a>	
</div>

<div id="container6" class="container">

	<div class="basic_info">
			
		<ul class="info">
		<li>
			<em>이름</em>
			<span><?=getWithoutNull($data['cs_name'])?></span>
		</li>
		<li>
			<em>닉네임</em>
			<span><?=getWithoutNull($data['cs_nick'])?></span>
		</li>
		<li>
			<em>고객등급</em>
			<span><?=getWithoutNull($data['txt_cs_level'])?></span>
		</li>
		<li>
			<em>생일(성별)</em>
			<span><?=$data['txt_cs_birth']?> (<?=$data['txt_cs_birth_type']?>) / <?=$data['txt_cs_gender']?></span>
		</li>
		<li>
			<em>지역</em>
			<span><?=getWithoutNull($data['txt_cs_area'])?></span>
		</li>
		<li>
			<em>휴대폰</em>
			<span><?=getWithoutNull($data['cs_hp'])?></span>
		</li>
		<li>
			<em>이메일</em>
			<span><?=getWithoutNull($data['cs_email'])?></span>
		</li>
		<li>
			<em>관리자메모</em><!-- 고객관리의 관리자 메모 출력 -->
			<span><?=getWithoutNull($data['cs_memo'])?></span>
		</li>
		<? for($i = 0 ; $i < sizeof($ad_list) ; $i++) { ?>
		<li>
			<em>선불제</em>
			<span>
				<?=$ad_list[$i]['ad_pc_name']?> (
				<? if($ad_list[$i]['ad_pc_type'] == 'M') { ?><?=number_format($ad_list[$i]['remain_money'])?>
				<? } else if($ad_list[$i]['ad_pc_type'] == 'Q') { ?><?=number_format($ad_list[$i]['remain_quantity'])?> / <?=number_format($ad_list[$i]['ad_pc_quantity'])?>
				<? } else if($ad_list[$i]['ad_pc_type'] == 'P') { ?><?=$ad_list[$i]['ad_pc_expire']?><? } ?>)
		</li>
		<? } ?>
		</ul>
		

	</div>
</div>