<?
if(!defined('_INPLUS_')) { exit; } 

/* set URI */
$this_uri = '/webmanager/portfolio/list.html';

/* init Class */
$oPortfolio = new PortfolioManager();
$oPortfolio->init();
$module_name = $oPortfolio->get('module_name');	// 모듈명

/* search condition */
$query_string = $oPortfolio->get('query_string');
$page = $oPortfolio->get('page');

/* insert or update */
$pk = $oPortfolio->get('pk');
$uid = $oPortfolio->get('uid');
$data = $oPortfolio->selectDetail($uid);

if($data[$pk]) {
	$mode = 'update';
	$file_list = $data['file_list'];
}
else {
	$mode = 'insert';
	$uid = makeTimecode();
}

$max_file = $oShop->get('max_file');
$main_img = $data['main_img'];
$sub_img = $data['sub_img'];

/* staff */
if(!isset($oStaff)) {
	include_once(_MODULE_PATH_.'/staff/staff.user.class.php');
	$oStaff = new StaffUser();
	$oStaff->init();
}
$staff_list = $oStaff->selectStaffByShopCode($member['sh_code']);
?>
<script type="text/javascript">
//<![CDATA[
$(document).ready(function() {

});
//]]>
</script>

<div id="<?=$module?>">

	<div class="write">

		<h4><?=$module_name?> 등록/수정</h4>
		
		<form name="write_form" method="post" action="./process.html" onsubmit="return submitWriteForm(this);" enctype="multipart/form-data" autocomplete="off">
		<fieldset>
		<legend>검색관련</legend>
		<input type="hidden" name="mode" value="<?=$mode?>" />	
		<input type="hidden" name="page" value="<?=$page?>" />
		<input type="hidden" name="query_string" value="<?=$query_string?>" />
		<input type="hidden" name="sh_code" value="<?=$member['sh_code']?>" />
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
		printWriteInput('제목', 'pf_subject', $data['pf_subject'], 'required', 80, 30); 
		?>
		<tr>
			<th class="required">담당자</th>
			<td>
				<select name="st_id" class="select required" title="담당자">
				<option value="">선택</option>
				<? printSelectOption($staff_list, $data['st_id'], 1); ?>
				</select>
			</td>
		</tr>
		<?
		printWriteTextarea('내용', 'pf_content', $data['pf_content'], 'required', '5', '80');
		?>
		<tr<? if($main_img['file_id']) { ?> class="file"<? } ?>>
			<th class="required">대표이미지<br />(640x380)</th>
			<td>	
				<input type="hidden" name="file_type[]" value="main" />
				<input type="file" name="wr_file[]" value="" class="file" size="80" title="대표이미지" />
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
		<? for($i = 0 ; $i < $max_file - 1 ; $i++) { ?>
		<tr<? if($sub_img[$i]['file_id']) { ?> class="file"<? } ?>>
			<th>서브이미지<?=$i+1?><br />(636x380)</th>
			<td>	
				<input type="hidden" name="file_type[]" value="sub" />
				<input type="file" name="wr_file[]" value="" class="file" size="80" title="서브이미지<?=$i+1?>" />
				<? if($sub_img[$i]['file_id']) { ?>
				<br />
				<input type="checkbox" name="del_file[]" id="del_file_<?=$i?>" value="<?=$sub_img[$i]['file_id']?>" title="파일삭제" />
				<label for="del_file_<?=$i?>">기존파일삭제</label>
				<span>|</span>				
				<?=$sub_img[$i]['file_name']?>
				(<?=$sub_img[$i]['size']?>)
				<?=$sub_img[$i]['btn_download']?>
				<? } ?>
			</td>
		</tr>
		<? } ?>
		<tr>
			<th class="required">태그</th>
			<td>
				<input type="text" name="pf_tags" value="<?=$data['pf_tags']?>" class="text required" size="80" maxlength="250" title="태그" />
				<br />
				<span class="comment">- 쉼표(,)로 구분되며 샵(#)은 입력하실 필요가 없습니다.</span>
			</td>
		</tr>
		</tbody>
		</table>
		</fieldset>

		<p class="button">
			<button type="submit" class="sButton primary">확인</button>
			<a href="./view.html?<?=$pk?>=<?=$uid?>&page=<?=$page?><?=$query_string?>" class="sButton active" title="취소">취소</a>
			<? if($mode == 'update') { ?>
			<a href="./process.html?mode=delete&<?=$pk?>=<?=$uid?>&page=<?=$page?><?=$query_string?>" id="btn_delete" class="sButton" title="삭제">삭제</a>
			<? } ?>
		</p>

		</form>
	</div>
</div>
