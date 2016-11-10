<?
if(!defined('_INPLUS_')) { exit; } 

/* set URI */
$this_uri = '/webmanager/staff/list.html';

/* init Class */
$oStaff = new StaffManager();
$oStaff->init();
$module_name = $oStaff->get('module_name');	// 모듈명

/* search condition */
$query_string = $oStaff->get('query_string');
$page = $oStaff->get('page');

/* insert or update */
$pk = $oStaff->get('pk');
$uid = $oStaff->get('uid');
$data = $oStaff->selectDetail($uid);

if($data[$pk]) {
	$mode = 'update';
	$file_list = $data['file_list'];
	$holiday_list = $data['holiday_list'];
}
else {
	$mode = 'insert'; 
	$data = array(
		'mb_level'	=> 7
	);
}

$max_file = $oStaff->get('max_file');

// sv codes
global $oService;
if(!isset($oService)) {
	include_once(_MODULE_PATH_.'/service/service.staff.class.php');
	$oService = new Service();
	$oService->init();
}
$service_arr = $oService->selectServiceCodeArray($member['sh_code']);
if(sizeof($service_arr) == 0) {
	alert('담당자를 등록하려면 서비스를 최소 1개 이상 등록해야 합니다.', '../service/write.html');	
} 

// hour
$hour_arr = getTimeTableArray('00:00', '24:00');
?>
<script type="text/javascript">
//<![CDATA[
$(document).ready(function() {

	// 이메일 검사
	$("#mb_email").on("focusout", function() {
		checkMemberEmail();
	});

	// 종일 체크
	$(document).on("click", "input.hl_chk_all", function() {
		toggleHolidayTime(this);
	});

	// default
	initHolidayAllTime();
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
		<input type="hidden" name="mb_level" value="<?=$data['mb_level']?>" />		
		<input type="hidden" name="df_email" value="<?=$data['mb_email']?>" />

		<h4>기본정보</h4>		
		<table class="write_table" border="1">
		<caption>기본정보</caption>
		<colgroup>
		<col width="140" />
		<col width="*" />
		</colgroup>
		<tbody>		
		<tr>
			<th class="required">이메일</th>
			<td>			
				<input type="text" name="mb_email" id="mb_email" value="<?=$data['mb_email']?>" class="text required" size="50" maxlength="50" title="이메일" />
				<input type="hidden" name="chk_mb_email" value="0" />
				<span id="state_mb_email"></span>			
			</td>
		</tr>
		<tr>
			<th<?if($mode=='insert'){?> class="required"<?}?>>비밀번호</th>
			<td>
				<input type="password" name="mb_pass" value="" class="text<?if($mode=='insert'){?> required<?}?>" size="30" maxlength="20" title="비밀번호" />
				<br />
				<span class="comment">-비밀번호 20자 이하의 영대/소문자, 숫자, 특수숫자만 입력 가능합니다.</span>
			</td>
		</tr>
		<tr>
			<th<?if($mode=='insert'){?> class="required"<?}?>>비밀번호 확인</th>
			<td>
				<input type="password" name="mb_pass2" value="" class="text<?if($mode=='insert'){?> required<?}?>" size="30" maxlength="20" title="비밀번호 확인" />				
			</td>
		</tr>
		<?
		printWriteInput('이름', 'mb_name', $data['mb_name'], 'required', 20, 10); 		
		printWriteInput('직책', 'mb_position', $data['mb_position'], '', 20, 10);		
		printWriteInput('닉네임', 'mb_nick', $data['mb_nick'], 'required', 20, 10); 		
		printWriteInput('휴대폰', 'mb_hp', $data['mb_hp'], 'required', 20, 15);				
		?>		
		<tr>
			<th class="required">근무시간</th>
			<td>
				<select name="s_work" class="select required" title="근무시작시간">
				<? printSelectOption($hour_arr, $data['s_work']);  ?>
				</select>	
				~
				<select name="e_work" class="select required" title="근무종료시간">
				<? printSelectOption($hour_arr, $data['e_work']);  ?>
				</select>
			</td>
		</tr>
		<tr>
			<th class="required">휴식시간</th>
			<td>
				<select name="s_break" class="select required" title="휴식시작시간">
				<? printSelectOption($hour_arr, $data['s_break']);  ?>
				</select>	
				~
				<select name="e_break" class="select required" title="휴식종료시간">
				<? printSelectOption($hour_arr, $data['e_break']);  ?>
				</select>
			</td>
		</tr>
		<tr>
			<th class="required">서비스</th>
			<td>
				<? printCheckBox('sv_code', $service_arr, $data['sv_code'], 1); ?>
			</td>
		</tr>
		<?
		printWriteInput('한줄소개', 'mb_pr', $data['mb_pr'], '', 40, 20);
		?>
		<? for($i = 0 ; $i < $max_file ; $i++) { ?>
		<tr<? if($file_list[$i]['file_id']) { ?> class="file"<? } ?>>
			<th>사진</th>
			<td<? if($file_list[$i]['file_id']) { ?> class="file"<? } ?>>	
				<input type="hidden" name="file_type[]" value="default" />
				<input type="file" name="wr_file[]" value="" class="file" size="80" title="첨부파일" />				
				<? if($file_list[$i]['file_id']) { ?>
				<br />
				<input type="checkbox" name="del_file[]" id="del_file_<?=$i?>" value="<?=$file_list[$i]['file_id']?>" title="파일삭제" />
				<label for="del_file_<?=$i?>">기존파일삭제</label>
				<span>|</span>				
				<?=$file_list[$i]['file_name']?>
				(<?=$file_list[$i]['size']?>, <?=$file_list[$i]['down']?>회)
				<?=$file_list[$i]['btn_download']?>
				<? } ?>
				<br />
				<span class="info">(최적 해상도는 305px * 200px 입니다.)</span>
			</td>
		</tr>
		<? } ?>
		<tr>
			<th>로그인차단</th>
			<td>
				<input type="checkbox" name="flag_no_login" id="flag_no_login" class="checkbox" value="Y" title="로그인차단" <?if($data['flag_no_login'] == 'Y'){?> checked="checked"<?}?> />
				<label for="flag_no_login">로그인차단</label>
			</td>
		</tr>			
		</tbody>
		</table>
		</fieldset>

		<fieldset class="etc">
		<!-- list_top -->
		<div class="list_top">
			<div class="left">
				<strong>휴가정보</strong>
			</div>
			<div class="right">
				<button type="button" onclick="addHoliday()" class="sButton tiny info">일정추가</button>
				
			</div>
		</div>
		<!-- //list_top -->
		<table class="list_table border" border="1">
		<caption>휴무일정</caption>
		<colgroup>
		<col width="*" />
		<col width="420" />				
		<col width="60" />
		</colgroup>
		<thead>
		<tr>
			<th>일시</th>
			<th>사유</th>
			<th>비고</th>
		</tr>
		</thead>
		<tbody id="holiday_list">				
		<?
		include_once(_MODULE_PATH_.'/staff/manager/ajax_holiday_list.php');
		if(sizeof($holiday_list) == 0) { printNoData(3); }
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
