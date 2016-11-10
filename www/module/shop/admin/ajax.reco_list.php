<?
if(!defined('_INPLUS_')) { exit; } 

/* init Class */
$oShop = new ShopAdmin();
$oShop->init();
$module_name = $oShop->get('module_name');	// 모듈명

$oShop->set('cnt_rows', 5);

/* list */
$list = $oShop->selectList();
$total_cnt = $oShop->get('total_cnt');
$cnt_page = $oShop->get('cnt_page');

/* search condition */
$sch_type_arr = $oShop->get('sch_type_arr');
$query_string = $oShop->get('query_string');
$query_string.= '&rc_id='.$rc_id;

/* pagination */
$page = $oShop->get('page');
$page_arr = $oShop->getPageArray();
$pk = $oShop->get('pk');
?>
<!-- search -->
<div class="search">
	<form name="search_form" action="../shop/ajax.reco_list.html" method="get" onsubmit="return submitSearchShopForm(this)" target="#layer_content">
	<input type="hidden" name="flag_json" value="1" />

	<fieldset>
	<legend>검색조건</legend>
	<table class="search_table" border="1">
	<caption>검색조건</caption>
	<colgroup>
	<col width="90px" />
	<col width="*" />
	<col width="90px" />
	<col width="*" />
	</colgroup>
	<tbody>
	<tr>
		<th>검색어</th>
		<td>
			<select name="sch_type" class="select" title="검색필드">
			<? printSelectOption($sch_type_arr, $sch_type, 1); ?>
			</select>	
			<input type="text" name="sch_keyword" value="<?=$sch_keyword?>" class="text" size="30" maxlength="30" title="검색어" />				
		</td>
	</tr>	
	</tbody>
	</table>
	</fieldset>

	<p class="button">		
		<button type="submit" class="sButton info" title="검색">검 색</button>
		<a href="../shop/ajax.reco_list.html?rc_id=<?=$rc_id?>" class="btn_ajax sButton" target="#layer_content" title="초기화">초기화</a>
	</p>
	</form>
</div>
<!-- //search -->

<!-- list_top -->
<div class="list_top">
	<div class="left">
		Total : <strong><?=number_format($total_cnt)?></strong> 건, 현재 : <strong><?=number_format($page)?></strong> 페이지
	</div>
	<div class="right">
		
	</div>
</div>
<!-- //list_top -->

<!-- list -->
<div class="list">	

	<table class="list_table border odd" border="1">
	<colgroup>
	<col width="50" />
	<col width="300" />
	<col width="*" />
	<col width="80px" />
	</colgroup>
	<thead>
	<tr>
		<th>No</th>
		<th>상호</th>
		<th>위치</th>
		<th>선택</th>
	</tr>
	</thead>
	<tbody>
	<? for($i = 0 ; $i < sizeof($list) ; $i++) { ?>
	<tr class="list_tr_<?=$list[$i]['odd']?>">		
		<td><?=$list[$i]['no']?></td>
		<td><?=$list[$i]['sh_name']?></td>
		<td><?=$list[$i]['sh_sido']?> <?=$list[$i]['sh_sigungu']?> <?=$list[$i]['sh_dong']?></td>
		<td>
			<button type="button" onclick="chooseRecoShop('<?=$list[$i][$pk]?>', '<?=$list[$i]['sh_name']?>')" class="sButton tiny">선택</button>
		</td>
	</tr>
	<? } if(sizeof($list) == 0) { printNoData(4); } ?>
	</tbody>
	</table>	

	<!-- pagination -->
	<div class="pagination">
		<ul>
		<? printAjaxPagination($page_arr, $query_string, '../shop/ajax.reco_list.html', '#layer_content'); ?>
		</ul>
	</div>
	<!-- //pagination -->

</div>
<!-- //list -->