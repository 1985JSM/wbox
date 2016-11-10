<?
$push_key = 'AIzaSyA0MuE_05eYzGdS5ligWNyjL0x5IDr6ung';
$reg_id = 'APA91bHABgrnQaDOelt_DbxCcuCjK55u-5dDn3J1hsOgz2Z2V1N50vqPap9YaK4FcIrw6929MDcKU93ZpQBC8SO0drwQRt9vPLgWe1gLceshVhG74vHjlWwkSdeVZ4--Sc4vy6Bnloo3';

// 헤더 부분
$headers = array(
	'Content-Type:application/json',
	'Authorization:key='.$push_key
);

// 푸시 내용, data 부분을 자유롭게 사용해 클라이언트에서 분기할 수 있음.
$arr = array(
	'data'	=> array(
		'pushType'	=> 'test',
		'pushTitle'	=> '[담당자] 예약 1시간 전 입니다.',
		'pushMsg'	=> '예약이 확인되었습니다.',
		'pushContent'=> "홍길동님은\n2015년 06월 03일(수) 11:30 예약되셨습니다.\n예약진행을 클릭하시면 300P 적립됩니다.",
		'pushUrl'	=> ''
	),

	'registration_ids'	=> array(
		'0'	=> $reg_id
	)
);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://android.googleapis.com/gcm/send');
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($arr));
$response = curl_exec($ch);
curl_close($ch);

// 푸시 전송 결과 반환.
$obj = json_decode($response);
print_R($obj);

// 푸시 전송시 성공 수량 반환.
$cnt = $obj->{"success"};

echo $cnt;
?>