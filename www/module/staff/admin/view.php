<?
if(!defined('_INPLUS_')) { exit; } 

/* set URI */
$this_uri = '/webadmin/staff/list.html';

/* init Class */
$oStaff = new StaffAdmin();
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
$service_arr = $oService->selectServiceCodeArray($data['sh_code']);
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
			<th>이메일</th>
			<td><?=$data['mb_email']?>		
			</td>
		</tr>
		<?
		printTr('이름',   $data['mb_name']); 		
		printTr('직책',   $data['mb_position']);		
		printTr('닉네임', $data['mb_nick']); 		
		printTr('휴대폰', $data['mb_hp']);				
		?>		
		<tr>
			<th>근무시간</th>
			<td>
				<?=$data['s_work']?>~<?=$data['e_work']?>
			</td>
		</tr>
		<tr>
			<th>휴식시간</th>
			<td>
				<?=$data['s_break']?>~<?=$data['e_break']?>
			</td>
		</tr>
		<tr>
			<th>서비스</th>
			<td>
				<?=$data['txt_sv_code']?>
			</td>
		</tr>
		<? for($i = 0 ; $i < $max_file ; $i++) { ?>
		<tr<? if($file_list[$i]['file_id']) { ?> class="file"<? } ?>>
			<th>사진</th>
			<td<? if($file_list[$i]['file_id']) { ?> class="file"<? } ?>>	
				<? if($file_list[$i]['file_id']) { ?>	
				<?=$file_list[$i]['file_name']?>
				(<?=$file_list[$i]['size']?>, <?=$file_list[$i]['down']?>회)
				<?=$file_list[$i]['btn_download']?>
				<br />
				<? } ?>
			</td>
		</tr>
		<? } ?>
		<tr>
			<th>로그인차단</th>
			<td>
				<?=$data['flag_no_login']?>
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
