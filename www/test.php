<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
<meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, width=device-width"/>
<title>KakaoLink Demo(App Button) - Kakao JavaScript SDK</title>
<script src="//developers.kakao.com/sdk/js/kakao.min.js"></script>
<style type='text/css'>
  /* <![CDATA[ */
    #file-input-wrapper {
    	display : none ;
    	margin-top : 50px ;
    }
  /* ]]> */
</style>

</head>
<body>
<h3>카카오톡 앱이 설치되어 있는 모바일 기기라면 아래의 링크가 동작합니다.</h3>
<a id="kakao-link-btn" href="javascript:;">
<img src="//dev.kakao.com/assets/img/about/logos/kakaolink/kakaolink_btn_medium.png"/>
</a>
<script type='text/javascript'>
  //<![CDATA[
    // 사용할 앱의 JavaScript 키를 설정해 주세요.
    Kakao.init('907cd9af248c0e9f8fff4101b39d84af');


    // 카카오톡 링크 버튼을 생성합니다. 처음 한번만 호출하면 됩니다.
    Kakao.Link.createTalkLinkButton({
      container: '#kakao-link-btn',
      label: '예약박스 가입하세요. 좋습니다.',
      image: {
        src: 'http://dn.api1.kage.kakao.co.kr/14/dn/btqaWmFftyx/tBbQPH764Maw2R6IBhXd6K/o.jpg',
        width: '300',
        height: '200'
      },
      appButton: {
        text: '예약박스'
      }
    });
  //]]>
</script>

</body>
</html>