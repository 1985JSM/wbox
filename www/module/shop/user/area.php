<?
if(!defined('_INPLUS_')) { exit; } 

//$back_type = 'hidden';
$back_url = '../page/main.html';
$doc_title = '검색';
$footer_nav['3'] = true;

$oShop = new ShopUser();
$oShop->init();

if(!$sch_sh_sido && $is_user) {
	$sch_sh_sido = $area_arr[$member['mb_area']];
}

if(!$sch_sh_sido) {
	$sch_sh_sido = $_POST['sch_sh_sido'] = $_GET['sch_sh_sido'] = '부산광역시';
}
$sido_arr = selectSido();
?>
<script type="text/javascript">
$(document).ready(function() {
	var obj_link = $("a.btn_choose_sido").on("click", function(e) {
		obj_link.parent("li").removeClass("on");
		$(this).parent("li").addClass("on");
	});
});
</script>

	<div class="search">
		<form name="search_shop_form" method="get" action="./search_list.html" onsubmit="return submitSearchShopForm(this)">
		<input type="hidden" name="sch_type" value="all" />

    	<div class="search_area">
        	<button class="btn_search"><i class="xi-magnifier"></i></button>
            <div class="search_input">
            	<input type="text" name="sch_keyword" class="required" placeholder="검색어를 입력해주세요." title="검색어">
            </div>
        </div>
		<button type="submit" class="btn_search02">검색</button>
		</form>
    </div>
        
	<div id="container" class="container">
		<div class="search_option">
			<ul class="area_search">
			<? foreach($sido_arr as $key => $val) { ?>
			<li<?if($val == $sch_sh_sido) { ?> class="on"<? } ?>><a href="./ajax.sigungu.html?sch_sh_sido=<?=$val?>" class="btn_ajax btn_choose_sido" target="#sigungu_list"><?=$key?></a></li>
			<? } ?>
			</ul>
			<ul id="sigungu_list" class="area_search2">
			<? include_once(_MODULE_PATH_.'/shop/user/ajax.sigungu.php'); ?>
			</ul>
		</div>
    </div>
