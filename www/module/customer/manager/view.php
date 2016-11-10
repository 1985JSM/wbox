<?
if(!defined('_INPLUS_')) { exit; } 

/* set URI */
$this_uri = '/webmanager/customer/list.html';

/* init Class */
$oCustomer = new CustomerManager();
$oCustomer->init();
$module_name = $oCustomer->get('module_name');	// 모듈명

/* search condition */
$query_string = $oCustomer->get('query_string');
$page = $oCustomer->get('page');

$_POST['page'] = $_GET['page'] = 1;

/* insert or update */
$pk = $oCustomer->get('pk');
$uid = $oCustomer->get('uid');
$data = $oCustomer->selectDetail($uid);

if($data[$pk]) {
	$mode = 'update';

	// reserve
	global $oReserve;
	if(!isset($oReserve)) {
		include_once(_MODULE_PATH_.'/reserve/reserve.manager.class.php');
		$oReserve = new Reserve();

		if(!$sch_cs_id && $cs_id) {
			$oReserve->set('sch_cs_id', $cs_id);
		}
		$oReserve->init();
	}

	unset($cnt_reserve);
	$cnt_reserve['E'] = $oReserve->countByCustomerId($data['cs_id'], 'E');
	$cnt_reserve['C'] = $oReserve->countByCustomerId($data['cs_id'], 'C');
	$cnt_reserve['B'] = $oReserve->countByCustomerId($data['cs_id'], 'B');
	$cnt_reserve['total'] = $cnt_reserve['E'] + $cnt_reserve['C'] + $cnt_reserve['B'];

	unset($cnt_payment);
	$cnt_payment['card'] = $oReserve->countByCustomerId($data['cs_id'], 'E', 'card');
	$cnt_payment['cash'] = $oReserve->countByCustomerId($data['cs_id'], 'E', 'cash');
	$cnt_payment['sale'] = $oReserve->countByCustomerId($data['cs_id'], 'E', 'sale');
	$cnt_payment['coupon'] = $oReserve->countByCustomerId($data['cs_id'], 'E', 'coupon');
	$cnt_payment['advance'] = $oReserve->countByCustomerId($data['cs_id'], 'E', 'advance');

	unset($sum_payment);
	$sum_payment['card'] = $oReserve->sumByCustomerId($data['cs_id'], 'E', 'card');
	$sum_payment['cash'] = $oReserve->sumByCustomerId($data['cs_id'], 'E', 'cash');
	$sum_payment['sale'] = $oReserve->sumByCustomerId($data['cs_id'], 'E', 'sale');
	$sum_payment['coupon'] = $oReserve->sumByCustomerId($data['cs_id'], 'E', 'coupon');
	$sum_payment['advance'] = $oReserve->sumByCustomerId($data['cs_id'], 'E', 'advance');
}
else {
	alert('비정상적인 접근입니다.', './list.html');
}

$cs_id = $uid;
?>
<script type="text/javascript">
//<![CDATA[
$(document).ready(function() {

	// 선불제 변경
	$(document).on("change", "#ad_id", function() {
		changeAdvanceId(this);
	});

	// 선불제 삭제
	$(document).on("click", "a.btn_delete_advance", function(e) {
		if(confirm("삭제 시 매출내역에서도 해당 선불제 내역이 삭제됩니다.\n\n정말 삭제하시겠습니까?")) {
			getContentsbyAjax(this);			
		}	

		e.preventDefault();
	});
});
//]]>
</script>

<div id="<?=$module?>">

	<div class="write">		

		<h4>기본사항</h4>	
				
		<table class="write_table" id="write_table" border="1">
		<caption>등록/수정</caption>
		<colgroup>
		<col width="140" />
		<col width="*" />
		<col width="140" />
		<col width="*" />
		</colgroup>
		<tbody>
		<tr>
			<th>이름</th>
			<td colspan="3"><?=$data['cs_name']?></td>
		</tr>		
		</tr>
		<tr>
			<th>이메일</th>
			<td colspan="3"><?=$data['cs_email']?></td>
		</tr>
		<tr>
			<th>휴대폰</th>
			<td colspan="3"><?=$data['cs_hp']?>  <? if($data['flag_receive_sms'] == 'Y'){ echo'(SMS수신)';} else {echo'(SMS 수신 거부)';}?></td>
		</tr>
		<tr>
			<th>닉네임</th>
			<td colspan="3"><?=$data['cs_nick']?></td>
		</tr>
		<tr>
			<th>지역</th>
			<td><?=$data['cs_area']?></td>	
			<th>생년월일/성별</th>
			<td><?=$data['txt_cs_birth']?> (<?=$data['txt_cs_birth_type']?>) / <?=$data['txt_cs_gender']?></td>
		</tr>		
		<tr>
			<th>가입일</th>
			<td colspan="3"><?=$data['reg_date']?></td>
		</tr>
		</tbody>
		</table>
		</fieldset>

		<fieldset class="etc">
		<legend>등록/수정</legend>	
		<h4>고객관리정보</h4>
		<table class="write_table" border="1">
		<caption>등록/수정</caption>
		<colgroup>
		<col width="140" />
		<col width="*" />
		</colgroup>
		<tbody>
		<tr>
			<th>담당자</th>
			<td>			
				<?=$data['txt_st_id']?>
			</td>
		</tr>
		<tr>
			<th>가맹점등급</th>
			<td>			
				<?=$data['txt_cs_level']?>
			</td>
		</tr>		
		<tr>
			<th>관리자메모</th>
			<td>
				<?=getWithoutNull(nl2br($data['cs_memo']))?>
			</td>
		</tr>					
		</tbody>
		</table>
		</fieldset>

		<fieldset class="etc">	
		<h4>이용내역</h4>	
		<table class="list_table border" border="1">
		<colgroup>
		<col width="*" />		
		<col width="105px" />
		<col width="105px" />
		<col width="105px" />
		<col width="120px" />
		<col width="120px" />
		<col width="120px" />
		<col width="120px" />
		</colgroup>
		<thead>
		<tr>
			<th colspan="4">예약내역</th>
			<th colspan="5">결제내역</th>
		  </tr>
        <tr>
			<th>전체</th>
			<th>완료</th>
			<th>정상취소</th>
			<th>비정상취소</th>
			<th>카드</th>
			<th>현금</th>
			<th>할인</th>
			<th>쿠폰</th>
			<th>선불제</th>
		  </tr>
		</thead>
		<tbody>		
		<tr>		
			<td><strong class="primary"><?=number_format($cnt_reserve['total'])?>건</strong></td>
			<td><strong><?=number_format($cnt_reserve['E'])?></strong>건</td>
			<td><strong><?=number_format($cnt_reserve['C'])?></strong>건</td>
			<td><strong><?=number_format($cnt_reserve['B'])?></strong>건</td>
			<td><strong class="info"><?=number_format($cnt_payment['card'])?></strong>회<br />(<?=number_format($sum_payment['card'])?>원)</td>
			<td><strong class="info"><?=number_format($cnt_payment['cash'])?></strong>회<br />(<?=number_format($sum_payment['cash'])?>원)</td>
			<td><strong class="info"><?=number_format($cnt_payment['sale'])?></strong>회<br />(<?=number_format($sum_payment['sale'])?>원)</td>
			<td><strong class="info"><?=number_format($cnt_payment['coupon'])?></strong>회<br />(<?=number_format($sum_payment['coupon'])?>원)</td>
			<td><strong class="info"><?=number_format($cnt_payment['advance'])?></strong>회<br />(<?=number_format($sum_payment['advance'])?>원)</td>
		</tr>
		</tbody>
		</table>
		</fieldset>	
		
		<fieldset class="etc">	
		<div id="advance_list">
			<? include_once(_MODULE_PATH_.'/advance_purchase/manager/ajax.list.php'); ?>			
		</div>
		</fieldset>
		
		<fieldset class="etc">	
		<div id="reserve_list">
			<? include_once(_MODULE_PATH_.'/reserve/manager/ajax.list.php'); ?>			
		</div>
		</fieldset>	

		<!-- button -->
		<div class="button">
			<div class="left">		
				<a href="./write.html?<?=$pk?>=<?=$uid?>&page=<?=$page?><?=$query_string?>" class="sButton" title="수정">수정</a>
				<a href="./process.html?mode=delete&<?=$pk?>=<?=$uid?>&page=<?=$page?><?=$query_string?>" id="btn_delete" class="sButton warning" title="삭제">삭제</a>									
			</div>
			<div class="right">
				<a href="./list.html?page=<?=$page?><?=$query_string?>" class="sButton active" title="목록">목록</a>
			</div>
		</div>
		<!-- //button -->

	</div>
</div>
