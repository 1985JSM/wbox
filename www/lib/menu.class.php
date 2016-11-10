<?
if(!defined('_INPLUS_')) { exit; } 

Class Menu
{
	protected $menu;
	protected $this_uri;

	protected $title;
	protected $page_no;

	public function init($menu, $this_uri) {
		$this->menu = $menu;
		$this->this_uri = $this_uri;
		$this->title = array();
		$this->page_no = array();

		$this->findPageInfo($this->menu);
		$this->title = array_reverse($this->title);
		$this->page_no = array_reverse($this->page_no);
	}

	public function getPageNo() {
		return $this->page_no;
	}

	protected function findPageInfo($arr) {		
		$bo_id = $_POST['bo_id'] ? $_POST['bo_id'] : $_GET['bo_id'];			// 게시판
		$rc_type = $_POST['rc_type'] ? $_POST['rc_type'] : $_GET['rc_type'];	// 처방하기

		for($i = 0 ; $i < sizeof($arr) ; $i++) {
			$flag_match = false;
			
			if(is_array($arr[$i]['sub'])) {
				$flag_match = $this->findPageInfo($arr[$i]['sub']);
			} else if(isset($bo_id)) {
				if(strpos($arr[$i]['uri'], 'bo_id='.$bo_id) > -1) {
					$flag_match = true; // 게시판
				}			
			} 
			else if(strpos($arr[$i]['uri'], $this->this_uri) > -1) {	
				$flag_match = true;
			}

			if($flag_match)
			{				
				$this->title[] = $arr[$i]['title'];
				$this->page_no[] = $i + 1;
				return true;
			}
		}			
	}

	public function getHtmlTitle($title) {		
		if(sizeof($this->title) > 0) { $html_title = implode(' &lt; ', array_reverse($this->title)).' :: '.$title; }
		else { $html_title = $title; }

		return $html_title;
	}

	public function getTitlePath($home) {
		global $layout;
		
		if(sizeof($this->title) > 0) { 
			$doc_title = $home.' &gt; '.implode(' &gt; ', $this->title); 
			
			$menu_arr = $this->menu;
			$title_arr = $this->title;
			$page_no_arr = $this->page_no;

			$doc_title = $home;
			for($i = 0 ; $i < sizeof($title_arr) ; $i++) {

				$title = $title_arr[$i];
				$page_no = $page_no_arr[$i] - 1;
				$href = $menu_arr[$page_no]['uri'];
				if(!$href) { $href = $menu_arr[$page_no]['sub'][0]['uri']; }
				if(!$href) { $href = $menu_arr[$page_no]['sub'][0]['sub'][0]['uri']; }
				if(!$href) { $href = $menu_arr[$page_no]['sub'][0]['sub'][0]['sub'][0]['uri']; }

				if($i < sizeof($title_arr) - 1) {
					$doc_title .= '<a href="'.$href.'" title="'.$title.'">'.$title.'</a>';
				} else {
					$doc_title .= '<span>'.$title.'</span>';
				}
				
				$menu_arr = $menu_arr[$page_no]['sub'];				
			}
		}
		else { $doc_title = $home; }

		return $doc_title;
	}

	public function getDocTitle() {
		$doc_title = $this->title[sizeof($this->title) - 1];
		return $doc_title;
	}

	protected function convertMenu($arr) {
		global $member;

		unset($menu);

		for($i = 0 ; $i < sizeof($arr) ; $i++) {

			if($arr[$i]['uri']) {
				$flag = false;

				/*
				if($arr[$i]['auth'] <= $member['mb_level']) { 
					$flag = true;
				}
				*/

				if(checkAdminAuth($arr[$i]['auth_key']) || !$arr[$i]['auth_key']) {
					$flag = true;
				}

				if($flag) {
					$menu[] = array(
						'title'	=> $arr[$i]['title'],
						'uri'	=> $arr[$i]['uri'],
						'no_complete'	=> $arr[$i]['no_complete']
					);				
				}
			} else if(is_array($arr[$i]['sub']) && sizeof($arr[$i]['sub']) > 0) {
				$sub_arr = $this->convertMenu($arr[$i]['sub']);
				if(sizeof($sub_arr) > 0) { 
					$menu[] = array(
						'title'	=> $arr[$i]['title'],
						'sub'	=> $sub_arr,
						'no_complete'	=> $arr[$i]['no_complete']
					);
				}
			}
		}

		return $menu;
	}

	public function getGnb() {
		$menu = $this->menu;
		$menu = $this->convertMenu($menu);

		ob_start();	
		for($i = 0 ; $i < sizeof($menu) ; $i++) { ?>
<li>
	<? if($menu[$i]['uri']) { $head_link = $menu[$i]['uri']; }
	else { $head_link = $menu[$i]['sub'][0]['uri']; } 

	if($head_link && $head_link != '#') { $chk_ext = 'ext'; }
	else { $chk_ext = ''; }	
	?>
	<a href="<?=$head_link?>" class="<?=$chk_ext?>" title="<?=$menu[$i]['title']?>" <?if(strpos($head_link, 'bo_id=') > -1){?> target="_blank"<?}?>><?=$menu[$i]['title']?></a>
	<? $sub = $menu[$i]['sub'];	if(sizeof($sub) > 0) { ?>
	<ul>
	<? for($j = 0 ; $j < sizeof($sub) ; $j++) { 
		if($sub[$j]['uri'] && $sub[$j]['uri'] != '#') { $chk_ext = 'ext'; }
		else { $chk_ext = ''; }

		if($sub[$j]['no_complete']) { $no_complete = ' btn_no_complete'; }
		else { $no_complete = ''; }
		?>
	<li>
		<a href="<?=$sub[$j]['uri']?>" class="<?=$chk_ext?><?=$no_complete?>" title="<?=$sub[$j]['title']?>" <?if(strpos($sub[$j]['uri'], 'bo_id=') > -1){?> target="_blank"<?}?>><?=$sub[$j]['title']?></a>
		<? $sub2 = $sub[$j]['sub']; if(sizeof($sub2) > 0) { ?>
		<ul>
		<? for($k = 0 ; $k < sizeof($sub2) ; $k++) { 
			if($sub2[$k]['uri'] && $sub2[$k]['uri'] != '#') { $chk_ext = 'ext'; }
			else { $chk_ext = ''; }
			?>
		<li><a href="<?=$sub2[$k]['uri']?>" class="<?=$chk_ext?>" title="<?=$sub2[$k]['title']?>"><?=$sub2[$k]['title']?></a></li>
		<? } ?>
		</ul>
		<? } ?>
	</li>	
	<? } ?>
	</ul>
	<? } ?>
</li>
		<? }
		$content = ob_get_contents();
		ob_end_clean();
		return $content;
	}

	public function getSubNav($page_no) {

		$page_idx1 = $page_no[0] - 1;
		$page_idx2 = $page_no[1] - 1;

		if($page_idx1 > -1) {
			$menu = $this->menu;		
			$menu = $menu[$page_idx1]['sub'];
			$menu = $this->convertMenu($menu);
			
			ob_start();	
			for($i = 0 ; $i < sizeof($menu) ; $i++) { 
				if($i == $page_idx2) {
					$chk_on = 'on';
				}
				else { $chk_on = ''; }
			?>
<li class="<?=$chk_on?>">
	<? if($menu[$i]['uri']) { $head_link = $menu[$i]['uri']; }
	else { $head_link = $menu[$i]['sub'][0]['uri']; } 

	if($head_link && $head_link != '#') { $chk_ext = 'ext'; }
	else { $chk_ext = ''; }	
	?>
	<a href="<?=$head_link?>" class="<?=$chk_ext?>" title="<?=$menu[$i]['title']?>" <?if(strpos($head_link, 'bo_id=') > -1){?> target="_blank"<?}?>><?=$menu[$i]['title']?></a>
</li>
			<? }
			$content = ob_get_contents();
			ob_end_clean();
			return $content;
		}
	}
}
?>