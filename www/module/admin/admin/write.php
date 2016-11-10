<?
if(!defined('_INPLUS_')) { exit; } 

/* set URI */
$this_uri = '/webadmin/admin/list.html';

/* init Class */
$oAdmin = new AdminAdmin();
$oAdmin->init();
$module_name = $oAdmin->get('module_name');	// 모듈명

/* search condition */
$query_string = $oAdmin->get('query_string');
$page = $oAdmin->get('page');

/* insert or update */
$pk = $oAdmin->get('pk');
$uid = $oAdmin->get('uid');
$data = $oAdmin->selectDetail($uid);

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

$max_file = $oAdmin->get('max_file');
?>
<script type="text/javascript">
//<![CDATA[
$(document).ready(function() {

	/* 아이디 검사 */
	$("#mb_id").on("focusout", function() {
		checkMemberId();
	});

	/* 권한 설정 */
	$("#mb_level").on("change", function() {
		changeMbAuthList(this);
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
			<th<?if($mode=='insert'){?> class="required"<?}?>>아이디</th>
			<?if($mode == 'insert'){?>
			<td>			
				<input type="text" name="mb_id" id="mb_id" value="<?=$data['mb_id']?>" class="text required" size="30" maxlength="20" title="아이디" />
				<input type="hidden" name="chk_mb_id" value="0" />
				<span id="state_mb_id"></span>			
				<br />
				<span class="comment">-아이디는 20자 이하의 영대/소문자, 숫자, _만 입력 가능합니다.</span>
			</td>
			<? } else { ?>
			<td>
				<strong><?=$data['mb_id']?></strong>
			</td>
			<? } ?>
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
		printWriteInput('이메일', 'mb_email', $data['mb_email'], '', 50, 50);
		printWriteInput('휴대폰', 'mb_hp', $data['mb_hp'], '', 20, 15);
		?>
		<tr>
			<th class="required">권한등급</th>
			<td>
				<select name="mb_level" id="mb_level" class="select" title="권한등급">
				<? printSelectOption($oAdmin->get('mb_level_arr'), $data['mb_level'], 1); ?>
				</select>
			</td>
		</tr>
		<tr>
			<th>권한설정</th>
			<td>
				<? printCheckBox('auth_code', $oAdmin->get('mb_auth_arr'), $data['auth_code'], 1); ?>
			</td>
		</tr>
		<tr>
			<th>로그인차단</th>
			<td>
				<input type="checkbox" name="flag_no_login" id="flag_no_login" class="checkbox" value="Y" title="로그인차단" <?if($data['flag_no_login'] == 'Y'){?> checked="checked"<?}?> />
				<label for="flag_no_login">로그인차단</label>
			</td>
		</tr>
		<?
		printWriteTextarea('로그인허용IP', 'auth_ip', $data['auth_ip'], '', '5', '80');
		?>
		<? for($i = 0 ; $i < $max_file ; $i++) { ?>
		<tr<? if($file_list[$i]['file_id']) { ?> class="file"<? } ?>>
			<th>파일첨부 #<?=$i+1?></th>
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
			</td>
		</tr>
		<? } ?>		
		<? if($mode == 'update') { ?>
		<tr>
			<th>최근접속</th>
			<td><?=getWithoutNull($data['mb_login_time'])?></td>
		</tr>
		<? } ?>
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
