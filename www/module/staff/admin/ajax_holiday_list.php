<?
if(!defined('_INPLUS_')) { exit; } 

// hour
$hour_arr = getTimeTableArray('00:00', '24:00');

if($mode == 'add') {
	$holiday_list[] = array();
}

for($i = 0 ; $i < sizeof($holiday_list) ; $i++) { ?>
<tr>
	<td class="subject">
		<input type="text" name="s_hl_date[]" class="text required date s_hl_date" value="<?=$holiday_list[$i]['s_hl_date']?>" size="10" maxlength="10" title="휴무시작일" />
		<select name="s_hl_time[]" class="select s_hl_time" title="휴무시작시간">
		<? printSelectOption($hour_arr, $holiday_list[$i]['s_hl_time']);  ?>
		</select>
		~
		<input type="text" name="e_hl_date[]" class="text required date e_hl_date" value="<?=$holiday_list[$i]['e_hl_date']?>" size="10" maxlength="10" title="휴무종료일" />
		<select name="e_hl_time[]" class="select e_hl_time" title="휴무종료시간">
		<? printSelectOption($hour_arr, $holiday_list[$i]['e_hl_time']);  ?>
		</select>

		<label><input type="checkbox" class="checkbox hl_chk_all" value="1" <? if($holiday_list[$i]['hl_all_time']) { ?>checked="checked"<? } ?> /> 종일</label>
		<input type="hidden" name="hl_all_time[]" class="hl_all_time" value="<?=$holiday_list[$i]['hl_all_time']?>" />
	</td>
	<td>
		<input type="text" name="hl_memo[]" class="text hl_memo" value="<?=$holiday_list[$i]['hl_memo']?>" size="60" maxlength="20" title="사유" />
	</td>	
	<td>
		<button type="button" class="sButton tiny" onclick="delHoliday(this)" title="삭제">삭제</button>
	</td>
</tr>
<? } ?>