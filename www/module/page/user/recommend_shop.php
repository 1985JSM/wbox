<?
if(!defined('_INPLUS_')) { exit; } 



$doc_title = '예약박스 추천샵';
$footer_nav['4'] = true;

$oPage = new PageUser();
$oPage->init();

?>

<style type="text/css">
div.recommend_shop {display:block; position:relative; width:100%;  margin-bottom:20px;  box-sizing:border-box; }
div.recommend_shop div.theme ul li {position:relative; width:100%; margin-bottom:10px; }
div.recommend_shop div.theme ul li div.info_area {display:block; overflow:hidden; position:absolute; z-index:10; width:100%; top:50%; margin-top:-36px; padding-top:10px; text-align:center; color:#fff; box-sizing:border-box;  background:url("/img/mobile/bg/bg_recommend_shop.png") top center no-repeat; background-size:23px 5px;}
div.recommend_shop div.theme ul li div.info_area strong {display:block; overflow:hidden; font-size:16px;text-overflow:ellipsis; white-space:nowrap;}
div.recommend_shop div.theme ul li div.info_area em {display:block; font-size:14px; overflow:hidden; text-overflow:ellipsis; white-space:nowrap;}
div.recommend_shop div.theme ul li div.img_area {display:block; overflow:hidden; background:#000; }
div.recommend_shop div.theme ul li div.img_area img {width:100%; height:auto; opacity:0.7; }

</style>

	<div id="container" class="container">
		<div class="recommend_shop">
			<div class="theme">
				<ul>
				<li class="theme_list01">
					<div class="info_area">
						<strong>나만 알고 싶은 가게</strong>
						<em>추천합니다</em>
					</div>
					<div class="img_area">
						<img src="/img/mobile/main/img_recommend_shop1.png" alt="">
					</div>
				</li>					
				</ul>
			</div>

			<ul id="shop_list" class="shop_list">
			<li>
				<div class="shopinfo_list">
					<a href="../shop/view.html?<?=$pk?>=<?=$list[$i][$pk]?>" class="btn_layer_page" target="#layer_page2">
						<div class="img_area"><img src="http://wbox.inplus21.com/data/upload/shop/Q/QB18J2JA3E63/0246d77b3c25a37f_thumb_640x380.jpg" alt=""></div>
						<div class="info_area">						
							<ul>
							<li class="tit">가게명이들어갑니다</li>
							<li class="addr">울산광역시 남구 무거동 </li>
							<li class="time"><i class="xi-time"></i> 10:00 ~ 08:00</li>
							</ul>
						</div>
					</a>

					<ul class="shop_list_btn">
					<li><button type="button" onclick="openReserveLayer('<?=$list[$i][$pk]?>')" class="ico_res"><i class="xi-calendar-add"></i><span class="hidden">예약하기</span></button></li>
					<li><a href="tel:<?=$list[$i]['sh_tel']?>" class="ico_tel"><i class="xi-phone"></i><span class="hidden">전화걸기</span></a></li>
					</ul>
				</div>
			</li>	
			<li>
				<div class="shopinfo_list">
					<a href="../shop/view.html?<?=$pk?>=<?=$list[$i][$pk]?>" class="btn_layer_page" target="#layer_page2">
						<div class="img_area"><img src="http://wbox.inplus21.com/data/upload/shop/Q/QB18J2JA3E63/0246d77b3c25a37f_thumb_640x380.jpg" alt=""></div>
						<div class="info_area">						
							<ul>
							<li class="tit">가게명이들어갑니다</li>
							<li class="addr">울산광역시 남구 무거동 </li>
							<li class="time"><i class="xi-time"></i> 10:00 ~ 08:00</li>
							</ul>
						</div>
					</a>

					<ul class="shop_list_btn">
					<li><button type="button" onclick="openReserveLayer('<?=$list[$i][$pk]?>')" class="ico_res"><i class="xi-calendar-add"></i><span class="hidden">예약하기</span></button></li>
					<li><a href="tel:<?=$list[$i]['sh_tel']?>" class="ico_tel"><i class="xi-phone"></i><span class="hidden">전화걸기</span></a></li>
					</ul>
				</div>
			</li>	
			<li>
				<div class="shopinfo_list">
					<a href="../shop/view.html?<?=$pk?>=<?=$list[$i][$pk]?>" class="btn_layer_page" target="#layer_page2">
						<div class="img_area"><img src="http://wbox.inplus21.com/data/upload/shop/Q/QB18J2JA3E63/0246d77b3c25a37f_thumb_640x380.jpg" alt=""></div>
						<div class="info_area">						
							<ul>
							<li class="tit">가게명이들어갑니다</li>
							<li class="addr">울산광역시 남구 무거동 </li>
							<li class="time"><i class="xi-time"></i> 10:00 ~ 08:00</li>
							</ul>
						</div>
					</a>

					<ul class="shop_list_btn">
					<li><button type="button" onclick="openReserveLayer('<?=$list[$i][$pk]?>')" class="ico_res"><i class="xi-calendar-add"></i><span class="hidden">예약하기</span></button></li>
					<li><a href="tel:<?=$list[$i]['sh_tel']?>" class="ico_tel"><i class="xi-phone"></i><span class="hidden">전화걸기</span></a></li>
					</ul>
				</div>
			</li>	
			<li>
				<div class="shopinfo_list">
					<a href="../shop/view.html?<?=$pk?>=<?=$list[$i][$pk]?>" class="btn_layer_page" target="#layer_page2">
						<div class="img_area"><img src="http://wbox.inplus21.com/data/upload/shop/Q/QB18J2JA3E63/0246d77b3c25a37f_thumb_640x380.jpg" alt=""></div>
						<div class="info_area">						
							<ul>
							<li class="tit">가게명이들어갑니다</li>
							<li class="addr">울산광역시 남구 무거동 </li>
							<li class="time"><i class="xi-time"></i> 10:00 ~ 08:00</li>
							</ul>
						</div>
					</a>

					<ul class="shop_list_btn">
					<li><button type="button" onclick="openReserveLayer('<?=$list[$i][$pk]?>')" class="ico_res"><i class="xi-calendar-add"></i><span class="hidden">예약하기</span></button></li>
					<li><a href="tel:<?=$list[$i]['sh_tel']?>" class="ico_tel"><i class="xi-phone"></i><span class="hidden">전화걸기</span></a></li>
					</ul>
				</div>
			</li>	
			<!--li class="no_data">
				<p>매장이 없습니다.</p>
			</li-->
			</ul>			
			
		</div>
		<!-- search_result -->
	</div>
	<!-- container -->