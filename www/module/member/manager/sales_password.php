<?
if(!defined('_INPLUS_')) { exit; } 

$this_uri = '/webmanager/reserve/sales_list.html';

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
		<!--p style="height:100px; font-size:36px; font-weight:bold; color:red;">이 페이지는 추가적인 화면 설계/구현이 필요합니다.</p-->
		
		<form name="sales_password_form" method="post" action="./process.html" onsubmit="return submitSalesPasswordForm(this);">

		<fieldset>
		<legend>검색관련</legend>
		<input type="hidden" name="mode" value="check_sales_password" />
		<input type="hidden" name="return_url" value="<?=$return_url?>" />
		</fieldset>

		<div class="section_pwconfirm">
			<div class="box">
				<h4>매출비밀번호 확인</h4>
				<p>매출내역은 아래의 비밀번호 인증 후 확인가능합니다.</p>
				<p class="comment"><span class="icon tip_info"></span>최초 비밀번호는 가맹점 관리자 모드 접속 비밀번호와 동일하며, 비밀번호 변경은 <a href="/webmanager/member/sales_auth.html" target="_self" title="정산권한관리" class="info">[정산권한관리]</a>에서 가능합니다.</p>
			</div>

			<div>
				<input type="password" name="sales_pw" value="" class="text required placeholder sales_pwconfirm" size="30" maxlength="20" title="매출확인 비밀번호" /> <button type="submit" class="sButton primary small">확인</button>
			</div>

			
		</div>

		<!--fieldset>
		<legend>등록/수정</legend>	
		
		<table class="write_table" border="1">
		<caption>등록/수정</caption>
		<colgroup>
		<col width="200" />
		<col width="*" />
		</colgroup>
		<tbody>		
		<tr>
			<th class="required">매출확인 비밀번호</th>
			<td>
											
			</td>
		</tr>
		</tbody>
		</table>
		</fieldset-->

		

		</form>
	</div>
</div>
