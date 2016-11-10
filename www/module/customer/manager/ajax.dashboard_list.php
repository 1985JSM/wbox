<?
if(!defined('_INPLUS_')) { exit; } 

/* init Class */
$oCustomer = new CustomerManager();
$oCustomer->init();

/* list */
$list = $oCustomer->selectList();
$total_cnt = $oCustomer->get('total_cnt');
$cnt_page = $oCustomer->get('cnt_page');

/* search condition */
$sch_type_arr = $oCustomer->get('sch_type_arr');
$query_string = $oCustomer->get('query_string');
$query_string.= '&list_mode='.$list_mode;

/* pagination */
$page = $oCustomer->get('page');
$page_arr = $oCustomer->getPageArray();
$pk = $oCustomer->get('pk');

//print_r($list);
/* reserve */
include_once(_MODULE_PATH_.'/reserve/reserve.manager.class.php');
$oReserve = new ReserveManager();
$_GET['sch_type'] = '';
$_GET['sch_keyword'] = '';
$_GET['sch_rs_date'] = '';
$oReserve->set('cnt_rows', 3);

$oReserve->init();

/* staff */
if(!isset($oStaff)) {
	include_once(_MODULE_PATH_.'/staff/staff.manager.class.php');
	$oStaff = new StaffManager();
	$oStaff->init();
}
$st_id_arr = $oStaff->selectStaffByShopCode($member['sh_code']);
?>
<!-- search -->
<div class="search">
	<form name="search_customer_form" method="get" action="../customer/ajax.dashboard_list.html" target="#layer_content" onSubmit="return submitSearchCustomerForm(this)">
	<input type="hidden" name="flag_json" value="1" />
	<input type="hidden" name="list_mode" value="<?=$list_mode?>" />
	<input type="hidden" name="sch_rs_date" value="<?=$sch_rs_date?>" />
	<input type="hidden" name="sch_type" value="all" />

	<fieldset>
	<legend>검색조건</legend>
	<table class="search_table" border="1">
	<caption>검색조건</caption>
	<colgroup>
	<col width="90" />
	<col width="350" />
	<col width="90" />
	<col width="*" />
	</colgroup>
	<tbody>	
	<tr>
		<th>이름/휴대폰</th>
		<td>
			<input type="text" name="sch_keyword" value="<?=$sch_keyword?>" class="text member_search placeholder" size="30" maxlength="30" title="검색어" />				
		</td>
		<th>담당자</th>
		<td>
			<select name="sch_st_id" class="select" title="담당자">
			<option value="">전체</option>
			<? printSelectOption($st_id_arr, $sch_st_id, 1); ?>
			</select>
		</td>
	</tr>	
	</tbody>
	</table>
	</fieldset>

	<p class="button">		
		<button type="submit" title="검색"><img src="/img/manager/btn_lookup.gif" alt="조회" /></button>
		<a href="../reserve/ajax.dashboard_reserve_payment.html" class="btn_ajax size_1000x800" target="#layer_popup" title="예약하기"><img src="/img/manager/btn_unregist.gif" alt="비회원고객예약"></a>
	</p>
	</form>

</div>
<!-- //search -->

<!-- list_top -->
<div class="list_top">
	<div class="left">
		Total : <strong><?=number_format($total_cnt)?></strong> 건, 현재 : <strong><?=number_format($page)?></strong> 페이지
	</div>
	<div class="right primary">
		
	</div>
</div>
<!-- //list_top -->

<div class="list">
	<!-- list -->
	<table class="list_table" border="1">
	<colgroup>
	<col width="50">			
	<col width="100">
	<col width="150">				
	<col width="*">
	<col width="70">
	<col width="70">
	<col width="70">
	<col width="60">
	</colgroup>
	<thead>
	<tr>
		<th>No</th>
		<th>고객명</th>
		<th>휴대폰</th>				
		<th>예약건수</th>	
		<th>정보</th>
		<th>내역</th>
		<th>선택</th>
		<th>&nbsp;</th>
	</tr>
	</thead>
	</table>

	<div class="user_list">

		<? if(sizeof($list) > 0) { ?>		
		<ul>
		<? for($i = 0 ; $i < sizeof($list) ; $i++) { ?>
		<li>
			<div class="user_info">
				<span><?=$list[$i]['no']?></span>
				<button type="button" onclick="toggleCustomerReserveInfo(this)" class="user_name"><?=$list[$i]['cs_name']?></button>
				<em class="hp"><?=$list[$i]['cs_hp']?></em>
				<em class="cnt_reserve"><?=number_format($list[$i]['cnt_total_reserve'])?></em>
				<a href="../customer/view.html?cs_id=<?=$list[$i]['cs_id']?>" target="_blank" class="sButton tiny user_info" title="새창">고객정보</a>					
				<button type="button" onclick="toggleCustomerReserveInfo(this)" class="sButton tiny user_reserve">예약내역</button>
				<a href="../reserve/ajax.dashboard_reserve_payment.html?<?=$pk?>=<?=$list[$i][$pk]?>" class="btn_ajax size_1000x800 sButton tiny user_choose" target="#layer_popup" title="예약하기">예약하기</a>
			</div>

			<div class="user_res">

				<? 
				$oReserve->set('sch_cs_id', $list[$i]['cs_id']);				
				$rs_list = $oReserve->selectList();
				?>				
				<table class="list_table border odd" border="1">
				<colgroup>
				<col width="80">			
				<col width="200">			
				<col width="80">
				<col width="*">
				</colgroup>
				<thead>
				<tr>
					<th>예약일</th>
					<th>서비스명</th>
					<th>상태</th>			
					<th>요청사항</th>
				</tr>
				</thead>
				<tbody>
				<? for($j = 0 ; $j < sizeof($rs_list) ; $j++) { 
					$sv_list = $rs_list[$j]['sv_name_list'];					
					?>
				<tr class="list_tr_<?=$rs_list[$j]['odd']?>">
					<td><?=$rs_list[$j]['rs_date']?></td>
					<td class="no_padding">
						<div class="service_info">
							<ul>
							<? for($k = 0 ; $k < sizeof($sv_list) ; $k++) { ?>
							<li><?=$sv_list[$k]?></li>
							<? } ?>
							</ul>
						</div>
					</td>
					<td class="state_<?=$rs_list[$j]['rs_state']?>"><?=$rs_list[$j]['txt_rs_state']?></td>
					<td class="content"><?=getWithoutNull($rs_list[$j]['rs_user_memo'])?></td>
				</tr>	
				<? } if(sizeof($rs_list) == 0) { printNoData(4, '예약된 내역이 없습니다.'); } ?>
				</tbody>
				</table>

			</div>
		</li>		
		<? } ?>
		</ul>
		<? } else { ?>
		<p class="no_data">
			검색 결과가 없습니다.<br />
			<a href="../reserve/ajax.dashboard_reserve_payment.html" class="btn_ajax size_1000x800 primary" target="#layer_popup" title="예약하기">비회원 고객예약</a> 버튼을 클릭하여 직접 예약해 주세요.
		</p>
		<? } ?>
	</div>
	<!-- //list -->

	<!-- pagination -->
	<div class="pagination">
		<ul>
		<? printAjaxPagination($page_arr, $query_string, '../customer/ajax.dashboard_list.html', '#layer_content'); ?>
		</ul>
	</div>
	<!-- //pagination -->
</div>
