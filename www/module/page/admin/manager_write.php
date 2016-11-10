<?
if(!defined('_INPLUS_')) { exit; } 
/* set URI */
$layout_size = 'tiny';
$doc_title = '가맹점관리자';
?>


<!-- <?=$module?> -->
<div id="<?=$module?>">

	<div class="write">

		<form name="" method="" action="" onsubmit="" enctype="" autocomplete="">
		<fieldset>
		<legend>검색관련</legend>
		<input type="hidden" name="mode" value="<?=$mode?>" />	
		<input type="hidden" name="page" value="<?=$page?>" />
		<input type="hidden" name="query_string" value="<?=$query_string?>" />
		</fieldset>
		
		<fieldset>
		<legend>등록/수정</legend>	
		<h4>기본정보</h4>		
		<table class="write_table" border="1">
		<caption>등록/수정</caption>
		<colgroup>
		<col width="140" />
		<col width="*" />
		</colgroup>
		<tbody>
		<tr>
			<th>아이디</th>
			<td><strong>goeunqpx</strong></td>		
		</tr>
		<tr>
			<th>비밀번호</th>
			<td>
				<input type="password" name="" value="" class="text" size="30" maxlength="20" title="비밀번호" />
				<br />
				<span class="comment">-비밀번호 20자 이하의 영대/소문자, 숫자, 특수숫자만 입력 가능합니다.</span>
			</td>
		</tr>
		<tr>
			<th>비밀번호 확인</th>
			<td>
				<input type="password" name="" value="" class="text" size="30" maxlength="20" title="비밀번호 확인" />				
			</td>
		</tr>
		<tr>
			<th>가맹점</th>
			<td>어썸뷰티</td>
		</tr>
		<tr>
			<th>담당자명</th>
			<td>goeunqpx</td>
		</tr>
		<tr>
			<th>이메일</th>
			<td>goeunqpx</td>
		</tr>
		<tr>
			<th>휴대폰</th>
			<td>010-6322-8821</td>
		</tr>
		<tr>
			<th>최근접속</th>
			<td>-</td>
		</tr>		
		</tbody>
		</table>
		</fieldset>



		<p class="button">
			<button type="submit" class="sButton primary">확인</button>
			<a href="/webadmin/manager/list.html" class="sButton active" title="목록">목록</a>			
			<a href="#" id="btn_delete" class="sButton warning" title="즉시탈퇴처리">삭제</a>
		</p>

		</form>
	</div>
</div>
<!-- //<?=$module?> -->


