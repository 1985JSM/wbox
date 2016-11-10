<?
if(!defined('_INPLUS_')) { exit; } 

$oMember = new MemberUser();
$oMember->init();

$result = $oMember->sendAuthNo('H', $mb_hp);
$msg_title = $result['msg'];
if($result['code'] == 'ok') {
	$msg_content = '확인 버튼을 클릭 후 인증번호를 입력해주세요.';
}
else if($result['code'] == 'duplication') {
	$msg_content = '이미 동일한 번호로 가입이 되어 있습니다.';
}
else {
	$msg_content = '짧은 시간 동안 너무 많은 인증번호를 요청하였습니다. 잠시 후 다시 요청해주세요.';
}
?>
<p class="layer_txt">
	<strong><?=$msg_title?></strong>
	<?=$msg_content?>	
</p>   
<ul class="layer_btn">
<li><div><input type="button" value="확인" class="btn_orange" onclick="closeAuthLayer()"></div></li>
</ul>