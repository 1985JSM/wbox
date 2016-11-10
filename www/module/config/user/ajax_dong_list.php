<?
if(!defined('_INPLUS_')) { exit; } 

$list = searchDong($sch_dong);
for($i = 0 ; $i < sizeof($list) ; $i++) { 
	$list[$i]['txt_addr'] = $list[$i]['sido_name'].' '.$list[$i]['sigungu_name'].' '.$list[$i]['dong_name'];	
	?>
<li><button type="button" onclick="saveGpsInfo('<?=$list[$i]['lat']?>', '<?=$list[$i]['lng']?>', '<?=$list[$i]['dong_name']?>', '<?=$list[$i]['txt_addr']?>')"><?=$list[$i]['txt_addr']?></button></li>
<? } if(sizeof($list) == 0) { ?>
<li class="no_data">
	<p>검색 결과가 없습니다.</p>
</li>
<? } ?>