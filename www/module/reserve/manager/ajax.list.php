<?
if(!defined('_INPLUS_')) { exit; } 

/* init Class */
global $oReserve;
if(!isset($oReserve)) {
	include_once(_MODULE_PATH_.'/reserve/reserve.manager.class.php');
	$oReserve = new ReserveManager();

	if(!$sch_cs_id && $cs_id) {
		$oReserve->set('sch_cs_id', $cs_id);
	}
	$oReserve->init();
}

/* list */
$oReserve->set('cnt_rows', 5);
$oReserve->set('list_mode', 'customer');
$rs_list = $oReserve->selectList();
$rs_query_string = $oReserve->get('query_string');

/* pagination */
$rs_page = $oReserve->get('page');
$rs_page_arr = $oReserve->getPageArray();
$rs_pk = $oReserve->get('pk');
?>
<h4>예약리스트</h4>
<table class="list_table border" border="1">
<colgroup>
<col width="100" />
<col width="250" />		
<col width="120" />
<col width="80" />
<col width="*" />
<col width="100" />
</colgroup>
<thead>
<tr>
	<th>예약일</th>
	<th>서비스</th>			
	<th>담당자</th>			
	<th>상태</th>
	<th>요청사항</th>
	<th>상세정보</th>
</tr>
</thead>
<tbody>
<? for($i = 0 ; $i < sizeof($rs_list) ; $i++) { ?>
<tr>		
	<td><?=$rs_list[$i]['rs_date']?></td>
	<td class="no_padding">
		<div class="service_info">
			<ul>
			<?
			$sv_name_list = $rs_list[$i]['sv_name_list'];
			for($j = 0 ; $j < sizeof($sv_name_list) ; $j++) { ?>
			<li><?=$sv_name_list[$j]?></li>
			<? } ?>
			</ul>
		</div>
	</td>
	<td><?=$rs_list[$i]['st_name']?></td>
	<td class="state_<?=$rs_list[$i]['rs_state']?>"><?=$rs_list[$i]['txt_rs_state']?></td>
	<td class="content"><?=$rs_list[$i]['rs_user_memo']?></td>
	<td><a href="../reserve/ajax.view.html?<?=$rs_pk?>=<?=$rs_list[$i][$rs_pk]?>" class="btn_ajax size_750x500 sButton info tiny" target="#layer_popup" title="예약정보">상세정보</a></td>
</tr>
<? } if(sizeof($rs_list) == 0) { printNoData(6, '예약된 데이터가 없습니다.'); } ?>
</tbody>
</table>	

<!-- pagination -->
<div class="pagination">
	<ul>
	<? printAjaxPagination($rs_page_arr, $rs_query_string, '../reserve/ajax.list.html', '#reserve_list'); ?>
	</ul>
</div>
<!-- //pagination -->