<?
if(!defined('_INPLUS_')) { exit; } 

/* layout size */
$layout_size = 'normal';

/* init Class */
$oStats = new StatsAdmin();
$oStats->init();
$module_name = $oStats->get('module_name');	// 모듈명

/* 최근 기간 */
$sch_date_arr = $oStats->get('sch_date_arr');
unset($sch_date_class);
for($i = 0 ; $i < sizeof($sch_date_arr) ; $i++) {
	if($sch_s_date == $sch_date_arr[$i] && $sch_e_date == $sch_date_arr[0]) {
		$sch_date_class[$i] = 'active';
	}
}
if(!$sch_s_date && !$sch_e_date) { $sch_date_class[$i] = 'active'; }

$shop_std_arr = $oStats->get('shop_std_arr');
if(!$std_type) {
	$std_type = 'sido';
}

$sido_arr = selectSido();
if($sch_sido) {
	$sigungu_arr = selectSigungu($sch_sido);
}

$stats = $oStats->selectShopJoinStats($std_type);
$total = $oStats->get('total');
?>
<script type="text/javascript">
//<![CDATA[
$(document).ready(function() {

	$("#sch_sido").on("change", function(e) {
		changeSigungu($(this).val());
	});	

});
//]]>
</script>

<!-- <?=$module?> -->
<div id="<?=$module?>">

	<!-- search -->
	<div class="search">
		<form name="search_form" action="./shop_join.html" method="get" onsubmit="return submitSearchForm(this)">

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
			<th>지역설정</th>
			<td>
				<select name="sch_sido" id="sch_sido" class="select" title="시/도">
				<option value="">전체 시/도</option>
				<? printSelectOption($sido_arr, $sch_sido); ?>
				</select>
				
				<select name="sch_sigungu" id="sch_sigungu" class="select" title="시/구/군">
				<option value="">전체 시/구/군</option>
				<? printSelectOption($sigungu_arr, $sch_sigungu); ?>
				</select>
			</td>
		</tr>
		<tr>
			<th>기간설정</th>
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
		<tr>
			<th>집계기준</th>
			<td>
				<? printRadio('std_type', $shop_std_arr, $std_type, 1); ?>
			</td>
		</tr>
		</tbody>
		</table>
		</fieldset>

		<p class="button">		
			<button type="submit" class="sButton info" title="검색">검 색</button>
			<a href="./shop_join.html" class="sButton" title="초기화">초기화</a>
		</p>
		</form>
	</div>
	<!-- //search -->

	<div class="stats">
		<h4>
			<strong class="info"><?=$shop_std_arr[$std_type]?></strong> 
			<strong>가맹점가입현황</strong> 

			(<? if($sch_area) { ?><?=$area_arr[$sch_area]?><? } else { echo '전체 지역'; } ?>, 
			<? if($sch_s_date && $sch_e_date) { ?><?=$sch_s_date?> ~ <?=$sch_e_date?><? } else if($sch_s_date) { ?><?=$sch_s_date?> 이후<? } else if($sch_e_date) { ?><?=$sch_e_date?> 이전<? } else { ?>전체 기간<? } ?>)
		</h4>

		<table class="stats_table">
		<colgroup>
		<col width="200">		
		<col width="*">
		<col width="100">
		</colgroup>
		<thead>
		<tr>
			<th>구분</th>			
			<th>비율</th>
			<th>가입회원수</th>
		</tr>
		</thead>		
		<tbody>
		<? if(sizeof($stats) > 0) { ?>
		<? foreach($stats as $key => $arr) { ?>
		<tr>
			<td class="sub_th"><?=$arr['name']?></td>			
			<td>
				<div class="visit_bar">
					<span style="width:<?=$arr['per']?>%"></span>
					<span class="percent" style="left:<?=$arr['per']?>%"><?=$arr['per']?>%</span>
				</div>
			</td>
			<td class="number"><?=number_format($arr['cnt'])?>명</td>
		</tr>
		<? } ?>
		<? } else { ?>
		<tr>
			<td colspan="3" class="no_data">해당 검색 조건에 해당하는 통계 자료가 존재하지 않습니다.</td>	
		</tr>
		<? } ?>
		</tbody>
		<tfoot>
		<tr class="sum">
			<th class="sub_th">합계</th>			
			<td class="number"></td>
			<td class="number"><?=number_format($total)?>명</td>
		</tr>
		</tfoot>
		</table>
	</div>
</div>
<!-- //<?=$module?> -->