<?
if(!defined('_INPLUS_')) { exit; } 

/* init Class */
$oCoupon = new CouponManager();
$oCoupon->init();
$module_name = $oCoupon->get('module_name');	// 모듈명

/* list */
$list = $oCoupon->selectList();
$total_cnt = $oCoupon->get('total_cnt');
$cnt_page = $oCoupon->get('cnt_page');

/* search condition */
$sch_type_arr = $oCoupon->get('sch_type_arr');
$query_string = $oCoupon->get('query_string');

/* pagination */
$page = $oCoupon->get('page');
$page_arr = $oCoupon->getPageArray();
$pk = $oCoupon->get('pk');
?>
<script type="text/javascript">
//<![CDATA[
$(document).ready(function() {
	
});
//]]>
</script>

<!-- <?=$module?> -->
<div id="<?=$module?>">

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
		<!-- list_table -->
		<table class="list_table border odd" border="1">
		<colgroup>
		<col width="80" />		
		<col width="*" />
		<col width="140" />
		<col width="120" />		
		<col width="100" />
		<col width="60" />
		</colgroup>
		<thead>
		<tr>
			<th>no</th>
			<th>쿠폰명</th>			
			<th>유형</th>
			<th>사용수</th>
			<th>상태</th>
			<th>수정</th>
		</tr>
		</thead>
		<tbody>
		<? for($i = 0 ; $i < sizeof($list) ; $i++) { ?>
		<tr class="list_tr_<?=$list[$i]['odd']?>">
			<td><?=$list[$i]['no']?></td>
			<td class="subject"><a href="./write.html?<?=$pk?>=<?=$list[$i][$pk]?>&page=<?=$page?><?=$query_string?>"><?=$list[$i]['cp_name']?></a></td>
			<td>
				<?=$list[$i]['txt_cp_type']?>
				<? if($list[$i]['cp_type'] == 'S') { ?>(<?=number_format($list[$i]['cp_sale_price'])?><?=$list[$i]['txt_cp_sale_type']?>)<? } ?>
			</td>
			<td class="primary">
				<?=number_format($list[$i]['cnt_use'])?>개 / 
				<? if($list[$i]['cp_quantity'] > 0) { ?><?=number_format($list[$i]['cp_quantity'])?>개<? } else { ?>무제한<? } ?>
			</td>
			<td><?=$list[$i]['txt_cp_display']?></td>
			<td><a href="./write.html?<?=$pk?>=<?=$list[$i][$pk]?>&page=<?=$page?><?=$query_string?>" class="sButton tiny " title="수정">수정</a></td>
		</tr>
		<? } if(sizeof($list) == 0) { printNoData(6); } ?>		
		</tbody>
		</table>	
		<!-- //list_table -->

		<div class="button">	
			<div class="left">
				
			</div>
			<div class="right">
				<a href="./write.html?page=<?=$page?><?=$query_string?>" class="sButton small primary" title="추가하기">추가하기</a>	
			</div>
		</div>
		</form>

		<!-- pagination -->
		<div class="pagination">
			<ul>
			<? printPagination($page_arr, $query_string); ?>
			</ul>
		</div>
		<!-- //pagination -->

	</div>
	<!-- //list -->
</div>
<!-- //<?=$module?> -->