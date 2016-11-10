<?
if(!defined('_INPLUS_')) { exit; } 

$doc_title = '포트폴리오관리';
$footer_nav['5'] = true;
$back_url = '../page/more.html';

$oPortfolio = new PortfolioStaff();
$oPortfolio->init();
?>
<script type="text/javascript">
$(document).ready(function() {
	$("#container").scroll(function() {
		getNextPage();		
	});
});
</script>
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

	<div id="container1" class="container">
		<div class="view_detail">
			<div class="view_detail_info">

				<div class="img_view">
					<div class="img_view_first">					
						<div><img src="http://wbox.inplus21.com/data/upload/portfolio/7/7/7dd709333952c3a6_thumb_640x380.jpg" alt="대표이미지" class="landscape"></div>
					</div>
				</div>

				<div class="title_area">
					<span class="writer">by.<strong>박은경</strong></span>
					<h3>포트폴리오 테스트7</h3>				
				</div>

				<div class="detail_con">
					<p>포트폴리오 테스트7</p>

					<div class="tag">
						<ul>
						<li><a href="../portfolio/search_list.html?sch_type=pf_tags&amp;sch_keyword=유니스텔라">#유니스텔라</a></li>
						</ul>					
					</div>

					<div class="img_view_detail">
						<img src="http://wbox.inplus21.com/data/upload/portfolio/7/7/33dd61251db004a2_thumb_640x380.jpg" alt="서브이미지">
					</div>
				</div>
			</div>
			<!-- //view_detail_info -->


			<div class="view_detail_review" id="portfolio_comment">

				<div class="review_write_area">			
					<a href="../portfolio/write_comment.html?sh_code=PL05N3AE0A01&amp;pf_id=7" class="review_write btn_layer_page" target="#layer_page6" title="댓글작성">총 <strong class="col_aqua"><span id="cnt_comment">0</span>명</strong>이 댓글을 남겨주셨습니다. <span class="col_orange">댓글쓰기</span></a>
				</div>

				<ul id="comment_list" class="coment">
				<li>
					<div class="img_area"><img src="http://wbox.inplus21.com/data/upload/user/P/PL05L5EA7B42/42ec3cf86d724f6d_thumb_120x120.png" alt="profile image"></div>
					<em>마용호</em>
					<span class="date"><i class="xi-time"></i> 2016.06.01</span>
					<span class="txt">sdsdasdsdsa</span>
					<button type="button" onclick="" class="btn_gray_line_s">답변</button>
					<button type="button" onclick="" class="btn_gray_line_s">삭제</button>

					<div class="rep_area">
						<strong><i class="xi-comments"></i> 전지현 디자이너</strong>
						<span class="rep_txt">내용이들어갑니다아</span>
						<span class="rep_data"><i class="xi-time"></i> 2016.06.01</span>
						<a href="#" class="btn_gray_line_s">삭제</a>
					</div>
				</li>
				<li class="no_data">
					<p>등록된 댓글이 없습니다.</p>
				</li>	            

				</ul>
			</div>

		</div>
	</div>

	<!-- 퀵 메뉴는 포트폴리오 > 상세보기에서 출력 -->
	<div class="quick_menu">
		<div class="quick_menu_area">
			<ul class="quick_list quick_list01">
			<li><div><a href="../staff/view.html?mb_id=<?=$data['st_id']?>" class="btn_layer_page btn_aqua_line btn_res" target="#layer_page3">수정</a></div></li>
			</ul>
		</div>
		<div class="quick_menu_bg"></div>
	</div>
	<!-- //퀵 메뉴는 포트폴리오 > 상세보기에서 출력 -->