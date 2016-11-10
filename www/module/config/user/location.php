<?
if(!defined('_INPLUS_')) { exit; } 

$back_url = '../shop/list_by_location.html';
$doc_title = '내위치설정';
$footer_nav['3'] = true;
?>
<script type="text/javascript">
function callbackSaveGpsInfo(lat, lng, dong, addr) {
	location.replace("../shop/list_by_location.html");
}

$(document).ready(function() {

});
</script>

	<div class="geo">
    	<p class="current"><i class="fa fa-map-marker"></i> <span id="this_addr"><?=_ADDR_?></span></p>		
        <button onclick="resetGpsInfo();" class="btn_reset">현재위치</button>
    </div>
    <div class="search02">
		<form name="search_dong_form" method="get" action="./ajax_dong_list.html" target="#dong_list" onsubmit="return submitSearchDongForm(this)">
		<input type="hidden" name="flag_json" value="1" />
    	<div class="search_area">
        	<span class="btn_search"><i class="fa fa-search"></i></span>
            <div class="search_input">
            	<input type="text" name="sch_dong" class="required" placeholder="동명(읍,면)을 입력해주세요. 예:석촌동" title="검색어">
            </div>
        </div>
		<button type="submit" class="btn_gray">검색</button>
		</form>
    </div>

	<div id="container" class="mysurr">		
		<ul id="dong_list" class="area_list">        

        </ul>
    </div>
