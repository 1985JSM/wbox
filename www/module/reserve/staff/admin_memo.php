<?
if(!defined('_INPLUS_')) { exit; } 

$back_url = '../page/more.html';
$doc_title = '기본정보';
$footer_nav['2'] = true;


?>
<script type="text/javascript">
//<![CDATA[
$(document).ready(function() {

	$(document).on("click", ".btn_change_state", function(e) {
		changeReserveState(this, "view");
		e.preventDefault();
	});
});
//]]>
</script>
<style type="text/css">
div.basic_info {position:relative; padding:20px 10px; background:#fff;}
div.basic_info ul.info{position:relative; padding-bottom:20px}
div.basic_info ul.info li {position:relative; padding:4px 0 4px 80px;  }
div.basic_info ul.info li em {position:absolute; top:4px; left:0; border-bottom:0; font-size:12px; font-weight:normal;color:#999;}
</style>

<div id="container6" class="container">

	<div class="basic_info">
			
		<ul class="info">
		<li>
			<em>이름</em>
			<span>홍길동</span>
		</li>
		<li>
			<em>닉네임</em>
			<span>닉네임열글자까지들</span>
		</li>
		<li>
			<em>생일(성별)</em>
			<span>1988.01.01(여자)</span>
		</li>
		<li>
			<em>지역</em>
			<span>울산시 남구 무거동</span>
		</li>
		<li>
			<em>휴대폰</em>
			<span>01030775530</span>
		</li>
		<li>
			<em>이메일</em>
			<span>smile@inplusweb.com</span>
		</li>
		<li>
			<em>관리자메모</em><!-- 고객관리의 관리자 메모 출력 -->
			<span>관리자메모는 길게 들어가는 경우에는 이렇게 길게 나오게됩니다.관리자메모는 길게 들어가는 경우에는 이렇게 길게 나오게됩니다.관리자메모는 길게 들어가는 경우에는 이렇게 길게 나오게됩니다.</span>
		</li>
		</ul>
		

	</div>

</div>
<!-- //container -->