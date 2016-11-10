<?
$flag_use_head = false;
$flag_use_header = false;
$flag_use_footer = false;

include_once(_MODULE_PATH_.'/sms_box/sms_box.manager.class.php');

$oSmsBox = new SmsBoxManager($member['sh_code']);
$query_string = $oSmsBox->get('query_string');
$oSmsBox->set('cnt_rows', 8);
$list = $oSmsBox->selectList();

$page_arr = $oSmsBox->getPageArray();
?>

<!-- message_list -->
<ul class="message_list">
	<?
	if (count($list) > 0) {
		foreach ($list as $list_data) {
			?>
			<li>
				<div class="message_view">
					<?=$list_data['sms_box_contents']?>
				</div>
				<div class="btn_layer">
					<button class="sButton small" onclick="textSelectFromBox(this)"><span class="sButton-container"><span class="sButton-bg"><span class="text">선택하기</span></span></span></button>
				</div>
			</li>
	<?
		}
	} else {
		echo '메시지 보관함에서 문자를 저장하세요';
	}
	?>
</ul>
<!-- //message_list -->

<!-- pagination -->
<div class="pagination">
	<ul>
		<?
		$query_string = preg_replace('/page=[0-9]+/', '', $query_string);

		for($i = 0 ; $i < sizeof($page_arr) ; $i++)
		{ ?>
			<li<?if($page_arr[$i]['class']){?> class="<?=$page_arr[$i]['class']?>"<?}?>><a class="btn_ajax" href="./lyr.sms_box_list.html?page=<?=$page_arr[$i]['page']?><?=$query_string?>" target="#layer_content" title="<?=$page_arr[$i]['title']?> 페이지"><?=$page_arr[$i]['title']?></a></li>
		<? } ?>

	</ul>
</div>
<!-- //pagination -->