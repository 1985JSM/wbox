<?
if(!defined('_INPLUS_')) { exit; } 

/* init Class */
$oReserve = new ReserveManager();
$oReserve->init();

/* search condition */
$query_string = $oReserve->get('query_string');
$page = $oReserve->get('page');

/* data */
$pk = $oReserve->get('pk');
$uid = $oReserve->get('uid');
$data = $oReserve->selectDetail($uid);

//print_r($data);

$data['rs_date'] = date('Y-m-d');
$rs_date = $data['rs_date'];
$rs_state_arr = $oReserve->get('rs_state_arr');

// coupon
if(!isset($oCoupon)) {
	include_once(_MODULE_PATH_.'/coupon/coupon.manager.class.php');
	$oCoupon = new CouponManager();
	$oCoupon->init();
}
$cp_id_arr = $oCoupon->selectCouponCodeArray($member['sh_code']);

// advance_purchase
if(!isset($oAdvancePurchase)) {
	include_once(_MODULE_PATH_.'/advance_purchase/advance_purchase.manager.class.php');
	$oAdvancePurchase = new AdvancePurchaseManager();
	$oAdvancePurchase->init();
}
$ad_pc_id_arr = $oAdvancePurchase->selectAdvancePurchaseCodeArray($data['cs_id']);
?>
<!-- write -->
<div class="write">
	<form name="payment_form" method="post" action="./process.html" onsubmit="return submitPaymentForm(this)">
	<input type="hidden" name="flag_json" value="1" />	
	<input type="hidden" name="mode" value="update_payment" />
	<input type="hidden" name="<?=$pk?>" value="<?=$uid?>" />
	<input type="hidden" name="service_price" value="<?=$data['sv_price']?>" />

	<fieldset>	
	<legend>고객정보</legend>	
	<h2>고객정보</h2>
	<table class="write_table" border="1">
	<caption>고객정보</caption>
	<colgroup>
	<col width="140" />
	<col width="*" />
	<col width="140" />
	<col width="*" />
	</colgroup>
	<tbody>
	<tr>
		<th>고객명 (연락처)</th>
		<td>
			<?=$data['us_name']?> (<?=$data['us_hp']?>)
		</td>
		<th>담당자</th>
		<td>
			<?=$data['st_name']?>
		</td>
	</tr>
	</tbody>
	</table>
	</fieldset>

	<fieldset class="etc">	
	<legend>할인정보</legend>	
	<h2>할인정보</h2>
	<table class="write_table" border="1">
	<caption>할인정보</caption>
	<colgroup>
	<col width="140" />
	<col width="*" />
	</colgroup>
	<tbody>
	<tr>
		<th>시술금액</th>
		<td>
			<strong><?=number_format($data['sv_price'])?>원</strong>
		</td>
	</tr>	
	<tr>
		<? /*
		<th>
			<input type="checkbox" name="flag_use_sale" id="flag_use_sale" class="pay_method"  value="1" <? if($data['flag_use_sale']) { ?>checked="checked"<? } ?> />
			<label for="flag_use_sale">일반할인</label>
		</th>
		<td class="td_use_sale">
			<input type="text" name="pm_sale_price"  value="<?=number_format($data['pm_sale_price'])?>" class="text money pay_price <? if($data['flag_use_sale']) { ?>required<? } else { ?>readonly<? } ?>" size="20" maxlength="10" title="일반할인금액" /> 원
		</td>
		*/ ?>
		<th>일반할인</th>
		<td class="td_use_sale">
			<input type="text" name="pm_sale_price"  value="<?=number_format($data['pm_sale_price'])?>" class="text money pay_price" size="20" maxlength="10" title="일반할인금액" /> 원
		</td>
	</tr>
	<tr>
		<? /*
		<th>
			<input type="checkbox" name="flag_use_coupon" id="flag_use_coupon" class="pay_method"  value="1" <? if($data['flag_use_coupon']) { ?>checked="checked"<? } ?> />
			<label for="flag_use_coupon">쿠폰사용</label>
		</th>
		<td class="td_use_coupon">
			<select name="cp_id" class="select <? if(!$data['flag_use_coupon']) { ?>readonly<? } ?>" title="쿠폰종류">
			<option value="">쿠폰선택</option>
			<? printSelectOption($cp_id_arr, $data['cp_id'], 1); ?>
			</select>
			<input type="text" name="pm_coupon_price"  value="<?=number_format($data['pm_coupon_price'])?>" class="text money pay_price <? if($data['flag_use_coupon']) { ?>required<? } else { ?>readonly<? } ?>" size="20" maxlength="10" title="쿠폰사용금액" /> 원
		</td>
		*/ ?>
		<th>쿠폰사용</th>
		<td class="td_use_coupon">
			<select name="cp_id" class="select" title="쿠폰종류">
			<option value="">쿠폰선택</option>
			<? printSelectOption($cp_id_arr, $data['cp_id'], 1); ?>
			</select>
			<input type="text" name="pm_coupon_price"  value="<?=number_format($data['pm_coupon_price'])?>" class="text money pay_price" size="20" maxlength="10" title="쿠폰사용금액" /> 원
		</td>
	</tr>
	<tr>
		<? /*
		<th>
			<input type="checkbox" name="flag_use_advance" id="flag_use_advance" class="pay_method"  value="1" <? if($data['flag_use_advance']) { ?>checked="checked"<? } ?> />
			<label for="flag_use_advance">선불제</label>
		</th>
		<td class="td_use_advance">
			<div>
				<select name="ad_pc_id" class="select <? if(!$data['flag_use_advance']) { ?>readonly<? } ?>" title="선불제상품">
				<option value="">선불제선택</option>
				<? printSelectOption($ad_pc_id_arr, $data['ad_pc_id'], 1); ?>
				</select>
				<input type="text" name="pm_advance_price"  value="<?=number_format($data['pm_advance_price'])?>" class="text money pay_price <? if($data['flag_use_advance']) { ?>required<? } else { ?>readonly<? } ?>" size="20" maxlength="10" title="선불제사용금액" /> 원 				
			</div>			
		</td>
		*/ ?>
		<th>선불제</th>
		<td class="td_use_advance">
			<div>
				<select name="ad_pc_id" class="select" title="선불제상품">
				<option value="">선불제선택</option>
				<? printSelectOption($ad_pc_id_arr, $data['ad_pc_id'], 1); ?>
				</select>
				<input type="text" name="pm_advance_price"  value="<?=number_format($data['pm_advance_price'])?>" class="text money pay_price" size="20" maxlength="10" title="선불제사용금액" /> 원 				
			</div>			
		</td>
	</tr>	
	<tr>
		<th>합계</th>
		<td>
			<strong class="primary"><span id="txt_real_price"><?=number_format($data['real_price'])?></span>원</strong>
		</td>
	</tr>
	</tbody>
	</table>
	</fieldset>

	<fieldset class="etc">	
	<legend>결제정보</legend>	
	<h2>결제정보</h2>
	<table class="write_table" border="1">
	<caption>결제정보</caption>
	<colgroup>
	<col width="140" />
	<col width="*" />
	<col width="140" />
	<col width="*" />
	</colgroup>
	<tbody>		
	<tr>
		<? /*
		<th>
			<input type="checkbox" name="flag_use_card" id="flag_use_card" class="pay_method"  value="1" <? if($data['flag_use_card']) { ?>checked="checked"<? } ?> />
			<label for="flag_use_card">카드결제</label> 
		</th>
		<td class="td_use_card">
			<input type="text" name="pm_card_price" value="<?=number_format($data['pm_card_price'])?>" class="text money pay_price <? if($data['flag_use_card']) { ?>required<? } else { ?>readonly<? } ?>" size="20" maxlength="10" title="카드결제금액" /> 원 
		</td>
		<th>
			<input type="checkbox" name="flag_use_cash" id="flag_use_cash" class="pay_method"  value="1" <? if($data['flag_use_cash']) { ?>checked="checked"<? } ?> />
			<label for="flag_use_cash">현금결제</label>
		</th>
		<td class="td_use_cash">
			<input type="text" name="pm_cash_price"  value="<?=number_format($data['pm_cash_price'])?>" class="text money pay_price <? if($data['flag_use_cash']) { ?>required<? } else { ?>readonly<? } ?>" size="20" maxlength="10" title="현금결제금액" /> 원
		</td>
		*/ ?>
		<th>카드결제</th>
		<td class="td_use_card">
			<input type="text" name="pm_card_price" value="<?=number_format($data['pm_card_price'])?>" class="text money pay_price" size="20" maxlength="10" title="카드결제금액" /> 원 
		</td>
		<th>현금결제</th>
		<td class="td_use_cash">
			<input type="text" name="pm_cash_price"  value="<?=number_format($data['pm_cash_price'])?>" class="text money pay_price" size="20" maxlength="10" title="현금결제금액" /> 원
		</td>
	</tr>	
	<tr>
		<th>매출액</th>
		<td colspan="3">
			<strong class="primary"><span id="txt_total_price"><?=number_format($data['total_price'])?></span>원</strong>
		</td>
	</tr>
	<tr>
		<th>비고</th>
		<td colspan="3">
			<textarea name="rs_pay_memo" class="textarea" rows="2" cols="85" title="비고"><?=$data['rs_pay_memo']?></textarea>
		</td>
	</tr>	
	</tbody>
	</table>
	</fieldset>

	<p class="button">
		<button type="submit"><img src="/img/manager/btn_nomember.gif" alt="확인"></button>
		<button type="button" onclick="closeLayerPopup()"><img src="/img/manager/btn_cancel.gif" alt="취소" /></button>
	</p>

	</form>

</div>
<!-- //write -->	
