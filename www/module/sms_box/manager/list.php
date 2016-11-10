<?
if(!defined('_INPLUS_')) { exit; }

/* set URI */
$layout_size = 'tiny';
$doc_title = '메시지보관함';

$oSmsBox = new SmsBoxManager($member['sh_code']);
$oSmsBox->set('cnt_rows', 9999);
$query_string = $oSmsBox->get('query_string');
$list = $oSmsBox->selectList();

$page_arr = $oSmsBox->getPageArray();
?>

<!-- <?=$module?> -->
<div id="<?=$module?>">

	<!-- subWrap -->
	<div class="subWrap">
		<form>
			<div class="sub_box">
				<div class="box_list messageAdd">
					<!-- 메시지 입력 전 -->
					<div class="btn_add">
						<button type="button" class="more" id="createNewBox"><i class="xi-plus-circle xi-3x"></i></button>
						<span>내용을 직접 추가하여 사용하세요</span>
					</div>
					<!-- //메시지 입력 전 -->
					<!-- 메시지 입력 -->
					<!--textarea class="messageBox" placeholder="내용을 입력해 주세요."></textarea>
					<div class="btn_area">
						<a href="#" class="sButton small info">저장</a>
						<a href="#" class="sButton small active">삭제</a>
					</div-->
					<!-- //메시지 입력 -->
				</div>
				<?php
				if (count($list) > 0) {
					foreach ($list as $list_data) {
						?>
						<div class="box_list" id="<?=$list_data['sms_box_id']?>">
							<textarea class="messageBox"><?=$list_data['sms_box_contents']?></textarea>
							<div class="btn_area">
								<button type="button" id="save" class="sButton small info">저장</button>
								<button type="button" id="delete" class="sButton small active btn_delete">삭제</button>
							</div>
						</div>
						<?
					}
				}

				?>


			<!-- pagination -->
			<div class="pagination">
				<ul>
					<? printPagination($page_arr, $query_string); ?>
				</ul>
			</div>
			<!-- //pagination -->
		</form>
	</div>
	<!-- //subWrap -->

</div>
<!-- //<?=$module?> -->