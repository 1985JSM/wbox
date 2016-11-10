<?
if(!defined('_INPLUS_')) { exit; } 

$back_url = '../page/main.html';
$doc_title = '회원탈퇴';
$footer_nav['1'] = true;

$oMember = new MemberUser();
$oMember->init();
?>
<script type="text/javascript">
$(document).ready(function() {

});
</script>

<div id="container" class="container">
	
	<div class="leave">
		<div class="leave_success">
			<p class="tit"><strong class="col_orange">탈퇴</strong>가 완료되었습니다.</p>
			<p>보다 나은 예약박스로<br />다시 만나뵐 수 있기를 바랍니다</p>
		</div>
		
		<div class="btn_leave_home">
			<a href="../page/main.html" class="btn_gray">홈으로</a>
		</div>
	</div>       
	
</div>

	