<?
if(!defined('_INPLUS_')) { exit; } 

/* set URI */
$referer_arr = array(
	'/reserve/list_by_wait.html',
	'/reserve/list_by_finish.html',
	'/reserve/list_by_cancel.html'
);
$back_url = getRefererInArray($referer_arr);
$url_arr = explode('?', $back_url);
$this_uri = str_replace('http://'.$_SERVER['HTTP_HOST'], '', $url_arr[0]);

/* init Class */
$oReserve = new ReserveAdmin();
$oReserve->init();
$module_name = $oReserve->get('module_name');	// 모듈명

/* search condition */
$query_string = $oReserve->get('query_string');
$page = $oReserve->get('page');

/* insert or update */
$pk = $oReserve->get('pk');
$uid = $oReserve->get('uid');
$data = $oReserve->selectDetail($uid);

if($data[$pk]) {
	$mode = 'update';
	$file_list = $data['file_list'];
}
else {
	$mode = 'insert'; 
	$data = array(
		'mb_id'		=> 'inplus',
		'mb_pass'	=> 'a1234',
		'mb_name'	=> '인플러스',
		'mb_level'	=> 7,
		'auth_code'	=> 'shop|member|contents'
	);
}
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
		<?
		printTr('이름', $data['us_name']); 
		printTr('휴대폰', $data['us_hp']);
		?>		
		</tr>	
		
		</tbody>
		</table>
		</fieldset>

		<p class="button">
			<a href="<?=$this_uri?>?page=<?=$page?><?=$query_string?>" class="sButton active" title="목록">목록</a>
		</p>

		</form>
	</div>
</div>
