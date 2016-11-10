<?
if(!defined('_INPLUS_')) { exit; } 
/* set URI */
$layout_size = 'large';
$doc_title = '고객 엑셀 업로드';
?>
<style>
div.information {margin-bottom:40px; padding:15px 30px 20px 30px; border:1px solid #dadada; font-size:11px; background:#f5f5f5;}
div.information strong {font-weight:bold;}
div.information p {padding:5px 0 20px 0;}
</style>

<!-- <?=$module?> -->
<div id="<?=$module?>">

	<div class="information">
		<h4><span class="icon tip_info"></span> 도움말</h4>		
		아래 고객 목록은 등록될 고객 목록을 미리 보여줍니다.<br />
		아래 고객 목록 확인 후 등록을 원하시는 경우, 아래의 <strong class="info">[등록하기]</strong> 버튼을 클릭해주세요.		
	</div>


	<!-- list -->
	<div class="list">
		<h4>등록할 고객 목록</h4>	

		<!-- list_table -->
		<table class="list_table border odd" border="1">
		<colgroup>
		<col width="120" />		
		<col width="50" />
		<col width="130" />
		<col width="230" />
		<col width="100" />
		<col width="100" />
		<col width="70" />
		<col width="100" />
		<col width="150" />
		<col width="*" />
		</colgroup>
		<thead>
		<tr>
			<th>이름</th>
			<th>성별</th>
			<th>닉네임</th>
			<th>이메일</th>
			<th>휴대폰</th>
			<th>생년월일</th>
			<th>양력/음력</th>
			<th>가맹점등급</th>
			<th>담당자</th>
			<th>메모</th>
		</tr>
		</thead>
		<tbody>
		
		<tr class="list_tr_0">		
			<td>홍길동</td>
			<td>남</td>
			<td>예약박스</td>
			<td>box@loadlab.com</td>
			<td>01012345678</td>
			<td>1990년 01월 01일</td>
			<td>양력</td>
			<td>일반</td>
			<td>김철수 원장</td>
			<td>메모가 작성됩니다.</td>
		</tr>
		<tr class="list_tr_1">		
			<td>홍길동</td>
			<td>남</td>
			<td>-</td>
			<td>box@loadlab.com</td>
			<td>01012345678</td>
			<td>-</td>
			<td>양력</td>
			<td>일반</td>
			<td>김철수 원장</td>
			<td>-</td>
		</tr>
		<tr>
			<td colspan="10" class="no_data">검색 결과가 없습니다.</td>
		</tr>
		</tbody>
		</table>	
		<!-- //list_table -->

		<p class="button">
			<button type="submit" class="sButton primary">등록하기</button>
			<a href="#" class="sButton active" title="목록">목록</a>
		</p>
	

		

	</div>
	<!-- //list -->
</div>
<!-- //<?=$module?> -->