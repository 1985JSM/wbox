<?
if(!defined('_INPLUS_')) { exit; } 

/* set URI */
$layout_size = 'tiny';
$doc_title = '서비스가입';
$oSms = new SmsManager();
$oSms->set('is_join_page', true);
$oSms->checkJoined(true);
?>

<!-- <?=$module?> -->
<div id="<?=$module?>">
	<!-- subWrap -->
	<div class="subWrap sub_member">
		<div class="info_box">
			<h4><span class="icon tip_info"></span> 도움말</h4>
			- 아래의 본인 인증 후 회원가입이 가능합니다.<br />
			- 만 14세 미만은 회원으로 가입할 수 없습니다.<br />
			- 타인의 정보 및 주민등록번호를 부정 사용하는 자는 3년 이하의 징역 또는 1천만원 이하의 벌금이 부과될 수 있습니다.
		</div>		
		
		<div class="mobileBox">
			<div class="mobile">
				<ul>
				<li><i class="xi-mobile xi-4x"></i></li>
				<li><span>휴대폰 본인 인증</span>본인 명의로 된 휴대폰으로만 인증이 가능합니다.</li>				
				</ul>			
			</div>

			<div class="btn_mobile">
				<a href="lyr.cert_join.html" target="#layer_popup" class="sButton large active btn_ajax size_480x750" title="휴대폰 인증하기">휴대폰 인증하기</a>
			</div>
		</div>
	</div>
	<!-- //subWrap -->	
</div>
<!-- //<?=$module?> -->