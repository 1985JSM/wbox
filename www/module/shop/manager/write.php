<?
if(!defined('_INPLUS_')) { exit; } 

/* init Class */
$oShop = new ShopManager();
$oShop->init();
$module_name = $oShop->get('module_name');	// 모듈명

/* update */
$pk = $oShop->get('pk');
$uid = $member['sh_code'];
$data = $oShop->selectDetail($uid);
$file_list = $data['file_list'];

$max_file = $oShop->get('max_file');
$main_img = $data['main_img'];
$sub_img = $data['sub_img'];

/* addr */
$sido_arr = selectSido();
if($data['sh_sido']) {
	$sigungu_arr = selectSigungu($data['sh_sido']);
}

if($data['sh_sido'] && $data['sh_sigungu']) {
	$dong_arr = selectDong($data['sh_sido'], $data['sh_sigungu']);
}

$time_table_arr = getTimeTableArray();

$sh_modify_minute_arr = $oShop->get('sh_modify_minute_arr');
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
		printWriteInput('상호', 'sh_name', $data['sh_name'], 'required', 50, 30); 
		?>
		<tr<? if($main_img['file_id']) { ?> class="file"<? } ?>>
			<th class="required">대표이미지<br />(640x380)</th>
			<td>	
				<input type="hidden" name="file_type[]" value="main" />
				<input type="file" name="wr_file[]" value="" class="file required" size="80" title="대표이미지" />
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
			<th>서브이미지<?=$i+1?><br />(640x380)</th>
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
		<? printWriteInput('연락처', 'sh_tel', $data['sh_tel'], 'required', 20, 15); ?>
		<tr>
			<th class="required">예약변경(취소)<br />가능시간</th>
			<td>
				<span>예약 변경(취소)은 최소</span>
				<select name="sh_modify_minute" class="select required" title="예약변경(취소) 가능시간">
				<? printSelectOption($sh_modify_minute_arr, $data['sh_modify_minute'], 1); ?>
				</select>
				<span>전까지 가능합니다.</span>
			</td>
		</tr>
		<? printWriteInput('매장소개', 'sh_memo', $data['sh_memo'], '', 100, 150); ?>		
		</tbody>
		</table>
		</fieldset>

		<p class="button">
			<button type="submit" class="sButton primary">확인</button>
		</p>

		</form>
	</div>
</div>
