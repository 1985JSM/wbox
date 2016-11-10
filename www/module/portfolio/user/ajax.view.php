<?
if(!defined('_INPLUS_')) { exit; } 

if(!$oPortfolio) {
	include_once(_MODULE_PATH_.'/portfolio/portfolio.user.class.php');
	$oPortfolio = new PortfolioUser();
	$oPortfolio->init();
}

$pk = $oPortfolio->get('pk');
$uid = $oPortfolio->get('uid');

$comment_pk = $oPortfolio->get('comment_pk');

// thumb
$oPortfolio->set('thumb_width', '640');
$oPortfolio->set('thumb_height', '380');

// data
$data = $oPortfolio->selectDetail($uid);
$flag_like = $oPortfolio->checkFlagLike($uid, $member['mb_id']);

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
div.img_view div.img_view_first {position: relative; padding-top: 60%; overflow: hidden; }
div.img_view div.img_view_first > div {  position: absolute; top: 0; left: 0; right: 0; bottom: 0; background:url("/img/mobile/bg/bg_loding_view.gif") 0 0 no-repeat; background-size:100%}
div.img_view div.img_view_first > div.no_img {background:#000}
div.img_view div.img_view_first img {position: absolute; top: 0; left: 0; max-width: 100%; height: auto; }
div.img_view div.img_view_first img.landscape { width: 100%; height: auto;  }

div.title_area {position:relative; padding:24px 10px 0 10px;}
div.title_area > span.writer {font-size:12px; padding-bottom:4px; color:#999; }
div.title_area > span.writer strong {font-weight:normal; color:#70cdd4;}
div.title_area button {display:inline-block; position:absolute; width:50px; height:50px; padding:0; margin:0; border-radius:50px; border:0; font-size:12px; text-align:center; background:#999999; color:#fff; cursor:pointer; }
div.title_area button.like {top:-25px;right:10px;}
div.title_area button.on {background:#f06e58;}
div.title_area button i {display:block; font-size:14px;}

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
</style>

<div class="view_detail">
	<div class="view_detail_info">
				
		<div class="img_view">
			<div class="img_view_first">
				<? if ($main_img['thumb'] == '') { ?>
				<div><img src="/img/mobile/common/img_noimg_640x360.gif" alt="이미지가 없습니다."></div>
				<? } else { ?>
				<div><img src="<?=$main_img['thumb']?>" alt="대표이미지" class="landscape" /></div>
				<? } ?>
			</div>
		</div>

		<div class="title_area">
			<span class="writer">by.<strong><?=$data['pf_name']?></strong></span>
			<h3><?=$data['pf_subject']?></h3>
			<? if($is_user) { ?><button type="button"  onclick="togglePortfolioLike(this, '<?=$uid?>')" class="like <? if($flag_like) { ?>on<? } ?>"><i class="xi-heart"></i> <span id="cnt_portfolio_like"><?=number_format($data['cnt_like'])?></span></button><? } else { ?><button type="button"  onclick="alert('로그인한 사람만 좋아요를 선택할 수 있습니다.')" class="like"><i class="xi-heart"></i> <span id="cnt_portfolio_like"><?=number_format($data['cnt_like'])?></span></button><? } ?>
		</div>

		<div class="detail_con">
			<p><?=nl2br($data['pf_content'])?></p>

			<? if(sizeof($pf_tag_arr) > 0) { ?>
			<div class="tag">
				<ul>
				<? for($i = 0 ; $i < sizeof($pf_tag_arr) ; $i++) { ?>
				<li><a href="../portfolio/search_list.html?sch_type=pf_tags&sch_keyword=<?=$pf_tag_arr[$i]?>">#<?=$pf_tag_arr[$i]?></a></li>
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
			<a href="../portfolio/write_comment.html?sh_code=<?=$sh_code?>&<?=$pk?>=<?=$uid?>" class="review_write <? if($is_user) { ?>btn_layer_page<? } else { ?>btn_only_login<? } ?>" target="#layer_page6" title="댓글작성">총 <strong class="col_aqua"><span id="cnt_comment"><?=number_format($cnt_comment)?></span>명</strong>이 댓글을 남겨주셨습니다. <span class="col_orange">댓글쓰기</span></a>
		</div>

		<ul id="comment_list" class="coment">
		<? include_once(_MODULE_PATH_.'/portfolio/user/ajax.comment_list.php'); ?>		
		</ul>
	
	</div>


</div>
<!-- //view_detail -->

<form name="delete_comment_form" method="post" action="../portfolio/process.html">
<input type="hidden" name="flag_json"			value="1" />
<input type="hidden" name="mode"				value="delete_comment" />
<input type="hidden" name="<?=$pk?>"			value="<?=$uid?>" />
<input type="hidden" name="<?=$comment_pk?>"	value="" />
</form>