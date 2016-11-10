<?
if(!defined('_INPLUS_')) { exit; } 

/* set URI */
$layout_size = 'small';
$doc_title = '알림문자수신설정';
?>

<style>
label > input {margin:-2px 5px 0 0;vertical-align:middle;}

div.sub_member fieldset table.list_table tr td ul li:first-child {margin:0;}
div.sub_member fieldset table.list_table tr td ul li {margin-top:8px;}
</style>

<!-- <?=$module?> -->
<div id="<?=$module?>">

	<!-- subWrap -->
	<div class="subWrap sub_member write">
		<div class="info_box">
			<h4><span class="icon tip_info"></span> 도움말</h4>
			메시지 관련 알림문자 사용여부를 설정 및 변경할 수 있습니다.
		</div>
		
		<form>
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
				<label><input type="radio" name="" class="" value="" checked="checked" title="사용">사용</label>
				<label><input type="radio" name="" class="" value="" title="미사용">미사용</label>
			</td>
		</tr>
		<tr>
			<th scope="row">발신 번호</th>
			<td><strong>01066552885</strong></td>
		</tr>
		<tr>
			<th scope="row">수신 번호</th>
			<td>
				<input type="text" name="" value="" class="text" size="15" maxlength="15" title="휴대폰번호" placeholder="휴대폰번호">
				<input type="text" name="" value="" class="text" size="15" maxlength="15" title="휴대폰번호" placeholder="휴대폰번호">
				<input type="text" name="" value="" class="text" size="15" maxlength="15" title="휴대폰번호" placeholder="휴대폰번호">
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
			<td><input type="checkbox" id="" title=""></td>
			<td>
				<ul>
				<li>
					충전 건수가
					<select name="" class="select" title="">
						<option value="">10,000</option>
						<option value="">15,000</option>
					</select>
					건 이하일 때 알림
				</li>
				<li>
					알림 시간
					<select name="" class="select" title="">
						<option value="">14:00</option>
						<option value="">15:00</option>
					</select>
				</li>
				</ul>
			</td>
			<td>"<strong>가맹정명</strong>"님의 메시지 충전 건수가 "<strong class="primary">10,000</strong>"건 남았습니다.</td>
		</tr>
		<tr>
			<td><input type="checkbox" id="" title=""></td>
			<td>예약이 접수된 경우 담당자에게 푸시 메시지와 함께 SMS문자 메시지를 전송합니다.</td>
			<td>푸시 메시지와 동일</td>
		</tr>
		<tr>
			<td><input type="checkbox" id="" title=""></td>
			<td>담당자 예약 승인한 경우 고객에게 푸시 메시지와 함께 SMS문자 메시지를 전송합니다.</td>
			<td>푸시 메시지와 동일</td>
		</tr>
		<tr>
			<td><input type="checkbox" id="" title=""></td>
			<td>예약시간이 도래할 경우 고객에게 푸시 메시지와 함께 SMS문자 메시지를 전송합니다.</td>
			<td>푸시 메시지와 동일</td>
		</tr>
		</tbody>
		</table>
		</fieldset>

		<p class="button">
			<button type="button" class="sButton large info">변경</button>
		</p>
		</form>

	</div>
	<!-- //subWrap -->	
	
</div>
<!-- //<?=$module?> -->