<?
if(!defined('_INPLUS_')) { exit; } 

/* init Class */
global $oAdvancePurchase;
if(!isset($oAdvancePurchase)) {
	include_once(_MODULE_PATH_.'/advance_purchase/advance_purchase.manager.class.php');
	$oAdvancePurchase = new AdvancePurchaseManager();

	if(!$sch_cs_id && $cs_id) {
		$oAdvancePurchase->set('sch_cs_id', $cs_id);
	}
	$oAdvancePurchase->init();
}

/* list */
$oAdvancePurchase->set('list_mode', 'customer');
$ad_list = $oAdvancePurchase->selectList();
$ad_query_string = $oAdvancePurchase->get('query_string');

/* pagination */
$ad_page = $oAdvancePurchase->get('page');
$ad_page_arr = $oAdvancePurchase->getPageArray();
$ad_pk = $oAdvancePurchase->get('pk');
?>
<!-- list_top -->
<div class="list_top">
	<div class="left">
		<strong>선불제</strong>
	</div>
	<div class="right">
		<a href="../advance_purchase/ajax.write.html?cs_id=<?=$cs_id?>&page=<?=$ad_page?><?=$ad_query_string?>" class="btn_ajax size_600x600 sButton tiny primary" target="#layer_popup" title="선불제 신규 등록">선불제 신규 등록</a>				
	</div>
</div>
<!-- list_top -->

<table class="list_table border" border="1">
<colgroup>
<col width="100" />
<col width="*" />
<col width="100" />
<col width="100" />		
<col width="100" />
<col width="160" />
<col width="160" />
</colgroup>
<thead>
<tr>
	<th>등록일</th>
	<th>선불제명</th>
	<th>결제방식</th>
	<th>잔여금액(원)</th>
	<th>잔여이용(회)</th>
	<th>사용기간</th>
	<th>관리</th>
</tr>
</thead>
<tbody>
<? for($i = 0 ; $i < sizeof($ad_list) ; $i++) { ?>
<tr>	
	<td><?=$ad_list[$i]['reg_date']?></td>
	<td><strong><?=$ad_list[$i]['txt_ad_pc_name']?></strong></td>
	<td><?=$ad_list[$i]['txt_ad_pc_method']?></td>
	<td><? if($ad_list[$i]['ad_pc_type'] == 'M') { ?><span class="primary"><?=number_format($ad_list[$i]['remain_money'])?></span><? } else { ?>-<? } ?></td>
	<td><? if($ad_list[$i]['ad_pc_type'] == 'Q') { ?><strong class="primary"><?=number_format($ad_list[$i]['remain_quantity'])?></strong> / <?=number_format($ad_list[$i]['ad_pc_quantity'])?><? } else { ?>-<? } ?></td>
	<td><?=$ad_list[$i]['txt_ad_pc_period']?></td>
	<td>
		<a href="../advance_purchase/ajax.charge.html?<?=$ad_pk?>=<?=$ad_list[$i][$ad_pk]?>&cs_id=<?=$cs_id?>&page=<?=$ad_page?><?=$ad_query_string?>" class="btn_ajax size_600x600 sButton tiny active" target="#layer_popup" title="선불제 상품 충전">충전</a>
		<a href="../advance_purchase/ajax.write.html?<?=$ad_pk?>=<?=$ad_list[$i][$ad_pk]?>&cs_id=<?=$cs_id?>&page=<?=$ad_page?><?=$ad_query_string?>" class="btn_ajax size_600x600 sButton tiny" target="#layer_popup" title="선불제 상품 수정">수정</a>
		<a href="../advance_purchase/process.html?mode=delete&<?=$ad_pk?>=<?=$ad_list[$i][$ad_pk]?>&page=<?=$page?><?=$ad_query_string?>" class="btn_delete_advance sButton tiny" target="#advance_list">삭제</a>
	</td>
</tr>
<? } if(sizeof($ad_list) == 0) { printNoData(7, '등록된 선불제가 없습니다.'); } ?>
</tbody>
</table>

<!-- pagination -->
<div class="pagination">
	<ul>
	<? printAjaxPagination($ad_page_arr, $ad_query_string, '../advance_purchase/ajax.list.html', '#advance_list'); ?>
	</ul>
</div>
<!-- //pagination -->