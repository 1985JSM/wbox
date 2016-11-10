<?php
$layout_size = 'tiny';
$doc_title = '메시지충전';
$oSms = new SmsManager();
$oSms->checkJoined(true);
$auth_info = $oSms->getAuthInfoByShCode($member['sh_code']);
$api_key = $auth_info['smscore_api_key'];
$mb_id = $auth_info['smscore_mb_id'];
?>

<!-- <?=$module?> -->
<div id="<?=$module?>">

	<!-- subWrap -->
	<div class="subWrap sub_payment write">
		<div class="info_box">
			<h4><span class="icon tip_info"></span> 도움말</h4>
			메시지 전송에 필요한 금액을 충전할 수 있습니다.
		</div>

		<form id="payment_form" name="payment_form" action="http://smscore.co.kr/webapi/payment/popup.request.html" method="post">
			<input type="hidden" name="mb_id" value="<?=$mb_id?>" />
			<input type="hidden" name="mb_api_key" value="<?=$api_key?>" />
			<input type="hidden" name="pa_type" value="C" />
			<input name="return_uri" value="http://<?=$_SERVER['HTTP_HOST']?>/webmanager/sms/pop.charge_result.html" type="hidden" />
			<input name="pa_price" value="40000" type="hidden" />
			<h4>충전 금액 선택</h4>

			<p class="vat">* VAT 별도</p>
			<table class="list_table border" summary="충전 금액 선택에 관련된 표로써 선택, 충전금액, 단가, SMS건수, 혜택 순으로 출력됩니다.">
				<caption>충전 금액 선택</caption>
				<colgroup>
					<col width="10%">
					<col width="30%">
					<col width="15%">
					<col width="15%">
					<col width="*">
				</colgroup>
				<thead>
				<tr>
					<th>선택</th>
					<th>충전금액</th>
					<th>단가</th>
					<th>SMS건수</th>
					<th>혜택</th>
				</tr>
				</thead>
				<tbody>
				<tr>
					현재 4만원만 가능합니다.
					<td><label><input type="radio" name="pa_subject" class="" value="2,000건" title="" /></label></td>
					<td id="price">40,000원</td>
					<td>20원</td>
					<td>2,000건</td>
					<td>-</td>
				</tr>
				<tr>
					<td><label><input type="radio" name="pa_subject" class="" value="5,500건" title="" /></label></td>
					<td id="price">100,000원</td>
					<td>18원</td>
					<td>5,500건</td>
					<td class="info">500건 추가지급</td>
				</tr>
				<tr>
					<td><label><input type="radio" name="pa_subject" class="" value="11,700건" title="" /></label></td>
					<td id="price">200,000원</td>
					<td>17원</td>
					<td>11,700건</td>
					<td class="info">1,700건 추가지급</td>
				</tr>
				<tr>
					<td><label><input type="radio" name="pa_subject" class="" value="25,000건" title="" /></label></td>
					<td id="price">400,000원</td>
					<td>15.9원</td>
					<td>25,000건</td>
					<td class="info">5,000건 추가지급</td>
				</tr>
				<tr>
					<td><label><input type="radio" name="pa_subject" class="" value="66,600건" title=""></label></td>
					<td id="price">1,000,000원</td>
					<td>15원</td>
					<td>66,600건</td>
					<td class="info">16,600건 추가지급</td>
				</tr>
				</tbody>
			</table>

			<fieldset class="etc">
				<table class="write_table" summary="충전금액에 관련된 표로써 충전금액, 부가세 순으로 출력됩니다.">
					<caption>충전금액</caption>
					<colgroup>
						<col width="25%">
						<col width="*">
					</colgroup>
					<tbody>
					<tr id="price">
						<th>충전금액</th>
						<td>0원</td>
					</tr>
					<tr id="tax">
						<th>부가세</th>
						<td>0원</td>
					</tr>
					</tbody>
				</table>
			</fieldset>

			<fieldset class="etc">
				<table class="write_table" summary="결제금액에 관련된 표로써 결제금액, 결제방식 순으로 출력됩니다.">
					<caption>결제금액</caption>
					<colgroup>
						<col width="25%">
						<col width="*">
					</colgroup>
					<tbody>
					<tr id="amount">
						<th>결제금액</th>
						<td><strong class="primary">0원</strong> (VAT 포함)</td>
					</tr>
					<tr>
						<th>결제방식</th>
						<td>
							<label><input type="radio" name="pa_method" class="" value="C" checked="checked" title="결제수단">신용카드</label>
							<label><input type="radio" name="pa_method" class="" value="V" title="결제수단">계좌이체</label>
						</td>
					</tr>
					</tbody>
				</table>
			</fieldset>

			<p class="button">
				<a href="lyr.req_payment.html" id="payment_submit" target="#layer_popup" class="sButton large info btn_ajax size_730x800" title="결제하기">결제하기</a>
			</p>

			<fieldset class="etc">
				<h4><span class="icon tip_info"></span> 메시지 충전 및 사용안내</h4>
				<table class="list_table border" summary="메시지 충전 및 사용안내에 관련된 표로써 구분, 차감건수, 발송 형식 순으로 출력됩니다.">
					<caption>메시지 충전 및 사용안내</caption>
					<colgroup>
						<col width="15%">
						<col width="20%">
						<col width="*">
					</colgroup>
					<thead>
					<tr>
						<th>구분</th>
						<th>차감건수</th>
						<th>발송 형식</th>
					</tr>
					</thead>
					<tbody>
					<tr>
						<td>SMS</td>
						<td><strong>1건</strong></td>
						<td>최대 90 byte(한글 45자)까지 문자 전송, 초과될 경우 장문문자로 자동 발송</td>
					</tr>
					<tr>
						<td>LMS</td>
						<td><strong>3건</strong></td>
						<td>최대 2,000 byte(한글 1,000자)까지 문자 전송</td>
					</tr>
					<tr>
						<td>MMS</td>
						<td><strong>6건</strong></td>
						<td>멀티미디어 파일(이미지, 동영상)을 포함한 2,000 byte까지 문자 전송</td>
					</tr>
					</tbody>
				</table>
			</fieldset>

			<div class="info_box last">
				<ul>
					<li>메시지 충전 이후 충전된 금액은 환불되지 않습니다.</li>
					<li>신용카드 결제의 경우 영수증(카드전표)이 발행되며, 세금계산서 대용으로 사용할 수 있습니다.</li>
					<li>실시간계좌이체의 경우 결제와 함께 요청시 결제 대행사에서 현금영수증이 발행됩니다.</li>
				</ul>
			</div>

		</form>
	</div>
	<!-- //subWrap -->

</div>
<!-- //<?=$module?> -->