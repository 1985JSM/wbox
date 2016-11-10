<?
if(!defined('_INPLUS_')) { exit; } 

$flag_use_header = false;
$flag_use_footer = false;

/* init Class */
$oMember = new MemberManager();
$oMember->init();
$module_name = $oMember->get('module_name');	// 모듈명
?>
<style>
body{ background:#f0f0f0}
.mt_5{ margin-top:5px;}

#page_wrap{padding:40px 0;}
#page_contents{width:800px; padding:100px 100px 150px; margin:0 auto; background:#fff url(/webmanager/member/img/page_logo.png) no-repeat 727px 70px;}
#page_contents h1{ margin-bottom:40px;}
#page_contents .txt01{color:#000;font-size:14px; line-height:24px;font-weight:bold; margin-bottom:20px;}
#page_contents .txt01 span{color:#f3003f}
#page_contents .txt02{color:#000;font-size:11px; line-height:18px; margin-bottom:5px;}
#page_contents .txt03{color:#f3003f;font-size:11px; line-height:18px; margin-bottom:25px;}
#page_contents .txt03 strong{font-weight:bold}


#page_contents .tbl_btn{ margin-top:20px; text-align:center}
#member h4{display:none}

.page_copyright{ padding:70px 0 30px ; text-align:center; font-size:12px; color:#6e6e6e}
</style>
</head>
<body>

<div id="page_wrap">
	<div id="page_contents">
    	<h1><img src="/webmanager/member/img/tit02.png" alt="가맹점 등록 최종 승인완료" /></h1>
        
        <p class="txt01">가맹점 등록이 <span>최종 승인</span>되었습니다.<br />작성하신 아이디 비밀번호를 이용하여 가맹점 관리자 화면에 접속하실 수 있습니다.</p> 
        <p class="txt02">단, 현재 가맹점의 상태는 비활성상태입니다.<br />가맹점 활성 상태를 위해 아래의 필수 정보를 작성하셔야 합니다.</p> 
        <p class="txt03"><strong>비활성</strong> : 고객이 사용하는 앱에 가맹점이 노출되지않아 예약이 불가한 상태<br /><strong>활성</strong> : 고객이 사용하는 앱에 가맹점이 노출되어 예약이 가능한 상태  </p> 
        
        
        <div id="member">
        
            <div class="view">
        
                <h4>기본사항</h4>
                
                <table class="list_table border" border="1">
                <caption>보기</caption>
                <colgroup>
                <col width="30%" />
                <col width="30%" />
                <col width="40%" />
                </colgroup>
                <tbody>		
                <tr>
                <th>1차메뉴</th>
                <th>2차메뉴</th>
                <th>설명</th>
                </tr>
                </tbody>
                <tbody>		
                <tr>
                <td>가맹점관리</td>
                <td>가맹점정보</td>
                <td>가맹점의 모든 기본 정보 입력은 필수</td>
                </tr>
                <tr>
                <td>가맹점관리</td>
                <td>담당자</td>
                <td>담당자 정보 1명 이상 등록 필수</td>
                </tr>
                <tr>
                <td>가맹점관리</td>
                <td>요금관리</td>
                <td>서비스 상품 정보 1개 이상 등록 필수 </td>
                </tr>
                
                </tbody>
                </table>		
        		
                <div class="tbl_btn">
                	<a href="./login.html"><img src="/webmanager/member/img/btn_go_login.png" alt="가맹점 로그인" /></a>
                </div>

            </div>
        </div>
    </div>
    
    <p class="page_copyright">COPYRIGHT 2015 © Reservation box ALL RIGHT RESERVED.</p>
</div>


</body>
</html>