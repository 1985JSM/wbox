<?
if(!defined('_INPLUS_')) { exit; } 

/* set URI */
$layout_size = 'tiny';
$doc_title = '메시지보관함';
?>

<style>
div.sub_box:after {display:block;content:'';clear:both}
div.sub_box div.box_list {float:left;width:180px;height:200px;margin:0 13px 15px 0;border:1px solid #ddd;}
div.sub_box div.box_list > textarea.messageBox {overflow:auto;width:150px;height:100px;margin:30px 10px 20px 10px;padding:5px;border:none;line-height:20px;background:transparent;color:#666;resize:none;}
div.sub_box div.box_list > div.btn_area {text-align:center;}

div.sub_box div.messageAdd {border:1px solid #2460ce;background:#2460ce;}
div.sub_box div.messageAdd > div.btn_add {padding:56px 30px 0 30px;text-align:center;}
div.sub_box div.messageAdd > div.btn_add > button.more {display:inline-block;overflow:visible;position:relative;width:36px;height:36px;margin:0;padding:0;border:none;font-size:12px;background: none;color:#fff;text-align:center;text-decoration:none !important;vertical-align:middle;white-space:nowrap;cursor:pointer;box-sizing:border-box;}
div.sub_box div.messageAdd > div.btn_add > span {display:inline-block;padding-top:30px;line-height:16px;color:#fff;}
div.sub_box div.messageAdd > textarea.messageBox {overflow:auto;width:150px;height:100px;margin:30px 10px 20px 10px;padding:5px;border:none;line-height:20px;background:transparent;color:#fff;resize:none;}

</style>

<!-- <?=$module?> -->
<div id="<?=$module?>">

	<!-- subWrap -->
	<div class="subWrap">
		<form>
		<div class="sub_box">
			<div class="box_list messageAdd">
				<!-- 메시지 입력 전 -->
				<div class="btn_add">
					<button class="more"><i class="xi-plus-circle xi-3x"></i></button>
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

			<div class="box_list">
				<textarea class="messageBox"></textarea>
				<div class="btn_area">
					<a href="#" class="sButton small info">저장</a>
					<a href="#" class="sButton small active">삭제</a>
				</div>
			</div>

			<div class="box_list">
				<textarea class="messageBox"></textarea>
				<div class="btn_area">
					<a href="#" class="sButton small info">저장</a>
					<a href="#" class="sButton small active">삭제</a>
				</div>
			</div>

			<div class="box_list">
				<textarea class="messageBox"></textarea>
				<div class="btn_area">
					<a href="#" class="sButton small info">저장</a>
					<a href="#" class="sButton small active">삭제</a>
				</div>
			</div>
			
			<div class="box_list">
				<textarea class="messageBox"></textarea>
				<div class="btn_area">
					<a href="#" class="sButton small info">저장</a>
					<a href="#" class="sButton small active">삭제</a>
				</div>
			</div>

			<div class="box_list">
				<textarea class="messageBox"></textarea>
				<div class="btn_area">
					<a href="#" class="sButton small info">저장</a>
					<a href="#" class="sButton small active">삭제</a>
				</div>
			</div>

			<div class="box_list">
				<textarea class="messageBox"></textarea>
				<div class="btn_area">
					<a href="#" class="sButton small info">저장</a>
					<a href="#" class="sButton small active">삭제</a>
				</div>
			</div>

			<div class="box_list">
				<textarea class="messageBox"></textarea>
				<div class="btn_area">
					<a href="#" class="sButton small info">저장</a>
					<a href="#" class="sButton small active">삭제</a>
				</div>
			</div>

			<div class="box_list">
				<textarea class="messageBox"></textarea>
				<div class="btn_area">
					<a href="#" class="sButton small info">저장</a>
					<a href="#" class="sButton small active">삭제</a>
				</div>
			</div>

			<div class="box_list">
				<textarea class="messageBox"></textarea>
				<div class="btn_area">
					<a href="#" class="sButton small info">저장</a>
					<a href="#" class="sButton small active">삭제</a>
				</div>
			</div>

			<div class="box_list">
				<textarea class="messageBox"></textarea>
				<div class="btn_area">
					<a href="#" class="sButton small info">저장</a>
					<a href="#" class="sButton small active">삭제</a>
				</div>
			</div>

			<div class="box_list">
				<textarea class="messageBox"></textarea>
				<div class="btn_area">
					<a href="#" class="sButton small info">저장</a>
					<a href="#" class="sButton small active">삭제</a>
				</div>
			</div>
		</div>

		<!-- pagination -->
		<div class="pagination">
			<ul>
			<li class="begin"><a href="#"></a></li>
			<li class="prev"><a href="#"></a></li>
			<li class="on"><a href="" title="1 페이지">1</a></li>
			<li><a href="" title="2 페이지">2</a></li>
			<li><a href="" title="3 페이지">3</a></li>
			<li><a href="" title="4 페이지">4</a></li>
			<li><a href="" title="5 페이지">5</a></li>
			<li class="next"><a href="#"></a></li>
			<li class="end"><a href="#"></a></li>
			</ul>
		</div>
		<!-- //pagination -->
		</form>
	</div>
	<!-- //subWrap -->	
	
</div>
<!-- //<?=$module?> -->