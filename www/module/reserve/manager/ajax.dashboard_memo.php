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
<!-- write -->
<div class="write">
	<form name="memo_form" method="post" action="./process.html" onsubmit="return submitMemoForm(this)">
	<input type="hidden" name="flag_json" value="1" />	
	<input type="hidden" name="mode" value="update_memo" />
	<input type="hidden" name="<?=$pk?>" value="<?=$uid?>" />
						
	<fieldset>
	<legend>관리자메모</legend>	
	<h2 class="hidden">관리자메모</h2>
	<table class="write_table" border="1">
	<caption>관리자메모</caption>
	<colgroup>
	<col width="100" />
	<col width="*" />
	</colgroup>
	<tbody>
	<tr>
		<th>메모</th>
		<td>
			<textarea name="rs_pay_memo" class="textarea placeholder manager_memo" rows="3" cols="65" title="내용"><?=$data['rs_pay_memo']?></textarea>
		</td>
	</tr>
	</tbody>
	</table>
	</fieldset>

	<p class="button">
		<button type="submit"><img src="/img/manager/btn_nomember.gif" alt="확인"></button>
		<button type="button" onclick="closeLayerPopup()"><img src="/img/manager/btn_cancel.gif" alt="취소" /></button>
	</p>

</div>
<!-- //write -->	