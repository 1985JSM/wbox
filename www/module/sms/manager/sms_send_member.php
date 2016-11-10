<h4>대상 고객 선택</h4>
<div class="selectArea">
	<label><input type="radio" name="chk_sort" class="" value="chk_sort_direct" title="고객 직접 선택">고객 직접 선택</label>
	<label><input type="radio" name="chk_sort" class="" value="chk_sort_level" title="고객 등급 선택">고객 등급 선택</label>
	<label><input type="radio" name="chk_sort" class="" value="chk_sort_all" title="전체 고객 발송">전체 고객 발송</label>
	<label><input type="radio" name="chk_sort" class="" value="chk_sort_staff"  title="담당자별 고객">담당자별 고객</label>
	<label><input type="radio" name="chk_sort" class="" value="chk_sort_reservation" title="예약 고객">예약 고객</label>
	<p><strong>* 수신동의여부</strong> : <label><input type="checkbox" name="filter_vetoer" value="1" class="checkbox" title="수신동의한 고객에게만 발송" /> 수신동의한 고객에게만 발송</label></p>
</div>

<!-- 고객 직접 선택시 출력 -->
<div class="member_option" id="chk_sort_direct" style="display: none;">
	고객 직접 선택 : <a href="lyr.customer_selector.html" target="#layer_popup" title="고객선택" id="member_select_link" class="sButton small info active btn_ajax size_1200x750">선택하기</a>

	<span class="num">선택된 고객수 : <strong class="primary">0명</strong> (수신거부 대상자 <strong class="rejectCount">0</strong>명 포함)</span>
	<br />
	<span class="info">- 버튼을 클릭하여 고객을 선택해주세요.</span>
	<table class="list_table border" id="selected_list" style="display:none;">
		<tbody>
		</tbody>
	</table>
</div>
<!-- //고객 직접 선택시 출력 -->
<!-- 고객 등급 선택시 출력 -->
<div class="member_option" id="chk_sort_level" style="display: none;">
	고객 등급 선택 :
	<select name="sch_cs_level" class="select" title="">
		<option value="">등급</option>
		<? printSelectOption($cs_level_arr, "", 1); ?>
	</select>

	<span class="num">선택된 고객수 : <strong class="primary">0명</strong></span>
	<br />
	<span class="info">- 고객 등급을 선택해주세요.</span>
</div>
<!-- //고객 등급 선택시 출력 -->
<!-- 전체 고객 발송 선택시 출력 -->
<div class="member_option" id="chk_sort_all" style="display: none;">
	전체고객 발송 : 발송인원 총 <strong class="primary">0명</strong>
	<span class="info">- 전체 고객에게 메시지가 발송됩니다.</span>
</div>
<!-- //전체 고객 발송 선택시 출력 -->
<!-- 담당자별 고객 선택시 출력 -->
<div class="member_option" id="chk_sort_staff" style="display: none;">
	담당자별 고객 선택 :
	<select name="sch_st_id" class="select" title="">
		<option value="">담당자</option>
		<? printSelectOption($st_id_arr, "", 1); ?>
	</select>

	<span class="num">선택된 고객수 : <strong class="primary">0명</strong></span>
	<br />
	<span class="info">- 담당자를 선택해주세요.</span>
</div>
<!-- //담당자별 고객 선택시 출력 -->
<!-- 예약 고객 선택시 출력 -->
<div class="member_option" id="chk_sort_reservation" style="display: none;">
	예약 고객 선택 :
	<select name="chk_selected_num" class="select" title="">
		<option value="">선택</option>
		<option value="1">예약 1회</option>
		<option value="2">예약 2회</option>
		<option value="3">예약 3회</option>
		<option value="4">예약 4회</option>
		<option value="5">예약 5회</option>
		<option value="6">예약 6회</option>
		<option value="7">예약 7회</option>
		<option value="8">예약 8회</option>
		<option value="9">예약 9회</option>
		<option value="big">예약 10회이상</option>
	</select>

	<span class="num">선택된 고객수 : <strong class="primary">0명</strong></span>
	<br />
	<span class="info">- 예약횟수를 선택해주세요.</span>
</div>
<!-- //예약 고객 선택시 출력 -->