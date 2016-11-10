<?
if(!defined('_INPLUS_')) { exit; } 

/* set URI */
$layout_size = 'tiny';
$doc_title = '비밀번호변경';
?>

<style type="text/css">
div.section_pwconfirm {padding:30px 40px 40px; border:1px solid #dadada; background:#f5f5f5;}
div.section_pwconfirm div.box {}
p.comment {font-size:11px; color:#777; margin-top:.75em;}
</style>

<div id="<?=$module?>">

	<div class="write">
	
		<form name="" method="" action="" onsubmit="">

		<fieldset>
		<legend>검색관련</legend>
		<input type="hidden" name="mode" value="check_sales_password" />
		<input type="hidden" name="return_url" value="<?=$return_url?>" />
		</fieldset>

		<div class="section_pwconfirm">
			<div class="box">
				<h4>비밀번호 확인</h4>
				<p>가맹점 관리자 홈페이지의 <span class="info">관리자 비밀번호를 변경</span>합니다.<br />정보를 안전하게 보호하기 위해 비밀번호를 다시 한 번 확인 합니다.</p>
				<p class="comment"><span class="icon tip_info"></span>회원님의 비밀번호는 타인에게 노출되지 않도록 주의해 주세요.</p>
			</div>			
		</div>

		<fieldset class="etc">
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
			<td>peg1234	</td>
		</tr>
		<tr>
			<th class="required">비밀번호</th>
			<td>
				<input type="password" name="mb_pass" value="" class="text" size="30" maxlength="20" title="비밀번호" />	
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
