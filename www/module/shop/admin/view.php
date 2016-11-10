<?
if(!defined('_INPLUS_')) { exit; } 

/* init Class */
$oShop = new ShopAdmin();
$oShop->init();
$module_name = $oShop->get('module_name');	// 모듈명

/* update */
$pk = $oShop->get('pk');
$uid = $_GET['sh_code'];
$data = $oShop->selectDetail($uid);
$file_list = $data['file_list'];
$max_file = $oShop->get('max_file');

/* addr */
$sido_arr = selectSido();
if($data['sh_sido']) {
	$sigungu_arr = selectSigungu($data['sh_sido']);
}

if($data['sh_sido'] && $data['sh_sigungu']) {
	$dong_arr = selectDong($data['sh_sido'], $data['sh_sigungu']);
}

$time_table_arr = getTimeTableArray();
?>
<script type="text/javascript">
//<![CDATA[
$(document).ready(function() {
	$("#sh_sido").on("change", function(e) {
		changeSigungu($(this).val());
	});	

	$("#sh_sigungu").on("change", function(e) {
		changeDong($("#sh_sido").val(), $(this).val());
	});	
});

// 원본 주소
var pre_addr = "<?=$data['txt_addr']?>";
//]]>
</script>

<div id="<?=$module?>">

	<div class="write">
		
		<form name="write_form" method="post" action="./process.html" onsubmit="return submitWriteForm(this);" enctype="multipart/form-data" autocomplete="off">
		<input type="hidden" name="mode" value="update" />	
		<input type="hidden" name="<?=$pk?>" value="<?=$uid?>" />
		<input type="hidden" name="sh_lat" value="<?=$data['sh_lat']?>" />
		<input type="hidden" name="sh_lng" value="<?=$data['sh_lng']?>" />
		<input type="hidden" name="sh_state" value="<?=$data['sh_state']?>" />

		<table class="write_table" border="1">
		<caption>등록/수정</caption>
		<colgroup>
		<col width="140" />
		<col width="*" />
		</colgroup>
		<tbody>
		<?
		printTr('가맹점코드', $uid.' (자동생성)');
		printTr('상호', $data['sh_name']); 
		?>
		<? for($i = 0 ; $i < $max_file ; $i++) { ?>
		<tr<? if($file_list[$i]['file_id']) { ?> class="file"<? } ?>>
			<th>대표이미지</th>
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
		<tr>
			<th class="required">영업시간</th>
			<td><?=$data['open_time']?>~<?=$data['close_time']?></td>
		</tr>
		<? printTr('휴무일', $data['sh_holiday']); ?>
		<tr class="addr">
			<th class="required">주소</th>
			<td><?=$data['sh_sido']?>			
				<?=$data['sh_sigungu']?>
				<?=$data['sh_dong']?>
				<br />
				<?=$data['sh_addr2']?>
			</td>	
		</tr>
		<?
		printTr('연락처', $data['sh_tel']);		
		?>		
		</tbody>
		</table>
		</fieldset>

		<p class="button">
			<a href="./list.html?page=<?=$page?><?=$query_string?>" class="sButton active" title="목록">목록</a>
		</p>

		</form>
	</div>
</div>
