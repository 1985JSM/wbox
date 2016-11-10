<?
if(!defined('_INPLUS_')) { exit; } 

/* set URI */
$layout_size = 'tiny';
$doc_title = '메시지전송내역';
?>

<style>
div.sub_send > table.list_table tr td a.edit {display:inline-block;overflow:visible;position:relative;width:12px;height:12px;margin:-2px 0 0 4px;padding:0;border:none;font-size:12px;line-height:10px;background:none;color:#538fd4;text-align:center;text-decoration:none !important;vertical-align:middle;white-space:nowrap;cursor:pointer;box-sizing:border-box;}

div.sub_send > table.list_table tr td.content {font-size:12px;}
div.sub_send > table.list_table tr td.content p.message_con {overflow:hidden;max-width:260px;white-space:nowrap;text-overflow:ellipsis;}
</style>

<!-- <?=$module?> -->
<div id="<?=$module?>">

	<!-- subWrap -->
	<div class="subWrap sub_send">		
		<div class="info_box">
			<h4><span class="icon tip_info"></span> 도움말</h4>
			- 6개월 전까지 전송 내역만 보관되며, 그 이전 내역은 자동 삭제됩니다.<br />
			- 전송결과 업데이트는 최대 2~3일이 소요될 수 있습니다.<br />
			- 보낸 메시지가 많을 경우 조회시간이 오래 걸릴 수 있습니다.
		</div>	

		<!-- search -->
		<div class="search">
			<form name="" method="" onsubmit="">
			<input type="hidden" name="" value="" />

			<fieldset>
			<legend>검색조건</legend>
			<table class="search_table" border="1">
			<caption>검색조건</caption>
			<colgroup>
			<col width="90" />
			<col width="*" />
			<col width="90" />
			<col width="*" />
			</colgroup>
			<tbody>
			<tr>
				<th>메시지유형</th>
				<td>
					<select name="" class="select" title="메시지유형">
					<option value="">메시지유형</option>
					</select>

					<select name="" class="select" title="상태">
					<option value="">상태</option>
					</select>

					<select name="" class="select" title="전송유형">
					<option value="">전송유형</option>
					</select>
				</td>
			</tr>
			<tr>
				<th>기간</th>
				<td colspan="3">								

					<input type="text" name="sch_s_date" id="sch_s_date" value="<?=$sch_s_date?>" class="text date" size="12" maxlength="10" title="검색 시작일" />
					~
					<input type="text" name="sch_e_date" id="sch_e_date" value="<?=$sch_e_date?>" class="text date" size="12" maxlength="10" title="검색 종료일" />	
					
					<a href="" class="sButton tiny  btn_quick_date">1일</a>
					<a href="" class="sButton tiny  btn_quick_date">7일</a>
					<a href="" class="sButton tiny  btn_quick_date">30일</a>
					<a href="" class="sButton tiny  btn_quick_date">6개월</a>
				</td>
			</tr>
			<tr>
				<th>수신번호</th>
				<td>
					<select name="" class="select" title="수신번호">
					<option value="">수신번호</option>
					</select>

					<input type="text" name="" value="" class="text" size="30" maxlength="30" title="검색어" />
					</select>
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

		<!-- list -->
		<table class="list_table border" summary="전송내역에 관련된 표로써 전송일시, 수신번호, 이름, 메시지 유형, 메시지 내용, 전송유형, 상태 순으로 출력됩니다.">
		<caption>전송내역</caption>
		<colgroup>
		<col width="12%">
		<col width="11%">
		<col width="9%">
		<col width="12%">
		<col width="*">
		<col width="10%">
		<col width="10%">
		</colgroup>
		<thead>
		<tr>
			<th>전송일시</th>
			<th>수신번호</th>
			<th>이름</th>
			<th>메시지 유형</th>
			<th>메시지 내용</th>
			<th>전송 유형</th>
			<th>상태</th>
		</tr>	
		</thead>
		<tbody>
		<tr>
			<td>2016-06-27<br />12:30:15</td>
			<td>01066552885</td>
			<td>홍길동</td>
			<td>SMS</td>
			<td class="content"><p class="message_con">행복한 하루 보내세요.</p></td>
			<td>즉시전송</td>
			<td><span class="success">성공</span></td>
		</tr>
		<tr>
			<td>2016-06-27<br />12:30:15</td>
			<td>01066552885</td>
			<td>홍길동</td>
			<td>LMS</td>
			<td class="content"><p class="message_con">안녕하십니까? 인플러스 디자인팀 이창걸입니다. 시안 확인 부탁드립니다.</p></td>
			<td>예약전송</td>
			<td><span class="processing">전송중</span></td>
		</tr>
		<tr>
			<td>2016-06-27<br />12:30:15</td>
			<td>01066552885</td>
			<td>홍길동</td>
			<td>MMS</td>
			<td class="content"><p class="message_con">행복한 하루 보내세요.</p></td>
			<td>즉시전송</td>
			<td><span class="info">예약중</span><a href="./ajax.reserve.html" class="edit btn_ajax size_480x220" target="#layer_popup" title="예약정보 수정"><i class="xi-pen"></i></a></td>
		</tr>
		<tr>
			<td>2016-06-27<br />12:30:15</td>
			<td>01066552885</td>
			<td>홍길동</td>
			<td>MMS</td>
			<td class="content"><p class="message_con">안녕하십니까? 인플러스 디자인팀 이창걸입니다. 시안 확인 부탁드립니다.</p></td>
			<td>예약전송</td>
			<td><span class="failed">실패</span></td>
		</tr>
		<tr>
			<td>2016-06-27<br />12:30:15</td>
			<td>01066552885</td>
			<td>홍길동</td>
			<td>SMS</td>
			<td class="content"><p class="message_con">행복한 하루 보내세요.</p></td>
			<td>예약전송</td>
			<td><span class="success">성공</span></td>
		</tr>
		<tr>
			<td>2016-06-27<br />12:30:15</td>
			<td>01066552885</td>
			<td>홍길동</td>
			<td>LMS</td>
			<td class="content"><p class="message_con">안녕하십니까? 인플러스 디자인팀 이창걸입니다. 시안 확인 부탁드립니다.</p></td>
			<td>즉시전송</td>
			<td><span class="processing">전송중</span></td>
		</tr>
		<tr>
			<td>2016-06-27<br />12:30:15</td>
			<td>01066552885</td>
			<td>홍길동</td>
			<td>MMS</td>
			<td class="content"><p class="message_con">행복한 하루 보내세요.</p></td>
			<td>즉시전송</td>
			<td><span class="info">예약중</span><a href="./ajax.reserve.html" class="edit btn_ajax size_480x220" target="#layer_popup" title="예약정보 수정"><i class="xi-pen"></i></a></td>
		</tr>
		<tr>
			<td>2016-06-27<br />12:30:15</td>
			<td>01066552885</td>
			<td>홍길동</td>
			<td>MMS</td>
			<td class="content"><p class="message_con">안녕하십니까? 인플러스 디자인팀 이창걸입니다. 시안 확인 부탁드립니다.</p></td>
			<td>즉시전송</td>
			<td><span class="failed">실패</span></td>
		</tr>
		<tr>
			<td>2016-06-27<br />12:30:15</td>
			<td>01066552885</td>
			<td>홍길동</td>
			<td>MMS</td>
			<td class="content"><p class="message_con">행복한 하루 보내세요.</p></td>
			<td>즉시전송</td>
			<td><span class="info">예약중</span><a href="./ajax.reserve.html" class="edit btn_ajax size_480x220" target="#layer_popup" title="예약정보 수정"><i class="xi-pen"></i></a></td>
		</tr>
		<tr>
			<td>2016-06-27<br />12:30:15</td>
			<td>01066552885</td>
			<td>홍길동</td>
			<td>MMS</td>
			<td class="content"><p class="message_con">안녕하십니까? 인플러스 디자인팀 이창걸입니다. 시안 확인 부탁드립니다.</p></td>
			<td>즉시전송</td>
			<td><span class="failed">실패</span></td>
		</tr>
		</tbody>
		</table>
		<!-- //list -->

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
	<!-- //subWrap -->	
	
</div>
<!-- //<?=$module?> -->

<!-- layer popup -->
<div id="layer_back" style="display:block;"></div>

<!-- 예약정보 수정 -->
<div id="layer_popup" style="display:block;width:480px;height:200px;margin:-100px 0 0 -240px;">
	<div id="layer_header">
		<h1>예약정보 수정</h1>
		<button type="button" onclick="closeLayerPopup()" title="닫기"><img src="http://wbox.inplus21.com/layout/manager/img/common/btn_close_layer.gif" alt="Close" /></button>
	</div>

	<div id="layer_content" class="center" style="height:100px;">
		<span class="title">예약날짜 및 시간</span>
		
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
			
		<!-- btn_layer -->
		<div class="btn_layer">
			<a href="#" class="sButton primary">변경</a>
			<a href="#" class="sButton active">삭제</a>
		</div>
		<!-- //btn_layer -->
	</div>	
</div>
<!-- //예약정보 수정 -->