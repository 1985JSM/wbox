<?
if(!defined('_INPLUS_')) { exit; } 

$back_url = './modify_index.html';
$doc_title = '프로필관리';
$footer_nav['1'] = true;

$oMember = new MemberUser();
$oMember->init();

$oMember->checkPasswordCookie($this_uri);
?>
<script type="text/javascript">
$(document).ready(function() {

});
</script>

<div id="container"  class="container">

	<div class="profile_form">
		<form name="default_form" action="./process.html" method="post" onsubmit="return submitDefaultForm(this)">
		<input type="hidden" name="mode" value="update_default" />

		<ul class="profile_modify_form">
		<li>
			<span class="tit">기본정보</span>
			<ul class="inp_info01">
			<li>
				<div>
					<input type="text" name="mb_name" value="<?=$member['mb_name']?>" class="input_txt required" placeholder="이름" maxlength="20" title="이름">
				</div>
			</li>
			<li>
				<div>
					<select name="mb_area" class="required" title="지역">
					<option value="">지역</option>
					<? printSelectOption($area_arr, $member['mb_area'], 1); ?>
					</select>
				</div>
			</li>
			</ul>
			<ul class="inp_info02">
			<li>
				<div>
					<input type="text" name="mb_birth" value="<?=$member['mb_birth']?>" class="input_txt input_date required" placeholder="생년월일" title="생년월일">                   
				</div>
			</li>
			<li>
				<div>
					<select name="mb_birth_type" class="required" title="양력/음력">
					<option value="">양력/음력</option>
					<? printSelectOption($birth_type_arr, $member['mb_birth_type'], 1); ?>
					</select>
				</div>
			</li>
			<li>
				<div>
					<select name="mb_gender" class="required" title="성별">
					<option value="">성별</option>
					<? printSelectOption($gender_arr, $member['mb_gender'], 1); ?>
					</select>
				</div>
			</li>
			</ul>
		</li>
		</ul>

		<button type="submit" class="btn_orange">확인</button>
		</form>
	</div>
</div>

	