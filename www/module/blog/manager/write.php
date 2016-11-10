<?
if(!defined('_INPLUS_')) { exit; } 

/* set URI */
$this_uri = '/webmanager/blog/list.html';

/* init Class */
$oBlog = new BlogManager();
$oBlog->init();
$module_name = $oBlog->get('module_name');	// 모듈명

/* search condition */
$query_string = $oBlog->get('query_string');
$page = $oBlog->get('page');

/* insert or update */
$pk = $oBlog->get('pk');
$uid = $oBlog->get('uid');
$data = $oBlog->selectDetail($uid);

/* code */
$bl_type_arr = $oBlog->get('bl_type_arr');
$bl_display_arr = $oBlog->get('bl_display_arr');

if($data[$pk]) {
	$mode = 'update';
	$file_list = $data['file_list'];
}
else {
	$mode = 'insert';	

	$data = array(
		'bl_display'	=> 'Y'
	);
}

$max_file = $oBlog->get('max_file');
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
		<tbody id="write_tbody" class="bl_type_<?=$data['bl_type']?>">
		<?
		printWriteInput('제목', 'bl_subject', $data['bl_subject'], 'required', 100, 50); 
		printWriteInput('연결URL', 'bl_url', $data['bl_url'], 'required', 100, 100); 
		?>
		<tr>
			<th class="required">내용</th>
			<td>
				<textarea name="bl_content" class="textarea" rows="3" cols="100" title="내용" maxlength="100" ><?=$data['bl_content']?></textarea>
				<br />
				<span class="comment"><strong class="info">최대 100자</strong>까지 입력 가능합니다. </span>
			</td>
		</tr>
		<? for($i = 0 ; $i < $max_file ; $i++) { ?>
		<tr<? if($file_list[$i]['file_id']) { ?> class="file"<? } ?>>
			<th class="required">출력이미지<br />(180x180)</th>
			<td>	
				<input type="hidden" name="file_type[]" value="default" />
				<input type="file" name="wr_file[]" value="" class="file" size="80" title="첨부파일" />
				<? if($file_list[$i]['file_id']) { ?>
				<br />
				<input type="checkbox" name="del_file[]" id="del_file_<?=$i?>" value="<?=$file_list[$i]['file_id']?>" title="파일삭제" />
				<label for="del_file_<?=$i?>">기존파일삭제</label>
				<span>|</span>				
				<?=$file_list[$i]['file_name']?>
				(<?=$file_list[$i]['size']?>)
				<?=$file_list[$i]['btn_download']?>
				<? } ?>
			</td>
		</tr>
		<? } ?>	
		<tr>
			<th class="required">노출여부</th>
			<td>
				<? printRadio('bl_display', $bl_display_arr, $data['bl_display'], 1); ?>
			</td>
		</tr>
		</tbody>
		</table>
		</fieldset>

		<p class="button">
			<button type="submit" class="sButton primary">확인</button>
			<a href="./list.html?page=<?=$page?><?=$query_string?>" class="sButton active" title="목록">목록</a>
			<? if($mode == 'update') { ?>
			<a href="./process.html?mode=delete&<?=$pk?>=<?=$uid?>&page=<?=$poage?><?=$query_string?>" id="btn_delete" class="sButton" title="삭제">삭제</a>
			<? } ?>
		</p>

		</form>
	</div>
</div>
