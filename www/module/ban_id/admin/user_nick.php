<?
if(!defined('_INPLUS_')) { exit; } 

/* init Class */
$oBanId = new BanIdAdmin();
$oBanId->init();
$module_name = $oBanId->get('module_name');	// 모듈명

/* insert or update */
$pk = $oBanId->get('pk');
$uid = 'user_nick';

$data = $oBanId->selectDetail($uid);
$mode = 'update';
?>
<script type="text/javascript">
//<![CDATA[
$(document).ready(function() {

});
//]]>
</script>

<div id="<?=$module?>">

	<div class="write">

		
		
		<form name="write_form" method="post" action="./process.html" onsubmit="return submitWriteForm(this);" enctype="multipart/form-data" autocomplete="off">
		
		<fieldset>
		<legend>등록/수정</legend>	
		<input type="hidden" name="mode" value="<?=$mode?>" />	
		<input type="hidden" name="<?=$pk?>" value="<?=$uid?>" />
				
		<table class="write_table" border="1">
		<caption>등록/수정</caption>
		<colgroup>
		<col width="140" />
		<col width="*" />
		</colgroup>
		<tbody>
		<tr>
			<th class="required">사용불가<br /> 닉네임</th>
			<td>
				<textarea name="ban_ids" class="textarea" rows="10" cols="100" title="내용" maxlength="100" ><?=$data['ban_ids']?></textarea>
				<br />
				<span class="comment">
				- 입력된 단어가 포함된 경우 <strong class="info">회원의 닉네임으로 사용할 수 없습니다.</strong> (예. 사과 등록시, 사과가 들어간 모든 단어 사용 불가) <br />
				- 단어와 단어 사이는 ,(콤마)로 구분합니다. </span>
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
