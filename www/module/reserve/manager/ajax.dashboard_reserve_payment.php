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

/* insert / update */
if(!$data[$pk]) {
	$mode = 'insert';
}
else {
	$mode = 'update';

	$st_id = $data['st_id'];
	$sv_id_arr = $data['sv_id_arr'];

	$txt_rs_date = $data['txt_rs_datetime'];
}

$sh_code = $member['sh_code'];

// customer
if($cs_id) {
	if(!isset($oCustomer)) {
		include_once(_MODULE_PATH_.'/customer/customer.manager.class.php');
		$oCustomer = new CustomerManager();
		$oCustomer->init();
	}
	$cs_data = $oCustomer->selectDetail($cs_id);

	$data['cs_id'] = $cs_id;
	$data['us_id'] = $cs_data['mb_id'];
	$data['us_name'] = $cs_data['cs_name'];
	$data['us_hp'] = $cs_data['cs_hp'];
}

// staff
if(!isset($oStaff)) {
	include_once(_MODULE_PATH_.'/staff/staff.manager.class.php');
	$oStaff = new StaffManager();
	$oStaff->init();
}
$st_id_arr = $oStaff->selectStaffByShopCode($sh_code);

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
<div class="reserve_write">
			
	<form name="reserve_payment_form" method="post" action="./process.html" onsubmit="return submitReservePaymentForm(this)" target="#reserve_list">

	<input type="hidden" name="flag_json" value="1" />
	<input type="hidden" name="mode" value="<?=$mode?>" />
	<input type="hidden" name="<?=$pk?>" value="<?=$uid?>" />

	<input type="hidden" name="reserve_type" value="staff" />

	<input type="hidden" name="cs_id" value="<?=$cs_id?>" />
	<input type="hidden" name="us_id" value="<?=$data['us_id']?>" />

	<input type="hidden" name="sh_code" value="<?=$sh_code?>" />
	<input type="hidden" name="rs_date" value="<?=$data['rs_date']?>" />
	<input type="hidden" name="rs_time" value="<?=$data['rs_time']?>" />

	<input type="hidden" name="rs_state" value="<?=$data['rs_state']?>" />

	<div class="reserve_info_write">

		<h2>예약정보입력</h2>

		<!-- customer -->
		<div class="reservation_userinfo">
			<span class="tit">고객명</span>
			<input type="text" name="us_name" class="text required<?if($cs_id) { ?> readonly<? } ?>" value="<?=$data['us_name']?>" size="20" maxlength="10" title="고객명" />
		</div>

		<div class="reservation_staff">
			<span class="tit">휴대폰</span>
			<input type="text" name="us_hp" class="text required<?if($cs_id) { ?> readonly<? } ?>" value="<?=$data['us_hp']?>" size="20" maxlength="15" title="휴대폰" />
		</div>
		<!-- //customer -->
		
		<!-- reservation_staff -->
		<div class="reservation_staff">
			<span class="tit">담당자</span>
			<select name="st_id" id="reserve_st_id" class="select required" title="담당자">				
			<option value="">담당자를 선택해주세요</option>
			<? printSelectOption($st_id_arr, $data['st_id'], 1); ?>
			</select>
		</div>
		<!-- //reservation_staff -->
		

		<!-- reservation_service -->
		<div class="reservation_service">
			<span class="tit">서비스</span>

			<select name="sv_id[]" id="reserve_sv_id" class="select" title="서비스">
			<? include_once(_MODULE_PATH_.'/service/manager/ajax.option.php'); ?>
			</select>

			<div id="selected_service" class="service_select">
			<? include_once(_MODULE_PATH_.'/service/manager/ajax.selected.php'); ?>				
			</div>											
		</div>
		<!-- //reservation_service -->


		<!-- reservation_time -->
		<div id="reserve_time" class="reservation_time"><!-- open 추가시 캘린더 열림  -->
			<button type="button" onclick="toggleCalendar()" class="btn_date">
				<span class="tit">예약일시</span>
				<strong><? if($mode == 'insert') { ?>예약시간을 선택해주세요<? } else { echo $data['txt_rs_datetime']; }?></strong>
			</button>
		
			<div id="reserve_datetime" class="res_calendar">
				
			</div>		
		</div>
		<!-- //reservation_time -->

		<div class="reservation_comment">
			<span class="tit hidden">요청사항</span>
			<div class="layer_textarea"><textarea name="rs_user_memo" title="요청사항" placeholder="요청사항을 입력해주세요.(150자 이내)" maxlength="150"><?=$data['rs_user_memo']?></textarea></div>
		</div>
	</div>

	<div class="pay_info_write">
		<fieldset>	
		<legend>할인정보</legend>	
		<h2>할인정보</h2>
		<table class="write_table" border="1">
		<caption>할인정보</caption>
		<colgroup>
		<col width="100" />
		<col width="*" />
		</colgroup>
		<tbody>
		<tr>		
			<th>일반할인</th>
			<td class="td_use_sale">
				<input type="text" name="pm_sale_price"  value="<?=number_format($data['pm_sale_price'])?>" class="text money pay_price" size="20" maxlength="10" title="일반할인금액" /> 원
			</td>
		</tr>
		<tr>			
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
		<col width="100" />
		<col width="*" />
		</colgroup>
		<tbody>		
		<tr>			
			<th>카드결제</th>
			<td class="td_use_card">
				<input type="text" name="pm_card_price" value="<?=number_format($data['pm_card_price'])?>" class="text money pay_price" size="20" maxlength="10" title="카드결제금액" /> 원 
			</td>
		</tr>
		<tr>
			<th>현금결제</th>
			<td class="td_use_cash">
				<input type="text" name="pm_cash_price"  value="<?=number_format($data['pm_cash_price'])?>" class="text money pay_price" size="20" maxlength="10" title="현금결제금액" /> 원
			</td>
		</tr>	
		<tr>
			<th>매출액</th>
			<td>
				<strong class="primary"><span id="txt_total_price"><?=number_format($data['total_price'])?></span>원</strong>
			</td>
		</tr>
		<tr>
			<th>비고</th>
			<td>
				<textarea name="rs_pay_memo" class="textarea" rows="2" cols="40" title="비고"><?=$data['rs_pay_memo']?></textarea>
			</td>
		</tr>	
		</tbody>
		</table>
		</fieldset>

	</div>
	
	<div class="res_btn">
		<button type="submit"><img src="/img/manager/btn_nomember.gif" alt="확인" /></button>
		<button type="button" onclick="closeLayerPopup()"><img src="/img/manager/btn_cancel.gif" alt="취소" /></button>
	</div>

	</form>
</div>