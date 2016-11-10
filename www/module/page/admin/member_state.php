<?
if(!defined('_INPLUS_')) { exit; } 

/* set URI */
$layout_size = 'small';
$doc_title = '회원가입통계';
?>

<!-- <?=$module?> -->
<div id="<?=$module?>">


	<!-- search -->
	<div class="search">
		<form name="" action="" method="" onsubmit="">
		<input type="hidden" name="" value="" />
		<input type="hidden" name="" value="" />
		<input type="hidden" name="" value="" />

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
			<th>지역설정</th>
			<td>
				<select name="" class="select" title="시/도">
				<option value="">시/도 전체</option>
				<option value="">서울특별시</option>
				<option value="">부산광역시</option>
				</select>
				
				<select name="" class="select" title="시/구/군">
				<option value="">남구</option>
				<option value="">북구</option>
				</select>
			</td>
		</tr>
		<tr>
			<th>기간설정</th>
			<td colspan="3">
				<input type="text" name="sch_s_date" id="sch_s_date" value="" class="text date" size="12" maxlength="10" title="검색 시작일" />
				~
				<input type="text" name="sch_e_date" id="sch_e_date" value="" class="text date" size="12" maxlength="10" title="검색 종료일" />						

			</td>
		</tr>
		<tr>
			<th>집계기준</th>
			<td>
				<input type="radio" name="" id="" class="" value="" /> <label for="">연도별</label> 
				<input type="radio" name="" id="" class="" value="" /> <label for="">월별</label> 	
				<input type="radio" name="" id="" class="" value="" /> <label for="">일별</label> 
				<input type="radio" name="" id="" class="" value="" /> <label for="">연령별</label> 
				<input type="radio" name="" id="" class="" value="" /> <label for="">성별</label> 
			</td>
		</tr>		
		</tbody>
		</table>
		</fieldset>

		<p class="button">		
			<button type="submit" class="sButton info" title="검색">검 색</button>
			<a href="./list.html" class="sButton" title="초기화">초기화</a>
		</p>
		</form>
	</div>
	<!-- //search -->

	<div class="stats">
		<h4><strong class="info">시/구/군별</strong> <strong>회원가입현황</strong> (울산특별시, 2015-01-01 ~ 2016-01-01)</h4> <!-- 기간설정, 지역선택, 출력형태 회원가입 현황 -->
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
		<tr>
			<td class="sub_th">남구</td>			
			<td>
				<div class="visit_bar">
					<span style="width:80%"></span>
					<span class="percent" style="left:80%">80%</span>
				</div>
			</td>
			<td class="number">8명</td>
		</tr>
		<tr>
			<td class="sub_th">동구</td>			
			<td>
				<div class="visit_bar">
					<span style="width:0%"></span>
					<span class="percent" style="left:0%">0%</span>
				</div>
			</td>
			<td class="number">0명</td>
		</tr>
		<tr>
			<td class="sub_th">북구</td>			
			<td>
				<div class="visit_bar">
					<span style="width:20%"></span>
					<span class="percent" style="left:20%">20%</span>
				</div>
			</td>
			<td class="number">2명</td>
		</tr>
		</tbody>
		<tfoot>
		<tr class="sum">
			<th class="sub_th">합계</th>			
			<td class="number"></td>
			<td class="number">6명</td>
		</tr>
		</tfoot>
		</table>
	</div>

	
</div>
<!-- //<?=$module?> -->