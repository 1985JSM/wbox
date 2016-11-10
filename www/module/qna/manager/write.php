<?
if(!defined('_INPLUS_')) { exit; } 

/* set URI */
$this_uri = '/webmanager/qna/list.html';

/* init Class */
$oQna = new QnaManager();
$oQna->init();
$module_name = $oQna->get('module_name');	// 모듈명

/* search condition */
$query_string = $oQna->get('query_string');
$page = $oQna->get('page');

/* insert or update */
$pk = $oQna->get('pk');
$uid = $oQna->get('uid');
$data = $oQna->selectDetail($uid);

if($data[$pk]) {
	$mode = 'update';
}
else {
	$mode = 'insert';	
}

// file
$file_list = $data['file_list'];
$max_file = $oQna->get('max_file');
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
		<legend>검색관련</legend>
		<input type="hidden" name="mode" value="<?=$mode?>" />	
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
			<th class="required">제목</th>
			<td><input type="text" name="bo_subject" value="<?=$data['bo_subject']?>" class="text required" size="120" maxlength="50" title="제목" /></td>
		</tr>		
		<tr>
		<th class="required">문의내용</th>
			<td>
				<textarea name="bo_content" class="textarea required" rows="20" cols="120" title="내용"><?=$data['bo_content']?></textarea>	
			</td>
		</tr>		
		</tbody>
		</table>
		</fieldset>

		<p class="button">
			<button type="submit" class="sButton primary">확인</button>
			<a href="./list.html?page=<?=$page?><?=$query_string?>" class="sButton active" title="목록">목록</a>
			<? if($mode == 'update') { ?>
			<a href="./process.html?mode=delete&<?=$pk?>=<?=$uid?>&page=<?=$page?><?=$query_string?>" id="btn_delete" class="sButton warning" title="삭제">삭제</a>
			<? } ?>
		</p>

		</form>
	</div>
</div>
