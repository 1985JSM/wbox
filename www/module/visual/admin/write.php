<?
if(!defined('_INPLUS_')) { exit; } 

/* set URI */
$this_uri = '/webadmin/visual/list.html';

/* init Class */
$oVisual = new VisualAdmin();
$oVisual->init();
$module_name = $oVisual->get('module_name');	// 모듈명

/* search condition */
$query_string = $oVisual->get('query_string');
$page = $oVisual->get('page');

/* insert or update */
$pk = $oVisual->get('pk');
$uid = $oVisual->get('uid');
$data = $oVisual->selectDetail($uid);

$vs_display_arr = $oVisual->get('vs_display_arr');

if($data[$pk]) {
	$mode = 'update';
	$file_list = $data['file_list'];
}
else {
	$mode = 'insert';	

	$data = array(
		'vs_display'	=> 'Y'
	);
}

$max_file = $oVisual->get('max_file');
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
		<tbody id="write_tbody" class="vs_type_<?=$data['vs_type']?>">
		<?
		printWriteInput('제목', 'vs_subject', $data['vs_subject'], 'required', 80, 60); 
		for($i = 0 ; $i < $max_file ; $i++) { ?>
		<tr<? if($file_list[$i]['file_id']) { ?> class="file"<? } ?>>
			<th class="required">사진</th>
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
			<th>추천가맹점</th>
			<td>
				<input type="hidden" name="sh_code" value="<?=$data['sh_code']?>" />
				<input type="text" name="sh_name" value="<?=$data['sh_name']?>" class="text readonly" size="50" title="추천가맹점" />
				<a href="../shop/ajax.reco_list.html" class="btn_ajax size_800x700 sButton small info" target="#layer_popup" title="추천가맹점 선택">가맹점선택</a>
				<button type="button" onclick="deleteRecoShop()" class="sButton small" title="추천가맹점 삭제">가맹점삭제</button>
				<span class="comment">- 메인 비주얼에 노출될 가맹점을 선택할 수 있습니다.<br />
				- 메인 비주얼에 노출된 가맹점은 가맹점 정보를 바로 확인할 수 있도록 링크가 연결됩니다.</span>
			</td>
		</tr>
		<tr>
			<th class="required">노출여부</th>
			<td>
				<? printRadio('vs_display', $vs_display_arr, $data['vs_display'], 1); ?>
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
