<?
if(!defined('_INPLUS_')) { exit; }

/* set URI */
$layout_size = 'tiny';
$doc_title = '메시지충전';

?>

<style>
	div.sub_result p.guide_txt {margin-bottom:20px;font-weight:600;font-size:18px;line-height:30px;color:#3c3c3c;}
	div.sub_result p.button {margin:30px 0 60px 0;}
</style>

<!-- <?=$module?> -->
<div id="<?=$module?>">

	<!-- subWrap -->
	<div class="subWrap sub_result write">
		<p class="guide_txt"><strong class="info"><i class="xi-comment xi-x"></i> 예약박스</strong>에서 메시지 충전하신 내역입니다.</p>

		<h4>고객정보</h4>
		<table class="write_table" summary="고객정보에 관련된 표로써 고객명, 휴대폰, 이메일 등 순으로 출력됩니다.">
			<caption>고객정보</caption>
			<colgroup>
				<col width="25%">
				<col width="*">
			</colgroup>
			<tbody>
			<tr>
				<th>고객명</th>
				<td class="left"><?=$_POST['pa_buyer_name']?></td>
			</tr>
			<tr>
				<th>휴대폰</th>
				<td class="left"><?=$_POST['pa_buyer_tel']?></td>
			</tr>
			<tr>
				<th>이메일</th>
				<td class="left"><?=$_POST['pa_buyer_email']?></td>
			</tr>
			</tbody>
		</table>

		<fieldset class="etc">
			<h4>결제정보</h4>
			<table class="write_table" summary="결제정보에 관련된 표로써 결제번호, 결제일시, 결제수단, 충전건수, 결제금액 등 순으로 출력됩니다.">
				<caption>결제정보</caption>
				<colgroup>
					<col width="25%">
					<col width="*">
				</colgroup>
				<tbody>
				<tr>
					<th>결제번호</th>
					<td><?=$_POST['pa_pg_tid']?></td>
				</tr>
				<tr>
					<th>결제일시</th>
					<td><?=$_POST['upt_time']?></td>
				</tr>
				<tr>
					<th>결제수단</th>
					<td><?if($_POST['pa_type']=='C'){?>신용카드<?}else if($_POST['pa_type']=='V'){?>계좌이체<?}?></td>
				</tr>
				<tr>
					<th>충전건수</th>
					<td><?=$_POST['pa_subject']?></td>
				</tr>
				<tr>
					<th>결제금액</th>
					<td><strong class="primary"><?=number_format($_POST['pa_price'])?> 원</strong></td>
				</tr>
				</tbody>
			</table>
		</fieldset>

		<p class="button">
			<a href="./sms_send.html" class="sButton large info">메시지전송</a>
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
	</div>
	<!-- //subWrap -->

</div>
<!-- //<?=$module?> -->