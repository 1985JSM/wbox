<?
if(!defined('_INPLUS_')) { exit; } 

/* set URI */
$this_uri = '/webadmin/event/list.html';

/* init Class */
$oEvent = new EventAdmin();
$oEvent->init();
$module_name = $oEvent->get('module_name');	// 모듈명

/* search condition */
$query_string = $oEvent->get('query_string');
$page = $oEvent->get('page');

/* insert or update */
$pk = $oEvent->get('pk');
$uid = $oEvent->get('uid');
$data = $oEvent->selectDetail($uid);

if($data[$pk]) {
	$mode = 'update';	
}
else {
	$mode = 'insert';
	$data = array(
		'bo_display'	=> 'U',
		'bo_state'		=> 'Y'
	);
}

// file
$file_list = $data['file_list'];
$max_file = $oEvent->get('max_file');
$main_img = $data['main_img'];
$sub_img = $data['sub_img'];

// code
$bo_state_arr = $oEvent->get('bo_state_arr');
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
		<col width="140" />
		<col width="*" />
		</colgroup>
		<tbody>	
		<tr>
			<th class="required">이벤트명</th>
			<td colspan="3"><input type="text" name="bo_subject" value="<?=$data['bo_subject']?>" class="text required" size="120" maxlength="50" title="이벤트명" /></td>
		</tr>
		<tr>
			<th class="required">이벤트시작일</th>
			<td><input type="text" name="bo_s_date" value="<?=$data['bo_s_date']?>" class="text date required" size="15" maxlength="10" title="이벤트시작일" /></td>
			<th class="required">이벤트종료일</th>
			<td><input type="text" name="bo_e_date" value="<?=$data['bo_e_date']?>" class="text date required" size="15" maxlength="10" title="이벤트종료일" /></td>
		</tr>
		<tr>
			<th class="required">진행여부</th>
			<td colspan="3">
				<? printRadio('bo_state', $bo_state_arr, $data['bo_state'], 1); ?>			
			</td>
		</tr>
		<tr>
			<th class="required">내용</th>
			<td colspan="3">
				<textarea name="bo_content" class="textarea required" rows="10" cols="120" title="내용"><?=$data['bo_content']?></textarea>	
			</td>
		</tr>	
		<tr<? if($main_img['file_id']) { ?> class="file"<? } ?>>
			<th class="required">배너이미지<br />(600x160)</th>
			<td colspan="3">	
				<input type="hidden" name="file_type[]" value="main" />
				<input type="file" name="wr_file[]" value="" class="file" size="80" title="배너이미지" />
				<? if($main_img['file_id']) { ?>
				<br />
				<input type="checkbox" name="del_file[]" id="del_file_<?=$i?>" value="<?=$main_img['file_id']?>" title="파일삭제" />
				<label for="del_file_<?=$i?>">기존파일삭제</label>
				<span>|</span>				
				<?=$main_img['file_name']?>
				(<?=$main_img['size']?>)
				<?=$main_img['btn_download']?>
				<? } ?>
			</td>
		</tr>
		<tr<? if($sub_img['file_id']) { ?> class="file"<? } ?>>
			<th class="required">상세이미지<br />(가로:640px)</th>
			<td colspan="3">	
				<input type="hidden" name="file_type[]" value="sub" />
				<input type="file" name="wr_file[]" value="" class="file" size="80" title="배너이미지" />
				<? if($sub_img['file_id']) { ?>
				<br />
				<input type="checkbox" name="del_file[]" id="del_file_<?=$i?>" value="<?=$sub_img['file_id']?>" title="파일삭제" />
				<label for="del_file_<?=$i?>">기존파일삭제</label>
				<span>|</span>				
				<?=$sub_img['file_name']?>
				(<?=$sub_img['size']?>)
				<?=$sub_img['btn_download']?>
				<? } ?>
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
