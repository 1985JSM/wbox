<?
if(!defined('_INPLUS_')) { exit; } 

/* set URI */
$layout_size = 'normal';
$doc_title = '메시지자동발송설정';
?>

<style>
div.sub_auto {position:relative;}
div.sub_auto ul.guide_list {margin-top:10px;}
div.sub_auto ul.guide_list > li {font-size:11px;}

div.sub_auto table.list_table tr td.left {padding-left:2em;text-align:left;}

div.sub_auto table tr td div.write_area {position:relative;left:50%;width:220px;height:180px;margin-left:-110px;border:1px solid #ddd;}
div.sub_auto table tr td div.write_area > textarea.smsbox {overflow:auto;width:190px;height:110px;margin:15px 10px;padding:5px;border:none;line-height:20px;background:transparent;color:#666;resize:none;}
div.sub_auto table tr td div.write_area p.byte {position:absolute;top:150px;left:10px;}
div.sub_auto table tr td div.write_area p.byte > span.length {font-weight:600;color:#2460ce;}
div.sub_auto table tr td div.write_area p.byte > span.limit {color:#3c3c3c;}
div.sub_auto table tr td div.write_area p.byte > span.type {margin-left:5px;padding-left:10px;background:url("/img/manager/bg_line.gif") 0 50% no-repeat;color:#3c3c3c;}
div.sub_auto table tr td div.write_area div.btn_delete {position:absolute;top:145px;right:10px;}
div.sub_auto table tr td div.write_area div.btn_delete > button.trash {display:inline-block;overflow:visible;position:relative;width:25px;height:25px;margin:0;padding:0;border:1px solid #1d4da5;font-size:12px;line-height:21px;background:#2460ce;color:#fff;text-align:center;text-decoration:none !important;vertical-align:middle;white-space:nowrap;cursor:pointer;box-sizing:border-box;}

div.sub_auto table tr td > span.title {display:block;margin-bottom:10px;font-weight:600;font-size:14px;}
div.sub_auto table tr td > span.help {display:block;margin-top:10px;font-size:11px;}
div.sub_auto table tr td ul.set {padding-bottom:20px;border-bottom:1px dashed #ddd;}
div.sub_auto table tr td ul.set > li:first-child {margin:0;}
div.sub_auto table tr td ul.set > li {margin-top:6px;}
div.sub_auto table tr td ul.set > li > input.text {text-align:center;}
div.sub_auto table tr td ul.set.last {border:none;}

div.sub_auto table tr td p.guide {margin:20px 0 0 0;}
</style>

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
				<select name="" class="select" title="">
					<option value="">01012345678</option>
					<option value="">01089742356</option>
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
				<select name="" class="select" title="">
					<option value="">11</option>
					<option value="">12</option>
					<option value="">13</option>
					<option value="">14</option>
				</select>
				시
				<select name="" class="select" title="">
					<option value="">00</option>
					<option value="">05</option>
					<option value="">10</option>
					<option value="">15</option>
				</select>
				분 ~
				<select name="" class="select" title="">
					<option value="">11</option>
					<option value="">12</option>
					<option value="">13</option>
					<option value="">14</option>
				</select>
				시
				<select name="" class="select" title="">
					<option value="">00</option>
					<option value="">05</option>
					<option value="">10</option>
					<option value="">15</option>
				</select>
				분 까지 발송하지 않음								
			</td>
		</tr>
		<tr>
			<th>발송 제한 시간 2</th>
			<td class="left">
				<select name="" class="select" title="">
					<option value="">11</option>
					<option value="">12</option>
					<option value="">13</option>
					<option value="">14</option>
				</select>
				시
				<select name="" class="select" title="">
					<option value="">00</option>
					<option value="">05</option>
					<option value="">10</option>
					<option value="">15</option>
				</select>
				분 ~
				<select name="" class="select" title="">
					<option value="">11</option>
					<option value="">12</option>
					<option value="">13</option>
					<option value="">14</option>
				</select>
				시
				<select name="" class="select" title="">
					<option value="">00</option>
					<option value="">05</option>
					<option value="">10</option>
					<option value="">15</option>
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
		<tr>
			<td>
				<span class="title">신규고객 방문 안내</span>
				신규(최초) 방문(예약) 고객이 시술 완료 후<br />설정된 시간에 자동 메시지가 전송됩니다.<br />(※단, 예약 상태가 "완료"로 변경된 경우 입니다.)
				<span class="help"><img src="/img/manager/ico_tip_notice.png" alt="도움말 아이콘" /> 시술 이용과 별개의 안내메시가 있는 경우 이용합니다.</span>
			</td>			
			<td>				
				<div class="write_area">
					<textarea class="smsbox"></textarea>

					<p class="byte">
						<span class="length">20</span>
						<span class="limit">/ 90byte</span>
						<span class="type">SMS</span>
					</p>

					<div class="btn_delete">
						 <button class="trash"><i class="xi-trash"></i></button>	
					</div>
				</div>
			</td>
			<td>
				<ul class="set">
				<li>
					시술완료
					<input type="text" name="" value="" class="text" size="4" maxlength="10" title="시간" placeholder="" />
					시간 후 자동전송
				</li>				
				</ul>
				<p class="guide primary">※ 1시간 단위로 숫자만 입력<br />※ "0" 입력시 상태변경 즉시 전송</p>
			</td>
			<td><input type="checkbox" id="" title="" /> 사용</td>
			<td>
				{사용자이름}<br />
				{가맹점명}<br />
				{예약:서비스명}<br />
				{예약:예약일시}<br />
				{예약:담당자명}<br />
				{예약:소요시간}<br />
			</td>
		</tr>
		<tr>
			<td>
				<span class="title">기존고객 방문 안내</span>
				2회 이상 방문(예약) 고객이 시술 완료 후<br />설정된 시간에 자동 메시지가 전송됩니다.<br />(※단, 예약 상태가 "완료"로 변경된 경우 입니다.)
				<span class="help"><img src="/img/manager/ico_tip_notice.png" alt="도움말 아이콘" /> 시술 이용과 별개의 안내메시가 있는 경우 이용합니다.</span>
			</td>
			<td>				
				<div class="write_area">
					<textarea class="smsbox"></textarea>

					<p class="byte">
						<span class="length">20</span>
						<span class="limit">/ 90byte</span>
						<span class="type">SMS</span>
					</p>

					<div class="btn_delete">
						 <button class="trash"><i class="xi-trash"></i></button>	
					</div>
				</div>
			</td>			
			<td>
				<ul class="set">
				<li>
					시술완료
					<input type="text" name="" value="" class="text" size="4" maxlength="10" title="시간" placeholder="" />
					시간 후 자동전송
				</li>				
				</ul>
				<p class="guide primary">※ 1시간 단위로 숫자만 입력<br />※ "0" 입력시 상태변경 즉시 전송</p>
			</td>
			<td><input type="checkbox" id="" title="" /> 사용</td>
			<td>
				{사용자이름}<br />
				{가맹점명}<br />
				{예약:서비스명}<br />
				{예약:예약일시}<br />
				{예약:담당자명}<br />
				{예약:소요시간}<br />
			</td>
		</tr>
		<tr>
			<td>
				<span class="title">미방문(예약) 안내</span>
				최종 시술완료 후 장/단시간 방문(예약)이 없을 경우<br />설정된 시간에 자동 메시지가 전송됩니다.<br />(※단, 최종 시술이 "완료"된 상태 기준입니다.)</td>
			<td>				
				<div class="write_area">
					<textarea class="smsbox"></textarea>

					<p class="byte">
						<span class="length">20</span>
						<span class="limit">/ 90byte</span>
						<span class="type">SMS</span>
					</p>

					<div class="btn_delete">
						 <button class="trash"><i class="xi-trash"></i></button>	
					</div>
				</div>
			</td>
			<td>
				<ul class="set">
				<li>
					<input type="checkbox" id="" title="" /> <input type="text" name="" value="" class="text" size="4" maxlength="10" title="일" placeholder="" /> 일 동안 미방문 자동전송
				</li>
				<li>
					<input type="checkbox" id="" title="" /> <input type="text" name="" value="" class="text" size="4" maxlength="10" title="일" placeholder="" /> 일 동안 미방문 자동전송
				</li>
				<li>
					<input type="checkbox" id="" title="" /> <input type="text" name="" value="" class="text" size="4" maxlength="10" title="일" placeholder="" /> 일 동안 미방문 자동전송
				</li>				
				</ul>
				<p class="guide primary">※ 1일 단위로 숫자만 입력</p>
			</td>
			<td><input type="checkbox" id="" title="" /> 사용</td>
			<td>
				{사용자이름}<br />
				{가맹점명}
			</td>
		</tr>
		<tr>
			<td>
				<span class="title">생일 안내</span>
				가맹점 관리고객 생일자에게 설정된 시간에<br />자동 메시지가 전송됩니다.<br />(※단, 생일 정보가 있는 고객의 경우 입니다.)</td>
			<td>				
				<div class="write_area">
					<textarea class="smsbox"></textarea>

					<p class="byte">
						<span class="length">20</span>
						<span class="limit">/ 90byte</span>
						<span class="type">SMS</span>
					</p>

					<div class="btn_delete">
						 <button class="trash"><i class="xi-trash"></i></button>	
					</div>
				</div>
			</td>
			<td>
				<ul class="set">				
				<li>
					생일
					<select name="" class="select" title="">
						<option value="">당일</option>
						<option value="">전일</option>
					</select>
					자동전송
				</li>
				<li>
					전송 예약시간
					<select name="" class="select" title="">
						<option value="">11</option>
						<option value="">12</option>
						<option value="">13</option>
						<option value="">14</option>
					</select>
					시
					<select name="" class="select" title="">
						<option value="">00</option>
						<option value="">05</option>
						<option value="">10</option>
						<option value="">15</option>
					</select>
					분
				</li>
				</ul>
				<p class="guide primary">※ 발송 제한 시간 설정이 적용안됨</p>
			</td>
			<td><input type="checkbox" id="" title="" /> 사용</td>
			<td>
				{사용자이름}<br />
				{가맹점명}
			</td>
		</tr>
		<tr>
			<td>
				<span class="title">이벤트 안내</span>
				신규(최초) 방문(예약) 후 1년 감사/이벤트 메시지가<br />설정된 시간에 자동 전송됩니다.<br />(※단, 첫 예약 상태가 "완료"일로부터 1년째 되는날의 기준입니다.)</td>
			<td>				
				<div class="write_area">
					<textarea class="smsbox"></textarea>

					<p class="byte">
						<span class="length">20</span>
						<span class="limit">/ 90byte</span>
						<span class="type">SMS</span>
					</p>

					<div class="btn_delete">
						 <button class="trash"><i class="xi-trash"></i></button>	
					</div>
				</div>
			</td>
			<td>
				<ul class="set">				
				<li>
					첫 방문 후
					<input type="text" name="" value="" class="text" size="4" maxlength="10" title="시간" placeholder="365" />
					일째
				</li>				
				</ul>
				<p class="guide primary">※ 1일 단위로 숫자만 입력</p>
			</td>
			<td><input type="checkbox" id="" title="" /> 사용</td>
			<td>
				{사용자이름}<br />
				{가맹점명}
			</td>
		</tr>
		<tr>
			<td>
				<span class="title">예약 시술 전 예약 안내</span>
				노쇼 방지를 위해 예약완료 고객에게 설정된 시간에<br />자동 메시지가 전송됩니다.<br />(※단, 담당자가 예약승인을 완료한<br />고객의 경우 입니다.)</td>
			<td>				
				<div class="write_area">
					<textarea class="smsbox"></textarea>

					<p class="byte">
						<span class="length">20</span>
						<span class="limit">/ 90byte</span>
						<span class="type">SMS</span>
					</p>

					<div class="btn_delete">
						 <button class="trash"><i class="xi-trash"></i></button>	
					</div>
				</div>
			</td>
			<td>
				<ul class="set last">				
				<li>
					<input type="checkbox" id="" title="" /> 담당자 예약 승인 즉시 전송
				</li>
				<li>
					<input type="checkbox" id="" title="" /> 예약일 하루전 예약시간 전송
				</li>				
				<li>
					<input type="checkbox" id="" title="" /> 예약 1시간전 전송
				</li>
				</ul>
			</td>
			<td><input type="checkbox" id="" title="" /> 사용</td>
			<td>
				{사용자이름}<br />
				{가맹점명}<br />
				{예약:서비스명}<br />
				{예약:예약일시}<br />
				{예약:담당자명}<br />
				{예약:소요시간}<br />
			</td>
		</tr>
		</tbody>
		</table>
		</fieldset>


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
		<tr>
			<td>
				<span class="title">선불제 구매 안내</span>
				선불제를 구입한 경우 구매 상세내역을<br />자동으로 설정된 시간에 메시지가 전송됩니다.<br />(※단, 선불제 신규등록 고객의 경우 입니다.)
				<span class="help"><img src="/img/manager/ico_tip_notice.png" alt="도움말 아이콘" /> 고객의 선불제 구매 유형에 따라 메시지가 전송됩니다.</span>	
			</td>
			<td>				
				<div class="write_area">
					<textarea class="smsbox">사랑합니다. {NAME}님! {가맹점명}입니다. {가맹점명} 선불제 구입에 감사드리며, 상세 구입내역을 알려드립니다. - 선불제유형: {선불제유형} - 전체: { 총 사용유형} - 사용: {사용한 사용유형} - 잔여: {잔여 사용유형} - 사용기간: {사용기간} 감사합니다. ^^</textarea>

					<p class="byte">
						<span class="length">20</span>
						<span class="limit">/ 90byte</span>
						<span class="type">SMS</span>
					</p>

					<div class="btn_delete">
						 <button class="trash"><i class="xi-trash"></i></button>	
					</div>
				</div>
			</td>
			<td>
				<ul class="set">				
				<li>
					등록 후
					<input type="text" name="" value="" class="text" size="4" maxlength="10" title="시간" placeholder="" />
					시간 후 자동전송
				</li>				
				</ul>
				<p class="guide primary">※ 1시간 단위로 숫자만 입력<br />※ "0" 입력시 등록 후 즉시 전송</p>
			</td>
			<td><input type="checkbox" id="" title="" /> 사용</td>
			<td>
				{사용자이름}<br />
				{가맹점명}<br />
				{선불제:선불제유형}<br />
				{선불제:전체}<br />
				{선불제:사용}<br />
				{선불제:잔여}<br />
				{선불제:사용기간}
			</td>
		</tr>
		<tr>
			<td>
				<span class="title">선불제 사용 안내</span>
				선불제를 구입한 고객이 사용할때 마다 잔여량을<br />자동으로 설정된 시간에 자동 메시지가 전송됩니다.<br />(※단, 선불제 구입 및 결제정보 입력의 경우 입니다.)
				<span class="help"><img src="/img/manager/ico_tip_notice.png" alt="도움말 아이콘" /> 고객의 선불제 사용 유형에 따라 메시지가 전송됩니다.</span>
			</td>
			<td>				
				<div class="write_area">
					<textarea class="smsbox">사랑합니다. {NAME}님! {가맹점명}입니다. {가맹점명} 선불제 이용내역을 알려드립니다. - {선불제유형}:{사용유형}을 이용하셨습니다. 사용후 남은 선불제 내역입니다. - 전체: {총 사용유형} - 사용: {사용한 사용유형} - 잔여: {잔여 사용유형} - 사용기간: {사용기간} 감사합니다. ^^</textarea>

					<p class="byte">
						<span class="length">20</span>
						<span class="limit">/ 90byte</span>
						<span class="type">SMS</span>
					</p>

					<div class="btn_delete">
						 <button class="trash"><i class="xi-trash"></i></button>	
					</div>
				</div>
			</td>
			<td>
				<ul class="set">				
				<li>
					선불제 사용
					<input type="text" name="" value="" class="text" size="4" maxlength="10" title="시간" placeholder="" />
					시간 후 자동전송
				</li>				
				</ul>
				<p class="guide primary">※ 1시간 단위로 숫자만 입력<br />※ "0" 입력시 상태변경 즉시 전송</p>
			</td>
			<td><input type="checkbox" id="" title="" /> 사용</td>
			<td>
				{사용자이름}<br />
				{가맹점명}<br />
				{선불제:선불제유형}<br />
				{선불제:전체}<br />
				{선불제:사용}<br />
				{선불제:잔여}<br />
				{선불제:사용기간}
			</td>
		</tr>
		<tr>
			<td>
				<span class="title">시술 이용 완료 안내</span>
				시술완료 후 고객에게 시술내역 메시지가<br />설정된 시간에 자동 전송됩니다.<br />(※단, 예약 상태가 "완료"로 변경된 경우 입니다.)
				<span class="help"><img src="/img/manager/ico_tip_notice.png" alt="도움말 아이콘" /> 고객 이용내역에 따라 메시지가 전송됩니다.</span>
			</td>
			<td>				
				<div class="write_area">
					<textarea class="smsbox">사랑합니다. {NAME}님! {가맹점명}입니다. {가맹점명} 시술 이용내역을 알려드립니다. - 예약일자: {예약일시}- 서비스명: {서비스명}- 담당자: {담당자명} - 소요시간: {소요시간} - 금액: {시술금액} - 할인: {일반할인}원 - 쿠폰: {쿠폰명}/{쿠폰할인금액}원 - 실제 결제금액: {매출액} 감사합니다. ^^</textarea>

					<p class="byte">
						<span class="length">20</span>
						<span class="limit">/ 90byte</span>
						<span class="type">SMS</span>
					</p>

					<div class="btn_delete">
						 <button class="trash"><i class="xi-trash"></i></button>	
					</div>
				</div>
			</td>
			<td>
				<ul class="set">				
				<li>
					시술완료
					<input type="text" name="" value="" class="text" size="4" maxlength="10" title="시간" placeholder="" />
					시간 후 자동전송
				</li>				
				</ul>
				<p class="guide primary">※ 1시간 단위로 숫자만 입력<br />※ "0" 입력시 상태변경 즉시 전송</p>
			</td>
			<td><input type="checkbox" id="" title="" /> 사용</td>
			<td>
				{사용자이름}<br />
				{가맹점명}<br />
				{예약:서비스명}<br />
				{예약:예약일시}<br />
				{예약:담당자명}<br />
				{예약:소요시간}<br />
				{예약:일반할인}<br />
				{예약:쿠폰명}<br />
				{예약:쿠폰할인금액}<br />
				{예약:실제결제금액}
			</td>
		</tr>
		</tbody>
		</table>
		</fieldset>

		<p class="button">
			<button type="button" class="sButton large info">변경</button>
		</p>
		
	</div>
	<!-- //subWrap -->	
	
</div>
<!-- //<?=$module?> -->

<!-- layer popup -->
<div id="layer_back"></div>

<!-- 치환코드 안내 -->
<div id="layer_popup" style="width:480px;height:500px;margin:-150px 0 0 -240px;">
	<div id="layer_header">
		<h1>치환코드 안내</h1>
		<button type="button" onclick="closeLayerPopup()" title="닫기"><img src="http://wbox.inplus21.com/layout/manager/img/common/btn_close_layer.gif" alt="Close" /></button>
	</div>

	<div id="layer_content" style="height:400px;">
		<div class="info_box">
			<h4><span class="icon tip_info"></span> 치환코드 표기 예시</h4>
			<ul>
			<li>- 일자 : 2016년09월26일</li>
			<li>- 시간 : 15:00:00</li>
			<li>- 금액 : 15,000원</li>
			</ul>
		</div>

		<ul class="code">
		<li><strong>{NAME}</strong> 고객명</li>
		<li><strong>{COMPANY}</strong> 가맹점명</li>
		<li><strong>{}</strong> 시술일자</li>
		<li><strong>{}</strong> 선불제유형</li>
		<li><strong>{}</strong> 총 사용유형</li>
		<li><strong>{}</strong> 사용한 사용유형</li>
		<li><strong>{}</strong> 잔여 사용유형</li>
		<li><strong>{}</strong> 사용기간</li>
		<li><strong>{}</strong> 사용유형</li>
		<li><strong>{}</strong> 예약일시</li>
		<li><strong>{}</strong> 서비스명</li>
		<li><strong>{}</strong> 담당자명</li>
		<li><strong>{}</strong> 소요시간</li>
		<li><strong>{}</strong> 시술금액</li>
		<li><strong>{}</strong> 일반할인</li>
		<li><strong>{}</strong> 쿠폰명</li>
		<li><strong>{}</strong> 쿠폰할인금액</li>
		<li><strong>{}</strong> 매출액</li>
		</ul>					
	</div>	
</div>
<!-- //치환코드 안내 -->