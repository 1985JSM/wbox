<?
if(!defined('_INPLUS_')) { exit; } 

$doc_title = '포트폴리오관리';
$footer_nav['5'] = true;
$back_url = '../page/main.html';

$oPortfolio = new PortfolioStaff();
$oPortfolio->init();
?>
<style type="text/css">

div.portfolio > ul {margin:10px;}
div.portfolio ul:after {display:block;content:'';clear:both}
div.portfolio ul li {position:relative; width:50%;float:left; margin-top:5px; border-radius:10px;  }
div.portfolio ul li div.portfolio_list {position:relative; padding-top:57%; overflow:hidden; margin:0 2px; border-bottom:2px solid #b5b5b5; border-left:0; border-right:0; border-bottom-right-radius:4px; border-bottom-left-radius:4px;  background:#fff;}
div.portfolio ul li div.portfolio_list div.img_area {position:absolute; top:0; left:0; right:0; bottom:0; width:100%; border-bottom:0; background:url("/img/mobile/bg/bg_loding_view.gif") 0 0 no-repeat; background-size:100%}
div.portfolio ul li div.portfolio_list div.img_area > img {position:absolute; top:0; left:0; max-width:100%; height:auto; border-top-right-radius:4px; border-top-left-radius:4px;}

div.portfolio ul li div.portfolio_list div.info_area { display:block; position:relative; height:120px; padding:16px; box-sizing:border-box; text-overflow:ellipsis; white-space:nowrap; overflow:hidden}
div.portfolio ul li div.portfolio_list div.info_area span {display:block; overflow:hidden; text-overflow:ellipsis; white-space:nowrap;}
div.portfolio ul li div.portfolio_list div.info_area span.writer {font-size:12px; padding-bottom:4px; color:#999; }
div.portfolio ul li div.portfolio_list div.info_area span.writer strong {font-weight:normal; color:#70cdd4;}
div.portfolio ul li div.portfolio_list div.info_area span.tit {font-size:16px; padding-bottom:20px; color:#333; }
div.portfolio ul li div.portfolio_list div.info_area span.tag {font-size:14px; color:#f06e58; }
div.portfolio ul li div.portfolio_list div.info_area span.tag a {color:#f06e58; }
div.portfolio ul li div.portfolio_list div.info_area a {color:#f06e58; }

div.portfolio ul li.no_data{width:100%; text-align:center;}
div.portfolio ul li.no_data p{ padding:50px 10px 150px; text-align:center;color:#555;background:url("/img/mobile/sub/no_data.png") no-repeat 50% 100%;background-size:110px 125px;-webkit-background-size:110px 125px}

div.portfolio_btn {position:relative; background:#fff; padding:20px 10px; color:#000000; }*/


</style>
<script type="text/javascript">
$(document).ready(function() {
	// 다음 페이지 가지고 오기
	$("#container").scroll(function() {
		getNextPageByAjax(this, document.portfolio_page_form, function() { 
		
		});
	});
});
</script>

<div id="container" class="container">
	<div class="portfolio">	
		
		<div class="portfolio_btn">
			<? if ($member['mb_id'] == 'QJ22L0FE7C00' && 1 == 2) { ?>
			<a href="../portfolio/write_test.html" class="btn_gray">포트폴리오 등록</a>
			<? } else { ?>
			<a href="../portfolio/write.html" class="btn_layer_page btn_gray" target="#layer_page3">포트폴리오 등록</a>
			<? } ?>
		</div>

		<ul id="portfolio_list">
		<? include_once(_MODULE_PATH_.'/portfolio/staff/ajax.list.php'); ?>		
		</ul>	

	</div>
</div>

<form name="portfolio_page_form" method="get" action="../portfolio/ajax.list.html" target="#portfolio_list">
<input type="hidden" name="flag_json"		value="1" />
<input type="hidden" name="is_load"			value="" />
<input type="hidden" name="page"			value="2" />
</form>
	