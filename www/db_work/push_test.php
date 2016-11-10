<?
$push_key = 'AIzaSyDsGaT0fY0d9PEPGW5rCETqrEPptC1-g68';
//$reg_id = 'APA91bG1jk2vKPFxH8UTeuFwmKF7omBXjFkSTi09wGz3X8BKRAZXHKN-lhA-UCAajVQ3ZOtk5fqfYbHYOXDSU-nIRYZbZTLS87NSGXgpxI_gsn-iM1R7Deudi2w-KetpNnK3ayh3Moqp';
$reg_id = 'APA91bEzNksoENYArgxKcvgOB5rl7c2pJrAK8Hrp4S3Pe0dsHYHMmW9JTgEwQ83-XRmgzxsCJLdWf_-YgGrmCkd8enJyZ-v2zmVBlN6LF4qMeBxdHY8jkTpGesh90B-_lAmpyJ9bd55z';

// 헤더 부분
$headers = array(
	'Content-Type:application/json',
	'Authorization:key='.$push_key
);

// 푸시 내용, data 부분을 자유롭게 사용해 클라이언트에서 분기할 수 있음.
$arr = array(
	'data'	=> array(
		'pushType'	=> 'test',
		'pushTitle'	=> '[사용자] 예약 1시간 전 입니다.',
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