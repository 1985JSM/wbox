<?
if(!defined('_INPLUS_')) { exit; } 

$oUser->init();
$module_name = $oUser->get('module_name');	// 모듈명

/* list */
$list = $oUser->selectList();
$total_cnt = $oUser->get('total_cnt');
$cnt_page = $oUser->get('cnt_page');

/* search condition */
$sch_type_arr = $oUser->get('sch_type_arr');
$query_string = $oUser->get('query_string');

/* pagination */
$page = $oUser->get('page');
$page_arr = $oUser->getPageArray();
$pk = $oUser->get('pk');

/* code */
$mb_level_arr = $oUser->get('mb_level_arr');

/* 최근 기간 */
$sch_date_arr = $oUser->get('sch_date_arr');
unset($sch_date_class);
for($i = 0 ; $i < sizeof($sch_date_arr) ; $i++) {
	if($sch_s_date == $sch_date_arr[$i] && $sch_e_date == $sch_date_arr[0]) {
		$sch_date_class[$i] = 'active';
	}
}
if(!$sch_s_date && !$sch_e_date) { $sch_date_class[$i] = 'active'; }

/* list mode */
$list_mode = $oUser->get('list_mode');
$colspan = '10';
if(!$list_mode) { $colspan++; }
?>
<script type="text/javascript">
//<![CDATA[
$(document).ready(function() {
	/* 출력옵션 */
	$("select.order_select").on("change", function() {

		var f = document.search_form;
		var name = $(this).attr("name");
		var value = $(this).val();

		$("input[name='" + name + "']", f).attr("value", value).val(value);
		if(f.onsubmit()) {
			f.submit();
		}
	});		
});
//]]>
</script>

<!-- <?=$module?> -->
<div id="<?=$module?>">

	<!-- search -->
	<div class="search">
		<form name="search_form" method="get" onsubmit="return submitSearchForm(this)">
		<input type="hidden" name="sch_cnt_rows" value="<?=$sch_cnt_rows?>" />
		<input type="hidden" name="sch_date_type" value="rs_date" />

		<fieldset>
		<legend>검색조건</legend>
		<table class="search_table" border="1">
		<caption>검색조건</caption>
		<colgroup>
		<col width="90" />
		<col width="*" />
		<col width="90" />
		<col width="*" />
		</colgroup>
		<tbody>
		<tr>
			<th>가입일</th>
			<td colspan="3">								
				<input type="text" name="sch_s_date" id="sch_s_date" value="<?=$sch_s_date?>" class="text date" size="12" maxlength="10" title="검색 시작일" />
				~
				<input type="text" name="sch_e_date" id="sch_e_date" value="<?=$sch_e_date?>" class="text date" size="12" maxlength="10" title="검색 종료일" />	
				
				<a href="./list.html?sch_s_date=<?=$sch_date_arr[0]?>&sch_e_date=<?=$sch_date_arr[0]?>" class="sButton tiny <?=$sch_date_class[0]?> btn_quick_date">1일</a>
				<a href="./list.html?sch_s_date=<?=$sch_date_arr[1]?>&sch_e_date=<?=$sch_date_arr[0]?>" class="sButton tiny <?=$sch_date_class[1]?> btn_quick_date">3일</a>
				<a href="./list.html?sch_s_date=<?=$sch_date_arr[2]?>&sch_e_date=<?=$sch_date_arr[0]?>" class="sButton tiny <?=$sch_date_class[2]?> btn_quick_date">7일</a>
				<a href="./list.html?sch_s_date=<?=$sch_date_arr[3]?>&sch_e_date=<?=$sch_date_arr[0]?>" class="sButton tiny <?=$sch_date_class[3]?> btn_quick_date">1개월</a>
				<a href="./list.html" class="sButton tiny <?=$sch_date_class[4]?> btn_quick_date">전체</a>
			</td>
		</tr>	
		<? if($list_mode != 'leave') { ?>
		<tr>
			<th>등급</th>
			<td>
				<select name="sch_mb_level" class="select" title="전체">
				<option value="">전체</option>
				<? printSelectOption($mb_level_arr, $sch_mb_level, 1); ?>
				</select>
			</td>
		</tr>			
		<? } ?>
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
			<a href="?page=1" class="sButton" title="초기화">초기화</a>
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
			<strong>*출력옵션 : </strong>
			<select name="sch_cnt_rows" class="select order_select" title="출력개수">
			<? printSelectOption($oUser->get('cnt_rows_arr'), $oUser->get('cnt_rows'), 1); ?>
			</select>
		</div>
	</div>
	<!-- //list_top -->

	<!-- list -->
	<div class="list">
		
		<form name="list_form" action="./process.html" method="post" onsubmit="return submitListForm(this)">
		<input type="hidden" name="mode" value="delete" />		
		<input type="hidden" name="page" value="<?=$page?>" />
		<input type="hidden" name="query_string" value="<?=$query_string?>" />
		<input type="hidden" name="<?=$pk?>" value="" />

		<!-- list_table -->
		<table class="list_table border odd" border="1">
		<colgroup>
		<? if($list_mode == 'leave') { ?><col width="30" /><? } ?>
		<col width="50" />
		<col width="100" />		
		<col width="50" />
		<col width="130" />
		<col width="*" />
		<col width="100" />		
		<col width="150" />
		<? if($list_mode != 'leave') { ?><col width="100" /><? } ?>
		<? if($list_mode != 'leave') { ?><col width="90" /><? } ?>
		<col width="100" />
		<? if($list_mode == 'leave') { ?><col width="100" /><? } ?>
		<? if(!$list_mode) { ?><col width="60" /><? } ?>
		</colgroup>
		<thead>
		<tr>
			<? if($list_mode == 'leave') { ?><th><input type="checkbox" id="all_check" title="전체선택" /></th><? } ?>
			<th>No</th>
			<th>이름</th>
			<th>성별</th>
			<th>닉네임</th>
			<th>이메일</th>
			<th>휴대폰</th>
			<th>지역</th>
			<? if($list_mode != 'leave') { ?><th>회원등급</th><? } ?>
			<? if($list_mode != 'leave') { ?><th>완료예약/<br />종료예약(건)</th><? } ?>
			<th>가입일</th>
			<? if($list_mode == 'leave') { ?><th>탈퇴일</th><? } ?>
			<? if(!$list_mode) { ?><th>수정</th><? } ?>
		</tr>
		</thead>
		<tbody>
		<? for($i = 0 ; $i < sizeof($list) ; $i++) { ?>
		<tr class="list_tr_<?=$list[$i]['odd']?>">	
			<? if($list_mode == 'leave') { ?><td><input type="checkbox" name="del_uid[]" value="<?=$list[$i][$pk]?>" class="list_check" title="선택/해제" /></td><? } ?>
			<td><?=$list[$i]['no']?></td>
			<td><strong><?=$list[$i]['mb_name']?></strong></td>
			<td><?=$list[$i]['txt_mb_gender']?></td>
			<td><?=$list[$i]['mb_nick']?></td>
			<td><?=$list[$i]['mb_email']?></td>
			<td><?=$list[$i]['mb_hp']?></td>
			<td><?=$list[$i]['txt_mb_area']?></td>
			<? if($list_mode != 'leave') { ?><td><?=$list[$i]['txt_mb_level']?></td><? } ?>
			<? if($list_mode != 'leave') { ?><td><strong class="primary"><?=number_format($list[$i]['cnt_finish_reserve'])?></strong> / <?=number_format($list[$i]['cnt_total_reserve'])?></td><? } ?>
			<td><?=$list[$i]['reg_date']?></td>
			<? if($list_mode == 'leave') { ?><td><?=$list[$i]['lv_date']?></td><? } ?>
			<? if(!$list_mode) { ?><td><a href="./write.html?<?=$pk?>=<?=$list[$i][$pk]?>&page=<?=$page?><?=$query_string?>" class="sButton tiny " title="수정">수정</a></td><? } ?>
		</tr>
		<? } if(sizeof($list) == 0) { printNoData($colspan); } ?>
		</tbody>
		</table>	
		<!-- //list_table -->

		<? if($list_mode == 'leave') { ?>
		<div class="button">	
			<div class="left">
				<button type="button" onclick="deleteLaeveMember()" class="sButton small primary" title="선택삭제">선택삭제</button>
				<button type="button" onclick="cancelLaeveMember()" class="sButton small active" title="탈퇴취소">탈퇴취소</button>
			</div>
			<div class="right">

			</div>
		</div>
		<? } ?>

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