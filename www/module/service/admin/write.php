<?
if(!defined('_INPLUS_')) { exit; } 

/* set URI */
$this_uri = '/webadmin/service/list.html';

/* init Class */
$oService = new ServiceAdmin();
$oService->init();
$module_name = $oService->get('module_name');	// 모듈명

/* search condition */
$query_string = $oService->get('query_string');
$page = $oService->get('page');

/* insert or update */
$pk = $oService->get('pk');
$uid = $oService->get('uid');
$data = $oService->selectDetail($uid);

if($data[$pk]) {
	$mode = 'update';
	$file_list = $data['file_list'];
}
else {
	$mode = 'insert';	
}

$max_file = $oService->get('max_file');
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
		<?
		printWriteInput('서비스명', 'sv_name', $data['sv_name'], 'required', 40, 20); 
		?>
		<tr>
			<th class="required">시간</th>
			<td>
				<select name="sv_time" class="select required" title="시간">
				<? printSelectOption($oService->get('sv_time_arr'), $data['sv_time'], 1); ?>
				</select>
			</td>
		</tr>
		<tr>
			<th class="required">가격(일반가)</th>
			<td>
				<input type="text" name="sv_normal_price" class="text money" value="<?=number_format($data['sv_normal_price'])?>" size="15" maxlength="10" title="가격(일반가)" />원
			</td>
		</tr>
		<tr>
			<th class="required">가격(할인가)</th>
			<td>
				<input type="text" name="sv_sale_price" class="text money" value="<?=number_format($data['sv_sale_price'])?>" size="15" maxlength="10" title="가격(할인가)" />원
			</td>
		</tr>
		<?
		printWriteTextarea('내용', 'sv_content', $data['sv_content'], 'required', '5', '80');
		?>
		<? for($i = 0 ; $i < $max_file ; $i++) { ?>
		<tr<? if($file_list[$i]['file_id']) { ?> class="file"<? } ?>>
			<th>사진</th>
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
		</tbody>
		</table>
		</fieldset>

		<p class="button">
			<button type="submit" class="sButton primary">확인</button>
			<a href="./list.html?page=<?=$page?><?=$query_string?>" class="sButton active" title="목록">목록</a>
			<? if($mode == 'update') { ?>
			<a href="./process.html?mode=delete&<?=$pk?>=<?=$uid?>&page=<?=$page?><?=$query_string?>" id="btn_delete" class="sButton" title="삭제">삭제</a>
			<? } ?>
		</p>

		</form>
	</div>
</div>
