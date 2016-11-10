<?
if(!defined('_INPLUS_')) { exit; }

/* set URI */
$layout_size = 'small';
$doc_title = 'SMS/LMS 전송';
?>

<style>

</style>

<!-- <?=$module?> -->
<div id="<?=$module?>">



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