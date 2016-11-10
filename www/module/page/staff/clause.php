<?
if(!defined('_INPLUS_')) { exit; } 

$doc_title = '이용약관';
$footer_nav['1'] = true;
$back_url = '../config/setting.html';

$oPage = new PageStaff();
$oPage->init();

$list_mode = $_GET['list_mode'];
if(!$list_mode) { $list_mode = 'c1'; }
?>
<script type="text/javascript">
$(document).ready(function() {

});
</script>

<div class="tab">
	<ul class="tab_list tab_list04 line">
	<li class="line01<? if($list_mode == 'c1') { ?> on<? } ?>"><a href="../page/clause.html?list_mode=c1">이용약관</a></li>
	<li class="line02<? if($list_mode == 'c2') { ?> on<? } ?>"><a href="../page/clause.html?list_mode=c2">개인정보<br>수집이용</a></li>
	<li class="line02<? if($list_mode == 'c3') { ?> on<? } ?>"><a href="../page/clause.html?list_mode=c3">개인정보<br>제3자제공</a></li>
	<li class="line03<? if($list_mode == 'c4') { ?> on<? } ?>"><a href="../page/clause.html?list_mode=c4">위치기반<br>서비스<br>이용약관</a></li>
	</ul>
</div>

<div id="container" class="container">
<? if($list_mode == 'c1') { ?>
	<div class="clause">
		<dl>
		<dt>제 1 조 ( 정의 )</dt>
		<dd>이 이용약관은 필요한 경우 수정될 수 있으며, 모바일 단발기, 이메일 또는 전화를 통해 직접 또는 간접적으로 제공된 모든 온라인 서비스에 적용됩니다. 플랫폼에 상관없이 당사의 애플리케이션을 통해 웹 사이트에 접속, 탐색하거나 이를 이용한 경우 또는 예약을 완료한 경우, 당사는 사용자가 아래의 이용 약관(개인정보 보호정책 포함)에 동의한 것으로 간주합니다. </dd>
		</dl>
	</div>	
	<? } else { ?>
	<div class="mysurr">
		<ul class="shop_list">
		<li class="no_data">
			<p>해당 서비스는 준비중입니다.</p>
		</li>		
		</ul>
	</div>	
	<? } ?>
</div>        
