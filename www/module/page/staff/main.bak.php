<?
if(!defined('_INPLUS_')) { exit; } 

$flag_use_info = true;
$footer_nav['1'] = true;

$oPage = new PageStaff();
$oPage->init();

// reserve
include_once(_MODULE_PATH_.'/reserve/reserve.staff.class.php');
$oReserve = new ReserveStaff();
$oReserve->init();
$rs_cnt = $oReserve->countByStaffId($member['mb_id'], 'W,P');
$oReserve->set('list_mode', 'wait');
$oReserve->set('cnt_rows', 3);
$rs_pk = $oReserve->get('pk');
$rs_list = $oReserve->selectList();

/*
// notice
include_once(_MODULE_PATH_.'/notice/notice.staff.class.php');
$oNotice = new NoticeStaff();
$oNotice->init();
$oNotice->set('cnt_rows', 3);
$nt_pk = $oNotice->get('pk');
$nt_list = $oNotice->selectList();
*/
?>
<script type="text/javascript">
$(document).ready(function() {
//	callNative("storeMemberId/<?=$member['mb_id']?>");
});
</script>

    <div id="container" class="main">
    	<div class="main_list01">
			<h4>현재 대기중 예약 <span class="col_orange"><?=number_format($rs_cnt)?></span>명</h4>
            <a href="<?=$base_uri?>/reserve/list.html" class="view_more">전체보기 <i class="fa fa-angle-right"></i></a>
            
			<ul class="list">
			<? for($i = 0 ; $i < sizeof($rs_list) ; $i++) { ?>
			<li>
            	<a href="<?=$base_uri?>/reserve/view.html?<?=$rs_pk?>=<?=$rs_list[$i][$rs_pk]?>">
					<span class="tit">
						<? if($rs_list[$i]['rs_type'] != 'U') { ?>
						<span class="ico_reservation">담당자예약</span>
						<? } ?>
						<?=$rs_list[$i]['us_name']?>			
					</span>

					<span class="txt"><?=$rs_list[$i]['txt_rs_datetime']?></span>

					<span class="txt">
						<span class="col_blue"><?=$rs_list[$i]['sv_name']?></span> | <span class="txt_rs_state state_<?=$rs_list[$i]['rs_state']?>"><?=$rs_list[$i]['txt_rs_state']?></span>
					</span>

					<? if($rs_list[$i]['flag_approach']) { ?>
					<span class="icon">임박</span>
					<? } ?>
                </a>
            </li>
			<? } if(sizeof($rs_list) == 0) { ?>
            <li class="no_data">
            	<p>대기 중인 리스트가 없습니다.</p>
            </li>
			<? } ?>
            </ul>
        </div>
        
        <div class="main_list02">
			<h4>담당자리뷰 <span class="col_orange"><?=number_format($rv_cnt)?></span>개</h4>
            <a href="<?=$base_uri?>/review/list.html" class="view_more">전체보기 <i class="fa fa-angle-right"></i></a>
            <ul class="list">
			<? for($i = 0 ; $i < sizeof($rv_list) ; $i++) { ?>
			<li>
            	<a href="<?=$base_uri?>/review/list.html">
					<span class="tit"><?=$rv_list[$i]['rv_name']?></span>
					<span class="txt"><?=$rv_list[$i]['rv_content']?></span>
                </a>
            </li>
			<? } if(sizeof($rv_list) == 0) { ?>
            <li class="no_data">
            	<p>담당자리뷰가 없습니다.</p>
            </li>
			<? } ?>
			</ul>
        </div>
        
        <div class="main_list03">
			<h4>공지사항</h4>
            <a href="<?=$base_uri?>/notice/list.html" class="view_more">전체보기 <i class="fa fa-angle-right"></i></a>
            <ul class="board_list">
			<? for($i = 0 ; $i < sizeof($nt_list) ; $i++) { ?>
			<li>
            	<a href="<?=$base_uri?>/notice/list.html"><?=$nt_list[$i]['nt_subject']?><span class="data">2015-06-01</span></a>
            </li>
			<? } if(sizeof($nt_list) == 0) { ?>
			<li class="no_data">
            	<p>등록된 공지사항이 없습니다.</p>
            </li>
			<? } ?>        	
        </ul>
        </div>
    </div>