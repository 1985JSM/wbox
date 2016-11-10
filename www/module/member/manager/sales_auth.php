<?
if(!defined('_INPLUS_')) { exit; } 

/* init Class */
$oMember = new MemberManager();
$oMember->init();
$module_name = $oMember->get('module_name');	// 모듈명
?>
<script type="text/javascript">
//<![CDATA[
$(document).ready(function() {

});
//]]>
</script>

<div id="<?=$module?>">

	<div class="write">
		
		<form name="sales_auth_form" method="post" action="./process.html" onsubmit="return submitSalesAuthForm(this);">
		<fieldset>
		<legend>검색관련</legend>
		<input type="hidden" name="mode" value="update_sales_pw" />	
		</fieldset>

		<fieldset>
		<legend>등록/수정</legend>	
		
		<table class="write_table" border="1">
		<caption>등록/수정</caption>
		<colgroup>
		<col width="200" />
		<col width="*" />
		</colgroup>
		<tbody>
		<tr>
			<th>아이디</th>
			<td><?=$member['mb_id']?></td>
		</tr>
		<tr>
			<th class="required">로그인 비밀번호</th>
			<td>
				<input type="password" name="login_pw" value="" class="text required" size="30" maxlength="20" title="로그인 비밀번호" />				
				<br />
				<span class="comment">로그인시 사용하는 비밀번호를 입력해주세요.</span>
			</td>
		</tr>
		<tr>
			<th class="required">매출확인 비밀번호</th>
			<td>
				<input type="password" name="sales_pw" value="" class="text required" size="30" maxlength="20" title="매출확인 비밀번호" />				
				<br />
				<span class="comment">비밀번호 20자 이하의 영대/소문자, 숫자, 특수문자만 입력 가능합니다.</span>
			</td>
		</tr>
		<tr>
			<th class="required">매출확인 비밀번호 확인</th>
			<td>
				<input type="password" name="sales_pw2" value="" class="text required" size="30" maxlength="20" title="매출확인 비밀번호 확인" />		
			</td>
		</tr>
		</tbody>
		</table>
		</fieldset>

		<p class="button">
			<button type="submit" class="sButton primary">확인</button>
		</p>

		</form>
	</div>
</div>
