<?
if(!defined('_INPLUS_')) { exit; } 

$footer_nav['2'] = true;
$doc_title = '예약관리';
$back_url = '../page/main.html';

/* init Class */
$oReserve = new ReserveStaff();
$list_mode = $_GET['list_mode'];
if(!$list_mode) { $list_mode = 'wait'; }
if($list_mode == 'wait') {
	if(!$sch_order_field) {
		$sch_order_field = 'concat(rs_date, rs_time)';
	}
	if(!$sch_order_direct) {
		$sch_order_direct = 'asc';
	}
}

$oReserve->init();
$module_name = $oReserve->get('module_name');	// 모듈명

$cnt_wait = $oReserve->countByStaffId($member['mb_id'], 'W,P');
$cnt_end = $oReserve->countByStaffId($member['mb_id'], 'E,C,B');
$cnt_ok = $oReserve->countByStaffId($member['mb_id'], 'E');
$cnt_cancel = $oReserve->countByStaffId($member['mb_id'], 'C');
$cnt_cancel2 = $oReserve->countByStaffId($member['mb_id'], 'B');

$rs_state_arr = $oReserve->get('rs_state_arr');
unset($rs_state_arr['W']);
unset($rs_state_arr['P']);
?>
<script type="text/javascript">
//<![CDATA[
$(document).ready(function() {
	$("#container").scroll(function() {
		getNextPage();		
	});	

	$(document).on("click", ".btn_change_state", function(e) {
		changeReserveState(this, "list");
		e.preventDefault();
	});
});
//]]>
</script>

	<div class="tab">
    	<ul class="tab_list tab_list02">
        <li<? if($list_mode == 'wait') { ?> class="on"<? } ?>><a href="../reserve/list.html?list_mode=wait">진행중인 예약</a></li>
        <li<? if($list_mode == 'end') { ?> class="on"<? } ?>><a href="../reserve/list.html?list_mode=end">종료된 예약</a></li>
        </ul>
    </div>    
    
	<div id="container" class="reservation2">
		<div class="res2_list">
			<? if($list_mode == 'wait') { ?>
			<h4>현재 대기중 예약 <span class="col_orange"><?=number_format($cnt_wait)?></span>명</h4>
			<div class="btn_switch">
				<a href="./list.html?list_mode=wait&sch_order_direct=asc" <? if($sch_order_direct == 'asc') { ?>class="on"<? } ?> title="임박순">임박순</a>
				<a href="./list.html?list_mode=wait&sch_order_field=reg_time&sch_order_direct=desc" <? if($sch_order_direct != 'asc') { ?>class="on"<? } ?> title="신청순">신청순</a>
			</div>
			<? } else if($list_mode == 'end') { ?>
			<h4>
				누적 총 <span class="col_orange"><?=number_format($cnt_end)?></span>건 
				<span class="txt">완료 <span class="col_orange"><?=number_format($cnt_ok)?></span>건, 정상취소 <span class="col_black"><?=number_format($cnt_cancel)?></span>건, 비정상취소 <span class="col_black"><?=number_format($cnt_cancel2)?></span>건</span>
			</h4>

			<form name="search_form" method="get" action="./list.html" onsubmit="return submitSearchForm(this)">
			<input type="hidden" name="page" value="1" />
			<input type="hidden" name="sch_type" value="all" />
			<input type="hidden" name="list_mode" value="end" />


            <ul class="list_search">
            <li>
            	<select name="sch_rs_state">
				<option value="">전체</option>
				<? printSelectOption($rs_state_arr, $sch_rs_state, 1); ?>
                </select>
            </li>
            <li>
            	<div class="list_search_form">
                	<div class="list_search_input"><input type="text" name="sch_keyword" value="<?=$sch_keyword?>" class="input_txt" placeholder="이름/휴대폰 검색" /></div>
                    <button type="submit" class="btn_search"><i class="fa fa-search"></i></button>
                </div>
            </li>
            </ul>

			</form>
			<? } ?>

			<ul id="reserve_list" class="list">
			<? include_once(_MODULE_PATH_.'/reserve/staff/ajax_list.php'); ?>		
			</ul>
		</div>

    </div>

	<input type="hidden" id="is_load"	value="" />
	<input type="hidden" id="ajax_url"	value="ajax_list.html" />
	<input type="hidden" id="next_page"	value="2" />
	<input type="hidden" id="list_mode"	value="<?=$list_mode?>" />
	<input type="hidden" id="sch_order_direct"	value="<?=$sch_order_direct?>" />
	<input type="hidden" id="sch_order_field"	value="<?=$sch_order_field?>" />

