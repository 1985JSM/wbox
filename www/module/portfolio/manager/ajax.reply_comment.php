<?
if(!defined('_INPLUS_')) { exit; } 

$oPortfolio = new PortfolioManager();
$oPortfolio->init();

$pk = $oPortfolio->get('pk');
$uid = $oPortfolio->get('uid');

$cmt_pk = $oPortfolio->get('comment_pk');
$cm_id = ($_POST[$cmt_pk]) ? $_POST[$cmt_pk] : $_GET[$cmt_pk];
$data = $oPortfolio->selectCommentDetail($cm_id);

/* staff */
if(!isset($oStaff)) {
	include_once(_MODULE_PATH_.'/staff/staff.manager.class.php');
	$oStaff = new StaffUser();
	$oStaff->init();
}
$staff_list = $oStaff->selectStaffByShopCode($member['sh_code']);
?>

<form name="write_comment_form" method="post" action="./process.html" onsubmit="return submitWriteCommentForm(this)">
<input type="hidden" name="mode" value="reply_comment" />
<input type="hidden" name="sh_code" value="<?=$member['sh_code']?>" />
<input type="hidden" name="page" value="<?=$page?>" />
<input type="hidden" name="query_string" value="<?=$query_string?>" />
<input type="hidden" name="<?=$pk?>" value="<?=$uid?>" />
<input type="hidden" name="<?=$cmt_pk?>" value="<?=$cm_id?>" />

<table class="write_table" border="1">
<colgroup>
<col width="100">
<col width="*">
</colgroup>
<tbody>
<tr>
	<th>담당자</th>
	<td>
		<select name="re_id" class="select required" title="담당자">
		<? printSelectOption($staff_list, $data['re_id'], 1); ?>
		</select>		
	</td>			
</tr>
<tr>
	<th>답변내용</th>
	<td>
		<textarea name="re_content" class="textarea required" rows="5" cols="40" title="답변내용"><?=$data['re_content']?></textarea>
	</td>
</tr>		
</tbody>
</table>

<p class="button">
	<button type="submit" class="sButton primary">등록</button>
	<button type="button" class="sButton active" onclick="closeLayerPopup()">닫기</button>
</p>

</form>