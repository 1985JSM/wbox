<?
if(!defined('_INPLUS_')) { exit; } 

Class Config extends StdController
{
	/* init */
	public function init() {

		// module info
		$this->set('module',		'config');
		$this->set('module_name',	'환경설정');		

		// context
		$this->set('data_table', 'tbl_config');
		$this->set('pk', 'sh_code');
		$this->set('search_field', 'sh_state');
		$this->set('sch_type_arr', array(
			'sh_name'		=> '상호'
		));
		
		/**
		* code array
		*/
		$this->set('sh_state_arr', array(
			'Y'	=> '활성화',
			'N'	=> '비활성화',
		));
	
		parent::init();
	}	

	/* get dong */
	public function getDongByGps($lat, $lng) {

		$data = getAddrFromGeocode($lat, $lng);

		$sido = $data['name1'];
		$sigungu = $data['name2'];
		$dong = $data['name'];

		$this->result['code'] = 'ok';

		$this->result['sido'] = $sido;
		$this->result['sigungu'] = $sigungu;
		$this->result['dong'] = $dong;

		$this->result['addr'] = $sido.' '.$sigungu.' '.$dong;

		return $this->result;
	}	
}
?>
