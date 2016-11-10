<?
if(!defined('_INPLUS_')) { exit; } 

/* set URI */
$this_uri = '/webadmin/notice/list.html';

/* init Class */
$oNotice = new NoticeAdmin();
$oNotice->init();
$module_name = $oNotice->get('module_name');	// 모듈명

/* search condition */
$query_string = $oNotice->get('query_string');
$page = $oNotice->get('page');

/* insert or update */
$pk = $oNotice->get('pk');
$uid = $oNotice->get('uid');
$data = $oNotice->selectDetail($uid);

if($data[$pk]) {
	$mode = 'update';
	$file_list = $data['file_list'];
}
else {
	$mode = 'insert'; 
}

$max_file = $oNotice->get('max_file');
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
		<input type="hidden" name="mb_level" value="9" />		
		
		<table class="write_table" border="1">
		<caption>등록/수정</caption>
		<colgroup>
		<col width="140" />
		<col width="*" />
		</colgroup>
		<tbody>	
		<tr>
			<th class="required">제목</th>
			<td><input type="text" name="" value="" class="text required" size="122" maxlength="50" title="제목" /></td>
		</tr>
		<tr>
			<th class="required">노출 사용자<br />선택</th>
			<td>
			<input type="radio" name="" id="" class="" value="" /> <label for="">가맹점</label> 
			<input type="radio" name="" id="" class="" value="" /> <label for="">담당자</label> 	
			<input type="radio" name="" id="" class="" value="" /> <label for="">사용자</label> 	
			<input type="radio" name="" id="" class="" value="" /> <label for="">홈페이지</label> 	
			<br />
			<span class="comment">선택하신 사용자에만 <strong class="info">해당 게시물이 출력</strong>됩니다.</span>
			</td>
		</tr>
		<tr>
		<th class="required">내용</th>
			<td>
			<textarea name="" class="textarea required" rows="30" cols="120" title="내용"></textarea>	</td>
		</tr>
		<!--?
		printWriteInput('제목', 'nt_subject', $data['nt_subject'], 'required', 122, 50); 		
		printWriteTextarea('내용', 'nt_content', $data['nt_content'], 'required', '30', '120');
		?>
		<? for($i = 0 ; $i < $max_file ; $i++) { ?>
		-->
		<!--tr<? if($file_list[$i]['file_id']) { ?> class="file"<? } ?>
			<th>파일첨부 #<?=$i+1?></th>
			<td<? if($file_list[$i]['file_id']) { ?> class="file"<? } ?>>	
				<input type="hidden" name="file_type[]" value="default" />
				<input type="file" name="wr_file[]" value="" class="file" size="80" title="첨부파일" />
				<? if($file_list[$i]['file_id']) { ?>
				<br />
				<input type="checkbox" name="del_file[]" id="del_file_<?=$i?>" value="<?=$file_list[$i]['file_id']?>" title="파일삭제" />
				<label for="del_file_<?=$i?>">기존파일삭제</label>
				<span>|</span>				
				<?=$file_list[$i]['file_name']?>
				(<?=$file_list[$i]['size']?>, <?=$file_list[$i]['down']?>회)
				<?=$file_list[$i]['btn_download']?>
				<? } ?>
			</td>
		</tr>
		<? } ?>	
		-->
		
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
