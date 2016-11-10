<?
if(!defined('_INPLUS_')) { exit; } 

/* init Class */
$oAdvancePurchase = new AdvancePurchaseManager();
$oAdvancePurchase->init();

$ad_pc_pk = $oAdvancePurchase->get('pk');
$ad_pc_uid = $oAdvancePurchase->get('uid');
$data = $oAdvancePurchase->selectDetail($ad_pc_uid);
$mode = 'charge';

$ad_pc_method_arr = $oAdvancePurchase->get('ad_pc_method_arr');

include_once(_MODULE_PATH_.'/reserve/reserve.manager.class.php');
$oReserve = new Reserve();

if(!$sch_cs_id && $cs_id) {
	$oReserve->set('sch_cs_id', $cs_id);
}
$oReserve->init();

$cnt_payment = array();
$cnt_payment = $oReserve->countByCustomerId($cs_id, 'E', 'advance');
?>
<script type="text/javascript">
//<![CDATA[
$(document).ready(function() {
	$("#ad_pc_money").on("keyup", function() {
		var old_money = delComma($("#txt_old_money").text());
		console.log("old_money : " + old_money);
		var charge_money = delComma($(this).val());
		var new_money = setComma(old_money * 1 + charge_money * 1);
		$("#txt_new_money").text(new_money);
	});

	$("#ad_pc_quantity").on("keyup", function() {
		var old_quantity = delComma($("#txt_old_quantity").text());
		console.log("old_quantity : " + old_quantity);
		var charge_quantity = delComma($(this).val());
		var new_quantity = setComma(old_quantity * 1 + charge_quantity * 1);
		$("#txt_new_quantity").text(new_quantity);
	});
});
//]]>
</script>

<form name="advance_charge_form" method="post" action="../advance_purchase/process.html" onsubmit="return submitAdvanceChargeForm(this)" target="#advance_list">
<input type="hidden" name="flag_json" value="1" />
<input type="hidden" name="mode" value="<?=$mode?>" />
<input type="hidden" name="<?=$ad_pc_pk?>" value="<?=$ad_pc_uid?>" />
<input type="hidden" name="cs_id" value="<?=$data['cs_id']?>" />
<input type="hidden" name="ad_pc_type" value="<?=$data['ad_pc_type']?>" />

<table class="write_table" border="1">
<colgroup>
<col width="140">
<col width="*">
</colgroup>
<tbody id="write_tbody" class="ad_type_<?=$data['ad_pc_type']?>">
<tr>
	<th>선불제상품</th>
	<td>
		<strong><?=$data['ad_pc_name']?> (<?=number_format($data['ad_pc_price'])?>원)</strong>
		<input type="hidden" name="ad_id" value="<?=$data['ad_id']?>" />
	</td>
</tr>
<tr>
	<th class="required">결제수단</th>
	<td>
		<select name="ad_pc_method" class="select" title="결제수단">
		<? printSelectOption($ad_pc_method_arr, $data['ad_pc_method'], 1); ?>
		</select>
	</td>
</tr>
<tr>
	<th class="required">결제금액</th>
	<td>
		<input type="text" name="ad_pc_price" value="0" class="text money required" size="15" maxlength="15" title="결제금액" />원
	</td>
</tr>
<? if($data['ad_pc_type'] == 'M') { ?>
<tr>
	<th>정액요금</th>
	<td>
		잔여금액 <strong id="txt_old_money"><?=number_format($data['ad_pc_money'])?></strong>원 +
		충전금액 <input type="text" name="ad_pc_money" id="ad_pc_money" class="text money" value="0" size="10" maxlength="10" title="충전금액" />원
		= <strong id="txt_new_money" class="primary"><?=number_format($data['ad_pc_money'])?></strong>원
	</td>
</tr>
<? } else if($data['ad_pc_type'] == 'Q') { ?>
<tr>
	<th>이용횟수</th>
	<td>
		잔여횟수 <strong id="txt_old_quantity"><?=(number_format($data['ad_pc_quantity']) - $cnt_payment)?></strong>회 +
		충전횟수 <input type="text" name="ad_pc_quantity" id="ad_pc_quantity" class="text money" value="0" size="10" maxlength="5" title="충전횟수" />회
		= <strong id="txt_new_quantity" class="primary"><?=number_format($data['ad_pc_quantity'])?></strong>회

		
	</td>
</tr>
<? } ?>
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

<form>