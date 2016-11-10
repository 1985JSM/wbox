<?
if(!defined('_INPLUS_')) { exit; } 

$back_url = '';
$doc_title = '문의하기';
$footer_nav['1'] = true;

?>

<style type="text/css">

.inquiry {}

ul.inquiry {margin:20px 10px}
ul.inquiry > li{ margin-bottom:10px}
ul.inquiry > li .input_txt{border:1px solid #ccc;border-radius:3px; height:40px; line-height:40px ; font-size:14px;color:#555;width:100%; text-indent:10px; margin-bottom:5px;box-sizing:border-box; background:#fff}
ul.inquiry > li textarea.input_txt{height:160px; line-height:18px; padding:10px; text-indent:0}
ul.inquiry > li .txt_info{color:#888;font-size:12px; line-height:15px}
div.inquiry_agree { padding:0 10px 20px 10px; }
div.inquiry_agree p { margin-bottom:10px; font-size:12px; color:#888}

div.btn_inquiry {padding:10px 10px 20px 10px;}
</style>

<div class="tab">
	<ul id="shop_tab" class="tab_list tab_list02">
	<li class="on"><a href="#">1:1문의하기</a></li>
	<li><a href="#">1:1문의내역</a></li>
	</ul>
</div>

<div id="container"  class="container">
	<div class="inquiry">
		<form name="write_form" action="" method="" onsubmit="">
		<input type="hidden" name="" value="" />

		<ul class="inquiry">
		 <li>			
			<input type="text" name="" class="input_txt required" placeholder="제목을 입력해주세요." maxlength="50" title="제목">
		</li>				
		<li>
			<textarea type="text" name="ap_memo" class="input_txt" title="문의내용"  placeholder="문의 내용을 정확히 작성해 주세요." ></textarea>
		</li>
		</ul>
		
		<div class="inquiry_agree">
			<p>문의하신 내용에 대해 정확한 답변 및 원활한 상담을 위하여	고객님의 이메일, 휴대폰번호를 수집합니다. 수집된 개인정보는 개인정보의 수집 및 이용 목적이 달성되면 관련 법령 또는 회사				
				내부 방침에 의해 보존할 필요가 있는 경우를 제외하고는 지체없이 파기됩니다. 더 자세한 내용에 대해서는 개인정보취급방침을	참고하시기 바랍니다.</p>
			<span class="input"><input type="checkbox" name="checkbox" class="chk_agree required" id="chk01"> <label for="chk01">서비스 이용약관</label></span>
		</div>

		<div class="btn_inquiry">
			<a href="#" class="btn_orange">문의하기</a>
		</div>

		</form>
	</div>
</div>

