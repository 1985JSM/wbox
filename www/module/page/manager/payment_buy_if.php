<?
if(!defined('_INPLUS_')) { exit; } 

$flag_use_header = false;
$flag_use_footer = false;

/* set URI */
$layout_size = 'tiny';
$doc_title = '메시지충전';
?>

<link rel="stylesheet" type="text/css" href="http://smscore.inplus21.com/common/css/ui.css" />
<style>
h4 {height:30px;font-weight:600;line-height:30px;color:#3c3c3c;}

div.sub_payment {position:relative;}
div.sub_payment p.vat {position:absolute;top:100px;right:0;}
div.sub_payment p.button {margin:30px 0 60px 0;}

div.sub_payment div.info_box.last {margin-top:20px;}
div.sub_payment div.info_box.last > ul {}
div.sub_payment div.info_box.last > ul > li {padding-left:10px;line-height:20px;background:url("/img/manager/bl_dot.gif") 0 50% no-repeat;}
</style>

<!-- <?=$module?> -->
<div id="<?=$module?>">

	<!-- subWrap -->
	<div class="subWrap sub_payment write">
		<div class="info_box">
			<h4><span class="icon tip_info"></span> 도움말</h4>
			메시지 전송에 필요한 금액을 충전할 수 있습니다.
		</div>

		<form>
		<h4>충전 금액 선택</h4>
		
		<p class="vat">* VAT 별도</p>
		<table class="list_table border" summary="충전 금액 선택에 관련된 표로써 선택, 충전금액, 단가, SMS건수, 혜택 순으로 출력됩니다.">
		<caption>충전 금액 선택</caption>
		<colgroup>
		<col width="10%">
		<col width="30%">
		<col width="15%">
		<col width="15%">
		<col width="*">
		</colgroup>
		<thead>
		<tr>
			<th>선택</th>
			<th>충전금액</th>
			<th>단가</th>
			<th>SMS건수</th>
			<th>혜택</th>
		</tr>	
		</thead>
		<tbody>
		<tr>
			<td><label><input type="radio" name="" class="" value="" title=""></label></td>
			<td>40,000원</td>
			<td>20원</td>
			<td>2,000건</td>
			<td class="info">-</td>
		</tr>
		<tr>
			<td><label><input type="radio" name="" class="" value="" title=""></label></td>
			<td>100,000원</td>
			<td>18원</td>
			<td>5,500건</td>
			<td class="info">500건 추가지급</td>
		</tr>
		<tr>
			<td><label><input type="radio" name="" class="" value="" title=""></label></td>
			<td>200,000원</td>
			<td>17원</td>
			<td>11,700건</td>
			<td class="info">1,700건 추가지급</td>
		</tr>
		<tr>
			<td><label><input type="radio" name="" class="" value="" title=""></label></td>
			<td>400,000원</td>
			<td>15.9원</td>
			<td>25,000건</td>
			<td class="info">5,000건 추가지급</td>
		</tr>
		<tr>
			<td><label><input type="radio" name="" class="" value="" title=""></label></td>
			<td>1,000,000원</td>
			<td>15원</td>
			<td>66,600건</td>
			<td class="info">16,600건 추가지급</td>
		</tr>
		</tbody>
		</table>

		<fieldset class="etc">
		<table class="write_table" summary="충전금액에 관련된 표로써 충전금액, 부가세 순으로 출력됩니다.">
		<caption>충전금액</caption>
		<colgroup>
		<col width="25%">
		<col width="*">
		</colgroup>
		<tbody>
		<tr>
			<th>충전금액</th>
			<td>100,000원</td>
		</tr>
		<tr>
			<th>부가세</th>
			<td>10,000원</td>
		</tr>		
		</tbody>
		</table>
		</fieldset>

		<fieldset class="etc">
		<table class="write_table" summary="결제금액에 관련된 표로써 결제금액, 결제방식 순으로 출력됩니다.">
		<caption>결제금액</caption>
		<colgroup>
		<col width="25%">
		<col width="*">
		</colgroup>
		<tbody>
		<tr>
			<th>결제금액</th>
			<td><strong class="primary">110,000원</strong> (VAT 포함)</td>
		</tr>
		<tr>
			<th>결제방식</th>
			<td>
				<label><input type="radio" name="" class="" value="" checked="checked" title="결제수단">신용카드</label>
				<label><input type="radio" name="" class="" value="" title="결제수단">계좌이체</label>
			</td>
		</tr>		
		</tbody>
		</table>
		</fieldset>	

		<p class="button">
			<a href="payment_result_if.html" class="sButton large info">결제하기</a>
		</p>

		<fieldset class="etc">
		<h4><span class="icon tip_info"></span> 메시지 충전 및 사용안내</h4>
		<table class="list_table border" summary="메시지 충전 및 사용안내에 관련된 표로써 구분, 차감건수, 발송 형식 순으로 출력됩니다.">
		<caption>메시지 충전 및 사용안내</caption>
		<colgroup>
		<col width="15%">
		<col width="20%">
		<col width="*">
		</colgroup>
		<thead>
		<tr>
			<th>구분</th>
			<th>차감건수</th>
			<th>발송 형식</th>
		</tr>	
		</thead>
		<tbody>
		<tr>
			<td>SMS</td>
			<td><strong>1건</strong></td>
			<td>최대 90 byte(한글 45자)까지 문자 전송, 초과될 경우 장문문자로 자동 발송</td>
		</tr>
		<tr>
			<td>LMS</td>
			<td><strong>3건</strong></td>
			<td>최대 2,000 byte(한글 1,000자)까지 문자 전송</td>
		</tr>
		<tr>
			<td>SMS</td>
			<td><strong>6건</strong></td>
			<td>멀티미디어 파일(이미지, 동영상)을 포함한 2,000 byte까지 문자 전송</td>
		</tr>
		</tbody>
		</table>
		</fieldset>

		<div class="info_box last">
			<ul>
			<li>메시지 충전 이후 충전된 금액은 환불되지 않습니다.</li>
			<li>신용카드 결제의 경우 영수증(카드전표)이 발행되며, 세금계산서 대용으로 사용할 수 있습니다.</li>
			<li>실시간계좌이체의 경우 결제와 함께 요청시 결제 대행사에서 현금영수증이 발행됩니다.</li>
			</ul>
		</div>
		
		</form>
	</div>
	<!-- //subWrap -->	
	
</div>
<!-- //<?=$module?> -->