<?
if(!defined('_INPLUS_')) { exit; } 

/* set URI */
$this_uri = '/webadmin/application/list.html';

/* init Class */
$oApplication = new ApplicationAdmin();
$oApplication->init();
$module_name = $oApplication->get('module_name');	// 모듈명

/* search condition */
$query_string = $oApplication->get('query_string');
$page = $oApplication->get('page');

/* insert or update */
$pk = $oApplication->get('pk');
$uid = $oApplication->get('uid');
$data = $oApplication->selectDetail($uid);

if($data[$pk]) {
	$mode = 'update';
	$file_list = $data['file_list'];
}
else {
	$mode = 'insert'; 	
}

/* addr */
$sido_arr = selectSido();
if($data['ap_sido']) {
	$sigungu_arr = selectSigungu($data['ap_sido']);
}

if($data['ap_sido'] && $data['ap_sigungu']) {
	$dong_arr = selectDong($data['ap_sido'], $data['ap_sigungu']);
}

/* state */
$ap_state_arr = $oApplication->get('ap_state_arr');

$max_file = $oApplication->get('max_file');
?>
<script type="text/javascript">
//<![CDATA[
$(document).ready(function() {
	$("#ap_sido").on("change", function(e) {
		changeSigungu($(this).val());
	});	

	$("#ap_sigungu").on("change", function(e) {
		changeDong($("#ap_sido").val(), $(this).val());
	});	
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
		<tr>
			<th>코드</th>
			<td>
				<strong><?=$uid?></strong>
			</td>
		</tr>		
		<tr>
			<th class="required">신청자</th>
			<td><?=$data['ap_name']?></td>
		</tr>
		<tr>
			<th class="required">업체명</th>
			<td><?=$data['ap_shop_name']?></td>
		</tr>
		<tr>
			<th class="required">주소</th>
			<td>	
				<?=$data['ap_sido']?>
				<?=$data['ap_sigungu']?>
				<?=$data['ap_dong']?>
			</td>	
		</tr>
		<?
		printTr('연락처', $data['ap_tel']);
		printTr('이메일', $data['ap_email']);		
		printTr('요청이유', $data['ap_memo']);
		?>		
		<tr>
			<th>진행여부</th>
			<td>
				<? foreach($ap_state_arr as $key => $val) {
					if($key == $data['ap_state']) { $state_class = $data['state_class']; }
					else { $state_class = 'disabled'; }
				?>
				<a href="./process.html?mode=update_state&<?=$pk?>=<?=$uid?>&ap_state=<?=$key?>" class="sButton tiny <?=$state_class?> btn_confirm btn_change" title="<?=$val?>"><?=$val?></a>
				<? } ?>
			</td>
		</tr>
		<tr>
			<th>신청일시</th>
			<td>	
				<?=$data['reg_time']?>
			</td>	
		</tr>
		</tbody>
		</table>
		</fieldset>

		<p class="button">
			<a href="./list.html?page=<?=$page?><?=$query_string?>" class="sButton active" title="목록">목록</a>
		</p>

		</form>
	</div>
</div>
