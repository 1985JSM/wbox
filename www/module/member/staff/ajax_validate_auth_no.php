<?
if(!defined('_INPLUS_')) { exit; } 

$oMember = new MemberStaff();
$oMember->init();

$result = $oMember->validateAuthNo('H', $mb_hp, $auth_no);
$msg_title = $result['msg'];
if($result['code'] != 'ok') {	
	//$msg_content = '5분 이내 발송된 인증번호만 유효합니다. 인증번호를 재발송하세요.';
}
?>
<p class="layer_txt">
	<strong><?=$msg_title?></strong>
	<?=$msg_content?>	
</p>   
<ul class="layer_btn">
<li><div><input type="button" value="확인" class="btn_orange" onclick="closeAuthLayer()"></div></li>
</ul>
<? if($result['code'] == 'ok') { ?>
<script type="text/javascript">
$("#mb_hp").prop("readonly", true).addClass("readonly");
$("#auth_no").prop("readonly", true).addClass("readonly");
$("#flag_validate_auth_no").val("Y");
</script>
<? } ?>
