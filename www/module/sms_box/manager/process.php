<?
/*
 * mode
 * createNewBox = 새로운 박스를 생성할 떄
 */

$oSmsBox = new SmsBoxManager($member['sh_code']);

switch ($mode) {
	case 'createNewBox':
		$_POST['sh_code'] = $member['sh_code'];
		echo json_encode($oSmsBox->insertData());
		break;
	case 'updateBox':
		$oSmsBox->set('uid', $sms_box_id);
		echo json_encode($oSmsBox->updateData());
		break;
	case 'deleteBox':
		$oSmsBox->set('uid', $sms_box_id);
		echo json_encode($oSmsBox->deleteData());
		break;
}