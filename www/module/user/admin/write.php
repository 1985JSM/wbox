<?
if(!defined('_INPLUS_')) { exit; } 

/* set URI */
$this_uri = '/webadmin/user/list.html';

/* init Class */
$oUser = new UserAdmin();
$oUser->init();
$module_name = $oUser->get('module_name');	// 모듈명

/* search condition */
$query_string = $oUser->get('query_string');
$page = $oUser->get('page');

/* insert or update */
$pk = $oUser->get('pk');
$uid = $oUser->get('uid');
$data = $oUser->selectDetail($uid);

if(!$data[$pk]) {
	alert('비정상적인 접근입니다', './list.html');
}
$mode = 'update';

// reserve
global $oReserve;
if(!isset($oReserve)) {
	include_once(_MODULE_PATH_.'/reserve/reserve.admin.class.php');
	$oReserve = new Reserve();	
	$oReserve->init();
}

unset($cnt_reserve);
$cnt_reserve['E'] = $oReserve->countByUserId($data['mb_id'], 'E');
$cnt_reserve['C'] = $oReserve->countByUserId($data['mb_id'], 'C');
$cnt_reserve['B'] = $oReserve->countByUserId($data['mb_id'], 'B');
$cnt_reserve['total'] = $cnt_reserve['E'] + $cnt_reserve['C'] + $cnt_reserve['B'];

/* code */
$mb_level_arr = $oUser->get('mb_level_arr');
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
		<input type="hidden" name="mb_name" value="<?=$data['mb_name']?>" />
		<input type="hidden" name="mb_email" value="<?=$data['mb_email']?>" />
		<input type="hidden" name="mb_hp" value="<?=$data['mb_hp']?>" />
				
		<table class="write_table" id="write_table" border="1">
		<caption>등록/수정</caption>
		<colgroup>
		<col width="140" />
		<col width="*" />
		<col width="140" />
		<col width="*" />
		</colgroup>
		<tbody>
		<tr>
			<th>이름</th>
			<td colspan="3"><?=$data['mb_name']?></td>
		</tr>		
		</tr>
		<tr>
			<th>이메일</th>
			<td colspan="3"><?=$data['mb_email']?></td>
		</tr>
		<tr>
			<th>휴대폰</th>
			<td colspan="3"><?=$data['mb_hp']?></td>
		</tr>
		<tr>
			<th>비밀번호</th>
			<td colspan="3">
				<input type="password" name="mb_pass" value="" class="text" size="30" maxlength="20" title="비밀번호" />
				<br />
				<span class="comment">-비밀번호 20자 이하의 영대/소문자, 숫자, 특수숫자만 입력 가능합니다.</span>
			</td>
		</tr>
		<tr>
			<th>비밀번호 확인</th>
			<td colspan="3">
				<input type="password" name="mb_pass2" value="" class="text" size="30" maxlength="20" title="비밀번호 확인" />				
			</td>
		</tr>
		<?		
		printWriteInput('닉네임', 'mb_nick', $data['mb_nick'], '', 20, 10, 3);
		?>
		<tr>
			<th>지역</th>
			<td>
				<select name="mb_area" class="select" title="지역선택">
				<? printSelectOption($area_arr, $data['mb_area'], 1); ?>
				</select>				
			</td>	
			<th>생년월일/성별</th>
			<td>
				<input type="text" name="mb_birth" value="<?=$data['mb_birth']?>" class="text birth" size="15" maxlength="10" title="생년월일" />

				<select name="mb_birth_type" class="select required" title="음력/양력">
				<? printSelectOption($birth_type_arr, $data['mb_birth_type'], 1); ?>
				</select>

				<select name="mb_gender" class="select required" title="성별">
				<? printSelectOption($gender_arr, $data['mb_gender'], 1); ?>
				</select>
			</td>
		</tr>
		<tr>
			<th>가입일</th>
			<td><?=$data['reg_date']?></td>
			<th>최근접속</th>
			<td><?=getWithoutNull($data['mb_login_time'])?></td>
		</tr>
		</tr>

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
			<th>종료예약건</th>
			<td>			
				총 <strong class="primary"><?=number_format($cnt_reserve['total'])?></strong>건 (완료 <strong><?=number_format($cnt_reserve['E'])?></strong>건, 정상취소 <strong><?=number_format($cnt_reserve['C'])?></strong>건, 비정상취소 <strong><?=number_format($cnt_reserve['B'])?></strong>건)
			</td>
		</tr>
		<tr>
			<th>회원등급</th>
			<td>			
				<select name="mb_level" class="select" title="회원등급">
				<? printSelectOption($mb_level_arr, $data['mb_level'], 1); ?>
				</select>
			</td>
		</tr>		
		<tr>
			<th>관리자메모</th>
			<td>
				<textarea name="mb_memo" class="textarea" rows="5" cols="80" title="관리자메모"><?=$data['mb_memo']?></textarea>
				<br />
				<span class="comment">- 관리자가 관리하는 고객 관리 메모입니다. 관리자 메모는 고객 및 상점에 노출되지 않습니다. </span>
			</td>
		</tr>					
		</tbody>
		</table>
		</fieldset>

		<p class="button">
			<button type="submit" class="sButton primary">확인</button>
			<a href="./list.html?page=<?=$page?><?=$query_string?>" class="sButton active" title="목록">목록</a>
			<? if($mode == 'update') { ?>
			<!--a href="./process.html?mode=delete&<?=$pk?>=<?=$uid?>&page=<?=$page?><?=$query_string?>" id="btn_delete" class="sButton" title="삭제">삭제</a-->
			<? } ?>
		</p>

		</form>
	</div>
</div>
