<?
if(!defined('_INPLUS_')) { exit; } 

$layout_size = 'small';

$oPage = new PageAdmin();
$oPage->init();

# 1. 방문자
include_once(_MODULE_PATH_.'/shop_visit/shop_visit.class.php');
$oShopVisit = new ShopVisit();
$oShopVisit->init();

// 오늘 방문자
$now_time = time();
$now_date = date('Y-m-d');
$cnt_today_visit = $oShopVisit->countRows($now_date);

// 어제 방문자
$pre_time = $now_time - 24 * 3600;
$pre_date = date('Y-m-d', $pre_time);
$cnt_pre_visit = $oShopVisit->countRows($pre_date);

# 2. 즐겨찾기
include_once(_MODULE_PATH_.'/favorite/favorite.class.php');
$oFavorite = new Favorite();
$oFavorite->init();
$cnt_total_favorite = $oFavorite->countTotal();

# 3. 예약현황
include_once(_MODULE_PATH_.'/reserve/reserve.admin.class.php');
$oReserve = new ReserveAdmin();
$oReserve->init();
$reserve_pk = $oReserve->get('pk');

// 누적 예약건수
$cnt_total_reserve = $oReserve->countTotalShopCode('W,P,E,C,B');

// 오늘 예약현황
$oReserve->set('sch_rs_date', $now_date);
$oReserve->set('order_field', 'rs_date');
$oReserve->set('order_direct', 'desc');
$rs_list = $oReserve->selectList();

# 5. 고객
include_once(_MODULE_PATH_.'/user/user.manager.class.php');
$oUser = new UserManager();

$oUser->set('cnt_rows', 4);

// 단골 회원
$oUser->set('list_mode', 'reserve');
$oUser->set('order_field', 'cnt_reserve');
$oUser->set('order_direct', 'desc');
$oUser->init();
$rg_list = $oUser->selectList();

// 즐겨찾기 회원
$oUser->set('list_mode', 'favorite');
$oUser->set('order_field', 'last_favorite_time');
$oUser->set('order_direct', 'desc');
$fv_list = $oUser->selectList();


# 6. 공지사항
include_once(_MODULE_PATH_.'/notice/notice.class.php');
$oNotice = new Notice();
$oNotice->init();
$notice_pk = $oNotice->get('pk');
$oNotice->set('cnt_rows', 4);
$nt_list = $oNotice->selectList();
?>
<style>
#main {}
#main div.main_box { margin-bottom:30px; }
#main div.main_top {}
#main div.main_article {}
#main div.main_wrap { position:relative; height:205px; margin-bottom:30px; *zoom:1; }
#main div.main_wrap:after { clear:both; display:block; content:""; }
#main div.main_wrap div.main_box { float:left; width:46%; margin-bottom:0; }
#main div.main_wrap > div.main_box:first-child { margin-right:4%; }
</style>
<div id="main">

	<div class="main_box">
		<div class="main_top">	
			<h4>사이트 접속 통계</h4>
			<div></div>
		</div>
		<div class="main_article">
			<table class="list_table border odd" border="1">
			<colgroup>
			<col width="25%" />
			<col width="25%" />
			<col width="25%" />
			<col width="25%" />
			</colgroup>
			<thead>
			<tr>
				<th>오늘 방문자</th>
				<th>어제 방문자</th>
				<th>즐겨찾기</th>
				<th>누적 예약건수</th>
			</tr>
			</thead>
			<tbody>
			<tr>
				<td><?=number_format($cnt_today_visit)?></td>
				<td><?=number_format($cnt_pre_visit)?></td>
				<td><?=number_format($cnt_total_favorite)?></td>
				<td><?=number_format($cnt_total_reserve)?></td>
			</tr>
			</tbody>
			</table>				
		</div>
	</div>

	<div class="main_box">
		<div class="main_top">	
			<h4>오늘 예약현황</h4>
			<div></div>
		</div>
		<div class="main_article">
			<table class="list_table border odd" border="1">
			<colgroup>
			<col width="15%" />
			<col width="15%" />
			<col width="30%" />
			<col width="15%" />
			<col width="25%" />
			</colgroup>
			<thead>
			<tr>
				<th>예약상태</th>
				<th>예약자명</th>
				<th>서비스명</th>
				<th>담당자명</th>
				<th>예약일시</th>
			</tr>			
			</thead>
			<tbody>
			<? for($i = 0 ; $i < sizeof($rs_list) ; $i++) { ?>
			<tr>
				<td><?=$rs_list[$i]['txt_rs_state']?></td>
				<td><?=$rs_list[$i]['us_name']?></td>
				<td class="subject"><a href="<?=$base_uri?>/reserve/write.html?<?=$reserve_pk?>=<?=$rs_list[$i][$reserve_pk]?>"><?=$rs_list[$i]['sv_name']?></a></td>
				<td><?=$rs_list[$i]['st_name']?></td>
				<td><?=$rs_list[$i]['txt_rs_datetime']?></td>
			</tr>
			<? } if(sizeof($rs_list) == 0) { printNoData(5); } ?>
			</tbody>
			</table>			
		</div>
	</div>

	<!--div class="main_wrap">
	
		<div class="main_box">
			<div class="main_top">	
				<h4>단골회원</h4>
				<div></div>
			</div>
			<div class="main_article">
				<table class="list_table border odd" border="1">
				<colgroup>
				<col width="50%" />
				<col width="50%" />
				</colgroup>
				<tbody>
				<? for($i = 0 ; $i < sizeof($rg_list) ; $i++) { ?>
				<tr>
					<td class="subject"><a href="<?=$base_uri?>/user/list_by_reserve.html?sch_order_field=cnt_reserve&sch_order_direct=desc"><?=$rg_list[$i]['mb_name']?></a></td>
					<td><?=number_format($rg_list[$i]['cnt_reserve'])?></td>
				</tr>
				<? } if(sizeof($rg_list) == 0) { printNoData(2); } ?>
				</tbody>
				</table>				
			</div>
		</div>
	</div>

	<div class="main_wrap">
		<div class="main_box">
			<div class="main_top">	
				<h4>공지사항</h4>
				<div></div>
			</div>
			<div class="main_article">
				<table class="list_table border odd" border="1">
				<colgroup>
				<col width="70%" />
				<col width="30%" />
				</colgroup>
				<tbody>
				<? for($i = 0 ; $i < sizeof($nt_list) ; $i++) { 
					$nt_list[$i]['txt_nt_subject'] = cutString($nt_list[$i]['nt_subject'], 30);
					?>
				<tr>
					<td class="subject"><a href="<?=$base_uri?>/notice/view.html?<?=$notice_pk?>=<?=$nt_list[$i][$notice_pk]?>"><?=$nt_list[$i]['txt_nt_subject']?></a></td>
					<td><?=$nt_list[$i]['reg_date']?></td>
				</tr>
				<? } if(sizeof($nt_list) == 0) { printNoData(2); } ?>
				</tbody>
				</table>				
			</div>
		</div>

		<div class="main_box">
			<div class="main_top">	
				<h4>신규 즐겨찾기 고객</h4>
				<div></div>
			</div>
			<div class="main_article">
				<table class="list_table border odd" border="1">
				<colgroup>
				<col width="50%" />
				<col width="50%" />
				</colgroup>
				<tbody>
				<? for($i = 0 ; $i < sizeof($fv_list) ; $i++) { ?>
				<tr>
					<td class="subject"><a href="<?=$base_uri?>/user/list_by_favorite.html?sch_order_field=last_favorite_time&sch_order_direct=desc"><?=$fv_list[$i]['mb_name']?></a></td>
					<td><?=$fv_list[$i]['last_reserve_date']?></td>
				</tr>
				<? } if(sizeof($fv_list) == 0) { printNoData(2); } ?>
				</tbody>
				</table>					
			</div>
		</div>
	</div-->


</div>
