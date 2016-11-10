<?
if(!defined('_INPLUS_')) { exit; } 

/* set URI */
$this_uri = '/webmanager/customer/list.html';

/* init Class */
$oCustomer = new CustomerManager();
$oCustomer->init();
$module_name = $oCustomer->get('module_name');	// 모듈명

/* search condition */
$query_string = $oCustomer->get('query_string');
$page = $oCustomer->get('page');

/* insert or update */
$pk = $oCustomer->get('pk');
$uid = $oCustomer->get('uid');
$data = $oCustomer->selectDetail($uid);

if($data[$pk]) {
	$mode = 'update';
}
else {
	$mode = 'insert';	

	$data = array(
		'ad_type'	=> 'M'
	);
}

/* code */
$cs_level_arr = $oCustomer->get('cs_level_arr');

/* shop */
if(!isset($oStaff)) {
	include_once(_MODULE_PATH_.'/staff/staff.manager.class.php');
	$oStaff = new StaffManager();
	$oStaff->init();
}
$st_id_arr = $oStaff->selectStaffByShopCode($member['sh_code']);
?>
<script type="text/javascript">
//<![CDATA[
$(document).ready(function() {

});
//]]>
</script>

<div id="<?=$module?>">

	<div class="write">
		
		<form name="write_form" method="post" action="./process.html" onsubmit="return submitWriteForm(this);">
		<fieldset>
		<legend>검색관련</legend>
		<input type="hidden" name="mode" value="<?=$mode?>" />	
		<input type="hidden" name="page" value="<?=$page?>" />
		<input type="hidden" name="query_string" value="<?=$query_string?>" />
		</fieldset>

		<fieldset>
		<legend>등록/수정</legend>	

		<input type="hidden" name="<?=$pk?>" value="<?=$uid?>" />

		<h4>기본사항</h4>
		<? if($data['mb_id']) { ?>
		<input type="hidden" name="cs_name" value="<?=$data['cs_name']?>" />
		<input type="hidden" name="cs_email" value="<?=$data['cs_email']?>" />
		<input type="hidden" name="cs_hp" value="<?=$data['cs_hp']?>" />
		<input type="hidden" name="cs_nick" value="<?=$data['cs_nick']?>" />
		<input type="hidden" name="cs_area" value="<?=$data['cs_area']?>" />
		<input type="hidden" name="cs_birth" value="<?=$data['cs_birth']?>" />
		<input type="hidden" name="cs_birth_type" value="<?=$data['cs_birth_type']?>" />
		<input type="hidden" name="cs_gender" value="<?=$data['cs_gender']?>" />

		<p>
			- 예약박스에서 가입한 고객의 기본 사항은 변경할 수 없습니다.
		</p>		
		<? } ?>		
				
		<table class="write_table" id="write_table" border="1">
		<caption>등록/수정</caption>
		<colgroup>
		<col width="140" />
		<col width="*" />
		<col width="140" />
		<col width="*" />
		</colgroup>
		<tbody>
		<? if($data['mb_id']) { ?>
		<tr>
			<th>이름</th>
			<td colspan="3"><?=$data['cs_name']?></td>
		</tr>		
		</tr>
		<tr>
			<th>이메일</th>
			<td colspan="3"><?=$data['cs_email']?></td>
		</tr>
		<tr>
			<th>휴대폰</th>
			<td colspan="3"><?=$data['cs_hp']?>  <? if($data['flag_receive_sms'] == 'Y'){ echo'(SMS수신)';} else {echo'(SMS 수신 거부)';}?></td>
		</tr>
		<tr>
			<th>닉네임</th>
			<td colspan="3"><?=$data['cs_nick']?></td>
		</tr>
		<tr>
			<th>지역</th>
			<td><?=$data['cs_area']?></td>	
			<th>생년월일/성별</th>
			<td><?=$data['txt_cs_birth']?> (<?=$data['txt_cs_birth_type']?>) / <?=$data['txt_cs_gender']?></td>
		</tr>
		
		<? } else { 
		printWriteInput('이름', 'cs_name', $data['cs_name'], 'required', 20, 10, 3); 
		printWriteInput('이메일', 'cs_email', $data['cs_email'], '', 50, 50, 3);
		printWriteInput('휴대폰', 'cs_hp', $data['cs_hp'], 'required', 20, 15, 3);
		?>
		<tr>
			<th>SMS수신여부</th>
			<td>
				<select name="flag_receive_sms" class="select" title="SMS수신여부">
					<?printSelectOption(array('Y' => '수신', 'N' => '거부'), $data['flag_receive_sms'], 1);?>
				</select>
			</td>
		</tr>
		<?
		printWriteInput('닉네임', 'cs_nick', $data['cs_nick'], '', 20, 10, 3);
		?>
		<tr>
			<th>지역</th>
			<td>
				<select name="cs_area" class="select" title="지역선택">
				<? printSelectOption($area_arr, $data['cs_area'], 1); ?>
				</select>				
			</td>	
			<th>생년월일/성별</th>
			<td>
				<input type="text" name="cs_birth" value="<?=$data['cs_birth']?>" class="text birth" size="15" maxlength="10" title="생년월일" />

				<select name="cs_birth_type" class="select required" title="음력/양력">
				<? printSelectOption($birth_type_arr, $data['cs_birth_type'], 1); ?>
				</select>

				<select name="cs_gender" class="select required" title="성별">
				<? printSelectOption($gender_arr, $data['cs_gender'], 1); ?>
				</select>
			</td>
		</tr>
		<? } ?>
		<? if($mode == 'update') { ?>
		<tr>
			<th>가입일</th>
			<td colspan="3"><?=$data['reg_date']?></td>
		</tr>
		<? } ?>
		</tbody>
		</table>
		</fieldset>

		<fieldset class="etc">
		<legend>등록/수정</legend>	
		<h4>고객관리정보</h4>
		<table class="write_table" border="1">
		<caption>등록/수정</caption>
		<colgroup>
		<col width="140" />
		<col width="*" />
		</colgroup>
		<tbody>
		<tr>
			<th>담당자</th>
			<td>			
				<select name="st_id" class="select" title="담당자">
				<? printSelectOption($st_id_arr, $data['st_id'], 1); ?>
				</select>	
			</td>
		</tr>
		<tr>
			<th>가맹점등급</th>
			<td>			
				<select name="cs_level" class="select" title="가맹점등급">
				<? printSelectOption($cs_level_arr, $data['cs_level'], 1); ?>
				</select>
				<span class="comment">- 가맹점에서 관리하는 고객 등급입니다.</span>
			</td>
		</tr>		
		<tr>
			<th>관리자메모</th>
			<td>
				<textarea name="cs_memo" class="textarea" rows="5" cols="80" title="관리자메모"><?=$data['cs_memo']?></textarea>
				<br />
				<span class="comment">- 가맹점에서 관리하는 고객 관리 메모입니다. 관리자 메모는 회원에게 노출되지 않습니다. </span>
			</td>
		</tr>					
		</tbody>
		</table>
		</fieldset>

		<p class="button">
			<button type="submit" class="sButton primary">확인</button>
			<a href="./list.html?<?=$pk?>=<?=$uid?>&page=<?=$page?><?=$query_string?>" class="sButton active" title="취소">취소</a>
		</p>

		</form>
	</div>
</div>
