<?
if(!defined('_INPLUS_')) { exit; }

$oPortfolio = new PortfolioStaff();
$oPortfolio->init();

$pk = $oPortfolio->get('pk');
$uid = $oPortfolio->get('uid');

$comment_pk = $oPortfolio->get('comment_pk');

// thumb
$oPortfolio->set('thumb_width', '640');
$oPortfolio->set('thumb_height', '380');

// data
$data = $oPortfolio->selectDetail($uid);
//$flag_like = $oPortfolio->checkFlagLike($uid, $member['mb_id']);

$main_img = $data['main_img'];
$sub_img = $data['sub_img'];
$pf_tag_arr = $data['pf_tag_arr'];

// shop
$sh_code = $data['sh_code'];
$sh_name = $data['sh_name'];

// comment
$cnt_comment = $oPortfolio->selectCountComment($uid);
?>
<style type="text/css">
div.view_detail_info{ border-bottom:0; margin-bottom:10px; }
div.view_detail_info:after{height:0; background:none; }

div.img_view {  width: 100%; }
div.img_view div.img_view_first {position: relative; padding-top: 57%; overflow: hidden; }
div.img_view div.img_view_first > div {  position: absolute; top: 0; left: 0; right: 0; bottom: 0; -webkit-transform: translate(50%,50%); -ms-transform: translate(50%,50%); transform: translate(50%,50%);}
div.img_view div.img_view_first > div.no_img {background:#000}
div.img_view div.img_view_first img {position: absolute; top: 0; left: 0; max-width: 100%; height: auto; -webkit-transform: translate(-50%,-50%); -ms-transform: translate(-50%,-50%); transform: translate(-50%,-50%); }
div.img_view div.img_view_first img.landscape { width: 100%; height: auto;  }

div.title_area {position:relative; padding:24px 10px 0 10px;}
div.title_area > span.writer {font-size:12px; padding-bottom:4px; color:#999; }
div.title_area > span.writer strong {font-weight:normal; color:#70cdd4;}
div.title_area div {display:inline-block; position:absolute; width:50px; height:50px; padding:0; margin:0; border-radius:50px; border:0; font-size:12px; text-align:center; background:#f06e58; color:#fff; }
div.title_area div.like {top:-25px;right:10px;}
div.title_area div i {display:block; font-size:14px; padding-top:10px;}

div.detail_con {position:relative; padding:12px 10px 20px 10px; border-bottom:4px solid #f6f6f6;}
div.detail_con div.tag, div.detail_con div.tag a {font-size:14px; color:#f06e58;}
div.detail_con div.tag {margin-top:30px; }
div.detail_con div.tag ul li {display:inline-block;  }

div.img_view_detail {width:100%;}
div.img_view_detail img {width:100%; margin-top:10px;}
div.img_view_detail img:first-child {margin-top:40px;}


div.view_detail_review{border-bottom:0; }
div.view_detail_review:after{height:0;}

div.view_detail_review ul.coment li div.img_area {overflow:hidden; width:50px; height:50px; }
div.view_detail_review ul.coment li div.img_area img{width:100%; height:100%;}
div.view_detail_review ul.coment li div.rep_area strong i{transform:rotate(0)}

div.view_detail_review ul.coment li div.rep_area span.rep_txt{display:block;color:#555;font-size:12px;line-height:18px;padding: 5px 0 5px 10px;}
div.view_detail_review ul.coment li div.rep_area span.rep_data{display:block;color:#888;font-size:12px; padding-left:10px}

div.view_detail_review ul.coment li a.btn_gray_line_s, div.view_detail_review ul.coment li button.btn_gray_line_s  {height:auto; line-height:1.5em; padding:5px 10px; box-sizing:border-box;}
div.view_detail_review ul.coment li button.btn_gray_line_s {margin-top:-1px;}
div.view_detail_review ul.coment li div.rep_area button.btn_gray_line_s {margin-top:8px;}
</style>
<script type="text/javascript">
$(document).ready(function() {

	// 다음 페이지 가지고 오기
	$("#container1").scroll(function() {
		getNextPageByAjax(this, document.comment_page_form, function() { 
		
		});
	});
});
</script>


<div class="location">
	<h2>포트폴리오관리</h2>
	<button type="button" onclick="closeLayerPage('1')" class="location_prev"><i class="xi-angle-left"></i></button>
</div>

<div id="container1" class="container">
	<div class="view_detail">
		<div class="view_detail_info">
					
			<div class="img_view">
				<div class="img_view_first">					
					<? if ($main_img['thumb'] == '') { ?>
					<div><img src="http://wbox.inplus21.com/img/mobile/common/img_noimg_640x360.gif" alt="이미지가 없습니다."></div>
					<? } else { ?>
					<div><img src="<?=$main_img['thumb']?>" alt="대표이미지" class="landscape" /></div>
					<? } ?>
				</div>
			</div>

			<div class="title_area">
				<span class="writer">by.<strong><?=$data['pf_name']?></strong></span>
				<h3><?=$data['pf_subject']?></h3>
				<div class="like"><i class="xi-heart"></i> <span id="cnt_portfolio_like"><?=number_format($data['cnt_like'])?></span></div>
			</div>

			<div class="detail_con">
				<p><?=nl2br($data['pf_content'])?></p>

				<? if(sizeof($pf_tag_arr) > 0) { ?>
				<div class="tag">
					<ul>
					<? for($i = 0 ; $i < sizeof($pf_tag_arr) ; $i++) { ?>
					<li>#<?=$pf_tag_arr[$i]?></li>
					<? } ?>
					</ul>					
				</div>
				<? } ?>

				<? if(sizeof($sub_img) > 0) { ?>
				<div class="img_view_detail">
					<? for($i = 0 ; $i < sizeof($sub_img) ; $i++) { ?>
					<img src="<?=$sub_img[$i]['thumb']?>" alt="서브이미지" />
					<? } ?>
				</div>
				<? } ?>
			</div>
		</div>
		<!-- //view_detail_info -->
			

		<div class="view_detail_review" id="portfolio_comment">

			<div class="review_write_area">			
				<a href="../portfolio/write_comment.html?sh_code=<?=$sh_code?>&<?=$pk?>=<?=$uid?>" class="review_write btn_layer_page" target="#layer_page6" title="댓글작성">총 <strong class="col_aqua"><span id="cnt_comment"><?=number_format($cnt_comment)?></span>명</strong>이 댓글을 남겨주셨습니다. <span class="col_orange">댓글쓰기</span></a>
			</div>

			<ul id="comment_list" class="coment">
			<? include_once(_MODULE_PATH_.'/portfolio/staff/ajax.comment_list.php'); ?>		
			</ul>
		
		</div>


	</div>
	<!-- //view_detail -->
	
</div>

<!-- 퀵 메뉴는 포트폴리오 > 상세보기에서 출력 -->
<div class="quick_menu">
	<div class="quick_menu_area">
		<ul class="quick_list quick_list02">
			<li><a href="../portfolio/process.html?mode=delete&<?=$pk?>=<?=$uid?>&page=<?=$page?><?=$query_string?>" id="btn_delete" class="sButton btn_aqua_line btn_res" title="삭제">삭제</a></li>
			<li><div><a href="../portfolio/write.html?<?=$pk?>=<?=$uid?>" class="btn_layer_page btn_aqua" target="#layer_page3">수정</a></div></li>
		</ul>
	</div>
	<div class="quick_menu_bg"></div>
</div>
<!-- //퀵 메뉴는 포트폴리오 > 상세보기에서 출력 -->

<form name="comment_page_form" method="get" action="../portfolio/ajax.comment_list.html" target="#comment_list">
<input type="hidden" name="flag_json"		value="1" />
<input type="hidden" name="is_load"			value="" />
<input type="hidden" name="page"			value="2" />
<input type="hidden" name="<?=$pk?>"		value="<?=$uid?>" />
</form>

<form name="delete_comment_form" method="post" action="../portfolio/process.html">
<input type="hidden" name="flag_json"			value="1" />
<input type="hidden" name="mode"				value="delete_comment" />
<input type="hidden" name="<?=$pk?>"			value="<?=$uid?>" />
<input type="hidden" name="<?=$comment_pk?>"	value="" />
</form>


<form name="delete_reply_form" method="post" action="../portfolio/process.html">
<input type="hidden" name="flag_json"			value="1" />
<input type="hidden" name="mode"				value="delete_reply" />
<input type="hidden" name="<?=$comment_pk?>"	value="" />
</form>
