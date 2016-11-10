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
			<td>홍길동</td>
		</tr>
		<tr>
			<th>성별/생년월일</th>
			<td>남자 / 1981-10-12 (음력)</td>
		</tr>
		<tr>
			<th>휴대폰</th>
			<td>01066552885</td>
		</tr>
		<tr>
			<th>아이디</th>
			<td>dudvnd2885</td>
		</tr>
		<tr>
			<th>비밀번호</th>
			<td>dudvnd2885</td>
		</tr>		
		<tr>
			<th>이메일</th>
			<td>dudvnd2885@inplusweb.com</td>
		</tr>
		</tbody>
		</table>

		<p class="button">
			<a href="payment_buy.html" class="sButton large info">충전하기</a>
		</p>
	</div>
	<!-- //subWrap -->	
	
</div>
<!-- //<?=$module?> -->