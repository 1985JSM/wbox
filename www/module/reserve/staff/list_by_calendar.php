<?
if(!defined('_INPLUS_')) { exit; } 

$footer_nav['3'] = true;
$doc_title = '일정관리';

/* init Class */
$oReserve = new ReserveStaff();
$list_mode = $_GET['list_mode'];
if(!$list_mode) { $list_mode = 'wait'; }
if($list_mode == 'wait') {
	$oReserve->set('order_direct', 'asc');
}
$oReserve->set('list_mode', $list_mode);

$oReserve->init();
$module_name = $oReserve->get('module_name');	// 모듈명
?>
<script type="text/javascript">
//<![CDATA[
$(document).ready(function() {

});
//]]>
</script>

	<div class="tab">
    	<ul class="tab_list tab_list02">
        <li class="on"><a href="../reserve/list_by_calendar.html">일정관리</a></li>
        <li><a href="../member/setting.html">설정</a></li>
        </ul>
    </div>    
    
	<div id="container" class="date">
		<? include_once(_MODULE_PATH_.'/reserve/staff/ajax_calendar2.php'); ?>				
    </div>
