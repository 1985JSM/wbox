<?
if(!defined('_INPLUS_')) { exit; } 

/* staff */
$oStaff = new StaffUser();
$oStaff->init();
$pk = $oStaff->get('pk');
$uid = $oStaff->get('uid');

// thumb
$oStaff->set('flag_use_thumb', true);
$oStaff->set('thumb_width', '640');
$oStaff->set('thumb_height', '380');

// data
$data = $oStaff->selectDetail($uid);
$flag_like = $oStaff->checkFlagLike($uid, $member['mb_id']);

$sh_code = $data['sh_code'];
$sh_name = $data['sh_name'];

/* portfolio */
if(!isset($oPortfolio)) {
	include_once(_MODULE_PATH_.'/portfolio/portfolio.user.class.php');
	$oPortfolio = new PortfolioUser();
	$oPortfolio->init();
}
$oPortfolio->set('cnt_rows', 6);
$oPortfolio->set('sch_a_st_id', $uid);
$sch_a_st_id = $uid;
?>
<style type="text/css">
div.view_detail{ background:#f6f6f6}

div.view_detail_info{ border-bottom:0; margin-bottom:10px; }
div.view_detail_info:after{height:0; background:none; }


div.img_view {  width: 100%; }
div.img_view div.img_view_first {position: relative; padding-top:60%; overflow: hidden; }
div.img_view div.img_view_first > div { position: absolute; top: 0; left: 0; right: 0; bottom: 0; 
	/*-webkit-transform: translate(50%,50%); -ms-transform: translate(50%,50%); transform: translate(50%,50%); */ 
	background:url("/img/mobile/bg/bg_loding_view.gif") no-repeat 50% 50%; background-size:100%;
}
div.img_view div.img_view_first > div.no_img {background:#000}
div.img_view div.img_view_first img {position: absolute; top: 0; left: 0; max-width: 100%; height: auto; /*-webkit-transform: translate(-50%,-50%); -ms-transform: translate(-50%,-50%); transform: translate(-50%,-50%); */}
div.img_view div.img_view_first img.landscape { width: 100%; height: auto;  }
/*
div.img_view {position:relative; width:100%; height:0; padding-top:57%; border:0;}
div.img_view div.img_view_first {background:#f6f6f6; }
div.img_view div.img_view_first img { position:absolute; top:0; left:0; width:100%; height:100%;  border:0;} 
*/

div.title_area {position:relative; padding:24px 10px 0 10px;}
div.title_area button{display:inline-block; position:absolute; width:50px; height:50px; padding:0; margin:0; border-radius:50px; border:0; font-size:12px; text-align:center; background:#999999; color:#fff; cursor:pointer; }
div.title_area a {display:inline-block; position:absolute; width:50px; height:50px; padding:0; margin:0; border-radius:50px; border:0; font-size:12px; text-align:center; background:#999999; color:#fff; cursor:pointer; }
div.title_area a.reserve {top:-25px;right:70px; background:#12aec3; padding-top:10px; box-sizing:border-box;}
div.title_area button.like {top:-25px;right:10px;}
div.title_area button.on {background:#f06e58;}
div.title_area button i, div.title_area a i {display:block; font-size:14px;}

div.detail_con {position:relative; padding:12px 10px 20px 10px; border-bottom:4px solid #f6f6f6;}

div.detail_caption li.service strong {display:inline-block;padding-right:5px; line-height:18px; font-weight:normal;}

/*div.view_detail_board {position:relative; margin-bottom:6px; padding:20px 10px}*/
div.view_detail_board {position:relative; margin-bottom:6px;}
div.view_detail_board h4{color:#333;font-weight:bold; padding:20px 10px 0 10px}
div.view_detail_board h4 span{font-weight:normal; padding-left:6px}
div.view_detail_board .view_more{font-size:12px; position:absolute;top:20px;right:10px;color:#888}

div.portfolio ul:after {display:block;content:'';clear:both}
div.portfolio ul li {position:relative; width:50%;float:left; margin-top:5px; border-radius:10px;  }
/*
div.portfolio ul li div.portfolio_list {margin:0 2px; border-bottom:2px solid #b5b5b5; border-left:0; border-right:0; border-bottom-right-radius:4px; border-bottom-left-radius:4px;  background:#fff;}
div.portfolio ul li div.portfolio_list div.img_area {position:relative; width:100%; border-bottom:0;}
div.portfolio ul li div.portfolio_list div.img_area > img {width:100%; border-top-right-radius:4px; border-top-left-radius:4px;}
*/


div.portfolio ul li div.portfolio_list {position:relative; padding-top:57%; overflow:hidden; margin:0 2px; border-bottom:2px solid #b5b5b5; border-left:0; border-right:0; border-bottom-right-radius:4px; border-bottom-left-radius:4px;  background:#fff;}
div.portfolio ul li div.portfolio_list div.img_area {position:absolute; top:0; left:0; right:0; bottom:0; width:100%; border-bottom:0; background:url("/img/mobile/bg/bg_loding_view.gif") 0 0 no-repeat; background-size:100%}
div.portfolio ul li div.portfolio_list div.img_area > img {position:absolute; top:0; left:0; max-width:100%; height:auto; border-top-right-radius:4px; border-top-left-radius:4px;}

div.portfolio ul li div.portfolio_list div.info_area { padding:16px; }
div.portfolio ul li div.portfolio_list div.info_area span {display:block; overflow:hidden; text-overflow:ellipsis; white-space:nowrap;}
div.portfolio ul li div.portfolio_list div.info_area span.writer {font-size:12px; padding-bottom:4px; color:#999; }
div.portfolio ul li div.portfolio_list div.info_area span.writer strong {font-weight:normal; color:#70cdd4;}
div.portfolio ul li div.portfolio_list div.info_area span.tit {font-size:16px; padding-bottom:20px; color:#333; }
div.portfolio ul li div.portfolio_list div.info_area span.tag {font-size:14px; color:#f06e58; }

#layer_page3.open {display:block; top:0; right:0;}
#layer_page4 {display:none;}
</style>
<script type="text/javascript">
$(document).ready(function() {
	
});
</script>

<div class="location">
	<h2><?=$sh_name?></h2>
	<button type="button" onclick="closeLayerPage('3')" class="location_prev"><i class="xi-angle-left"></i></button>
</div>

<div id="container3" class="container">

	<div class="view_detail">
		<div class="view_detail_info">
					
			<div class="img_view">
				<div class="img_view_first">					
					<div><img src="<?=$data['thumb']?>" alt="<?=$data['txt_staff']?> thumbnail image" class="landscape" /></div>
				</div>
			</div>

			<div class="title_area">
				<h3><?=$data['txt_staff']?></h3>
				<a href="../reserve/write.html?reserve_type=staff&sh_code=<?=$sh_code?>&st_id=<?=$uid?>" class="<? if($is_user) { ?>btn_layer_page<? } else { ?>btn_only_login<? } ?> reserve" target="#layer_page5"><i class="xi-calendar"></i> 예약</a>
				<button type="button" onclick="toggleStaffLike(this, '<?=$uid?>')" class="like <? if($flag_like) { ?>on<? } ?>"><i class="xi-heart"></i> <span id="cnt_staff_like"><?=number_format($data['cnt_like'])?></span></button>
			</div>

			<div class="detail_con">
				<p><?=getWithoutNull($data['mb_pr'])?></p>				
			</div>

			<div class="detail_caption">
				<ul>
				<li>
					<em>근무시간</em><span><?=$data['s_work']?> ~ <?=$data['e_work']?></span>
				</li>
				<li>
					<em>휴무시간</em><span><?=$data['s_break']?> ~ <?=$data['e_break']?></span>
				</li>
				<li class="service">
					<em>서비스</em>
					<span class="col_aqua">
						<? $sv_list = explode(',', $data['txt_sv_code']); 
						for($i = 0 ; $i < sizeof($sv_list) ; $i++) { ?>
						<strong><?=$sv_list[$i]?></strong>
						<? } ?>
				</span>
				</li>
				</ul>
			</div>
		</div>
		<!-- //view_detail_info -->
		
		<div class="view_detail_board">
			<h4>포트폴리오</h4>
			<a href="../portfolio/staff_list.html?sh_code=<?=$sh_code?>&sch_a_st_id=<?=$uid?>" class="btn_layer_page view_more" target="#layer_page4">전체보기 <i class="xi-angle-right"></i></a>
			<div class="portfolio">
			<ul>
			<? include_once(_MODULE_PATH_.'/portfolio/user/ajax.list.php'); ?>			
			</ul>
			</div>
		</div>

	</div>
	<!-- //view_detail -->

</div>
