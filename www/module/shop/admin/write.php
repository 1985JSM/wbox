<?
if(!defined('_INPLUS_')) { exit; } 

/* init Class */
$oShop = new ShopAdmin();
$oShop->init();
$module_name = $oShop->get('module_name');	// 모듈명

/* update */
$pk = $oShop->get('pk');
//$uid = $member['sh_code'];
$uid = $oShop->get('uid');
$data = $oShop->selectDetail($uid);
if(!$data[$pk]) {
	alert('비정상적인 접근입니다.');
}

$mode = 'update';


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
		<input type="hidden" name="mode" value="<?=$mode?>" />	
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
		printWriteInput('상호', 'sh_name', $data['sh_name'], 'required', 50, 30); 
		?>
		<? for($i = 0 ; $i < $max_file ; $i++) { ?>
		<tr<? if($file_list[$i]['file_id']) { ?> class="file"<? } ?>>
			<th>대표이미지</th>
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
			<th class="required">영업시간</th>
			<td>
				<select name="open_time" class="select required" title="오픈시간">
				<? printSelectOption($time_table_arr, $data['open_time']); ?>
				</select>
				~
				<select name="close_time" class="select required" title="마감시간">
				<? printSelectOption($time_table_arr, $data['close_time']); ?>
				</select>
			</td>
		</tr>
		<? printWriteInput('휴무일', 'sh_holiday', $data['sh_holiday'], 'required', 40, 20); ?>
		<tr class="addr">
			<th class="required">주소</th>
			<td>	
				<select name="sh_sido" id="sh_sido" class="select required" title="주소 시/도">
				<option value="">시/도</option>
				<? printSelectOption($sido_arr, $data['sh_sido']); ?>
				</select>
			
				<select name="sh_sigungu" id="sh_sigungu" class="select required" title="주소 시/군/구">
				<option value="">시/군/구</option>
				<? printSelectOption($sigungu_arr, $data['sh_sigungu']); ?>
				</select>
			
				<select name="sh_dong" id="sh_dong" class="select required" title="주소 읍/면/동">
				<option value="">읍/면/동</option>
				<? printSelectOption($dong_arr, $data['sh_dong']); ?>
				</select>

				<br />

				<input type="text" name="sh_addr2" value="<?=$data['sh_addr2']?>" class="text required" size="50" maxlength="30" title="상세주소" />
			</td>	
		</tr>
		<?
		printWriteInput('연락처', 'sh_tel', $data['sh_tel'], 'required', 20, 15);		
		?>		
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
