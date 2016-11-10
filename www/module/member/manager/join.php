<?
if(!defined('_INPLUS_')) { exit; } 

$flag_use_header = false;
$flag_use_footer = false;

/* init Class */
$oMember = new MemberManager();
$oMember->init();
$module_name = $oMember->get('module_name');	// 모듈명

/* application */
if(!isset($oApplication)) {
	include_once(_MODULE_PATH_.'/application/application.class.php');
	$oApplication = new Application();
	$oApplication->init();
}
$data = $oApplication->selectDetail($ap_code);
if(!$data['ap_code'] || $data['ap_state'] != 'P') {
	alert('비정상적인 접근입니다.', '/webmanager/member/login.html');
}

/* addr */
$sido_arr = selectSido();
if($data['ap_sido']) {
	$sigungu_arr = selectSigungu($data['ap_sido']);
}

if($data['ap_sido'] && $data['ap_sigungu']) {
	$dong_arr = selectDong($data['ap_sido'], $data['ap_sigungu']);
}
?>
<script type="text/javascript">
//<![CDATA[
$(document).ready(function() {

	/* 아이디 검사 */
	$("#mb_id").on("focusout", function() {
		checkMemberId();
	});

	$("#sh_sido").on("change", function(e) {
		changeSigungu($(this).val());
	});	

	$("#sh_sigungu").on("change", function(e) {
		changeDong($("#sh_sido").val(), $(this).val());
	});	
});
//]]>
</script>
<style>
body{ background:#f0f0f0}
.mt_5{ margin-top:5px;}

#page_wrap{padding:40px 0;}
#page_contents{width:800px; padding:100px 100px 150px; margin:0 auto; background:#fff url(/webmanager/member/img/page_logo.png) no-repeat 727px 70px;}
#page_contents h1{ margin-bottom:40px;}
#page_contents .txt01{color:#000;font-size:14px; line-height:24px;font-weight:bold; margin-bottom:20px;}
#page_contents .txt01 span{color:#f3003f}
#page_contents .txt02{color:#000;font-size:11px; line-height:18px; margin-bottom:5px;}
#page_contents .txt03{color:#f3003f;font-size:11px; line-height:18px; margin-bottom:25px;}
#page_contents .txt03 strong{font-weight:bold}


#page_contents .tbl_btn{ margin-top:20px; text-align:center}
#member h4{display:none}

.page_copyright{ padding:70px 0 30px ; text-align:center; font-size:12px; color:#6e6e6e}
</style>
</head>
<body>

<div id="page_wrap">
	<div id="page_contents">
    	<h1><img src="/webmanager/member/img/tit01.png" alt="가맹점 추가정보 작성" /></h1>

		<div id="<?=$module?>">

			<div class="write">

				<h4>기본사항</h4>
				
				<form name="write_form" method="post" action="./process.html" onsubmit="return submitWriteForm(this);">
				<input type="hidden" name="mode" value="insert" />	
				<input type="hidden" name="sh_code" value="<?=$ap_code?>" />
				
				<table class="write_table" border="1">
				<caption>등록/수정</caption>
				<colgroup>
				<col width="140" />
				<col width="*" />
				</colgroup>
				<tbody>		
				<?
				printTr('코드', $ap_code.' (자동생성)');
				printWriteInput('가맹점명', 'sh_name', $data['ap_shop_name'], 'required', 50, 30); 
				printWriteInput('담당자', 'mb_name', $data['ap_name'], 'required', 20, 10); 
				printWriteInput('연락처', 'sh_tel', $data['ap_tel'], 'required', 20, 15);
				printWriteInput('이메일', 'mb_email', $data['ap_email'], 'required', 50, 50);
				?>
				<tr>
					<th class="required">주소</th>
					<td>	
						<select name="sh_sido" id="sh_sido" class="select required" title="주소 시/도">
						<option value="">시/도</option>
						<? printSelectOption($sido_arr, $data['ap_sido']); ?>
						</select>
					
						<select name="sh_sigungu" id="sh_sigungu" class="select required" title="주소 시/군/구">
						<option value="">시/군/구</option>
						<? printSelectOption($sigungu_arr, $data['ap_sigungu']); ?>
						</select>
					
						<select name="sh_dong" id="sh_dong" class="select required" title="주소 읍/면/동">
						<option value="">읍/면/동</option>
						<? printSelectOption($dong_arr, $data['ap_dong']); ?>
						</select>

						<div class="mt_5">
							<input type="text" name="sh_addr2" value="" class="text required" size="50" maxlength="30" title="상세주소" />
						</div>						
					</td>	
				</tr>
				<tr>
					<th class="required">아이디</th>
					<td>			
						<input type="text" name="mb_id" id="mb_id" value="" class="text required" size="30" maxlength="20" title="아이디" />
						<input type="hidden" name="chk_mb_id" value="0" />
						<span id="state_mb_id"></span>			
						<br />
						<span class="comment">-아이디는 20자 이하의 영대/소문자, 숫자, _만 입력 가능합니다.</span>
					</td>
				</tr>
				<tr>
					<th class="required">비밀번호</th>
					<td>
						<input type="password" name="mb_pass" value="" class="text required" size="30" maxlength="20" title="비밀번호" />
						<br />
						<span class="comment">-비밀번호 20자 이하의 영대/소문자, 숫자, 특수숫자만 입력 가능합니다.</span>
					</td>
				</tr>
				<tr>
					<th class="required">비밀번호 확인</th>
					<td>
						<input type="password" name="mb_pass2" value="" class="text required" size="30" maxlength="20" title="비밀번호 확인" />				
					</td>
				</tr>		
				</tbody>
				</table>		

				<p class="button">
					<input type="image" src="/webmanager/member/img/btn_success.png" alt="가맹점 등록완료" />
				</p>

				</form>
			</div>
		</div>
	</div>
    
    <p class="page_copyright">COPYRIGHT 2015 © Reservation box ALL RIGHT RESERVED.</p>
</div>


</body>
</html>	