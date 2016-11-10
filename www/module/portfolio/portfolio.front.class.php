<?
if(!defined('_INPLUS_')) { exit; } 

include_once(_MODULE_PATH_.'/portfolio/portfolio.class.php');

Class PortfolioFront extends Portfolio
{	
	/* init */
	public function init() {

		// thumbnail
		$this->set('flag_use_thumb', true);
		$this->set('thumb_width', 320);
		$this->set('thumb_height', 190);

		parent::init();
	}	
}
?>
