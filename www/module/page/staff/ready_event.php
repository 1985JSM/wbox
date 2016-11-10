<?
if(!defined('_INPLUS_')) { exit; } 

$doc_title = '이벤트';
$footer_nav['5'] = true;
$back_url = '../page/more.html';

$oPage = new PageStaff();
$oPage->init();

$list_mode = $_GET['list_mode'];
if(!$list_mode) { $list_mode = 'now'; }
?>
<script type="text/javascript">
$(document).ready(function() {

});
</script>

	<div class="tab">
    	<ul class="tab_list tab_list03">
        <li<? if($list_mode == 'now') { ?> class="on"<? } ?>><a href="../page/ready_event.html?list_mode=now">진행중인 이벤트</a></li>
        <li<? if($list_mode == 'end') { ?> class="on"<? } ?>><a href="../page/ready_event.html?list_mode=end">종료된 이벤트</a></li>
        <li<? if($list_mode == 'result') { ?> class="on"<? } ?>><a href="../page/ready_event.html?list_mode=result">당첨자 발표</a></li>
        </ul>
    </div>

	<div id="container" class="mysurr">
		<ul class="shop_list">
		<li class="no_data">
			<p>해당 서비스는 준비중입니다.</p>
		</li>		
        </ul>
    </div>

        
