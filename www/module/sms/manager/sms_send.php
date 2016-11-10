<?
if(!defined('_INPLUS_')) { exit; }

/* set URI */
$layout_size = 'small';
$doc_title = 'SMS/LMS 전송';
$oSms = new SmsManager();
$oSms->checkJoined(true);
$smscore_auth_info = $oSms->getAuthInfoByShCode($member['sh_code']);
$smscore_user_info = $oSms->getUserInfo($member['sh_code']);

$cs_level_arr = $oSms->getArrOfInformation('cs_level_arr');
$st_id_arr = $oSms->getArrOfInformation('st_id_arr');

//print_r($smscore_user_info);
?>

<!-- <?=$module?> -->
<div id="<?=$module?>">

	<!-- subWrap -->
	<div class="subWrap sub_send">
		<div class="info_box">
			<h4><span class="icon tip_info"></span> 도움말</h4>
			한글 1자/2byte, 영문 1자/1byte의 SMS, LMS 메시지를 전송할 수 있습니다.
		</div>

		<form action="./process.html" method="post" onsubmit="return sendSms(this)">
			<input type="hidden" name="mode" value="memberSelect" />
			<input type="hidden" name="mode_memberSelect" value="" />
			<!-- send_area -->
			<div class="send_area">
				<!-- con_left -->
				<div class="con_left">
					<!-- box -->
					<div class="box">
						<ul>
							<li>잔여 충전 건수 <span><?=number_format($smscore_user_info['data']['mb_cnt_sms'])?>건수</span></li>
							<li id="cnt_sent">차감 예정 건수 <span>0건수</span></li>
							<li>전송 가능 건수</li>
						</ul>

						<table class="list_table border" summary="전송 가능 건수에 관련된 표로써 SMS, LMS, MMS 순으로 출력됩니다.">
							<caption>전송 가능 건수</caption>
							<colgroup>
								<col width="33%">
								<col width="33%">
								<col width="*">
							</colgroup>
							<thead>
							<tr>
								<th>SMS</th>
								<th>LMS</th>
								<th>MMS</th>
							</tr>
							</thead>
							<tbody>
							<tr>
								<td><?=number_format($smscore_user_info['data']['mb_cnt_sms'])?></td>
								<td><?=number_format(($smscore_user_info['data']['mb_cnt_sms'] / 3))?></td>
								<td>-</td>
							</tr>
							</tbody>
						</table>

						<div class="btn_charge">
							<a href="./sms_charge.html" class="sButton tiny info"><span class="text">충전</span></a>
						</div>
					</div>
					<!-- //box -->

					<!-- phone -->
					<div class="phone">
						<div class="write_area">
							<textarea name="sms_send_text" class="smsbox"></textarea>
						</div>

						<p class="byte">
							<span class="length">0</span>
							<span class="limit">/ 90byte</span>
							<span class="type">SMS</span>
						</p>

						<div class="btn_delete">
							<button class="trash"><i class="xi-trash"></i></button>
						</div>

						<p class="change_info">90byte 초과시 자동 LMS로 전환됩니다.</p>

						<div class="btn_sms">
							<span class="btn_set sms"><a href="./lyr.char_figure.html" class="active btn_ajax size_480x300" target="#layer_popup" title="특수문자">특수문자</a></span><span class="btn_set sms"><a href="./lyr.sms_box_list.html" class="active center btn_ajax size_780x640" target="#layer_popup" title="메시지 저장함">메시지함</a></span><span class="btn_set sms"><a href="./lyr.short_url.html" class="active btn_ajax size_480x400" target="#layer_popup" title="짧은 URL">짧은주소</a></span>
						</div>
					</div>
					<!-- //phone -->

					<!-- message_info -->
					<div class="message_info">
						<ul>
							<li><button type="button" class="name">{이름} 자동삽입</button><button type="button" id="name" class="question" onclick="showHelp(this)"><i class="xi-help-o xi-x"></i></button></li>
							<li><p class="btn_area"><input type="checkbox" id="sms_deny080" name="sms_deny080"><label for="sms_deny080">080수신거부 사용하기</label></p><button type="button" id="quiesce" class="question" onclick="showHelp(this)"><i class="xi-help-o xi-x"></i></button></li>
						</ul>
						<!-- 이름자동삽입-->
						<p class="name on"> <!-- class "on" 추가시 보여짐  -->
							<strong>{이름} 자동삽입이란?</strong><br />
							주소록에 등록된 수신자 개별 이름으로 발송할 수 있는 기능
						</p>
						<!-- //이름자동삽입-->
						<!-- 080수신거부사용-->
						<p class="quiesce">
							광고성 문자 전송 시에는 (광고), 매장명, 무료수신거부를 반드시표기해야하며, 미준수시 최소 300 ~ 3,000만원 벌금 부과 *080수신거부 체크시 자동추가되며, 서비스 요금이 적용됩니다.
						</p>
						<!-- //080수신거부사용-->
					</div>
					<!-- //message_info -->

					<!-- caller_id -->
					<div class="caller_id">
						<span class="caller">발신번호</span>
						<select name="sms_sd_no" class="select" title="발신번호">
							<?printSelectOption($smscore_user_info['data']['sd_tel_no_arr'], '')?>
						</select>
						<button type="button" class="sButton small info" onclick="alert('발신번호관리는 점검 중 입니다.')"><span class="text">발신번호관리</span></button>
					</div>
					<!-- //caller_id -->
				</div>
				<!-- //con_left -->

				<!-- con_right -->
				<div class="con_right">
					<!-- tab -->
					<div class="tab_area">
						<ul>
							<li><a href="#typeRecipient">직접입력</a></li>
							<li><a href="#memberSelect" class="on">고객선택</a></li>
						</ul>
					</div>
					<!-- //tab -->
					<div class="tab_area_list">
						<div id="typeRecipient" style="display: none;">
							<? include_once 'sms_send_direct.php'; ?>
						</div>
						<div id="memberSelect">
							<? include_once 'sms_send_member.php'; ?>
						</div>
					</div>
					<h4>전송 정보 설정</h4>

					<table class="write_table" summary="직접입력에 관련된 표로써 수신번호입력, 중복번호제거, 전송시각, 테스트전송 등 순으로 출력됩니다.">
						<caption>직접입력</caption>
						<colgroup>
							<col width="20%">
							<col width="*">
						</colgroup>
						<tbody>
						<tr>
							<th scope="row">중복번호제거</th>
							<td>
								<label><input type="radio" name="sms_remove_repeated" class="" value="Y" checked="checked" title="사용">사용</label>
								<label><input type="radio" name="sms_remove_repeated" class="" value="N" title="미사용">미사용</label>
							</td>
						</tr>
						<tr>
							<th scope="row">전송시각</th>
							<td>
								<label><input type="radio" name="sms_rs_type" class="" value="D" checked="checked" title="즉시전송">즉시전송</label>
								<label><input type="radio" name="sms_rs_type" class="" value="R" title="예약전송">예약전송</label>

								<!-- 예약전송 선택시 출력 -->
								<div class="reservation">
									<input type="text" name="sms_rs_date" id="" value="" class="text date" size="10" maxlength="10" title="전송일" readonly="readonly"/>

									<select name="sms_rs_hour" class="select" title="">
										<?
										for ($i=0; $i<=23; $i++) {
											echo "<option value=\"{$i}\">{$i}</option>";
										}
										?>
									</select>
									시
									<select name="sms_rs_minutes" class="select" title="">
										<?
										for ($i=0; $i<=55; $i=$i+5) {
											echo "<option value=\"{$i}\">{$i}</option>";
										}
										?>
									</select>
									분
								</div>
								<!-- //예약전송 선택시 출력 -->
							</td>
						</tr>
						<tr>
							<th scope="row">테스트전송</th>
							<td>
								<table class="list_table border" summary="테스트전송에 관련된 표로써 이름, 휴대폰 순으로 출력됩니다.">
									<caption>테스트전송</caption>
									<colgroup>
										<col width="40%">
										<col width="*">
									</colgroup>
									<thead>
									<tr>
										<th>이름</th>
										<th>휴대폰</th>
									</tr>
									</thead>
									<tbody>
									<tr>
										<td><input type="text" name="test_recipient_name" value="" class="text" size="10" maxlength="15" title="이름" placeholder="이름" /></td>
										<td><input type="text" name="test_recipient_hp" value="" class="text number" size="20" maxlength="15" title="휴대폰번호" placeholder="휴대폰번호" /></td>
									</tr>
									</tbody>
								</table>

								<p class="test">테스트 전송은 정상 과금됩니다.</p>
								<?=$query_string?>
								<div class="btn_test">
									<button type="button" class="sButton small info"><span class="sButton-container"><span class="sButton-bg"><span class="text">테스트 전송</span></span></span></button>
								</div>
							</td>
						</tr>
						</tbody>
					</table>

					<div class="btn_transmit">
						<button type="submit" class="sButton large info"><span class="sButton-container"><span class="sButton-bg"><span class="text">전송하기</span></span></span></button>
					</div>
				</div>
				<!-- con_right -->
			</div>
			<!-- //send_area -->
		</form>
	</div>
	<!-- //subWrap -->

</div>
<!-- //<?=$module?> -->