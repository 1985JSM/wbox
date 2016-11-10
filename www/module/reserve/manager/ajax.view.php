<?
if(!defined('_INPLUS_')) { exit; } 

/* init Class */
$oReserve = new ReserveManager();
$oReserve->init();
$module_name = $oReserve->get('module_name');	// 모듈명

$pk = $oReserve->get('pk');
$uid = $oReserve->get('uid');
$data = $oReserve->selectDetail($uid);
?>
<p class="primary help">* 예약 상태 및 예약 변경은 <strong>예약캘린더</strong>에서 이용하실 수 있습니다.</p>
<table class="write_table" border="1">
<colgroup>
<col width="140">
<col width="*">
<col width="140">
<col width="*">
</colgroup>
<tbody>
<tr>
	<th>이름(휴대폰)</th>
	<td><?=$data['us_name']?> (<?=$data['us_hp']?>)</td>
	<th>담당자</th>
	<td><?=$data['st_name']?></td>
</tr>
<tr>
	<th>서비스</th>
	<td colspan="3">
		<div class="service_info">
			<ul>
			<?
			$sv_name_list = $data['sv_name_list'];
			for($j = 0 ; $j < sizeof($sv_name_list) ; $j++) { ?>
			<li><?=$sv_name_list[$j]?></li>
			<? } ?>
			</ul>
		</div>
	</td>
</tr>
<tr>
	<th>소요시간</th>
	<td><?=number_format($data['sv_time'])?>분</td>
	<th>상태</th>
	<td class="state_<?=$data['rs_state']?>"><?=$data['txt_rs_state']?></td>
</tr>
<tr>
	<th>예약일시</th>
	<td><?=$data['txt_rs_datetime']?></td>
	<th>담당자승인</th>
	<td><?=getWithoutNull($data['txt_ac_datetime'])?></td>
</tr>
<tr>
	<th>예약확정</th>
	<td><?=getWithoutNull($data['txt_cf_datetime'])?></td>
	<th>취소일시</th>
	<td><?=getWithoutNull($data['txt_cc_datetime'])?></td>
</tr>
<tr>
	<th>요청사항</th>
	<td colspan="3"><?=getWithoutNull($data['rs_user_memo'])?></td>
</tr>
</tbody>
</table>

<p class="button">
	<button type="button" onclick="closeLayerPopup()" class="sButton active" title="닫기">닫기</a>	
</p>
