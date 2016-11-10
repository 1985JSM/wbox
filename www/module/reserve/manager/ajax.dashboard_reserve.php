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

	$cs_id = $data['cs_id'];
	$us_id = $data['us_id'];
}

$sh_code = $member['sh_code'];

/*
// customer
if($cs_id) {
	if(!isset($oCustomer)) {
		include_once(_MODULE_PATH_.'/customer/customer.manager.class.php');
		$oCustomer = new CustomerManager();
		$oCustomer->init();
	}
	$cs_data = $oCustomer->selectDetail($cs_id);

	$data['us_name'] = $cs_data['cs_name'];
	$data['us_hp'] = $cs_data['cs_hp'];
}
*/

// staff
if(!isset($oStaff)) {
	include_once(_MODULE_PATH_.'/staff/staff.manager.class.php');
	$oStaff = new StaffManager();
	$oStaff->init();
}
$st_id_arr = $oStaff->selectStaffByShopCode($sh_code);
?>
<div class="reserve_write">
			
	<form name="reserve_form" method="post" action="./process.html" onsubmit="return submitReserveForm(this)" target="#reserve_list">
	<input type="hidden" name="flag_json" value="1" />
	<input type="hidden" name="mode" value="<?=$mode?>" />
	<input type="hidden" name="<?=$pk?>" value="<?=$uid?>" />

	<input type="hidden" name="reserve_type" value="staff" />

	<input type="hidden" name="cs_id" value="<?=$cs_id?>" />
	<input type="hidden" name="us_id" value="<?=$us_id?>" />

	<input type="hidden" name="sh_code" value="<?=$sh_code?>" />
	<input type="hidden" name="rs_date" value="<?=$data['rs_date']?>" />
	<input type="hidden" name="rs_time" value="<?=$data['rs_time']?>" />

	<input type="hidden" name="rs_state" value="<?=$data['rs_state']?>" />

	<!-- customer -->
	<div class="reservation_userinfo">
		<span class="tit">고객명</span>
		<input type="text" name="us_name" class="text required" value="<?=$data['us_name']?>" size="20" maxlength="10" title="고객명" />
	</div>

	<div class="reservation_staff">
		<span class="tit">휴대폰</span>
		<input type="text" name="us_hp" class="text required" value="<?=$data['us_hp']?>" size="20" maxlength="15" title="휴대폰" />
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
	
	<div class="res_btn">
		<button type="submit"><img src="/img/manager/btn_nomember.gif" alt="확인" /></button>
		<button type="button" onclick="closeLayerPopup()"><img src="/img/manager/btn_cancel.gif" alt="취소" /></button>
	</div>

		

	</form>
</div>