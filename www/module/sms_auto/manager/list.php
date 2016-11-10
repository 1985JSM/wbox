<?
if(!defined('_INPLUS_')) { exit; }

/* set URI */
$layout_size = 'normal';
$doc_title = '메시지자동발송설정';

$oSmsAuto = new SmsAutoManager($member['sh_code']);
$oSmsAuto->initSetup();
$data = $oSmsAuto->getListData();

$restrict_time = $oSmsAuto->getRestrictTime();
$substitution_code = $oSmsAuto->get('substitution_code');

include_once(_MODULE_PATH_.'/sms/sms.manager.class.php');
$oSms = new SmsManager();
$user_info = $oSms->getUserInfo($member['sh_code']);
$sd_no = $user_info['data']['sd_tel_no_arr'];
?>

<!-- <?=$module?> -->
<div id="<?=$module?>">

	<!-- subWrap -->
	<div class="subWrap sub_auto write">
		<div class="info_box">
			<h4><span class="icon tip_info"></span> 도움말</h4>
			<ul>
				<li>- 전송여부 사용에 체크시 메시지가 자동 발송됩니다.</li>
				<li>- 자동으로 변환되는 글자수가 90byte 이상일 경우 자동으로 LMS로 변환되어 전송됨을 유의해 주세요.</li>
				<li>- 자동SMS의 발송문구는 기본 제공됩니다. 각 기본 발송문구의 텍스트는 수정 가능하며, 치환코드를 사용하여 시스템상의 정보를 SMS에 포함할 수 있습니다. </li>
				<li>- 항목별 사용 가능한 치환코드는 사용 가능한 치환 코드에서 사용가능합니다.</li>
				<li>- 치환코드는 복사하여 사용가능하며, <span class="primary">{}까지 선택하여 사용</span>해주시길 바랍니다.</li>
			</ul>
		</div>

		<form method="post" action="process.html">
			<input type="hidden" name="mode" value="modify_auto" />
			<input type="hidden" name="sa_id" value="<?=$oSmsAuto->get('uid')?>" />
			<fieldset>
				<h4>발신번호 설정</h4>
				<table class="list_table" summary="발송 제한 시간 설정에 관련된 표로써 발송 제한 시간 설정 순으로 출력됩니다.">
					<caption>발송 제한 시간 설정</caption>
					<colgroup>
						<col width="20%">
						<col width="*">
					</colgroup>
					<tr>
						<th>발신번호 설정</th>
						<td class="left">
							<select name="sms_sd_no" class="select" title="">
								<?printSelectOption($sd_no, $oSmsAuto->get('sd_no'))?>
							</select>
							<a href="#" class="sButton small info">발신번호관리</a>
						</td>
					</tr>
				</table>
			</fieldset>

			<fieldset class="etc">
			<h4>발송 제한 시간 설정</h4>
			<table class="list_table" summary="발송 제한 시간 설정에 관련된 표로써 발송 제한 시간 설정 순으로 출력됩니다.">
				<caption>발송 제한 시간 설정</caption>
				<colgroup>
					<col width="20%">
					<col width="*">
				</colgroup>
				<tr>
					<th>발송 제한 시간 1</th>
					<td class="left">
						<select name="restrict_time1_start_hours" class="select" title="">
							<?=$oSmsAuto->getTimeOption('hours', $restrict_time['time1_start'][0]);?>
						</select>
						시
						<select name="restrict_time1_start_minutes" class="select" title="">
							<?=$oSmsAuto->getTimeOption('minutes', $restrict_time['time1_start'][1]);?>
						</select>
						분 ~
						<select name="restrict_time1_end_hours" class="select" title="">
							<?=$oSmsAuto->getTimeOption('hours', $restrict_time['time1_end'][0]);?>
						</select>
						시
						<select name="restrict_time1_end_minutes" class="select" title="">
							<?=$oSmsAuto->getTimeOption('minutes', $restrict_time['time1_end'][1]);?>
						</select>
						분 까지 발송하지 않음
					</td>
				</tr>
				<tr>
					<th>발송 제한 시간 2</th>
					<td class="left">
						<select name="restrict_time2_start_hours" class="select" title="">
							<?=$oSmsAuto->getTimeOption('hours', $restrict_time['time2_start'][0]);?>
						</select>
						시
						<select name="restrict_time2_start_minutes" class="select" title="">
							<?=$oSmsAuto->getTimeOption('minutes', $restrict_time['time2_start'][1]);?>
						</select>
						분 ~
						<select name="restrict_time2_end_hours" class="select" title="">
							<?=$oSmsAuto->getTimeOption('hours', $restrict_time['time2_end'][0]);?>
						</select>
						시
						<select name="restrict_time2_end_minutes" class="select" title="">
							<?=$oSmsAuto->getTimeOption('minutes', $restrict_time['time2_end'][1]);?>
						</select>
						분 까지 발송하지 않음
					</td>
				</tr>
			</table>
			<ul class="guide_list info">
				<li>- 자동 SMS 전송 제한 및 허용 시간을 설정할 수 있습니다.</li>
				<li>- 오후 9시~오전 8시(수신자가 받는 시간 기준)에 광고성 정보를 전송하려면, 수신자 사전동의가 필요합니다.</li>
			</ul>
			</fieldset>

			<?
			foreach ($data as $sort => $data_arr) {
				if ($sort == 'var') {
					?>
					<fieldset class="etc">
					<h4>메시지 자동 발송/문구 설정</h4>

					<table class="list_table" summary="메시지 자동발송 설정에 관련된 표로써 전송내용, 설명, 설정, 사용가능 치환코드 순으로 출력됩니다.">
					<caption>메시지 자동발송 설정</caption>
					<colgroup>
						<col width="300" />
						<col width="320" />
						<col width="300" />
						<col width="80" />
						<col width="*" />
					</colgroup>
					<thead>
					<tr>
						<th>설명</th>
						<th>전송내용</th>
						<th>설정</th>
						<th>전송여부</th>
						<th>사용가능 치환코드</th>
					</tr>
					</thead>
					<tbody>
				<?
				}

				else if ($sort == 'let') {
					?>
					<fieldset class="etc">
						<h4>시술 및 선불제 메시지 자동 발송 설정</h4>

						<p class="guide">
							시술 및 선불제 메시지의 경우 전송 내용 수정이 불가능 합니다.
						</p>

						<table class="list_table" summary="시술 및 선불제 메시지 자동 발송 설정에 관련된 표로써 전송내용, 설명, 설정, 사용가능 치환코드 순으로 출력됩니다.">
							<caption>시술 및 선불제 메시지 자동 발송 설정</caption>
							<colgroup>
								<col width="300" />
								<col width="320" />
								<col width="300" />
								<col width="80" />
								<col width="*" />
							</colgroup>
							<thead>
							<tr>
								<th>설명</th>
								<th>전송내용</th>
								<th>설정</th>
								<th>전송여부</th>
								<th>사용가능 치환코드</th>
							</tr>
							</thead>
							<tbody>
					<?
				}

				// 테이블 내용
				foreach ($data_arr as $key => $value) {
					// 타이틀 설명부분
					echo '<tr>';
					echo '<td><span class="title">' . $value['title'] . '</span>' . $value['description'];
					if ($value['hint'] != '') {
						echo '<span class="help"><img src="/img/manager/ico_tip_notice.png" alt="도움말 아이콘" /> ' . $value['hint'] . '</span>';
					}
					echo '</td>';

					// SMS 내용 부분
					echo '<td><div class="write_area">';
					if ($sort == 'let') {
						echo '<textarea class="smsbox" readonly>' . $value['contents'] . '</textarea>';
					} else {
						echo '<textarea class="smsbox" name="' . $key . '_text" onkeyup="fnChkByte(this)" onkeydown="fnChkByte(this)">' . $value['contents'] . '</textarea>';
					}
					echo '<p class="byte">';
					$sms_length = $oSmsAuto->oSms->getSmsLength($value['contents']);
					echo '<span class="length">' . $sms_length['length'] . '</span>';

					if ($sms_length['length'] > 90) {
						echo '<span class="limit">/ 2000byte</span>';
						echo '<span class="type">LMS</span>';
					} else {
						echo '<span class="limit">/ 90byte</span>';
						echo '<span class="type">SMS</span>';
					}
					echo '</p>';
					echo '<div class="btn_delete"><button type="button" class="trash"><i class="xi-trash"></i></button></div></div>';
					echo '</td>';

					// SMS 옵션 부분
					echo '<td><ul class="set">';
					$i = 1;
					while (1) {
						if (isset($value['option' . $i . '_printed'])) {
							echo '<li>';
							if ($value['option' . $i . '_input_type'] == 'select') {
								$input_text = '<select class="' . $value['option' . $i . '_input_type'] . '" name="' . $key . '_option' . $i . '_value">';

								$explode_type = explode('_', $value['option' . $i . '_type']);
								if ($explode_type[1] == 'hours') {
									$input_text .= $oSmsAuto->getTimeOption('hours', $value['option' . $i . '_value']);
								} else if ($explode_type[1] == 'minutes') {
									$input_text .= $oSmsAuto->getTimeOption('minutes', $value['option' . $i . '_value']);
								} else if ($explode_type[1] == 'seconds') {
									$input_text .= $oSmsAuto->getTimeOption('seconds', $value['option' . $i . '_value']);
								} else if ($explode_type[1] == 'birthday') {
									$input_text .= '<option value="당일">당일</option>';
									$input_text .= '<option value="전날">전날</option>';
								}
								$input_text .= '</select>';

							} else {
								$input_text = '<input class="' . $value['option' . $i . '_input_type'] . '" type="' . $value['option' . $i . '_input_type'] . '" name="' . $key . '_option' . $i . '_value" size="4" value="' . $value['option' . $i . '_value'] . '" />';
							}

							if ($value['option' . $i . '_check_use']) {
								echo '<input name="' . $key . '_option' . $i . '_use' . '" type="checkbox" value="Y"';
								if ($value['option' . $i . '_use'] == 'Y') {
									echo ' checked';
								}
								echo ' />';
							}
							echo str_replace('{{input}}', $input_text, $value['option' . $i . '_printed']);
							echo '</li>';
							$i++;
						}
						else {
							break;
						}
					}
					echo '</ul>';
					if (!empty($value['option_text'])) {
						echo '<p class="guide primary">';
						echo $value['option_text'];
						echo '</p>';
					}
					echo '</td>';

					// 사용 여부
					echo '<td><input type="checkbox" id="' . $key . '_use" name="' . $key . '_use" value="Y"';
					if ($value['use'] == 'Y') {
						echo ' checked="checked"';
					}
					echo ' /><label for="' . $key . '_use"> 사용</label></td>';

					// 치환 코드 목록
					echo '<td>';
					if ($sort == 'let') {

					} else {
						foreach ($substitution_code['default'] as $code_key => $code_value) {
							echo $code_value . '<br />';
						}
						if (count($substitution_code[$value['code_type']]) > 0) {
							foreach ($substitution_code[$value['code_type']] as $code_key => $code_value) {
								echo $code_value . '<br />';
							}
						}
					}

					echo '</td>';
					echo '</tr>';
				}
				?>
					</tbody>
				</table>
			</fieldset>
			<?
			}
			?>
			<p class="button">
				<button type="submit" class="sButton large info">변경</button>
			</p>
		</form>
	</div>
	<!-- //subWrap -->

</div>
<!-- //<?=$module?> -->