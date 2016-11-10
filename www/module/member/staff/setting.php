<?
if(!defined('_INPLUS_')) { exit; } 

$footer_nav['3'] = true;
$doc_title = '일정관리';

/* init Class */
$oMember = new MemberStaff();
$oMember->init();
$module_name = $oMember->get('module_name');	// 모듈명

$holiday_list = $member['holiday_list'];

// hour
$hour_arr = getTimeTableArray('00:00', '24:00');
?>
<script type="text/javascript">
//<![CDATA[
$(document).ready(function() {

	/*
	// 종일 체크
	$(document).on("click", "input.hl_chk_all", function() {
		toggleHolidayTime(this);
	});

	// default
	initHolidayAllTime();
	*/
});
//]]>
</script>
<style type="text/css">
div.date {background:#fff;}
</style>

<div class="tab">
	<ul class="tab_list tab_list02">
	<li><a href="../reserve/calendar_list.html">일정관리</a></li>
	<li class="on"><a href="../member/setting.html">설정</a></li>
	</ul>
</div>    

<div id="container" class="container">
	<div class="date">
		<form name="setting_form" method="post" action="./process.html" onsubmit="return submitSettingForm(this);">
		<fieldset>
		<legend>검색관련</legend>
		<input type="hidden" name="mode" value="update_setting" />	

		<ul class="date_form">
		<li>
			<span class="tit">근무시간</span>
			<div class="column">
				<ul class="col2">
				<li>
					<div>
						<select name="s_work" class="required" title="근무시작시간">
						<? printSelectOption($hour_arr, $member['s_work']);  ?>
						</select>	
					</div>
				</li>
				<li>
					<div>
						<select name="e_work" class="required" title="근무종료시간">
						<? printSelectOption($hour_arr, $member['e_work']);  ?>
						</select>
					</div>
				</li>
				</ul>
			</div>
		</li>
		<li>
			<span class="tit">휴식시간</span>
			<div class="column">
				<ul class="col2">
				<li>
					<div>
						<select name="s_break" class="required" title="휴식시작시간">
						<? printSelectOption($hour_arr, $member['s_break']);  ?>
						</select>	
					</div>
				</li>
				<li>
					<div>
						<select name="e_break" class="required" title="휴식종료시간">
						<? printSelectOption($hour_arr, $member['e_break']);  ?>
						</select>
					</div>
				</li>
				</ul>
				<p class="txt_info">식사시간 및 브레이크타임을 입력해주세요.</p>
			</div>
		</li>	
		</ul>

		<!--
		<ul class="date_form">
		<li>
			<span class="tit">휴가정보</span>
			<div id="holiday_list">
			<?
			include_once(_MODULE_PATH_.'/member/staff/ajax_holiday_list.php');
			?>        
			</div>
		</ul>
		-->

		<div class="date_submit"><button type="submit" class="btn_orange">확인</button></div>		

		</form>
	</div>
</div>