<?
if(!defined('_INPLUS_')) { exit; } 

include_once(_MODULE_PATH_.'/page/page.class.php');

Class PageFront extends Page
{	

	/* select sigungu */
	public function selectSigungu($sido) {

		$list = selectSigungu($sido);
		$content = '<option value="">시/군/구</option>';
		foreach($list as $sigungu_name) {
			$content .= '<option value="'.$sigungu_name.'">'.$sigungu_name.'</option>';
		}

		$this->result['content'] = $content;
		
		return $this->result;
	}

	/* select dong */
	public function selectDong($sido, $sigungu) {

		$list = selectDong($sido, $sigungu);
		$content = '<option value="">읍/면/동</option>';
		foreach($list as $dong_name) {
			$content .= '<option value="'.$dong_name.'">'.$dong_name.'</option>';
		}

		$this->result['content'] = $content;
		
		return $this->result;
	}

}
?>
