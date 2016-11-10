<?
if(!defined('_INPLUS_')) { exit; } 


/* init Class */
$oPush = new PushAdmin();
$oPush->init();
$module_name = $oPush->get('module_name');	// 모듈명

$push_config = $oPush->get('push_config');
$code_arr = explode(',', 'reserve_to_staff,accept_to_user,progress_to_staff,modify_to_user,modify_to_staff,cancel_to_user,cancel_to_staff,auto_to_user,auto_to_staff,pass_to_staff,remain_to_user,finish_to_user,reply_to_user');
?>
<script type="text/javascript">
//<![CDATA[
$(document).ready(function() {


});
//]]>
</script>
<style>
div.box {width:280px; float:left; margin:0 20px 20px 0;}

div.box_header {position:relative; padding:10px 20px; border:1px solid #d2d2d2; background:#f0f0f0;}
div.box_header > div.box_title {font-weight:bold;}
div.box_header > div.push_user {position:absolute; top:7px; right:20px;padding:2px 4px; border:1px solid #3c3c3c; font-size:11px; background:#3c3c3c; color:#fff;}
div.box_header > div.push_user span {}

div.box_content {border:1px solid #d2d2d2; padding:20px; height:120px;}

p.button {clear:both;}
textarea {resize:none}

</style>

<div id="<?=$module?>">

	<!-- list -->
	<div class="list">

		<div class="info_box icon">               
			<h4>도움말</h4>                
			<div class="content">        
				- <span class="info">{예약자명}</span> : 예약한 사람의 이름이 출력됩니다. <br />
				- <span class="info">{매장명}</span> : 예약한 매장명이 출력됩니다. <br />
				- <span class="info">{예약일시}</span> : 예약일시가 0000년 00월 00일 (요일) 00:00로 출력됩니다. (예. 2016년 01월 01일 (금) 09:30) <br />
				- <span class="info">{남은시간}</span> : 예약시간까지 남은 시간이 0분으로 출력됩니다. (예. 50분) <br />
				- <span class="info">{작성자}</span> : 1:1 문의 글 작성한 사람의 이름이 출력됩니다. 
			</div>           
		</div>


		<form name="write_form" method="post" action="./process.html" onsubmit="return submitWriteForm(this);">
		<fieldset>
		<legend>검색관련</legend>
		<input type="hidden" name="mode" value="update_config" />	
		</fieldset>

		<fieldset>
		<legend>등록/수정</legend>
		
		<?		
		for($i = 0 ; $i < sizeof($code_arr) ; $i++) {
			$code = $code_arr[$i];
			$arr = $push_config[$code];
		?>
		<div class="box">
			<div class="box_header">
				<div class="box_title"><?=$arr['title']?></div>
				<div class="push_user">수신대상 <span><?=$arr['receiver']?></span></div>
			</div>
			<div class="box_content">
				<div>
					<input type="hidden" name="ps_cf_code[]" value="<?=$code?>" />
					<textarea name="ps_cf_content[]" class="textarea required" rows="2" cols="32" title="푸시메세지"><?=$arr['content']?></textarea>
				</div>
				<p class="comment"><span class="icon tip_info"></span><?=$arr['memo']?></p>
			</div>			
		</div>
		<? } ?>

		</fieldset>

		<p class="button">
			<button type="submit" class="sButton primary">저장</button>
		</p>

		

		</form>
	</div>
</div>
