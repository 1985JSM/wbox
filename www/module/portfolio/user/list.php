<?
if(!defined('_INPLUS_')) { exit; } 

$back_url = '../page/main.html';
$doc_title = '포트폴리오';
$footer_nav['2'] = true;

$oPortfolio = new PortfolioUser();
$oPortfolio->init();

$sch_type_arr = $oPortfolio->get('sch_type_arr');

$order_field_arr = $oPortfolio->get('order_field_arr');
?>
<style type="text/css">
div.portfolio > ul {margin:10px;}
div.portfolio ul:after {display:block;content:'';clear:both}
div.portfolio ul li {position:relative; width:50%;float:left; margin-top:5px; border-radius:10px;  }

div.portfolio ul li div.portfolio_list {position:relative; padding-top:57%; overflow:hidden; margin:0 2px; border-bottom:2px solid #b5b5b5; border-left:0; border-right:0; border-bottom-right-radius:4px; border-bottom-left-radius:4px;  background:#fff;}
div.portfolio ul li div.portfolio_list div.img_area {position:absolute; top:0; left:0; right:0; bottom:0; width:100%; border-bottom:0; background:url("/img/mobile/bg/bg_loding_view.gif") 0 0 no-repeat; background-size:100%}
div.portfolio ul li div.portfolio_list div.img_area > img {position:absolute; top:0; left:0; max-width:100%; height:auto; border-top-right-radius:4px; border-top-left-radius:4px;}
/*
div.portfolio ul li div.portfolio_list {margin:0 2px; border-bottom:2px solid #b5b5b5; border-left:0; border-right:0; border-bottom-right-radius:4px; border-bottom-left-radius:4px;  background:#fff;}
div.portfolio ul li div.portfolio_list div.img_area {position:relative; width:100%; border-bottom:0;}
div.portfolio ul li div.portfolio_list div.img_area > img {width:100%; border-top-right-radius:4px; border-top-left-radius:4px;}
*/

div.portfolio ul li div.portfolio_list div.info_area { display:block; position:relative; height:120px; padding:16px; box-sizing:border-box; text-overflow:ellipsis; white-space:nowrap; overflow:hidden}
div.portfolio ul li div.portfolio_list div.info_area span {display:block; overflow:hidden; text-overflow:ellipsis; white-space:nowrap;}
div.portfolio ul li div.portfolio_list div.info_area span.writer {font-size:12px; padding-bottom:4px; color:#999; }
div.portfolio ul li div.portfolio_list div.info_area span.writer strong {font-weight:normal; color:#70cdd4;}
div.portfolio ul li div.portfolio_list div.info_area span.tit {font-size:16px; padding-bottom:20px; color:#333; }
div.portfolio ul li div.portfolio_list div.info_area span.tag {font-size:14px; color:#f06e58; }
div.portfolio ul li div.portfolio_list div.info_area a {color:#f06e58; }


div.portfolio ul li.no_data{width:100%; text-align:center;}
div.portfolio ul li.no_data p{ padding:50px 10px 150px; text-align:center;color:#555;background:url("/img/mobile/sub/no_data.png") no-repeat 50% 100%;background-size:110px 125px;-webkit-background-size:110px 125px}

div.portfolio_search {position:relative; background:#fff; padding:20px 10px; color:#000000; }
div.portfolio_search:after {display:block;content:'';clear:both}
div.portfolio_search div.portfolio_select {position:absolute; left:10px; top:20px; width:100px;}
div.portfolio_search div.portfolio_select select { width:100%;}
div.portfolio_search div.portfolio_search_area {position:relative; margin:0 0 0 105px; border:1px solid #c8c8c8; border-radius:2px;}

div.portfolio_search button.btn_search{width:37px;height:40px; text-align:center; line-height:40px;font-size:18px;position:absolute;top:0;right:0;color:#f06e58; margin:0; background:none; border:0}
div.portfolio_search div.search_input {padding-left:10px; box-sizing:border-box; margin-right:40px;}
div.portfolio_search div.search_input input{height:38px;line-height:438px;font-size:12px;color:#555;width:100%;border:0; }


div.selection_range {position:relative; display:block; margin:0; background:#f6f6f6; padding:15px 10px 0 10px; box-sizing:border-box;  font-size:12px; height:34px; }
div.selection_range ul:after {display:block; clear:both; content:'';}
div.selection_range ul li {display:block;float:left; width:auto; margin:0; padding:0; }
div.selection_range ul li:first-child {}

div.selection_range i {display:inline-block; line-height:20px; padding-right:5px; color:#bbb }
div.selection_range select { height:20px; line-height:20px; font-size:12px; padding:0 10px 0 0; background:transparent; -webkit-appearance:none; border:0; }

</style>
<script type="text/javascript">
$(document).ready(function() {
	// 다음 페이지 가지고 오기
	$("#container").scroll(function() {
		getNextPageByAjax(this, document.portfolio_page_form, function() { 
		
		});
	});

	// 정렬순서 변경
	$("#sch_order_field").on("change", function() {
		var sch_order_field = $(this).val();
		location.replace("./list.html?sch_order_field=" + sch_order_field);
	});
});
</script>

<div id="container" class="container">
	<div class="view_detail">	
		<div class="portfolio">

			<div class="portfolio_search">
				<form name="search_portfolio_form" method="get" action="./search_list.html" onsubmit="return submitSearchPortfolioForm(this)">

				<div class="portfolio_select">
					<select title="검색어" name="sch_type" class="required" >
					<? printSelectOption($sch_type_arr, '', 1); ?>
					</select>
				</div>

				<div class="portfolio_search_area">					
					<div class="search_input">
						<input type="text" name="sch_keyword" class="required" placeholder="검색어를 입력해주세요." title="검색어">
					</div>
					<button type="submit" class="btn_search"><i class="xi-magnifier"></i></button>
				</div>
				</form>

			</div>

			<div class="selection_range">
				<ul>		
				<li><i class="xi-lineheight-plus"></i></li>
				<li>
					<select name="sch_order_field" id="sch_order_field">
					<? printSelectOption($order_field_arr, $sch_order_field, 1); ?>
					</select>
				</li>
				
				</ul>
			</div>

			<ul id="portfolio_list">
			<? include_once(_MODULE_PATH_.'/portfolio/user/ajax.list.php'); ?>		
			</ul>	
		</div>
	</div>
</div>

<form name="portfolio_page_form" method="get" action="../portfolio/ajax.list.html" target="#portfolio_list">
<input type="hidden" name="flag_json"		value="1" />
<input type="hidden" name="is_load"			value="" />
<input type="hidden" name="page"			value="2" />
<input type="hidden" name="sch_order_field"	value="<?=$sch_order_field?>" />
</form>