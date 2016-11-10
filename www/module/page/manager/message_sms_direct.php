<?
if(!defined('_INPLUS_')) { exit; } 

/* set URI */
$layout_size = 'small';
$doc_title = 'SMS/LMS 전송';
?>

<style>
div.sub_send {}

div.send_area {margin-top:60px;}
div.send_area:after {display:block;content:'';clear:both;} 
div.send_area > div.con_left {float:left;width:300px;}
div.send_area > div.con_left > div.box {display:block;position:relative;padding:15px 20px;border:1px solid #ddd;border-radius:2px;}
div.send_area > div.con_left > div.box > ul {}
div.send_area > div.con_left > div.box > ul > li {padding-left:10px;font-weight:600;line-height:20px;background:url("/img/manager/bl_dot.gif") 0 8px no-repeat;color:#333;}
div.send_area > div.con_left > div.box > ul > li > span {position:absolute;right:70px;color:#ff0000;}
div.send_area > div.con_left > div.box > table.list_table {margin-top:5px;border-top:1px solid #d2d2d2;}
div.send_area > div.con_left > div.box > div.btn_charge {position:absolute;top:15px;right:20px;}

div.send_area > div.con_left > div.phone {display:block;position:relative;margin-top:20px;background:url("/img/manager/bg_phone.png") 0 0 no-repeat;}
div.send_area > div.con_left > div.phone > div.write_area {padding:42px 22px 0 17px;}
div.send_area > div.con_left > div.phone > div.write_area > textarea.smsbox {overflow:auto;width:200px;height:200px;margin:20px;padding:10px;border:none;line-height:20px;background:transparent;color:#666;resize:none;}
div.send_area > div.con_left > div.phone > p.byte {margin:5px 0 0 40px;}
div.send_area > div.con_left > div.phone > p.byte > span.length {font-weight:600;color:#2460ce;}
div.send_area > div.con_left > div.phone > p.byte > span.limit {color:#333;}
div.send_area > div.con_left > div.phone > p.byte > span.type {margin-left:5px;padding-left:10px;background:url("/img/manager/bg_line.gif") 0 50% no-repeat;color:#333;}
div.send_area > div.con_left > div.phone > div.btn_delete {position:absolute;top:302px;right:42px;}
div.send_area > div.con_left > div.phone > div.btn_delete > button.trash {display:inline-block;overflow:visible;position:relative;width:25px;height:25px;margin:0;padding:0;border:1px solid #1d4da5;font-size:12px;line-height:21px;background:#2460ce;color:#fff;text-align:center;text-decoration:none !important;vertical-align:middle;white-space:nowrap;cursor:pointer;box-sizing:border-box;}
div.send_area > div.con_left > div.phone > p.change_info {margin:30px 0 0 18px;}
div.send_area > div.con_left > div.phone > div.btn_sms {padding:12px 0 25px 17px;}
div.send_area > div.con_left > div.phone > div.btn_mms {padding:36px 0 46px 17px;}

div.send_area > div.con_left > div.message_info {position:relative;margin-top:30px;}
div.send_area > div.con_left > div.message_info > ul {}
div.send_area > div.con_left > div.message_info > ul:after {display:block;content:'';clear:both;} 
div.send_area > div.con_left > div.message_info > ul > li {float:left;margin-left:4px;}
div.send_area > div.con_left > div.message_info > ul > li:first-child {margin:0;}
div.send_area > div.con_left > div.message_info > ul > li > button.name {display:inline-block;overflow:visible;position:relative;width:95px;height:25px;margin:0;padding:0;border:1px solid #ddd;font-size:12px;line-height:21px;background:#f5f5f5;color:#333;text-align:center;text-decoration:none !important;vertical-align:middle;white-space:nowrap;cursor:pointer;box-sizing:border-box;}
div.send_area > div.con_left > div.message_info > ul > li > button.question {display:inline-block;overflow:visible;position:relative;width:25px;height:25px;margin:0;padding:0;border:1px solid #e7b800;font-size:12px;line-height:21px;background:#feca00;color:#333;text-align:center;text-decoration:none !important;vertical-align:top;white-space:nowrap;cursor:pointer;box-sizing:border-box;}
div.send_area > div.con_left > div.message_info > ul > li > button.question > i {font-weight:600;}
div.send_area > div.con_left > div.message_info > ul > li > p.btn_area {display:inline-block;width:150px;height:25px;padding-top:1px;border:1px solid #ddd;line-height:22px;background:#f5f5f5;color:#333;box-sizing:border-box;}
div.send_area > div.con_left > div.message_info > ul > li > p.btn_area > input {margin-bottom:5px;}
div.send_area > div.con_left > div.message_info > ul > li > p.btn_area > label {margin:0;}
div.send_area > div.con_left > div.message_info > ul > li > span {position:absolute;top:1px;}
div.send_area > div.con_left > div.message_info > ul > li:first-child > span {position:relative;top:0;}
div.send_area > div.con_left > div.message_info > p {padding:20px 0;border-bottom:1px solid #ddd;line-height:16px;}
div.send_area > div.con_left > div.message_info > p > strong {font-weight:600;color:#333;}

div.send_area > div.con_left > div.caller_id {display:block;width:300px;height:43px;margin-top:20px;padding:5px;border-top:1px solid #ddd;border-right:1px solid #999;border-bottom:1px solid #999;border-left:1px solid #ddd;background:#f5f5f5;box-sizing:border-box;}
div.send_area > div.con_left > div.caller_id > span.caller {padding:0 10px 0 5px;font-weight:600;color:#333;vertical-align:middle;}
div.send_area > div.con_left > div.caller_id > select {width:116px;}

div.send_area > div.con_right {margin-left:330px;}
div.send_area > div.con_right > ul {}
div.send_area > div.con_right > ul > li {padding-left:10px;line-height:20px;background:url("/img/manager/bl_dot.gif") 0 50% no-repeat;}
div.send_area > div.con_right > ul > li > strong {color:#ff0000;}

div.send_area > div.con_right table.write_table {position:relative;margin-top:20px;}
div.send_area > div.con_right table.write_table tr th, div.send_area > div.con_right table.write_table tr td {padding:1em 10px;}
div.send_area > div.con_right table.write_table tr td div.recipient {margin-top:5px;}
div.send_area > div.con_right table.write_table tr td ul.receive_list {display:block;overflow-y:scroll;margin-top:10px;padding:10px 20px;width:318px;height:100px;border:1px solid #d8d8d8;}
div.send_area > div.con_right table.write_table tr td ul.receive_list li {position:relative;line-height:20px;}
div.send_area > div.con_right table.write_table tr td ul.receive_list li span.name {display:inline-block;width:110px;line-height:16px;}
div.send_area > div.con_right table.write_table tr td ul.receive_list li span.num {vertical-align:top;}
div.send_area > div.con_right table.write_table tr td ul.receive_list li button {display:inline-block;overflow:visible;position:absolute;top:5px;right:20px;width:10px;height:10px;margin:0;padding:0;border:none;font-size:12px;line-height:10px;background:#fff;color:#666;text-align:center;text-decoration:none !important;vertical-align:middle;white-space:nowrap;cursor:pointer;box-sizing:border-box;}
div.send_area > div.con_right table.write_table tr td p.total {margin:20px 0;}
div.send_area > div.con_right table.write_table tr td p.total strong {font-weight:600;color:#2460ce;}
div.send_area > div.con_right table.write_table tr td div.btn_total {position:absolute;top:195px;right:165px;}
div.send_area > div.con_right table.write_table tr td div.reservation {margin:15px 0 5px 0;}
div.send_area > div.con_right table.write_table tr td p.test {margin-top:10px;padding-left:10px;line-height:20px;background:url("/img/manager/bl_dot.gif") 0 50% no-repeat;}
div.send_area > div.con_right table.write_table tr td div.btn_test {margin:10px 0 20px 0;text-align:right;}

div.send_area > div.con_right table.write_table tr td table.list_table {margin-top:10px;border-top:1px solid #d2d2d2;}
div.send_area > div.con_right table.write_table tr td table.list_table tr th {padding:10px;border-right:0;text-align:center}
div.send_area > div.con_right table.write_table tr td table.list_table tr td {padding:8px 10px;text-align:center}

div.send_area > div.con_right table.write_table tr td table.write_table {margin:0;border-top:1px solid #d2d2d2;}
div.send_area > div.con_right table.write_table tr td table.write_table tr th, div.send_area > div.con_right table.write_table tr td table.write_table tr td {padding:1em 10px;}
div.send_area > div.con_right table.write_table tr td table.write_table tr td p {margin-top:5px;font-size:11px;}
div.send_area > div.con_right table.write_table tr td table.write_table tr td p > span.receiveTotal, 
div.send_area > div.con_right table.write_table tr td table.write_table tr td p > span.rejectCount {font-weight:600;}

div.send_area > div.con_right table.write_table label {margin-right:5px;}
div.send_area > div.con_right table.write_table input {margin: -2px 4px 0 2px;}
div.send_area > div.con_right table.write_table input.checkbox {margin:-2px 0 0 0;}
div.send_area > div.con_right table.write_table input.text {margin:0;text-align:center;}

div.send_area > div.con_right div.btn_transmit {margin-top:30px;text-align:center;}

/* 메시지 전송 버튼 */
span.btn_set a, span.btn_set button, span.btn_set input {display:inline-block;overflow:visible;position:relative;width:90px;height:30px;margin:0;padding:0;border:1px solid #7584a3;font-size:12px;line-height:30px;background:#5c6b8b;color:#fff;text-align:center;text-decoration:none !important;vertical-align:middle;white-space:nowrap;cursor:pointer;box-sizing:border-box;}

span.btn_set.sms a, span.btn_set.sms button, span.btn_set.sms input {width:86px;}
span.btn_set.mms a, span.btn_set.mms button, span.btn_set.mms input {width:65px;}

span.btn_set > .center {border-right:none;border-left:none;}
span.btn_set > .center2 {border-right:none;}
</style>

<!-- <?=$module?> -->
<div id="<?=$module?>">

	<!-- subWrap -->
	<div class="subWrap sub_send">
		<div class="info_box">
			<h4><span class="icon tip_info"></span> 도움말</h4>
			한글 1자/2byte, 영문 1자/1byte의 SMS, LMS 메시지를 전송할 수 있습니다.
		</div>

		<form>
		<!-- send_area -->
		<div class="send_area">
			<!-- con_left -->
			<div class="con_left">
				<!-- box -->
				<div class="box">
					<ul>
					<li>잔여 충전 건수 <span>20,000건수</span></li>
					<li>차감 예정 건수 <span>200건수</span></li>
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
						<td>20</td>
						<td>40</td>
						<td>-</td>
					</tr>								
					</tbody>
					</table>

					<div class="btn_charge">
						<a href="payment_buy.html" class="sButton tiny info">충전</a>
					</div>
				</div>
				<!-- //box -->
				
				<!-- phone -->
				<div class="phone">
					<div class="write_area">
						<textarea class="smsbox"></textarea>
					</div>

					<p class="byte">
						<span class="length">20</span>
						<span class="limit">/ 90byte</span>
						<span class="type">SMS</span>
					</p>

					<div class="btn_delete">
						 <button class="trash"><i class="xi-trash"></i></button>	
					</div>

					<p class="change_info">90byte 초과시 자동 LMS로 전환됩니다.</p>	

					<div class="btn_sms">
						<span class="btn_set sms"><a href="./ajax.char_figure.html" class="active btn_ajax size_480x300" target="#layer_popup" title="특수문자">특수문자</a></span><span class="btn_set sms"><a href="../box/ajax.list.html" class="active center btn_ajax size_780x640" target="#layer_popup" title="메시지 저장함">메시지함</a></span><span class="btn_set sms"><a href="./ajax.short_url.html" class="active btn_ajax size_480x400" target="#layer_popup" title="짧은 URL">짧은주소</a></span>
					</div>	
				</div>
				<!-- //phone -->

				<!-- message_info -->
				<div class="message_info">
					<ul>
					<li><button class="name">{이름} 자동삽입</button><button class="question"><i class="xi-help-o xi-x"></i></button></li>
					<li><p class="btn_area"><input type="checkbox" id=""><label for="">080수신거부 사용하기</label></p><button class="question"><i class="xi-help-o xi-x"></i></button></li>
					</ul>
					<!-- 이름자동삽입-->
					<p class="name">
						<strong>{이름} 자동삽입이란?</strong><br />
						주소록에 등록된 수신자 개별 이름으로 발송할 수 있는 기능
					</p>
					<!-- //이름자동삽입-->
					<!-- 080수신거부사용-->
					<!--p class="quiesce">
						광고성 문자 전송 시에는 (광고), 매장명, 무료수신거부를 반드시표기해야하며, 미준수시 최소 300 ~ 3,000만원 벌금 부과 *080수신거부 체크시 자동추가되며, 서비스 요금이 적용됩니다.
					</p-->
					<!-- //080수신거부사용-->
				</div>
				<!-- //message_info -->
				
				<!-- caller_id -->
				<div class="caller_id"> 
					<span class="caller">발신번호</span>
					<select name="" class="select" title="">
						<option value="">01066552885</option>
						<option value="">01011112222</option>
					</select>
					<button type="button" class="sButton small info">발신번호관리</button>
				</div>
				<!-- //caller_id -->
			</div>
			<!-- //con_left -->

			<!-- con_right -->
			<div class="con_right">
				<!-- tab -->
				<div class="tab_area">
					<ul>
					<li><a href="message_sms_direct.html" class="on">직접입력</a></li>
					<li><a href="message_sms_member.html">고객선택</a></li>
					</ul>
				</div>
				<!-- //tab -->

				<ul>
				<li>최대 O만 건까지 입력할 수 있습니다.</li>
				<li>직접 입력하실 경우 <strong>이름 자동삽입</strong> 기능이 지원되지 않습니다.</li>
				</ul>
				
				<table class="write_table" summary="직접입력에 관련된 표로써 수신번호입력, 중복번호제거, 전송시각, 테스트전송 등 순으로 출력됩니다.">
				<caption>직접입력</caption>
				<colgroup>
				<col width="20%">
				<col width="*">
				</colgroup>
				<tbody>
				<tr>
					<th scope="row">수신번호입력</th>
					<td>
						<div class="recipient">
							<input type="text" name="" value="" class="text" size="10" maxlength="15" title="이름" placeholder="이름" /> <input type="text" name="" value="" class="text" size="20" maxlength="15" title="휴대폰번호" placeholder="휴대폰번호" /> <button type="button" class="sButton small info">추가</button>
						</div>
						
						<ul class="receive_list">
						<li>
							<span class="name">정예슬</span>
							<span class="num">01040670780</span>
							<button><i class="xi-close"></i></button>
						</li>
						<li>
							<span class="name">이창걸</span>
							<span class="num">01040670780</span>
							<button><i class="xi-close"></i></button>
						</li>
						<li>
							<span class="name">김은지</span>
							<span class="num">01040670780</span>
							<button><i class="xi-close"></i></button>
						</li>
						<li>
							<span class="name">이름을 길게 입력한 경우</span>
							<span class="num">01040670780</span>
							<button><i class="xi-close"></i></button>
						</li>
						<li>
							<span class="name">이창걸</span>
							<span class="num">01040670780</span>
							<button><i class="xi-close"></i></button>
						</li>
						<li>
							<span class="name">김은지</span>
							<span class="num">01040670780</span>
							<button><i class="xi-close"></i></button>
						</li>
						</ul>

						<p class="total">총 <strong>28</strong>명</p>

						<div class="btn_total">
							<button type="button" class="sButton small">전체삭제</button>
						</div>
					</td>
				</tr>
				<tr>
					<th scope="row">중복번호제거</th>
					<td>
						<label><input type="radio" name="" class="" value="" checked="checked" title="사용">사용</label>
						<label><input type="radio" name="" class="" value="" title="미사용">미사용</label>
					</td>
				</tr>
				<tr>
					<th scope="row">전송시각</th>
					<td>									
						<label><input type="radio" name="" class="" value="" checked="checked" title="즉시전송">즉시전송</label>
						<label><input type="radio" name="" class="" value="" title="예약전송">예약전송</label>
						
						<!-- 예약전송 선택시 출력 -->
						<input type="text" name="" id="" value="" class="text date" size="10" maxlength="10" title="전송일" />
						
						<select name="" class="select" title="">
							<option value="">12</option>
							<option value="">13</option>
						</select>
						시
						<select name="" class="select" title="">
							<option value="">00</option>
							<option value="">05</option>
						</select>
						분
						<!-- //예약전송 선택시 출력 -->
					</td>
				</tr>
				<tr>
					<th scope="row">테스트전송</th>
					<td>
						<label><input type="radio" name="" class="" value="" checked="checked" title="사용">사용</label>
						<label><input type="radio" name="" class="" value="" title="미사용">미사용</label>								

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
							<td><input type="text" name="" value="" class="text" size="15" maxlength="15" title="이름" placeholder="이름" /></td>
							<td><input type="text" name="" value="" class="text" size="25" maxlength="15" title="휴대폰번호" placeholder="휴대폰번호" /></td>
						</tr>								
						</tbody>
						</table>

						<p class="test">테스트 전송은 정상 과금됩니다.</p>

						<div class="btn_test">
							<a href="#" class="sButton small info">테스트 전송</a>
						</div>
					</td>
				</tr>
				</tbody>
				</table>

				<div class="btn_transmit">
					<a href="#" class="sButton large info">전송하기</a>
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

<!-- layer popup -->
<div id="layer_back" style="display:block;"></div>

<!-- 특수문자 -->
<!-- 도형 -->
<div id="layer_popup" style="width:480px;height:270px;margin:-150px 0 0 -240px;">
	<div id="layer_header">
		<h1>특수문자</h1>
		<button type="button" onclick="closeLayerPopup()" title="닫기"><img src="http://wbox.inplus21.com/layout/manager/img/common/btn_close_layer.gif" alt="Close" /></button>
	</div>

	<div id="layer_content" style="height:170px;">		
		<!-- tab -->
		<div class="layerTab">
			<ul>
			<li><span>도형</span></li>
			<li><a href="">사랑</a></li>
			<li><a href="">웃음</a></li>
			<li><a href="">슬픔</a></li>
			<li><a href="">기타</a></li>
			</ul>
		</div>
		<!-- //tab -->
		
		<div class="charWrap figure">
			<a href=""><abbr title="㈜">㈜</abbr></a>						
			<a href=""><abbr title="㉿">㉿</abbr></a>						
			<a href=""><abbr title="♬">♬</abbr></a>						
			<a href=""><abbr title="♩">♩</abbr></a>						
			<a href=""><abbr title="♭">♭</abbr></a>						
			<a href=""><abbr title="♪">♪</abbr></a>						
			<a href=""><abbr title="☞">☞</abbr></a>						
			<a href=""><abbr title="☜">☜</abbr></a>						
			<a href=""><abbr title="♨">♨</abbr></a>						
			<a href=""><abbr title="∴">∴</abbr></a>						
			<a href=""><abbr title="∼">∼</abbr></a>						
			<a href=""><abbr title="※">※</abbr></a>						
			<a href=""><abbr title="☎">☎</abbr></a>						
			<a href=""><abbr title="☏">☏</abbr></a>						
			<a href=""><abbr title="▼">▼</abbr></a>						
			<a href=""><abbr title="▽">▽</abbr></a>						
			<a href=""><abbr title="▲">▲</abbr></a>						
			<a href=""><abbr title="△">△</abbr></a>						
			<a href=""><abbr title="◀">◀</abbr></a>						
			<a href=""><abbr title="◁">◁</abbr></a>						
			<a href=""><abbr title="▶">▶</abbr></a>						
			<a href=""><abbr title="▷">▷</abbr></a>						
			<a href=""><abbr title="■">■</abbr></a>						
			<a href=""><abbr title="□">□</abbr></a>						
			<a href=""><abbr title="●">●</abbr></a>						
			<a href=""><abbr title="○">○</abbr></a>						
			<a href=""><abbr title="♠">♠</abbr></a>						
			<a href=""><abbr title="♤">♤</abbr></a>						
			<a href=""><abbr title="♣">♣</abbr></a>						
			<a href=""><abbr title="♣">♧</abbr></a>						
			<a href=""><abbr title="◆">◆</abbr></a>						
			<a href=""><abbr title="◇">◇</abbr></a>						
			<a href=""><abbr title="♥">♥</abbr></a>						
			<a href=""><abbr title="♡">♡</abbr></a>						
			<a href=""><abbr title="★">★</abbr></a>						
			<a href=""><abbr title="☆">☆</abbr></a>
		</div>			
	</div>	
</div>
<!-- //도형 -->

<!-- 사랑 -->
<div id="layer_popup" style="width:480px;height:270px;margin:-150px 0 0 -240px;">
	<div id="layer_header">
		<h1>특수문자</h1>
		<button type="button" onclick="closeLayerPopup()" title="닫기"><img src="http://wbox.inplus21.com/layout/manager/img/common/btn_close_layer.gif" alt="Close" /></button>
	</div>

	<div id="layer_content" style="height:170px;">		
		<!-- tab -->
		<div class="layerTab">
			<ul>
			<li><a href="">도형</a></li>
			<li><span>사랑</span></li>
			<li><a href="">웃음</a></li>
			<li><a href="">슬픔</a></li>
			<li><a href="">기타</a></li>
			</ul>
		</div>
		<!-- //tab -->
		
		<div class="charWrap">
			<a href=""><abbr title="~( ♡o♡)~">~( ♡o♡)~</abbr></a>						
			<a href=""><abbr title="♡(^ㅇ^)♡">♡(^ㅇ^)♡</abbr></a>						
			<a href=""><abbr title="(*^.☜)">(*^.☜)</abbr></a>						
			<a href=""><abbr title="(*^3(^^*)">(*^3(^^*)</abbr></a>						
			<a href=""><abbr title="(*_*)">(*_*)</abbr></a>						
			<a href=""><abbr title="(^*^)kiss">(^*^)kiss</abbr></a>						
			<a href=""><abbr title="^}{^">^}{^</abbr></a>						
			<a href=""><abbr title="☞♡☜">☞♡☜</abbr></a>						
			<a href=""><abbr title="♡.♡">♡.♡</abbr></a>						
			<a href=""><abbr title="(つ＾з＾)つ">(つ＾з＾)つ</abbr></a>						
			<a href=""><abbr title="γ^ε^γ">γ^ε^γ</abbr></a>						
			<a href=""><abbr title="♥.♥">♥.♥</abbr></a>						
		</div>			
	</div>	
</div>
<!-- //사랑-->

<!-- 웃음 -->
<div id="layer_popup" style="width:480px;height:270px;margin:-150px 0 0 -240px;">
	<div id="layer_header">
		<h1>특수문자</h1>
		<button type="button" onclick="closeLayerPopup()" title="닫기"><img src="http://wbox.inplus21.com/layout/manager/img/common/btn_close_layer.gif" alt="Close" /></button>
	</div>

	<div id="layer_content" style="height:170px;">		
		<!-- tab -->
		<div class="layerTab">
			<ul>
			<li><a href="">도형</a></li>
			<li><a href="">사랑</a></li>
			<li><span>웃음</span></li>
			<li><a href="">슬픔</a></li>
			<li><a href="">기타</a></li>
			</ul>
		</div>
		<!-- //tab -->
		
		<div class="charWrap">
			<a href=""><abbr title="(^ㅇ^)b">(^ㅇ^)b</abbr></a>						
			<a href=""><abbr title="s(￣▽￣)/">s(￣▽￣)/</abbr></a>						
			<a href=""><abbr title="~( ^ㅇ^)~">~( ^ㅇ^)~</abbr></a>						
			<a href=""><abbr title="(ノ^O^)ノ">(ノ^O^)ノ</abbr></a>
			<a href=""><abbr title="^,.^+">^,.^+</abbr></a>
			<a href=""><abbr title="^▽^">^▽^</abbr></a>											
			<a href=""><abbr title="^.~">^.~</abbr></a>						
			<a href=""><abbr title="^____^">^____^</abbr></a>						
			<a href=""><abbr title="^o^♬">^o^♬</abbr></a>						
			<a href=""><abbr title="*^^*">*^^*</abbr></a>						
			<a href=""><abbr title="^.^">^.^</abbr></a>						
			<a href=""><abbr title="＼(≥∇≤)ノ">＼(≥∇≤)ノ</abbr></a>						
		</div>			
	</div>	
</div>
<!-- //웃음-->

<!-- 슬픔 -->
<div id="layer_popup" style="width:480px;height:270px;margin:-150px 0 0 -240px;">
	<div id="layer_header">
		<h1>특수문자</h1>
		<button type="button" onclick="closeLayerPopup()" title="닫기"><img src="http://wbox.inplus21.com/layout/manager/img/common/btn_close_layer.gif" alt="Close" /></button>
	</div>

	<div id="layer_content" style="height:170px;">		
		<!-- tab -->
		<div class="layerTab">
			<ul>
			<li><a href="">도형</a></li>
			<li><a href="">사랑</a></li>
			<li><a href="">웃음</a></li>
			<li><span>슬픔</span></li>
			<li><a href="">기타</a></li>
			</ul>
		</div>
		<!-- //tab -->
		
		<div class="charWrap">
			<a href=""><abbr title="`o’">`o’</abbr></a>						
			<a href=""><abbr title="(￣^￣)">(￣^￣)</abbr></a>						
			<a href=""><abbr title="(-_-)+">(-_-)+</abbr></a>						
			<a href=""><abbr title="-,.-">-,.-</abbr></a>						
			<a href=""><abbr title="( ToT)">( ToT)</abbr></a>						
			<a href=""><abbr title="(=,.=)">(=,.=)</abbr></a>						
			<a href=""><abbr title="Θ_Θ">Θ_Θ</abbr></a>						
			<a href=""><abbr title="T.T">T.T</abbr></a>						
			<a href=""><abbr title="(>_<)">(&gt;_&lt;)</abbr></a>						
			<a href=""><abbr title="ㅠ.ㅠ">ㅠ.ㅠ</abbr></a>						
			<a href=""><abbr title="o(T^T)o">o(T^T)o</abbr></a>						
			<a href=""><abbr title="ご.ご">ご.ご</abbr></a>						
		</div>			
	</div>	
</div>
<!-- //슬픔-->

<!-- 기타 -->
<div id="layer_popup" style="width:480px;height:270px;margin:-150px 0 0 -240px;">
	<div id="layer_header">
		<h1>특수문자</h1>
		<button type="button" onclick="closeLayerPopup()" title="닫기"><img src="http://wbox.inplus21.com/layout/manager/img/common/btn_close_layer.gif" alt="Close" /></button>
	</div>

	<div id="layer_content" style="height:170px;">		
		<!-- tab -->
		<div class="layerTab">
			<ul>
			<li><a href="">도형</a></li>
			<li><a href="">사랑</a></li>
			<li><a href="">웃음</a></li>
			<li><a href="">슬픔</a></li>
			<li><span>기타</span></li>
			</ul>
		</div>
		<!-- //tab -->
		
		<div class="charWrap">
			<a href=""><abbr title="づ.ど)">づ.ど)</abbr></a>						
			<a href=""><abbr title="(-_ど)">(-_ど)</abbr></a>						
			<a href=""><abbr title="(づ_-)">(づ_-)</abbr></a>						
			<a href=""><abbr title="⊙.⊙">⊙.⊙</abbr></a>						
			<a href=""><abbr title="(-_-)Zz">(-_-)Zz</abbr></a>						
			<a href=""><abbr title="┏(;-_-)┛">┏(;-_-)┛</abbr></a>						
			<a href=""><abbr title="@}->-">@}-&gt;-</abbr></a>						
			<a href=""><abbr title="⊙⊙ㆀ">⊙⊙ㆀ</abbr></a>						
			<a href=""><abbr title="★.★">★.★</abbr></a>						
			<a href=""><abbr title="(♨_♨)">(♨_♨)</abbr></a>						
			<a href=""><abbr title="-_-ㆀ">-_-ㆀ</abbr></a>						
			<a href=""><abbr title="+_+">+_+</abbr></a>						
		</div>			
	</div>	
</div>
<!-- //기타-->

<!-- 메시지함 -->
<div id="layer_popup" style="width:780px;height:630px;margin:-300px 0 0 -390px;">
	<div id="layer_header">
		<h1>메시지 저장함</h1>
		<button type="button" onclick="closeLayerPopup()" title="닫기"><img src="http://wbox.inplus21.com/layout/manager/img/common/btn_close_layer.gif" alt="Close" /></button>
	</div>

	<div id="layer_content" style="height:530px;">
		<!-- message_list -->
		<ul class="message_list">
		<li>
			<div class="message_view">
				(주)인플러스김덕일입니다.직통(070-8630-0000) 이메일:inplus@inplusweb.com 휴대폰:010-8502-9990감사합니다.
			</div>
			<div class="btn_layer">
				<a href="#" class="sButton small">선택하기</a>
			</div>
		</li>
		<li>
			<div class="message_view">
				(주)인플러스김덕일입니다.직통(070-8630-0000) 이메일:inplus@inplusweb.com 휴대폰:010-8502-9990감사합니다. (주)인플러스김덕일입니다.직통(070-8630-0000) 이메일:inplus@inplusweb.com 휴대폰:010-8502-9990감사합니다.
			</div>
			<div class="btn_layer">
				<a href="#" class="sButton small">선택하기</a>
			</div>
		</li>
		<li>
			<div class="message_view">
				시안 보고드립니다, 확인 후 연락 부탁드립니다.
			</div>
			<div class="btn_layer">
				<a href="#" class="sButton small">선택하기</a>
			</div>
		</li>
		<li>
			<div class="message_view">
				세금계산서가 발행되었습니다.
			</div>
			<div class="btn_layer">
				<a href="#" class="sButton small">선택하기</a>
			</div>
		</li>
		<li>
			<div class="message_view">
				(주)인플러스김덕일입니다.직통(070-8630-0000) 이메일:inplus@inplusweb.com 휴대폰:010-8502-9990감사합니다.
			</div>
			<div class="btn_layer">
				<a href="#" class="sButton small">선택하기</a>
			</div>
		</li>
		<li>
			<div class="message_view">
				(주)인플러스김덕일입니다.직통(070-8630-0000) 이메일:inplus@inplusweb.com 휴대폰:010-8502-9990감사합니다. (주)인플러스김덕일입니다.직통(070-8630-0000) 이메일:inplus@inplusweb.com 휴대폰:010-8502-9990감사합니다.
			</div>
			<div class="btn_layer">
				<a href="#" class="sButton small">선택하기</a>
			</div>
		</li>
		<li>
			<div class="message_view">
				시안 보고드립니다, 확인 후 연락 부탁드립니다.
			</div>
			<div class="btn_layer">
				<a href="#" class="sButton small">선택하기</a>
			</div>
		</li>
		<li>
			<div class="message_view">
				세금계산서가 발행되었습니다.
			</div>
			<div class="btn_layer">
				<a href="#" class="sButton small">선택하기</a>
			</div>
		</li>
		</ul>
		<!-- //message_list -->

		<!-- pagination -->
		<div class="pagination">
			<ul>
			<li class="begin"><a href="#"></a></li>
			<li class="prev"><a href="#"></a></li>
			<li class="on"><a href="" title="1 페이지">1</a></li>
			<li><a href="" title="2 페이지">2</a></li>
			<li><a href="" title="3 페이지">3</a></li>
			<li><a href="" title="4 페이지">4</a></li>
			<li><a href="" title="5 페이지">5</a></li>
			<li class="next"><a href="#"></a></li>
			<li class="end"><a href="#"></a></li>
			</ul>
		</div>
		<!-- //pagination -->
	</div>	
</div>
<!-- //메시지함 -->

<!-- 짧은주소 -->
<div id="layer_popup" style="display:block;width:480px;height:360px;margin:-198px 0 0 -240px;">
	<div id="layer_header">
		<h1>짧은 URL</h1>
		<button type="button" onclick="closeLayerPopup()" title="닫기"><img src="http://wbox.inplus21.com/layout/manager/img/common/btn_close_layer.gif" alt="Close" /></button>
	</div>

	<div id="layer_content" style="height:260px;">	
		<p class="dot">짧은 URL로 변경할 URL을 입력한 후 변환하기 버튼을 눌러주세요.</p>
		
		<ul class="shortUrl">
		<li>
			<dt>사이트 URL</dt>
			<dd><textarea rows="3" id=""></textarea> <a href="#" class="sButton small primary">변환</a></dd>
		</li>
		<!-- 변환버튼 클릭시 짧은 url 생성, 변환 전 숨김처리 -->
		<li>
			<dt>짧은 URL</dt>
			<dd><input type="text" name="" value="" class="text readonly" title="짧은 URL" /> <a href="#" class="sButton small active">복사</a></dd>
		</li>
		<!-- //변환버튼 클릭시 짧은 url 생성, 변환 전 숨김처리 -->
		</ul>

		<p>예약박스의 짧은URL은 Google URL Shortener Api로 제공됩니다.</p>

	</div>	
</div>
<!-- //짧은주소 -->