<?
if(!defined('_INPLUS_')) { exit; } 

$oApplication = new ApplicationFront();
$oApplication->init();

$uid = $oApplication->get('uid');
$data = $oApplication->selectDetail($uid);
?>
<div class="write">

	<p class="layer_txt"><img src="/module/page/front/img/img_txt_application.gif" alt="가맹점 등록 신청이 완료되었습니다." /></p>

	<table class="write_table" border="1">
	<caption>등록/수정</caption>
	<colgroup>
	<col width="140" />
	<col width="*" />
	</colgroup>
	<tbody>
	<tr>
		<th class="required">신청자</th>
		<td><?=$data['ap_name']?></span></td>				
	</tr>
	<tr>
		<th class="required">업체명</th>
		<td><?=$data['ap_shop_name']?></span></td>
	</tr>
	<tr>
		<th class="required">주소</th>
		<td><?=$data['txt_addr']?></td>	
	</tr>
	<tr>
		<th class="required">이메일</th>
		<td><?=$data['ap_email']?></td>
	</tr>
	<tr>
		<th class="required">연락처</th>
		<td><?=$data['ap_tel']?></td>
	</tr>			
	<tr>
		<th>요청이유</th>
		<td><?=nl2br($data['ap_memo'])?></td>
	</tr>
	</tbody>
	</table>

	<p class="button">
		<button type="button" onclick="closeLayerPopup()" class="sButton">닫기</button>
	</p>
</div>