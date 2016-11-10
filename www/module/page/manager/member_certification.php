<?
if(!defined('_INPLUS_')) { exit; } 

/* set URI */
$layout_size = 'tiny';
$doc_title = '서비스가입';
?>

<style>
div.sub_member div.mobileBox {position:relative;height:160px;margin-bottom:30px;border:1px solid #1d4da5;border-radius:2px;background:#2460ce;}
div.sub_member div.mobileBox > div.mobile {padding:60px 0 0 80px;color:#fff;}
div.sub_member div.mobileBox > div.mobile > ul {}
div.sub_member div.mobileBox > div.mobile > ul:after {display:block;content:'';clear:both;} 
div.sub_member div.mobileBox > div.mobile > ul > li:first-child {margin:0;}
div.sub_member div.mobileBox > div.mobile > ul > li {float:left;margin-left:20px;}
div.sub_member div.mobileBox > div.mobile > ul > li > span {display:block;margin:4px 0 10px 0;font-weight:600;font-size:18px;}

div.sub_member div.mobileBox > div.btn_mobile {position:absolute;top:60px;right:80px;}
</style>

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
				<a href="member_join_result.html" class="sButton large active">휴대폰 인증하기</a>
			</div>
		</div>
	</div>
	<!-- //subWrap -->	
	
</div>
<!-- //<?=$module?> -->