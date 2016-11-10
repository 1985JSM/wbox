<?
if(!defined('_INPLUS_')) { exit; } 

/* init Class */
global $oAdvancePurchase;
if(!isset($oAdvancePurchase)) {
	include_once(_MODULE_PATH_.'/advance_purchase/advance_purchase.manager.class.php');
	$oAdvancePurchase = new AdvancePurchaseManager();
	$oAdvancePurchase->init();
}

$ad_pc_pk = $oAdvancePurchase->get('pk');
$ad_pc_uid = $oAdvancePurchase->get('uid');
$data = $oAdvancePurchase->selectDetail($ad_pc_uid);
if($data[$ad_pc_pk]) {
	$mode = 'update';

}
else {
	$mode = 'insert';

}

$ad_pc_method_arr = $oAdvancePurchase->get('ad_pc_method_arr');

/* init Class */
if(!isset($oAdvance)) {
	include_once(_MODULE_PATH_.'/advance/advance.manager.class.php');
	$oAdvance = new AdvanceManager();
	$oAdvance->init();
}
$ad_list = $oAdvance->selectAdvanceByShopCode($member['sh_code']);

if($mode == 'insert') {
	if(sizeof($ad_list) > 0) { 
		foreach($ad_list as $ad_id => $arr) { 
			$data = array(
				'ad_pc_type'	=> $arr['ad_type'],
				'ad_pc_name'	=> $arr['ad_name'],
				'ad_pc_price'	=> $arr['ad_price'],
				'ad_pc_money'	=> $arr['ad_money'],
				'ad_pc_quantity'	=> $arr['ad_quantity'],
				'ad_pc_start'	=> $arr['ad_start'],
				'ad_pc_expire'	=> $arr['ad_expire'],
				'cs_id'			=> $sch_cs_id
			);
			break;
		}
	}
}
?>
<script type="text/javascript">
//<![CDATA[
<? if($mode == 'update') { ?>
alert("'선불제 상품 수정' 기능은 잘못된 정보를 정정하기 위한 기능이므로\n\n매출 및 정산 기능에 건수와 금액이 합산되지 않습니다.\n\n매출 및 정산에 건수와 금액이 합산되길 원하는 경우,\n\n[충전] 기능을 이용해주세요!!");
<? } ?>

var ad_list = new Array();
<? if(sizeof($ad_list) > 0) { 
	foreach($ad_list as $ad_id => $arr) { ?>
	ad_list["<?=$ad_id?>"] = {
		<? foreach($arr as $key => $val) { if($key == 'ad_type') { continue; } ?>
		"<?=$key?>"	: "<?=$val?>",
		<? } ?>
		"ad_type"	: "<?=$arr['ad_type']?>"
	};
	<? }
} ?>
//]]>
</script>

<form name="advance_purchase_form" method="post" action="../advance_purchase/process.html" onsubmit="return submitAdvancePurchaseForm(this)" target="#advance_list">
<input type="hidden" name="flag_json" value="1" />
<input type="hidden" name="mode" value="<?=$mode?>" />
<input type="hidden" name="<?=$ad_pc_pk?>" value="<?=$ad_pc_uid?>" />
<input type="hidden" name="sh_code" value="<?=$member['sh_code']?>" />
<input type="hidden" name="cs_id" value="<?=$data['cs_id']?>" />
<input type="hidden" name="ad_pc_type" value="<?=$data['ad_pc_type']?>" />
<input type="hidden" name="ad_pc_name" value="<?=$data['ad_pc_name']?>" />
<input type="hidden" name="ad_pc_price" value="<?=$data['ad_pc_price']?>" />

<table class="write_table" border="1">
<colgroup>
<col width="140">
<col width="*">
</colgroup>
<tbody id="write_tbody" class="ad_type_<?=$data['ad_pc_type']?>">
<tr>
	<? if($mode == 'insert') { ?>
	<th class="required">선불제상품</th>
	<td>
		<select name="ad_id" id="ad_id" class="select" title="선불제상품">
		<? if(sizeof($ad_list) > 0) { foreach($ad_list as $key => $arr) { ?>
		<option value="<?=$key?>"><?=$arr['ad_name']?> (<?=number_format($arr['ad_price'])?>원)</option>
		<? } } ?>
		</select>
	</td>
	<? } else { ?>
	<th>선불제상품</th>
	<td>
		<strong><?=$data['ad_pc_name']?> (<?=number_format($data['ad_pc_price'])?>원)</strong>
		<input type="hidden" name="ad_id" value="<?=$data['ad_id']?>" />
	</td>
	<? } ?>
</tr>
<tr>
	<th class="required">결제수단</th>
	<td>
		<select name="ad_pc_method" class="select" title="결제수단">
		<? printSelectOption($ad_pc_method_arr, $data['ad_pc_method'], 1); ?>
		</select>
	</td>
</tr>
<tr class="tr_ad_options ad_type_M">
	<th>정액요금</th>
	<td>
		<input type="text" name="ad_pc_money" class="text money" value="<?=number_format($data['ad_pc_money'])?>" size="15" maxlength="10" title="정액요금" />원
	</td>
</tr>
<tr class="tr_ad_options ad_type_Q">
	<th>이용횟수</th>
	<td>
		<input type="text" name="ad_pc_quantity" class="text number" value="<?=number_format($data['ad_pc_quantity'])?>" size="15" maxlength="5" title="이용횟수" />회
	</td>
</tr>
<tr>
	<th class="required">시작일</th>
	<td>
		<input type="text" name="ad_pc_start" class="text date required" value="<?=$data['ad_pc_start']?>" size="15" maxlength="10" title="시작일" />
	</td>
</tr>
<tr>
	<th class="required">만료일</th>
	<td>
		<input type="text" name="ad_pc_expire" class="text date required" value="<?=$data['ad_pc_expire']?>" size="15" maxlength="10" title="만료일" />
	</td>
</tr>
</tbody>
</table>

<p class="button">
	<button type="submit" class="sButton primary">등록</button>
	<button type="button" class="sButton active" onclick="closeLayerPopup()">닫기</button>
</p>

</form>