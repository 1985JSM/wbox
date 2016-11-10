<?
if(!defined('_INPLUS_')) { exit; } 

/* init Class */
$oVisual = new VisualAdmin();
$oVisual->init();
$module_name = $oVisual->get('module_name');	// 모듈명

/* list */
$list = $oVisual->selectList();
$total_cnt = $oVisual->get('total_cnt');
$cnt_page = $oVisual->get('cnt_page');

/* search condition */
$sch_type_arr = $oVisual->get('sch_type_arr');
$query_string = $oVisual->get('query_string');

/* pagination */
$page = $oVisual->get('page');
$page_arr = $oVisual->getPageArray();
$pk = $oVisual->get('pk');
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
		<col width="50" />
		<col width="80" />
		<col width="240" />
		<col width="*" />
		<col width="120" />
		<col width="80" />		
		<col width="60" />
		</colgroup>
		<thead>
		<tr>
			<th>no</th>
			<th>순서</th>
			<th>이미지</th>
			<th>제목</th>
			<th>등록일</th>
			<th>상태</th>
			<th>수정</th>
		</tr>
		</thead>
		<tbody>
		<? for($i = 0 ; $i < sizeof($list) ; $i++) { ?>
		<tr class="list_tr list_tr_<?=$list[$i]['odd']?>">
			<td><?=$list[$i]['no']?></td>
			<td>
				<button type="button" onclick="changeOrder('up', this)" class="up" title="위로"></button>
				<button type="button" onclick="changeOrder('down', this)" class="down" title="아래로"></button>
				<input type="hidden" name="<?=$pk?>" value="<?=$list[$i][$pk]?>" />
			</td>
			<td>
				<a href="./write.html?<?=$pk?>=<?=$list[$i][$pk]?>&page=<?=$page?><?=$query_string?>"><img src="<?=$list[$i]['thumb']?>" width="200" height="125" /></a>
			</td>
			<td class="subject"><a href="./write.html?<?=$pk?>=<?=$list[$i][$pk]?>&page=<?=$page?><?=$query_string?>"><?=$list[$i]['vs_subject']?></a></td>
			<td><?=$list[$i]['reg_date']?></td>
			<td><?=$list[$i]['txt_vs_display']?></td>
			<td><a href="./write.html?<?=$pk?>=<?=$list[$i][$pk]?>&page=<?=$page?><?=$query_string?>" class="sButton tiny " title="수정">수정</a></td>
		</tr>
		<? } if(sizeof($list) == 0) { printNoData(7); } ?>		
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
	
	</div>
	<!-- //list -->
</div>
<!-- //<?=$module?> -->