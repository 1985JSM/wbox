<?
if(!defined('_INPLUS_')) { exit; } 

$flag_use_shop_tab = true;
$shop_tab['1'] = 'on';
$flag_use_footer_nav = true;
$flag_use_quick = true;

//$back_url = '../shop/view.html?sh_code='.$sh_code;
$back_url = '';

$oPortfolio = new PortfolioUser();
if(!$sch_sh_code && $sh_code) {
	$sch_sh_code = $sh_code;
}
$oPortfolio->set('sch_sh_code', $sch_sh_code);
if($sch_st_id) {
	$oPortfolio->set('sch_st_id', $sch_st_id);
}
$oPortfolio->init();

/* shop */
if(!isset($oShop)) {
	include_once(_MODULE_PATH_.'/shop/shop.user.class.php');
	$oShop = new ShopUser();
	$oShop->init();
}
$sh_data = $oShop->selectDetail($sh_code);
$doc_title = '포트폴리오';
?>
<script type="text/javascript">
$(document).ready(function() {
	$("#container").scroll(function() {
		getNextPage();		
	});
});
</script>
<style type="text/css">
div.portfolio > ul {margin:10px;}
div.portfolio ul:after {display:block;content:'';clear:both}
div.portfolio ul li {position:relative; width:50%;float:left; margin-top:5px; border-radius:10px;  }
div.portfolio ul li div.portfolio_list {margin:0 2px; border-bottom:2px solid #b5b5b5; border-left:0; border-right:0; border-bottom-right-radius:4px; border-bottom-left-radius:4px;  background:#fff;}
div.portfolio ul li div.portfolio_list div.img_area {position:relative; width:100%; border-bottom:0;}
div.portfolio ul li div.portfolio_list div.img_area > img {width:100%; border-top-right-radius:4px; border-top-left-radius:4px;}

div.portfolio ul li div.portfolio_list div.info_area { padding:16px; }
div.portfolio ul li div.portfolio_list div.info_area span {display:block; overflow:hidden; text-overflow:ellipsis; white-space:nowrap;}
div.portfolio ul li div.portfolio_list div.info_area span.writer {font-size:12px; padding-bottom:4px; color:#999; }
div.portfolio ul li div.portfolio_list div.info_area span.writer strong {font-weight:normal; color:#70cdd4;}
div.portfolio ul li div.portfolio_list div.info_area span.tit {font-size:16px; padding-bottom:20px; color:#333; }
div.portfolio ul li div.portfolio_list div.info_area span.tag {font-size:14px; color:#f06e58; }
div.portfolio ul li div.portfolio_list div.info_area span.tag a {color:#f06e58; }


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

</style>

<div id="container2" class="container">

	<div class="view_detail">	
        <div id="portfolio_list" class="portfolio">
			<div class="portfolio_search">
				<div class="portfolio_select">
					<select title="검색어" class="required" id="" name="">
					<option value="">지역</option>
					<option value="">담당자</option>
					<option value="">제목</option>
					<option value="">태그</option>
					</select>
				</div>

				<div class="portfolio_search_area">					
					<div class="search_input">
						<input type="text" name="sch_keyword" class="required" placeholder="검색어를 입력해주세요." title="검색어">
					</div>
					<button class="btn_search"><i class="xi-magnifier"></i></button>
				</div>

			</div>
			<!-- //portfolio_search -->
			<ul>
			<li>
			
				<div class="portfolio_list">
					<a href="#" class="" target="" title="">
						<div class="img_area">
							<img src="http://wbox.inplus21.com/data/upload/portfolio/7/7/7dd709333952c3a6_thumb_320x190.jpg" alt="">
						</div>
						<div class="info_area">
							<span class="writer">by.<strong>작성자이름</strong></span>
							<span class="tit">2016 S/S 유행 디자인의 선두주자</span>
							<span class="tag"><a href="">#태그명</a></span>
						</div>
					</a>
				</div>
			</li>
			<li>
			
				<div class="portfolio_list">
					<a href="#" class="" target="" title="">
						<div class="img_area">
							<img src="http://wbox.inplus21.com/data/upload/portfolio/7/7/7dd709333952c3a6_thumb_320x190.jpg" alt="">
						</div>
						<div class="info_area">
							<span class="writer">by.<strong>작성자이름</strong></span>
							<span class="tit">2016 S/S 유행 디자인의 선두주자</span>
							<span class="tag"><a href="">#태그명</a></span>
						</div>
					</a>
				</div>
			</li>

			<li class="no_data">
				<p>등록된 이미지가 없습니다.</p>
			</li>
			</ul>	
		</div>
    </div>

	<input type="hidden" id="is_load"	value="" />
	<input type="hidden" id="ajax_url"	value="ajax_list.html" />
	<input type="hidden" id="next_page"	value="2" />
	<input type="hidden" id="query_string"	value="<?=$query_string?>" />


	