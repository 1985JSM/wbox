<?
if(!defined('_INPLUS_')) { exit; } 

// hour
$hour_arr = getTimeTableArray('00:00', '24:00');

if($mode == 'add') {
	$holiday_list[] = array();
}

for($i = 0 ; $i < sizeof($holiday_list) ; $i++) { ?>
<div class="column line">
            	
	<ul class="col3">
	<li>
		<div>
			<input type="text" class="input_txt" placeholder="사유를 작성하세요" />
		</div>
	</li>
	<li>
		<div>
			<a href="#" class="btn_gray_s">추가</a>
		</div>
	</li>
	</ul>

	<ol class="date_time_area">
		<li>
			<em>시작</em>
			<input type="date" name="s_hl_date[]" class="input_txt required s_hl_date" value="<?=$holiday_list[$i]['s_hl_date']?>" title="휴무시작일" />
			<select name="s_hl_time[]" class="s_hl_time" title="휴무시작시간">
			<? printSelectOption($hour_arr, $holiday_list[$i]['s_hl_time']);  ?>
			</select>
		</li>
		<li>
			<em>종료</em>
			<input type="date" name="e_hl_date[]" class="input_txt required e_hl_date" value="<?=$holiday_list[$i]['e_hl_date']?>" title="휴무종료일" />
			<select name="e_hl_time[]" class="e_hl_time" title="휴무종료시간">
			<? printSelectOption($hour_arr, $holiday_list[$i]['e_hl_time']);  ?>
			</select>
		</li>
	</ol>
	<button class="all_day on">종일</button>

</div>
<? } ?>
