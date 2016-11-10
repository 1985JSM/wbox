<?
if(!defined('_INPLUS_')) { exit; } 

$back_url = '../page/main.html';
$doc_title = '공지사항';
$footer_nav['1'] = true;

$list_mode = 'admin';
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


<div id="container" class="container">

	<div class="board">	
		<div class="event_board_list">
			<div class="event_wait_list">
				<h4><i class="xi-present"></i> 진행중인 이벤트</h4>
				<ul>
				<li>
					<a href="#" class="btn_layer_page" target="#layer_page1">
						<strong>제목이들어갑니다.</strong>
						<span class="data">기간 2016.06.01 ~ 2016.06.30</span>
						<span>
							<img src="/img/mobile/sub/img_event_list.jpg" alt="banner image" />
						</span>
					</a>
				</li>
				</ul>
			</div>

			<div class="event_end_list">
				<h4><i class="xi-present"></i> 종료된 이벤트</h4>
				<ul id="board_list" class="board_list">
				<li>
					<a href="#" class="btn_layer_page" target="#layer_page1">
						<strong>제목이들어갑니다.</strong>
						<span class="data">기간 2016.06.01 ~ 2016.06.30</span>
						<span>
							<img src="/img/mobile/sub/img_event_list.jpg" alt="banner image" />
						</span>
					</a>
				</li>	
				</ul>
			</div>
		</div>		
	</div>

</div>
