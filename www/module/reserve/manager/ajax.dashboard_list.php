<?
if(!defined('_INPLUS_')) { exit; } 

/* init Class */
$oReserve = new ReserveManager();
$oReserve->init();

/* list */
$list = $oReserve->selectList();
$total_cnt = $oReserve->get('total_cnt');
$cnt_page = $oReserve->get('cnt_page');

/* search condition */
$sch_type_arr = $oReserve->get('sch_type_arr');
$query_string = $oReserve->get('query_string');
$query_string.= '&list_mode='.$list_mode;

/* pagination */
$page = $oReserve->get('page');
$page_arr = $oReserve->getPageArray();
$pk = $oReserve->get('pk');
?>
<!-- search -->
<div class="search">
	<form name="search_reserve_form2" method="get" action="./ajax.dashboard_list.html" target="#layer_content" onSubmit="return submitSearchReserveForm(this)">
	<input type="hidden" name="flag_json" value="1" />
	<input type="hidden" name="list_mode" value="<?=$list_mode?>" />

	<fieldset>
	<legend>검색조건</legend>
	<table class="search_table" border="1">
	<caption>검색조건</caption>
	<colgroup>
	<col width="90" />
	<col width="*" />
	</colgroup>
	<tbody>	
	<tr>
		<th>검색어</th>
		<td>
			<select name="sch_type" class="select" title="검색유형">
			<? printSelectOption($sch_type_arr, $sch_type, 1); ?>
			</select>
			<input type="text" name="sch_keyword" value="<?=$sch_keyword?>" class="text required" size="30" maxlength="30" title="검색어" />				
		</td>
	</tr>	
	</tbody>
	</table>
	</fieldset>

	<p class="button">		
		<button type="submit" title="검색"><img src="/img/manager/btn_lookup.gif" alt="조회" /></button>
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
		* 상세정보를 클릭하시면 <strong class="primary">예약캘린더</strong>에서 내용을 확인할 수 있습니다.
	</div>
</div>
<!-- //list_top -->

<div class="list">
	<!-- list -->
	<table class="list_table border odd" border="1">
	<colgroup>
	<col width="50">
	<col width="80">
	<col width="100">		
	<col width="*">
	<col width="130">
	<col width="90">	
	<col width="80">
	</colgroup>
	<thead>
	<tr>
		<th>No</th>
		<th>고객명</th>
		<th>예약일</th>
		<th>서비스</th>			
		<th>담당자</th>			
		<th>상태</th>
		<th>상세정보</th>
	</tr>
	</thead>
	<tbody>
	<? for($i = 0 ; $i < sizeof($list) ; $i++) { ?>
	<tr class="list_tr_<?=$list[$i]['odd']?>">
		<td><?=$list[$i]['no']?></td>
		<td><?=$list[$i]['us_name']?></td>
		<td><?=$list[$i]['rs_date']?></td>
		<td class="no_padding">
			<div class="service_info">
				<ul>
				<?
				$sv_name_list = $list[$i]['sv_name_list'];
				for($j = 0 ; $j < sizeof($sv_name_list) ; $j++) { ?>
				<li><?=$sv_name_list[$j]?></li>
				<? } ?>
				</ul>
			</div>
		</td>
		<td><?=$list[$i]['st_name']?></td>
		<td class="state_<?=$list[$i]['rs_state']?>"><?=$list[$i]['txt_rs_state']?></td>
		<td><a href="./ajax.dashboard_aside.html?list_mode=<?=$list_mode?>&sch_rs_date=<?=$list[$i]['rs_date']?>&<?=$pk?>=<?=$list[$i][$pk]?>" class="btn_ajax btn_choose_reserve sButton info tiny" target="#reserve_list">상세정보</a></td>
	</tr>
	<? } if(sizeof($list) == 0) { printNoData(7, '예약 내역이 없습니다.'); } ?>
	</tbody>
	</table>
	</div>
	<!-- //list -->

	<!-- pagination -->
	<div class="pagination">
		<ul>
		<? printAjaxPagination($page_arr, $query_string, './ajax.dashboard_list.html', '#layer_content'); ?>
		</ul>
	</div>
	<!-- //pagination -->
</div>
