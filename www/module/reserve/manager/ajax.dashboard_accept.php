<?
if(!defined('_INPLUS_')) { exit; } 

/* init Class */
$oReserve = new ReserveManager();
$oReserve->init();

/* search condition */
$query_string = $oReserve->get('query_string');
$page = $oReserve->get('page');

/* data */
$pk = $oReserve->get('pk');
$uid = $oReserve->get('uid');
$data = $oReserve->selectDetail($uid);
?>
<div class="write">
			
	<form name="accept_form" method="post" action="./process.html" onsubmit="return submitAcceptForm(this)" target="#reserve_list">
	<input type="hidden" name="flag_json" value="1" />	
	<input type="hidden" name="mode" value="update_state" />

	<input type="hidden" name="list_mode" value="<?=$list_mode?>" />
	<input type="hidden" name="sch_rs_date" value="<?=$sch_rs_date?>" />
	<input type="hidden" name="sch_st_id" value="<?=$sch_st_id?>" />

	<input type="hidden" name="<?=$pk?>" value="<?=$uid?>" />
	<input type="hidden" name="rs_state" value="A" />

	<fieldset>
	<legend>등록/수정</legend>			
	<table class="write_table" border="1">
	<caption>등록/수정</caption>
	<colgroup>
	<col width="140">
	<col width="*">
	</colgroup>
	<tbody>
	<tr>
		<th class="required">예약승인여부</th>
		<td>
			<input type="radio" name="rs_state" id="rs_state_A" value="A" checked="checked" />
			<label for="rs_state_A">예약승인</label>

			<input type="radio" name="rs_state" id="rs_state_C" value="C" />
			<label for="rs_state_C">예약불가</label>

			<br />
			<span class="comment">- 예약승인 후 변경은 불가능합니다. 신중히 선택바랍니다.</span>
		</td>
	</tr>		
	</tbody>
	</table>
	</fieldset>	

	<p class="button">
		<button type="submit"><img src="/img/manager/btn_nomember.gif" alt="확인"></button>
		<button type="button" onclick="closeLayerPopup()"><img src="/img/manager/btn_cancel.gif" alt="취소" /></button>
	</p>

	</form>
</div>
