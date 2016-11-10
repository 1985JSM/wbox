<?
if(!defined('_INPLUS_')) { exit; }

/* set URI */
$layout_size = 'normal';
$doc_title = '메시지자동발송설정';

$oSmsAuto = new SmsAutoManager($member['sh_code']);
$oSmsAuto->initSetup();
$smscore_user_info = $oSmsAuto->oSms->getUserInfo($member['sh_code']);

$report_data = $oSmsAuto->get('report_data');
$report_list = $oSmsAuto->defineReportList();
?>

<!-- <?=$module?> -->
<div id="<?=$module?>">

	<!-- subWrap -->
	<div class="subWrap sub_member write">
		<div class="info_box">
			<h4><span class="icon tip_info"></span> 도움말</h4>
			메시지 관련 알림문자 사용여부를 설정 및 변경할 수 있습니다.
		</div>

		<form method="post" action="process.html">
			<input type="hidden" name="mode" value="modify_report" />
			<input type="hidden" name="sa_id" value="<?=$oSmsAuto->get('uid')?>" />
			<table class="write_table" summary="알림문자수신설정에 관련된 표로써 알림 기능, 발신 번호, 수신 번호, 알림 시간, 알림 조건, 알림 메시지 등 순으로 출력됩니다.">
				<caption>알림문자수신설정</caption>
				<colgroup>
					<col width="20%">
					<col width="*">
				</colgroup>
				<tbody>
				<tr>
					<th scope="row">알림 기능</th>
					<td>
						<label><input type="radio" name="sa_report_use" class="" value="Y" title="사용"<? if ($report_data['use'] == 'Y') {echo ' checked="checked"';}?>>사용</label>
						<label><input type="radio" name="sa_report_use" class="" value="N" title="미사용"<? if ($report_data['use'] == 'N') {echo ' checked="checked"';}?>>미사용</label>
					</td>
				</tr>
				<tr>
					<th scope="row">발신 번호</th>
					<td><strong><?=$smscore_user_info['data']['sd_tel_no_arr'][0]?></strong></td>
				</tr>
				<tr>
					<th scope="row">수신 번호</th>
					<td>
						<input type="text" name="sa_report_rc_no1" value="<?=$report_data['rc_no'][0]?>" class="text" size="15" maxlength="15" title="휴대폰번호" placeholder="휴대폰번호">
						<input type="text" name="sa_report_rc_no2" value="<?=$report_data['rc_no'][1]?>" class="text" size="15" maxlength="15" title="휴대폰번호" placeholder="휴대폰번호">
						<input type="text" name="sa_report_rc_no3" value="<?=$report_data['rc_no'][2]?>" class="text" size="15" maxlength="15" title="휴대폰번호" placeholder="휴대폰번호">
						<span>※ 수신번호는 3개까지 등록할 수 있습니다.</span>
					</td>
				</tr>
				<tr>
					<th scope="row">알림 시간</th>
					<td>알림 조건이 발생하는 정시에 메시지가 전송됩니다.</td>
				</tr>
				</tbody>
			</table>

			<fieldset class="etc">
				<table class="list_table border" summary="알림문자수신설정에 관련된 표로써 알림 설정, 알림 조건, 알림 메시지 등 순으로 출력됩니다.">
					<caption>알림문자수신설정</caption>
					<colgroup>
						<col width="10%">
						<col width="*">
						<col width="40%">
					</colgroup>
					<thead>
					<tr>
						<th scope="row">알림 설정</th>
						<th scope="row">알림 조건</th>
						<th scope="row">알림 메시지</th>
					</tr>
					</thead>
					<tbody>
					<tr>
						<td><input type="checkbox" name="use_report_amount" id="" title=""<? if ($report_data['data']['report_amount']['use'] == 'Y') { echo ' checked=checked';}?>></td>
						<td>
							<ul>
								<li>
									충전 건수가
									<select name="report_amount_option1" class="select" title="남은 건수">
										<option value="10000">10,000</option>
										<option value="15000">15,000</option>
									</select>
									건 이하일 때 알림
								</li>
								<li>
									알림 시간
									<select name="report_amount_option2" class="select" title="알림시간">
										<option value="14:00">14:00</option>
										<option value="15:00">15:00</option>
									</select>
								</li>
							</ul>
						</td>
						<td>"<strong>가맹정명</strong>"님의 메시지 충전 건수가 "<strong class="primary">10,000</strong>"건 남았습니다.</td>
					</tr>
					<tr>
						<td><input type="checkbox" name="use_reserve_to_staff" id="" title=""<? if ($report_data['data']['reserve_to_staff']['use'] == 'Y') { echo ' checked=checked';}?>></td>
						<td>예약이 접수된 경우 담당자에게 푸시 메시지와 함께 SMS문자 메시지를 전송합니다.</td>
						<td>푸시 메시지와 동일</td>
					</tr>
					<tr>
						<td><input type="checkbox" name="use_accept_to_user" id="" title=""<? if ($report_data['data']['accept_to_user']['use'] == 'Y') { echo ' checked=checked';}?>></td>
						<td>담당자 예약 승인한 경우 고객에게 푸시 메시지와 함께 SMS문자 메시지를 전송합니다.</td>
						<td>푸시 메시지와 동일</td>
					</tr>
					<tr>
						<td><input type="checkbox" name="use_remain_to_user" id="" title=""<? if ($report_data['data']['remain_to_user']['use'] == 'Y') { echo ' checked=checked';}?>></td>
						<td>예약시간이 도래할 경우 고객에게 푸시 메시지와 함께 SMS문자 메시지를 전송합니다.</td>
						<td>푸시 메시지와 동일</td>
					</tr>
					</tbody>
				</table>
			</fieldset>

			<p class="button">
				<button type="submit" class="sButton large info">변경</button>
			</p>
		</form>

	</div>
	<!-- //subWrap -->

</div>
<!-- //<?=$module?> -->
