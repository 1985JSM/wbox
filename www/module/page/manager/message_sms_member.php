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

div.send_area > div.con_right {margin-left:330px;}
div.send_area > div.con_right > ul {}
div.send_area > div.con_right > ul > li {padding-left:10px;line-height:20px;background:url("/img/manager/bl_dot.gif") 0 50% no-repeat;}
div.send_area > div.con_right > ul > li > strong {color:#ff0000;}

div.send_area > div.con_right > div.memberSelect {margin-bottom:40px;padding:1em 10px;border-top:2px solid #646464;border-bottom:1px solid #d2d2d2;}
div.send_area > div.con_right > div.memberSelect > div.selectArea {}
div.send_area > div.con_right > div.memberSelect > div.selectArea label {margin-right:5px;}
div.send_area > div.con_right > div.memberSelect > div.selectArea input {margin:-2px 4px 0 2px;}
div.send_area > div.con_right > div.memberSelect > div.selectArea > p {margin-top:10px;}
div.send_area > div.con_right > div.memberSelect > div.selectArea > p > strong {font-weight:600;}
div.send_area > div.con_right > div.memberSelect > div.member_option {margin-top:10px;padding-top:10px;border-top:1px dotted #d2d2d2;}
div.send_area > div.con_right > div.memberSelect > div.member_option > span {display:block;margin-top:6px;}
div.send_area > div.con_right > div.memberSelect > div.member_option > span.num {display:inline-block;padding-left:15px;}
div.send_area > div.con_right > div.memberSelect > div.member_option strong {font-weight:600;}

div.send_area > div.con_right table.write_table {position:relative;}
div.send_area > div.con_right table.write_table tr th, div.send_area > div.con_right table.write_table tr td {padding:1em 10px;}
div.send_area > div.con_right table.write_table tr td div.recipient {margin-top:5px;}
div.send_area > div.con_right table.write_table tr td ul.receive_list {display:block;overflow-y:scroll;margin-top:10px;padding:10px 20px;width:272px;height:100px;border:1px solid #d8d8d8;}
div.send_area > div.con_right table.write_table tr td ul.receive_list li {position:relative;line-height:20px;}
div.send_area > div.con_right table.write_table tr td ul.receive_list li span.name {display:inline-block;width:100px;line-height:16px;}
div.send_area > div.con_right table.write_table tr td ul.receive_list li span.num {vertical-align:top;}
div.send_area > div.con_right table.write_table tr td ul.receive_list li button {display:inline-block;overflow:visible;position:absolute;top:5px;right:20px;width:10px;height:10px;margin:0;padding:0;border:none;font-size:12px;line-height:10px;background:#fff;color:#666;text-align:center;text-decoration:none !important;vertical-align:middle;white-space:nowrap;cursor:pointer;box-sizing:border-box;}
div.send_area > div.con_right table.write_table tr td p.total {margin:20px 0;}
div.send_area > div.con_right table.write_table tr td p.total strong {font-weight:600;color:#2460ce;}
div.send_area > div.con_right table.write_table tr td div.btn_total {position:absolute;top:195px;right:5px;}
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
				직접입력 페이지 참고
			</div>
			<!-- //con_left -->

			<!-- con_right -->
			<div class="con_right">
				<!-- tab -->
				<div class="tab_area">
					<ul>
					<li><a href="message_sms_direct.html">직접입력</a></li>
					<li><a href="message_sms_member.html" class="on">고객선택</a></li>
					</ul>
				</div>
				<!-- //tab -->
				
				<h4>대상 고객 선택</h4>
				<div class="memberSelect">
					<div class="selectArea">
						<label><input type="radio" name="" class="" value="" title="고객 직접 선택">고객 직접 선택</label> <label><input type="radio" name="" class="" value="" title="고객 등급 선택">고객 등급 선택</label> <label><input type="radio" name="" class="" value="" title="전체 고객 발송">전체 고객 발송</label> <label><input type="radio" name="" class="" value=""  title="담당자별 고객">담당자별 고객</label> <label><input type="radio" name="" class="" value="" title="예약 고객">예약 고객</label>
						<p><strong>* 수신동의여부</strong> : <label><input type="checkbox" name="" value="" class="checkbox" title="수신동의한 고객에게만 발송" /> 수신동의한 고객에게만 발송</label></p>
					</div>
					<!-- 고객 직접 선택시 출력 -->
					<div class="member_option">
						고객 직접 선택 : <a href="#" class="sButton small info">선택하기</a> 

						<span class="num">선택된 고객수 : <strong class="primary">5명</strong> (수신거부 대상자 <strong class="rejectCount">0</strong>명 포함)</span>
						<br />						
						<span class="info">- 버튼을 클릭하여 고객을 선택해주세요.</span>				
					</div>
					<!-- //고객 직접 선택시 출력 -->
					<!-- 고객 등급 선택시 출력 -->
					<div class="member_option">
						고객 등급 선택 :
						<select name="" class="select" title="">
							<option value="">선택</option>
							<option value="">일반</option>
							<option value="">브론즈</option>
							<option value="">실버</option>
							<option value="">골드</option>
							<option value="">VIP</option>
						</select>						
						
						<span class="num">선택된 고객수 : <strong class="primary">5명</strong></span>
						<br />
						<span class="info">- 고객 등급을 선택해주세요.</span>						
					</div>
					<!-- //고객 등급 선택시 출력 -->
					<!-- 전체 고객 발송 선택시 출력 -->
					<div class="member_option">
						전체고객 발송 : 발송인원 총 <strong class="primary">2명</strong> 
						<span class="info">- 전체 고객에게 메시지가 발송됩니다.</span>
					</div>
					<!-- //전체 고객 발송 선택시 출력 -->
					<!-- 담당자별 고객 선택시 출력 -->
					<div class="member_option">
						담당자별 고객 선택 : 
						<select name="" class="select" title="">
							<option value="">선택</option>
							<option value="">담당자1</option>
							<option value="">담당자2</option>
							<option value="">담당자3</option>
							<option value="">담당자4</option>
							<option value="">담당자 미지정</option>
						</select>
						 
						<span class="num">선택된 고객수 : <strong class="primary">5명</strong></span>
						<br />
						<span class="info">- 담당자를 선택해주세요.</span>
					</div>
					<!-- //담당자별 고객 선택시 출력 -->
					<!-- 예약 고객 선택시 출력 -->
					<div class="member_option">
						예약 고객 선택 : 
						<select name="" class="select" title="">
							<option value="">선택</option>
							<option value="">예약 1회</option>
							<option value="">예약 2회</option>
							<option value="">예약 3회</option>
							<option value="">예약 4회</option>
							<option value="">예약 5회</option>
							<option value="">예약 6회</option>
							<option value="">예약 7회</option>
							<option value="">예약 8회</option>
							<option value="">예약 9회</option>
							<option value="">예약 10회이상</option>
						</select>
						 
						<span class="num">선택된 고객수 : <strong class="primary">5명</strong></span>
						<br />
						<span class="info">- 예약횟수를 선택해주세요.</span>						
					</div>
					<!-- //예약 고객 선택시 출력 -->
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

<!-- 고객 선택하기 -->
<div id="layer_popup" style="display:block;width:1200px;height:750px;margin:-375px 0 0 -600px;">
	<div id="layer_header">
		<h1>고객선택</h1>
		<button type="button" onclick="closeLayerPopup()" title="닫기"><img src="http://wbox.inplus21.com/layout/manager/img/common/btn_close_layer.gif" alt="Close" /></button>
	</div>

	<div id="layer_content" style="height:650px;">
		<div class="selectMember">
			<!-- left -->
			<div class="leftArea">
				<h3>고객선택</h3>
				<!-- search -->
				<div class="search">
					<form name="" method="" onsubmit="">
					<input type="hidden" name="" value="" />

					<fieldset>
					<legend>검색조건</legend>
					<table class="search_table" border="1">
					<caption>검색조건</caption>
					<colgroup>
					<col width="150" />
					<col width="*" />
					</colgroup>
					<tbody>
					<tr>
						<th>가입일</th>
						<td>
							<input type="text" name="" id="" value="" class="text date" size="12" maxlength="10" title="가입일" />	
						</td>
					</tr>
					<tr>
						<th>등급/담당자</th>
						<td>
							<input type="text" name="" id="" value="" class="text" size="30" maxlength="30" title="등급/담당자" />
						</td>
					</tr>
					<tr>
						<th>검색어</th>
						<td>
							<input type="text" name="" id="" value="" class="text" size="30" maxlength="30" title="검색어" />
						</td>
					</tr>
					<tr>
						<th>SMS수신동의</th>
						<td>
							<label><input type="radio" name="" class="" value="" title="전체">전체</label>
							<label><input type="radio" name="" class="" value="" title="수신">수신</label>
							<label><input type="radio" name="" class="" value="" title="거부">거부</label>
						</td>
					</tr>
					</tbody>
					</table>
					</fieldset>

					<p class="button">		
						<button type="submit" class="sButton info" title="검색">검 색</button>
						<a href="?page=1" class="sButton" title="초기화">초기화</a>
					</p>
					</form>
				</div>
				<!-- //search -->

				<div class="table_th">
					<table class="list_table border" summary="고객선택에 관련된 표로써 No, 이름, 성별, 휴대폰(수신여부), 등급, 담당자 등 순으로 출력됩니다.">
					<caption>고객선택</caption>
					<colgroup>
					<col width="28">
					<col width="38">
					<col width="67">
					<col width="67">
					<col width="*">
					<col width="57">
					<col width="67">
					<col width="17">
					</colgroup>
					<thead>
					<tr>
						<th scope="row"><input type="checkbox" id="" title=""></th>
						<th scope="row">No</th>
						<th scope="row">이름</th>	
						<th scope="row">성별</th>
						<th scope="row">휴대폰(수신여부)</th>
						<th scope="row">등급</th>
						<th scope="row">담당자</th>
						<th scope="row"></th>
					</tr>
					</thead>
					</table>
				</div>

				<div class="table_td">
					<table class="list_table border" summary="고객선택에 관련된 표로써 No, 이름, 성별, 휴대폰(수신여부), 등급, 담당자 등 순으로 출력됩니다.">
					<caption>고객선택</caption>
					<colgroup>
					<col width="28">
					<col width="38">
					<col width="67">
					<col width="67">
					<col width="*">
					<col width="57">
					<col width="67">
					</colgroup>
					<tbody>
					<tr>
						<td><input type="checkbox" id="" title=""></td>
						<td>1</td>
						<td>홍길동</td>
						<td>남</td>
						<td>010-1111-2222 <span class="info">(수신)</span></td>
						<td></td>
						<td>김담당</td>
					</tr>
					</tbody>
					</table>
				</div>
			</div>
			<!-- //left -->

			<!-- center -->
			<div class="centerArea">
				<ul>
				<li><button type="button" class="sButton small">추가 +</button></li>
				<li><button type="button" class="sButton small">삭제 -</button></li>
				</ul>
			</div>
			<!-- //center -->

			<!-- right -->
			<div class="rightArea">
				<h3>선택 고객 리스트</h3>

				<div class="table_th">
					<table class="list_table border" summary="고객선택에 관련된 표로써 No, 이름, 성별, 휴대폰(수신여부), 등급, 담당자 등 순으로 출력됩니다.">
					<caption>고객선택</caption>
					<colgroup>
					<col width="28">
					<col width="38">
					<col width="67">
					<col width="67">
					<col width="*">
					<col width="57">
					<col width="67">
					<col width="17">
					</colgroup>
					<thead>
					<tr>
						<th scope="row"><input type="checkbox" id="" title=""></th>
						<th scope="row">No</th>
						<th scope="row">이름</th>	
						<th scope="row">성별</th>
						<th scope="row">휴대폰(수신여부)</th>
						<th scope="row">등급</th>
						<th scope="row">담당자</th>
						<th scope="row"></th>
					</tr>
					</thead>
					</table>
				</div>
				
				<div class="table_td">				
					<table class="list_table border" summary="고객선택에 관련된 표로써 No, 이름, 성별, 휴대폰(수신여부), 등급, 담당자 등 순으로 출력됩니다.">
					<caption>고객선택</caption>
					<colgroup>
					<col width="28">
					<col width="38">
					<col width="67">
					<col width="67">
					<col width="*">
					<col width="57">
					<col width="67">
					</colgroup>			
					<tbody>
					<tr>
						<td><input type="checkbox" id="" title=""></td>
						<td>1</td>
						<td>홍길동</td>
						<td>남</td>
						<td>010-1111-2222 <span class="info">(수신)</span></td>
						<td></td>
						<td>김담당</td>
					</tr>
					<tr>
						<td><input type="checkbox" id="" title=""></td>
						<td>2</td>
						<td>홍길동</td>
						<td>남</td>
						<td>010-1111-2222 <span class="primary">(거부)</span></td>
						<td></td>
						<td>김담당</td>
					</tr>
					<tr>
						<td><input type="checkbox" id="" title=""></td>
						<td>3</td>
						<td>홍길동</td>
						<td>남</td>
						<td>010-1111-2222 <span class="info">(수신)</span></td>
						<td></td>
						<td>김담당</td>
					</tr>
					<tr>
						<td><input type="checkbox" id="" title=""></td>
						<td>4</td>
						<td>홍길동</td>
						<td>남</td>
						<td>010-1111-2222 <span class="primary">(거부)</span></td>
						<td></td>
						<td>김담당</td>
					</tr>
					<tr>
						<td><input type="checkbox" id="" title=""></td>
						<td>5</td>
						<td>홍길동</td>
						<td>남</td>
						<td>010-1111-2222 <span class="info">(수신)</span></td>
						<td></td>
						<td>김담당</td>
					</tr>
					<tr>
						<td><input type="checkbox" id="" title=""></td>
						<td>6</td>
						<td>홍길동</td>
						<td>남</td>
						<td>010-1111-2222 <span class="primary">(거부)</span></td>
						<td></td>
						<td>김담당</td>
					</tr>
					<tr>
						<td><input type="checkbox" id="" title=""></td>
						<td>7</td>
						<td>홍길동</td>
						<td>남</td>
						<td>010-1111-2222 <span class="info">(수신)</span></td>
						<td></td>
						<td>김담당</td>
					</tr>
					<tr>
						<td><input type="checkbox" id="" title=""></td>
						<td>8</td>
						<td>홍길동</td>
						<td>남</td>
						<td>010-1111-2222 <span class="primary">(거부)</span></td>
						<td></td>
						<td>김담당</td>
					</tr>
					<tr>
						<td><input type="checkbox" id="" title=""></td>
						<td>9</td>
						<td>홍길동</td>
						<td>남</td>
						<td>010-1111-2222 <span class="info">(수신)</span></td>
						<td></td>
						<td>김담당</td>
					</tr>
					<tr>
						<td><input type="checkbox" id="" title=""></td>
						<td>10</td>
						<td>홍길동</td>
						<td>남</td>
						<td>010-1111-2222 <span class="primary">(거부)</span></td>
						<td></td>
						<td>김담당</td>
					</tr>
					<tr>
						<td><input type="checkbox" id="" title=""></td>
						<td>11</td>
						<td>홍길동</td>
						<td>남</td>
						<td>010-1111-2222 <span class="info">(수신)</span></td>
						<td></td>
						<td>김담당</td>
					</tr>
					<tr>
						<td><input type="checkbox" id="" title=""></td>
						<td>12</td>
						<td>홍길동</td>
						<td>남</td>
						<td>010-1111-2222 <span class="primary">(거부)</span></td>
						<td></td>
						<td>김담당</td>
					</tr>
					</tbody>
					</table>
				</div>
			</div>
			<!-- //right -->
		</div>

		<!-- btn_layer -->
		<div class="btn_layer">
			<a href="#" class="sButton active">취소</a>
			<a href="#" class="sButton primary">선택완료</a>
		</div>
		<!-- //btn_layer -->
		
	</div>	
</div>
<!-- //고객 선택하기 -->