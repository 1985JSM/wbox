<?
if(!defined('_INPLUS_')) { exit; } 

$oMember = new MemberStaff();
$oMember->init();

$find_email = $_GET['find_email'];
$result = $oMember->findPasswordByEmail($find_email);
$msg_title = $result['msg'];
?>
<script type="text/javascript">

</script>
<p class="layer_txt">
	<strong><?=$msg_title?></strong>
</p>   
<ul class="layer_btn">
<li>
	<div>
		<? if($result['code'] == 'ok') { ?>
		<button type="button" class="btn_orange" onclick="closeLayerPopup()">확인</button>
		<? } else { ?>
		<a href="../member/ajax_find_password.html" class="btn_orange btn_ajax size_280x280" target="#layer_popup" title="비밀번호찾기">확인</a>
		<? } ?>
	</div>
</li>
</ul>