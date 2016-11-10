<?
if(!defined('_INPLUS_')) { exit; }

$flag_use_header = false;
$flag_use_footer = false;
$oSms = new SmsManager();
$pk = $oSms->get('pk');
$module = $oSms->get('module');
$uid = $_GET['uid'];
?>
<script type="text/javascript">
$(document).ready(function(){
	$(".file_test").change(function(){
		var form = $("#file_form").contents();
		var file_content = $(this).val();

		//form.find(".file_list").find("img").attr("src", "data:image/jpeg;base64," + file_content);
	});
});
function fileCheck(f){
    return true;
}
</script>
<ul class="guide_list">
	<li>업로드 가능 파일 확장자 : JPG</li>
	<li>등록 가능 용량 : 이미지당 30 KB, 최대 3개</li>
	<li>크기 제한 : 가로 174픽셀 * 세로 144픽셀 이내<br />
		(초과시 SKT수신자 전송실패)</li>
</ul>

<span class="fileSelect">파일 선택</span>
<form name="mms_img" id="mms_img" method="post" action="./process.html" target="file_form" enctype="multipart/form-data" onsubmit="return fileCheck(this);">
    <input type="hidden" name="mode" value="mms_image_insert" />
    <input type="hidden" name="module" value="<?=$module?>" />
    <input type="hidden" name="uid" value="<?=$uid?>" />
	<input type="file" name="wr_file[]" value="" class="file" size="80" title="첨부파일" />
    <button type="submit" value="추가" />
<iframe src="./ajax.mms_list.html?uid=<?=$uid?>" id="file_form" name="file_form"></iframe>

<!-- btn_layer -->
<div class="btn_layer">
	<a href="#" class="sButton primary">등록</a>
	<a href="#" class="sButton active">취소</a>
</div>
<!-- //btn_layer -->
</form>