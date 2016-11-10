<?
if(!defined('_INPLUS_')) { exit; } 

$back_url = '../page/main.html';
$doc_title = '이벤트';
$footer_nav['1'] = true;

$oEvent = new EventUser();
$oEvent->init();
?>
<style type="text/css">
div.event_board_list > div > h4 {padding:8px 10px 8px 10px;}
div.event_board_list > div > ul {}
div.event_board_list > div > ul > li {display:block; width:100%; border-bottom:1px solid #f6f6f6; font-size:14px; color:#000; position:relative; font-weight:bold; text-align:left; box-sizing:border-box; background:#fff;}
div.event_board_list > div > ul > li > a {display:block; padding:15px 10px; box-sizing:border-box;}]
div.event_board_list > div > ul > li > a > strong {display:block;}
div.event_board_list > div > ul > li > a > span.data {display:block;color:#888;font-size:12px; padding:5px 0; font-weight:normal}
div.event_board_list > div > ul > li > a > span {width:100%; height:auto; max-width:600px; max-height:160px; }
div.event_board_list > div > ul > li > a > span > img  {display:block; width:100%; height:100%; max-width:600px; }

div.event_board_list li.no_data p { padding:15px 10px; text-align:center;color:#888;}
div.event_board_list li.no_data p i {display:block; margin-bottom:10px; font-size:40px; color:#cccccc }
</style>
<script type="text/javascript">
$(document).ready(function() {
	// 다음 페이지 가지고 오기
	$("#container").scroll(function() {
		getNextPageByAjax(this, document.event_page_form, function() { 
		
		});
	});
});
</script>

<div id="container" class="container">
	<div class="board">	
		<div class="event_board_list">
			<div class="event_wait_list">
				<h4><i class="xi-present"></i> 진행중인 이벤트</h4>
				<ul>
				<? 
				$sch_bo_state = 'Y';
				include(_MODULE_PATH_.'/event/user/ajax.list.php'); ?>
				</ul>
			</div>

			<div class="event_end_list">
				<h4><i class="xi-present"></i> 종료된 이벤트</h4>
				<ul>
				<ul id="board_list" class="board_list">
				<?
				$sch_bo_state = 'N';
				include(_MODULE_PATH_.'/event/user/ajax.list.php'); 
				?>		
				</ul>
				</ul>
			</div>
		</div>		
	</div>
</div>

<form name="event_page_form" method="get" action="../event/ajax.list.html" target="#board_list">
<input type="hidden" name="flag_json"		value="1" />
<input type="hidden" name="is_load"			value="" />
<input type="hidden" name="page"			value="2" />
<input type="hidden" name="sch_bo_state"	value="<?=$sch_bo_state?>" />
</form>
