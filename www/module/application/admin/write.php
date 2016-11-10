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
		<? if($mode == 'update') { ?>
		<tr>
			<th>코드</th>
			<td>
				<strong><?=$uid?></strong>
			</td>
		</tr>		
		<? } ?>
		<tr>
			<th class="required">신청자</th>
			<td>
				<input type="text" name="ap_name" value="<?=$data['ap_name']?>" class="text required" size="20" maxlength="10" title="신청자" />
			</td>
		</tr>
		<tr>
			<th class="required">업체명</th>
			<td>
				<input type="text" name="ap_shop_name" value="<?=$data['ap_shop_name']?>" class="text required" size="50" maxlength="30" title="업체명" />
			</td>
		</tr>
		<tr>
			<th class="required">주소</th>
			<td>	
				<select name="ap_sido" id="ap_sido" class="select required" title="주소 시/도">
				<option value="">시/도</option>
				<? printSelectOption($sido_arr, $data['ap_sido']); ?>
				</select>
			
				<select name="ap_sigungu" id="ap_sigungu" class="select required" title="주소 시/군/구">
				<option value="">시/군/구</option>
				<? printSelectOption($sigungu_arr, $data['ap_sigungu']); ?>
				</select>
			
				<select name="ap_dong" id="ap_dong" class="select required" title="주소 읍/면/동">
				<option value="">읍/면/동</option>
				<? printSelectOption($dong_arr, $data['ap_dong']); ?>
				</select>
			</td>	
		</tr>
		<?
		printWriteInput('연락처', 'ap_tel', $data['ap_tel'], 'required', 20, 15);
		printWriteInput('이메일', 'ap_email', $data['ap_email'], 'required', 50, 50);		
		printWriteTextarea('요청이유', 'ap_memo', $data['ap_memo'], '', 5, 50);
		?>		
		<? if($mode == 'update') { ?>
		<tr>
			<th>진행여부</th>
			<td>
				<? foreach($ap_state_arr as $key => $val) {
					if($key == $data['ap_state']) { $state_class = $data['state_class']; }
					else { $state_class = 'disabled'; }
				?>
				<a href="./process.html?mode=update_state&<?=$pk?>=<?=$uid?>&ap_state=<?=$key?>" class="sButton tiny <?=$state_class?> btn_confirm btn_change" title="<?=$val?>"><?=$val?></a>
				<? } ?>
				<span class="comment ">
				- <strong class="info">보류</strong>: 가맹점 입점 승인이 보류된 상태를 의미합니다. (보류 시, 별도 안내 메시지는 발송되지 않습니다.)<br />
				- <strong class="info">접수</strong>: 가맹점 입점 신청이 최초 접수된 상태를 의미합니다.<br />
				- <strong class="info">승인</strong>: 가맹점 입점 신청이 승인된 상태를 의미하며, 인증 메일이 자동 발송됩니다. (인증 후, 가맹점 관리자가  가맹점 정보를 입력해주셔야 사용자앱에 노출됩니다.)<br /></span>
			</td>
		</tr>
		<tr>
			<th>신청일시</th>
			<td>	
				<?=$data['reg_time']?>
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
