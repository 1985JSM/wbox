<?
if(!defined('_INPLUS_')) { exit; }

/* set URI */
$layout_size = 'small';
$doc_title = 'SMS/LMS 전송';
$oSms = new SmsManager();
$cs_level_arr = $oSms->getArrOfInformation('cs_level_arr');
$st_id_arr = $oSms->getArrOfInformation('st_id_arr');
$sch_type_arr = $oSms->getArrOfInformation('sch_type_arr');
?>
<div class="selectMember">
	<!-- left -->
	<div class="leftArea">
		<h3>고객선택</h3>
		<!-- search -->
		<div class="search">
			<form name="customer_selector" method="get" onsubmit="return customerSelector(this)" target="layer_content">
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
								<input type="text" name="sch_s_date" id="sch_s_date" value="<?=$sch_s_date?>" class="text date" size="12" maxlength="10" title="검색 시작일" />
								~
								<input type="text" name="sch_e_date" id="sch_e_date" value="<?=$sch_e_date?>" class="text date" size="12" maxlength="10" title="검색 종료일" />
								<!--input type="text" name="" id="" value="" class="text date" size="12" maxlength="10" title="가입일" /-->
							</td>
						</tr>
						<tr>
							<th>등급/담당자</th>
							<td>
								<select name="sch_cs_level" class="select" title="가맹점등급">
									<option value="">가맹점등급</option>
									<? printSelectOption($cs_level_arr, $sch_cs_level, 1); ?>
								</select>

								<select name="sch_st_id" class="select" title="담당자">
									<option value="">담당자</option>
									<? printSelectOption($st_id_arr, $sch_st_id, 1); ?>
								</select>
							</td>
						</tr>
						<tr>
							<th>검색어</th>
							<td>
								<select name="sch_type" class="select" title="검색필드">
									<? printSelectOption($sch_type_arr, "", 1); ?>
								</select>
								<input type="text" name="sch_keyword" value="" class="text" size="30" maxlength="30" title="검색어" />
							</td>
						</tr>
						<tr>
							<th>SMS수신동의</th>
							<td>
								<label><input type="radio" name="sch_flag_receive_sms" class="" value="" title="전체">전체</label>
								<label><input type="radio" name="sch_flag_receive_sms" class="" value="Y" title="수신">수신</label>
								<label><input type="radio" name="sch_flag_receive_sms" class="" value="N" title="거부">거부</label>
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
			<table class="list_table border" id="search_list" summary="고객선택에 관련된 표로써 No, 이름, 성별, 휴대폰(수신여부), 등급, 담당자 등 순으로 출력됩니다.">
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
				</tbody>
			</table>
		</div>
	</div>
	<!-- //left -->

	<!-- center -->
	<div class="centerArea">
		<ul>
			<li><button type="button" class="sButton small" onclick="addToSelectedList()">추가 +</button></li>
			<li><button type="button" class="sButton small" onclick="deleteFromSelectedList()">삭제 -</button></li>
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
			<table class="list_table border" id="selected_list" summary="고객선택에 관련된 표로써 No, 이름, 성별, 휴대폰(수신여부), 등급, 담당자 등 순으로 출력됩니다.">
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
				</tbody>
			</table>
		</div>
	</div>
	<!-- //right -->
</div>

<!-- btn_layer -->
<div class="btn_layer">
	<button type="button" class="sButton active" onclick="closeLayerPopup()">취소</button>
	<button type="button" class="sButton primary" onclick="completeSelect(this)">선택완료</button>
</div>
<!-- //btn_layer -->
<script>
	$(function() {
		loadFromSelectedList();
	});
</script>