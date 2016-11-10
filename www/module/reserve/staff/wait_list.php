<?
if(!defined('_INPLUS_')) { exit; } 

$footer_nav['2'] = true;
$doc_title = '예약관리';
$back_url = '../page/main.html';

/* init Class */
$oReserve = new ReserveStaff();
$oReserve->init();
$module_name = $oReserve->get('module_name');	// 모듈명

$list_mode = 'wait';
if(!$sch_order_field) {
	$sch_order_field = 'concat(rs_date, rs_time)';
}

if(!$sch_order_direct) {
	$sch_order_direct = 'asc';
}

ob_start();
include_once(_MODULE_PATH_.'/reserve/staff/ajax.list.php');
$list_content = ob_get_contents();
ob_end_clean();
?>
<style type="text/css">
div.reservation2 div.res2_list {margin-bottom:20px; border:0;}
div.reservation2 div.res2_list:after{height:0;}
div.reservation2 div.res2_list div.list {border-top:20px solid #f6f6f6;}

div.reservation2 div.res2_list h4 {padding:20px 10px; border:0;  }
div.reservation2 div.range { position:absolute; top:10px; right:10px; }

div.res2_list {position:relative; margin-bottom:20px}
div.res2_list:after{height:0;}
div.res2_list:after{display:block;content:'';width:100%;height:1px; background:#cecece; position:absolute;bottom:-2px;left:0}

div.res2_list div.list ul li { position:relative; border:0; border-bottom:4px solid #f6f6f6; }
div.res2_list div.list ul li strong.user_name {display:block; margin-bottom:16px; padding-right:100px; color:#333;} 

div.res2_list div.list ul li > a {display:block; position:relative;  padding:15px 10px;color:#333}

div.res2_list div.list ul li > a ul.res_info {position:relative; line-height:1.0em;}
div.res2_list div.list ul li > a ul.res_info li {padding:4px 0 4px 80px; border:0; }
div.res2_list div.list ul li > a ul.res_info li em {position:absolute; top:4px; left:0; border-bottom:0; font-size:12px; font-weight:normal;color:#999;}
div.res2_list div.list ul li > a ul.res_info li em.state_W {font-size:14px; font-weight:bold; color:#12aec3;} /* 신청중 */
div.res2_list div.list ul li > a ul.res_info li em.state_F {font-size:14px; font-weight:bold; color:#9e6eaf;} /* 담당자확정 */
div.res2_list div.list ul li > a ul.res_info li em.state_P {font-size:14px; font-weight:bold; color:#f06e58;} /* 진행중 */
div.res2_list div.list ul li > a ul.res_info li em.state_E {font-size:14px; font-weight:bold; color:#12aec3;} /* 완료 */
div.res2_list div.list ul li > a ul.res_info li em.state_C {font-size:14px; font-weight:bold; color:#888;} /* 정상취소 */
div.res2_list div.list ul li > a ul.res_info li em.state_B {font-size:14px; font-weight:bold; color:#f06e58;} /* 비정상취소 */

div.res2_list div.list ul li > a ul.res_info li span {position:relative; font-size:12px;}

div.res2_list div.list ul li > a ul.res_info li.res_state { min-height:14px;margin-bottom:8px; }
div.res2_list div.list ul li > a ul.res_info li.res_state em {font-size:14px;}
div.res2_list div.list ul li > a ul.res_info li.res_state span {font-size:11px; }

div.res2_list div.list ul li > a ul.res_info li span strong {font-weight:normal;}
div.res2_list div.list ul li > a ul.res_info li span.service strong {display:block; padding-top:4px; overflow:hidden; white-space:nowrap; text-overflow:ellipsis; }
div.res2_list div.list ul li > a ul.res_info li span.service strong:first-child {padding-top:0; }

div.res2_list div.list ul li > a ul.res_info li i{display:inline; height:auto; font-size:12px; color:#888; position:relative; line-height:20px; text-align:center;top:0;right:0}
div.res2_list div.list ul li > a span.ico_reservation{ border-radius:0;font-size:11px;border:0; font-weight:normal; background:none;color:#f06e58;}


div.reservation2 div.ico_info {position:absolute; top:10px; right:10px; padding:0;}
div.reservation2 div.ico_info ul:after { clear:both; display:block; content:""; }
div.reservation2 div.ico_info ul li {float:left; position:relative; top:0; right:0; padding:0; margin:0 0 0 4px; width:44px; height:44px; border-radius:44px; border-bottom:0;  text-align:center; font-size:11px; box-sizing:border-box;  line-height:1.25em; }

div.reservation2 div.ico_info ul li.icon_info {padding-top:8px;border:2px solid #ececec; background:#fff; }
div.reservation2 div.ico_info ul li.icon_info a {display:block; width:100%; padding:0; color:#555; }
div.reservation2 div.ico_info ul li.basic_info { background:#cccccc; color:#fff;  }
div.reservation2 div.ico_info ul li.basic_info.on { background:#58585a; }
div.reservation2 div.ico_info ul li.basic_info a {display:block; width:100%; padding:8px 0 0 0; color:#fff; }
div.reservation2 div.ico_info ul li.basic_info a i {display:block; position:relative; font-size:11px; height:auto; color:#fff; line-height:1.25em; top:0; right:0; }
div.reservation2 div.ico_info ul li.icon { padding-top:8px;background:#ff3f1e; color:#fff;  }
div.reservation2 div.ico_info ul li.icon i {display:block;}

div.res2_list div.list ul li div.btn_switch2 {background:#fff; padding:0 10px 20px 10px; margin:0}
div.res2_list div.list ul li div.btn_switch2 a {width: 25%; padding:0; color:#bbb; border:1px solid #fff; text-align:center; background:#ebebeb;}
div.res2_list div.list ul li div.btn_switch2 a.on{color:#fff; border:1px solid #fff; background:#72ced4;}

div.reservation div.reservation_comment div.layer_textarea {padding:10px;border:1px solid #ccc; border-radius:2px; margin-bottom:5px}

.res2_list .list li .btn_switch2 a{padding:0 10px;box-sizing:border-box;color:#bbb;border:1px solid #ccc;margin-left:-1px;font-size:12px;}

</style>
<script type="text/javascript">
//<![CDATA[
$(document).ready(function() {

	// 다음 페이지 가지고 오기
	$("#container").scroll(function() {
		getNextPageByAjax(this, document.reserve_page_form, function() { 
		
		});
	});

	// 정렬순서 변경
	$("#sch_order_field").on("change", function() {

		var f = document.search_form;
		var sch_order_field = $(this).val();
		if(sch_order_field == "reg_time") {
			f.sch_order_direct.value = "desc";
		}
		else {
			f.sch_order_direct.value = "asc";
		}

		f.submit();
	});

	/*
	$(document).on("click", ".btn_change_state", function(e) {
		changeReserveState(this, "list");
		e.preventDefault();
	});
	*/
});
//]]>
</script>

<div class="tab">
	<ul class="tab_list tab_list02">
	<li class="on"><a href="../reserve/wait_list.html">진행중인 예약</a></li>
	<li><a href="../reserve/end_list.html">종료된 예약</a></li>
	</ul>
</div>    
    
<div id="container" class="container">
	<div class="reservation2">
		<div class="res2_list">
			<h4>현재 진행중 예약 <span class="col_orange"><?=number_format($total_cnt)?></span>명</h4>
			<div class="range">
				<form name="search_form" method="get" action="./wait_list.html">
				<input type="hidden" name="sch_order_direct" value="<?=$sch_order_direct?>" />
				<select name="sch_order_field" id="sch_order_field" title="정렬순서">
				<option value="concat(rs_date, rs_time)">임박순</option>
				<option value="reg_time" <? if($sch_order_field == 'reg_time') { ?>selected="selected"<? } ?>>신청순</option>
				</select>
				</form>
			</div>			

			<div class="list">
				<ul id="reserve_list">
				<?=$list_content?>
				</ul>
			</div>
		</div>
	</div>

</div>

<form name="reserve_page_form" method="get" action="../reserve/ajax.list.html" target="#reserve_list">
<input type="hidden" name="flag_json"			value="1" />
<input type="hidden" name="is_load"				value="" />
<input type="hidden" name="page"				value="2" />
<input type="hidden" name="list_mode"			value="<?=$list_mode?>" />
<input type="hidden" name="sch_order_field"		value="<?=$sch_order_field?>" />
<input type="hidden" name="sch_order_direct"	value="<?=$sch_order_direct?>" />
</form>
