<?
if(!defined('_INPLUS_')) { exit; } 

$back_url = '../portfolio/list.html';
$doc_title = '포트폴리오';
$footer_nav['2'] = true;

$oPortfolio = new PortfolioUser();
$oPortfolio->init();

$sch_type_arr = $oPortfolio->get('sch_type_arr');

$order_field_arr = $oPortfolio->get('order_field_arr');

ob_start();
include_once(_MODULE_PATH_.'/portfolio/user/ajax.list.php');
$search_list = ob_get_contents();
ob_end_clean();
?>
<style type="text/css">
div.portfolio ul {margin:10px;}
div.portfolio ul:after {display:block;content:'';clear:both}
div.portfolio ul li {position:relative; width:50%;float:left; margin-top:5px; border-radius:10px;  }
/*
div.portfolio ul li div.portfolio_list {margin:0 2px; border-bottom:2px solid #b5b5b5; border-left:0; border-right:0; border-bottom-right-radius:4px; border-bottom-left-radius:4px;  background:#fff;}
div.portfolio ul li div.portfolio_list div.img_area {position:relative; width:100%; border-bottom:0;}
div.portfolio ul li div.portfolio_list div.img_area > img {width:100%; border-top-right-radius:4px; border-top-left-radius:4px;}
*/

div.portfolio ul li div.portfolio_list {position:relative; padding-top:60%; overflow:hidden; margin:0 2px; border-bottom:2px solid #b5b5b5; border-left:0; border-right:0; border-bottom-right-radius:4px; border-bottom-left-radius:4px;  background:#fff;}
div.portfolio ul li div.portfolio_list div.img_area {position:absolute; top:0; left:0; right:0; bottom:0; width:100%; border-bottom:0; background:url("/img/mobile/bg/bg_loding_view.gif") 0 0 no-repeat; background-size:100%}
div.portfolio ul li div.portfolio_list div.img_area > img {position:absolute; top:0; left:0; max-width:100%; height:auto; border-top-right-radius:4px; border-top-left-radius:4px;}

div.portfolio ul li div.portfolio_list div.info_area { display:block; position:relative; height:120px; padding:16px; box-sizing:border-box; text-overflow:ellipsis; white-space:nowrap; overflow:hidden }
div.portfolio ul li div.portfolio_list div.info_area span {display:block; overflow:hidden; text-overflow:ellipsis; white-space:nowrap;}
div.portfolio ul li div.portfolio_list div.info_area span.writer {font-size:12px; padding-bottom:4px; color:#999; }
div.portfolio ul li div.portfolio_list div.info_area span.writer strong {font-weight:normal; color:#70cdd4;}
div.portfolio ul li div.portfolio_list div.info_area span.tit {font-size:16px; padding-bottom:20px; color:#333; }
div.portfolio ul li div.portfolio_list div.info_area a.tag {font-size:14px; color:#f06e58; }

div.portfolio ul li.no_data{width:100%; text-align:center;}
div.portfolio ul li.no_data p{ padding:50px 10px 150px; text-align:center;color:#555;background:url(/img/mobile/sub/no_data.png) no-repeat 50% 100%;background-size:110px 125px;-webkit-background-size:110px 125px}

div.portfolio_search {background:#fff; padding:20px 10px; color:#000000; overflow:hidden; text-overflow:ellipsis;  white-space:nowrap;}
div.portfolio_search strong {}

div.selection_range {position:relative; display:block; margin:0; background:#f6f6f6; padding:15px 10px 0 10px; box-sizing:border-box;  font-size:12px; height:34px; }
div.selection_range ul:after {display:block; clear:both; content:'';}
div.selection_range ul {margin:0}
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
		location.replace("./search_list.html?sch_type=<?=$sch_type?>&sch_keyword=<?=$sch_keyword?>&sch_order_field=" + sch_order_field);
	});
});
</script>

<div id="container" class="container">

	<div class="view_detail">	
        <div class="portfolio">
			<div class="portfolio_search">
				<!--strong class="col_orange">사하</strong> <strong class="col_aqua">15개</strong> 검색 결과 -->
				<strong class="col_orange"><?if($sch_type == 'a.pg_tags') { ?>#<? } ?><?=$sch_keyword?></strong> <?=$sch_type_arr[$sch_type]?> <strong class="col_aqua"><?=number_format($total_cnt)?>개</strong> 검색 결과				
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
			<?=$search_list?>		
			</ul>		
		</div>
    </div>

</div>

<form name="portfolio_page_form" method="get" action="../portfolio/ajax.list.html" target="#portfolio_list">
<input type="hidden" name="flag_json"		value="1" />
<input type="hidden" name="is_load"			value="" />
<input type="hidden" name="sch_type"		value="<?=$sch_type?>" />
<input type="hidden" name="sch_keyword"		value="<?=$sch_keyword?>" />
<input type="hidden" name="page"			value="2" />
<input type="hidden" name="sch_order_field"	value="<?=$sch_order_field?>" />
</form>
	