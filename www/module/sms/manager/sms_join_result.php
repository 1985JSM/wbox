<?
if(!defined('_INPLUS_')) { exit; } 

/* set URI */
$layout_size = 'tiny';
$doc_title = '서비스가입';

$oSms = new SmsManager();
$oSms->set('is_join_page', true);
$oSms->checkJoined(true);
$result = $oSms->joinToSmscore();

if ($_POST['ct_gender'] == 'M') {
	$ct_gender = '남자';
} else if ($_POST['st_gender'] == 'W') {
	$ct_gender = '여자';
}

$ct_birthday = $_POST['ct_birthday'];
?>

<!-- <?=$module?> -->
<div id="<?=$module?>">

	<!-- subWrap -->
	<div class="subWrap sub_member">
		<? if ($result['code'] == 'success') { ?>
		<h4>가맹점 정보확인</h4>

		<table class="write_table" summary="회원가입 결과에 관련된 표로써 가입일자, 이름, 아이디, 휴대폰, 이메일 등 순으로 출력됩니다.">
		<caption>회원가입 결과</caption>
		<colgroup>
		<col width="25%">
		<col width="*">
		</colgroup>
		<tbody>
		<tr>
			<th>이름</th>
			<td><?=$_POST['ct_name']?></td>
		</tr>
		<tr>
			<th>성별/생년월일</th>
			<td><?=$ct_gender?> / <? echo substr($_POST['ct_birthday'], 0, 4) . '-' . substr($_POST['ct_birthday'], 4, 2) . '-' . substr($_POST['ct_birthday'], 6, 2); ?> (양력)</td>
		</tr>
		<tr>
			<th>휴대폰</th>
			<td><?=$_POST['ct_phone']?></td>
		</tr>
		<tr>
			<th>이메일</th>
			<td><?=$member['mb_email']?></td>
		</tr>
		</tbody>
		</table>

		<p class="button">
			<a href="sms_charge.html" class="sButton large info"><span class="sButton-container"><span class="sButton-bg"><span class="text">충전하기</span></span></span></a>
		</p>
		<? } else {
				echo $result['msg'];
			}
		?>

	</div>
	<!-- //subWrap -->	
	
</div>
<!-- //<?=$module?> -->