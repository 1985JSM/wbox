<?
if(!defined('_INPLUS_')) { exit; } 

/* init Class */
$oPortfolio = new PortfolioStaff();
$oPortfolio->init();

/* insert or update */
$pk = $oPortfolio->get('pk');
$uid = $oPortfolio->get('uid');
$oPortfolio->set('thumb_width', 140);
$oPortfolio->set('thumb_height', 84);

$data = $oPortfolio->selectDetail($uid);

if($data[$pk]) {
	$mode = 'update';
	$file_list = $data['file_list'];
}
else {
	$mode = 'insert';	
	$data = array(
		'pf_subject'	=> 'test',
		'pf_content'	=> 'test',
		'pf_tags'	=> 'test'
	);
	$uid = makeTimecode();
}

$max_file = $oShop->get('max_file');
$main_img = $data['main_img'];
$sub_img = $data['sub_img'];

$file_content = '
';
// 576929 : failed
// 500000 : failed
// 400000 : failed > success
// 350000 : success
// 300000 : success

// 391436 : success
// 390000 : success
// 350000 : success
// 300000 : success
// 195718 : success
//$file_content = substr($file_content, 0, 400000);
?>
<style type="text/css">
div.portfolio_add_area ul {margin:20px 10px}
div.portfolio_add_area ul > li{ margin-bottom:10px}
div.portfolio_add_area ul > li .input_txt{border:1px solid #ccc;border-radius:3px; height:40px; line-height:40px ; font-size:14px;color:#555;width:100%; text-indent:10px; margin-bottom:5px;box-sizing:border-box; background:#fff}
div.portfolio_add_area ul > li textarea.input_txt{height:160px; line-height:18px; padding:10px; text-indent:0}
div.portfolio_add_area ul > li .txt_info{color:#888;font-size:12px; line-height:15px}
div.portfolio_add_area ul > li > span.tit{display:block;font-size:14px; color:#333; font-weight:bold; margin-bottom:5px; position:relative}
div.portfolio_add_area ul > li.file > input {margin-bottom:10px;}

li.photo { height:200px; }
li.photo input { margin-left:100px; }
li.photo textarea { width:390px; height:100px; }
li.photo ul {margin:0}
li.photo ul:after{display:block;content:'';clear:both}
li.photo li.photo_upload {position:relative; float:left; display:block; width:25%;height:50px;}

div.photo_button { display:block; position:absolute; top:0;  left:0; width:70px; height:42px; border:0;   }
li.photo_upload.on div.photo_button { display:none; }
div.photo_button > button {display:block; width:70px; height:42px; border:0; font-size:18px; background:#555; color:#fff;}
div.photo_button > button > i  {display:block; font-size:20px;}
div.photo_button > button > span  {display:block; font-size:11px; color:#fff;}

div.photo_thumb { display:none; z-index:20; position:absolute; top:0; left:0px; width:70px; height:42px;  border:1px solid #ccc; }
li.photo_upload.on div.photo_thumb { display:block; }
div.photo_thumb > img {position:absolute; top:0px; left:0px; width:70px;height:42px; }
div.photo_thumb > button {position:absolute; top:-12px; right:-12px; width:30px; height:30px;  border:1px solid #ccc;   -webkit-border-radius:20px; font-size:18px; line-height:32px; color:#333; background:#fff; }
div.photo_thumb > button > span {  }
</style>

<div class="location">
	<h2>포트폴리오등록</h2>
	<button type="button" onclick="closeLayerPage('3')" class="location_prev"><i class="xi-angle-left"></i></a>	
</div>

<div id="container3" class="container">
	<div class="portfolio_add_area">
		<form name="write_portfolio_form" method="post" action="./process.html" enctype="multipart/form-data" onsubmit="return submitWritePortfolioForm(this)">
		<!--input type="hidden" name="flag_json" value="1" /-->
		<input type="hidden" name="mode" value="<?=$mode?>" />	
		<input type="hidden" name="sh_code" value="<?=$member['sh_code']?>" />
		<input type="hidden" name="<?=$pk?>" value="<?=$uid?>" />

		<ul>
		<li>
			<input type="text" name="pf_subject" value="<?=$data['pf_subject']?>" class="input_txt required" placeholder="제목을 입력해주세요." title="제목" />
		</li>
		<li>
			<textarea type="text" name="pf_content" class="input_txt required" placeholder="내용을 입력해주세요." title="내용"><?=$data['pf_content']?></textarea>
		</li>	
		<li>
			<input type="text" name="pf_tags" value="<?=$data['pf_tags']?>" class="input_txt required" placeholder="태그를 입력해주세요." title="태그" />
			<p class="txt_info">쉼표(,)로 구분되며 샵(#)은 입력하실 필요가 없습니다.</p>
		</li>
		<li class="photo">
			<span class="tit">대표사진</span>
			<ul>
			<li id="main_img" class="photo_upload<? if($main_img['file_id']) { ?> on<? } ?>">
				<div class="photo_button">
					<button class="btn_camera" onclick="choosePortfolioPhoto('main_img')" type="button"><i class="xi-image"></i><span>사진추가</span></button>
				</div>

				<div class="photo_thumb" class="img_area">						
					<img src="<?=$main_img['thumb']?>" alt="main photo" />
					<button class="btn_del_img" onclick="deletePortfolioPhoto('main_img')" type="button"><span><i class="xi-close"></i></span></button>
				</div>

				<input type="text" name="file_id[]" value="<?=$main_img['file_id']?>" />
				<input type="text" name="file_type[]" value="main" />
				<input type="text" name="file_name[]" value="test.jpg" />
				<textarea name="file_content[]"><?=$file_content?></textarea>
			</li>
			</ul>			
		</li>
		<li class="photo">
			<span class="tit">서브사진</span>
			<ul>
			<? for($i = 1 ; $i < $max_file ; $i++) { ?>
			<li id="sub_img<?=$i?>" class="photo_upload<? if($sub_img[$i-1]['file_id']) { ?> on<? } ?>">
				<div class="photo_button">
					<button class="btn_camera" onclick="choosePortfolioPhoto('sub_img<?=$i?>')" type="button"><i class="xi-image"></i><span>사진추가</span></button>
				</div>

				<div class="photo_thumb" class="img_area">						
					<img src="<?=$sub_img[$i-1]['thumb']?>" alt="sub photo<?=$i?>" />
					<button class="btn_del_img" onclick="deletePortfolioPhoto('sub_img<?=$i?>')" type="button"><span><i class="xi-close"></i></span></button>
				</div>			

				<input type="hidden" name="file_id[]" value="<?=$sub_img[$i-1]['file_id']?>" />
				<input type="hidden" name="file_type[]" value="sub" />
				<input type="hidden" name="file_name[]" value="" />
				<input type="hidden" name="file_content[]" value="" />				
			</li>
			<? } ?>			
			</ul>			
		</li>		
		</ul>

		<div id="hidden_delete_area">

		</div>

		<ul class="layer_btn">
		<li><div><button type="submit" class="btn_orange">등록하기</button></div></li>
		</ul>
		
		</form>
	</div>
</div>
