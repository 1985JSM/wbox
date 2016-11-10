<?
if(!defined('_INPLUS_')) { exit; } 

/* set URI */
$this_uri = '/webadmin/portfolio/list.html';

/* init Class */
$oPortfolio = new PortfolioAdmin();
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

$max_file = $oPortfolio->get('max_file');

/* staff */
if(!isset($oStaff)) {
	include_once(_MODULE_PATH_.'/staff/staff.user.class.php');
	$oStaff = new StaffUser();
	$oStaff->init();
}
$staff_list = $oStaff->selectStaffCodeTotal('');
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
		printTr('제목', $data['pf_subject']); 
		?>
		<tr>
			<th>담당자</th>
			<td>
				<?=$data['pf_name']?>
			</td>
		</tr>
		<?
		printTr('내용',  $data['pf_content']);
		?>
		<? for($i = 0 ; $i < $max_file ; $i++) { ?>
		<tr<? if($file_list[$i]['file_id']) { ?> class="file"<? } ?>>
			<th>사진</th>
			<td>	
				<? if($file_list[$i]['file_id']) { ?>
				<?=$file_list[$i]['file_name']?>
				(<?=$file_list[$i]['size']?>)
				<?=$file_list[$i]['btn_download']?>
				<br />
				<? } ?>
			</td>
		</tr>
		<? } ?>				
		</tbody>
		</table>
		</fieldset>

		<p class="button">
			<a href="./list.html?page=<?=$page?><?=$query_string?>" class="sButton active" title="목록">목록</a>
		</p>

		</form>
	</div>
</div>
