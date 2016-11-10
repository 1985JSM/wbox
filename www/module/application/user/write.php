<?
if(!defined('_INPLUS_')) { exit; } 

$back_url = '../page/main.html';
$doc_title = '가맹점등록요청';
$footer_nav['1'] = true;


$oApplication = new ApplicationUser();
$oApplication->init();
$sido_arr = selectSido();
?>
<script type="text/javascript">
$(document).ready(function() {
	$("#ap_sido").on("change", function(e) {
		changeSigungu($(this).val());
	});	

	$("#ap_sigungu").on("change", function(e) {
		changeDong($("#ap_sido").val(), $(this).val());
	});	
});
</script>

<div id="container" class="container">
	<div class="join">

		<form name="write_form" action="./process.html" method="post" onsubmit="return submitWriteForm(this)">
		<input type="hidden" name="mode" value="insert" />
		
		<div class="join_intro">
			<p>자주가는 매장을 가맹점으로 추천하고 싶은 분!<br>예약박스의 가맹점이 되고 싶으신 분!<br>가맹점 등록 요청을 여기서 해주세요.<br>최대한 빠른 시일내에 가맹점으로 초대하겠습니다.</p>
			<div class="join_intro_cloud_ani"></div>
		</div>
        
        <ul class="join_form">
        <li>
        	<span class="tit">업체명</span>
            <input type="text" name="ap_shop_name" class="input_txt required" placeholder="업체명을 입력해 주세요." maxlength="30" title="업체명">
        </li>
		 <li>
        	<span class="tit">담당자</span>
            <input type="text" name="ap_name" class="input_txt required" placeholder="담당자를 입력해 주세요." maxlength="10" title="담당자">
        </li>
        <li>
			<span class="tit">주소</span>
			<ul class="inp_info02">
            <li>
				<div>					
					<select name="ap_sido" id="ap_sido" class="required" title="주소 시/도">
					<option value="">시/도</option>
					<? printSelectOption($sido_arr, ''); ?>
					</select>
				</div>
			</li>
			<li>
				<div>
					<select name="ap_sigungu" id="ap_sigungu" class="required" title="주소 시/군/구">
					<option value="">시/군/구</option>
					</select>
				</div>
			</li>
			<li>
				<div>
					<select name="ap_dong" id="ap_dong" class="required" title="주소 읍/면/동">
					<option value="">읍/면/동</option>
					</select>
				</div>
			</li>
			</ul>
        </li>
		<li>
        	<span class="tit">이메일</span>
            <input type="text" name="ap_email" class="input_txt required" placeholder="업체 이메일을 입력해주세요." maxlength="50" title="이메일">
        </li>
        <li>
        	<span class="tit">연락처</span>
            <input type="tel" name="ap_tel" class="input_txt required" placeholder="업체 연락처를 입력해주세요." maxlength="15" title="연락처">
        </li>
        <li>
        	<span class="tit">요청이유</span>
            <textarea type="text" name="ap_memo" class="input_txt" title="요청이유"></textarea>
            <p class="txt">등록 요청 접수 후 섭외까지 약 2주간의 시간이 소요됩니다.</p>
        </li>
        </ul>
        
        <div class="join_submit"><button type="submit" class="btn_orange">확인</button></div>
    </div>
	</form>
	</div>

</div>

	