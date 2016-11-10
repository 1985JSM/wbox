<?
if(!defined('_INPLUS_')) { exit; } 

/* set URI */
$this_uri = '/webadmin/manager/list.html';

/* init Class */
$oManager = new ManagerAdmin();
$oManager->init();
$module_name = $oManager->get('module_name');	// 모듈명

/* search condition */
$query_string = $oManager->get('query_string');
$page = $oManager->get('page');

/* insert or update */
$pk = $oManager->get('pk');
$uid = $oManager->get('uid');
$data = $oManager->selectDetail($uid);

if(!$data[$pk]) {
	alert('비정상적인 접근입니다.', './list.html');
}

$max_file = $oManager->get('max_file');
$file_list =$data['file_list'];
?>
<script type="text/javascript">
//<![CDATA[
$(document).ready(function() {

});
//]]>
</script>

<div id="<?=$module?>">

	<div class="write">

		<h4>기본사항</h4>

		<form name="password_form" method="post" action="./process.html" onsubmit="return submitPasswordForm(this);">
		<fieldset>
		<legend>검색관련</legend>
		<input type="hidden" name="mode" value="update_password" />	
		<input type="hidden" name="page" value="<?=$page?>" />
		<input type="hidden" name="query_string" value="<?=$query_string?>" />
		</fieldset>

		<fieldset>
		<legend>등록/수정</legend>	
		<input type="hidden" name="<?=$pk?>" value="<?=$uid?>" />
				
		<table class="write_table" border="1">
		<caption>등록/수정</caption>
		<colgroup>
		<col width="140" />
		<col width="*" />
		</colgroup>
		<tbody>
		<tr>
			<th>아이디</th>
			<td><strong><?=$data['mb_id']?></strong></td>		
		</tr>
		<tr>
			<th>비밀번호</th>
			<td>
				<input type="password" name="mb_pass" value="" class="text required" size="30" maxlength="20" title="비밀번호" />
				<br />
				<span class="comment">-비밀번호 20자 이하의 영대/소문자, 숫자, 특수숫자만 입력 가능합니다.</span>
			</td>
		</tr>
		<tr>
			<th>비밀번호 확인</th>
			<td>
				<input type="password" name="mb_pass2" value="" class="text required" size="30" maxlength="20" title="비밀번호 확인" />				
			</td>
		</tr>
		<tr>
			<th>가맹점</th>
			<td><?=$data['sh_name']?></td>
		</tr>
		<tr>
			<th>담당자명</th>
			<td><?=$data['mb_id']?></td>
		</tr>
		<tr>
			<th>이메일</th>
			<td><?=$data['mb_email']?></td>
		</tr>
		<tr>
			<th>휴대폰</th>
			<td><?=$data['mb_hp']?></td>
		</tr>
		<tr>
			<th>최근접속</th>
			<td><?=getWithoutNull($data['mb_login_time'])?></td>
		</tr>		
		<? for($i = 0 ; $i < sizeof($file_list) ; $i++) { ?>
		<tr>
			<th>첨부파일 #<?=$i+1?></th>
			<td>					
				<?=$file_list[$i]['file_name']?>
				(<?=$file_list[$i]['size']?>, <?=$file_list[$i]['down']?>회)
				<?=$file_list[$i]['btn_download']?>
			</td>
		</tr>
		<? } ?>
		</tbody>
		</table>

		<p class="button">
			<button type="submit" class="sButton primary">확인</button>
			<a href="./list.html?page=<?=$page?><?=$query_string?>" class="sButton active" title="목록">목록</a>
		</p>

		</form>
	</div>
</div>
