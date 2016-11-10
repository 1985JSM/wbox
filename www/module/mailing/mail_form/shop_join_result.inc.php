<?
if(!defined('_INPLUS_')) { exit; } 

$to_mail = $arr['mb_email'];
$to_name = $arr['mb_name'];
$subject = '['._HOMEPAGE_TITLE_.'] 가맹점 등록 최종 승인 완료';
?>
<TABLE style=" background:url(http://<?=_HOMEPAGE_DOMAIN_?>/img/mailing/bg_right.gif) right top no-repeat; WIDTH: 630px; BORDER-COLLAPSE: collapse !important">
  <TBODY>
    <TR>
      <TD style="BORDER-BOTTOM: 0px; BORDER-LEFT: 0px; PADDING-BOTTOM: 5px; PADDING-LEFT: 15px; PADDING-RIGHT: 15px; BORDER-TOP: 0px; BORDER-RIGHT: 0px; PADDING-TOP: 5px"><TABLE style="BORDER-BOTTOM: #ddd 1px solid; BORDER-LEFT: #ddd 1px solid; BACKGROUND-COLOR: #fff; WIDTH: 100%; BORDER-COLLAPSE: collapse !important; BORDER-TOP: #ddd 1px solid; BORDER-RIGHT: #ddd 1px solid">
          <TBODY>
            <TR>
              <TD style="TEXT-ALIGN: right; HEIGHT:100px; padding-top:20px; padding-right:20px;"><IMG style="BORDER-BOTTOM: 0px; BORDER-LEFT: 0px; BORDER-TOP: 0px; BORDER-RIGHT: 0px" alt=예약박스 align=absMiddle src="http://<?=_HOMEPAGE_DOMAIN_?>/img/mailing//mailLogo.jpg"></TD>
            </TR>
            <TR>
              <TD style="TEXT-ALIGN: center; PADDING-BOTTOM: 30px; PADDING-LEFT: 20px; PADDING-RIGHT: 20px; PADDING-TOP:0px"><!-- 내용 : S -->
                <TABLE style="WIDTH: 100%; BORDER-COLLAPSE: collapse !important">
                  <TBODY>
                    <TR>
                      <TD style="FONT-FAMILY: Dotum,돋움;BORDER-BOTTOM: 1px #e5e5e5 solid; TEXT-ALIGN:left; BORDER-LEFT: 0px; PADDING-BOTTOM:10px; PADDING-LEFT: 10px; PADDING-RIGHT: 10px;  COLOR: #000000; FONT-SIZE: 12pt; BORDER-TOP: 0px; FONT-WEIGHT: bold; BORDER-RIGHT: 0px; PADDING-TOP: 10px">가맹점 등록 최종 승인 완료</TD>
                    </TR>
                    <TR>
                      <TD style="BORDER-BOTTOM: 0px; BORDER-LEFT: 0px; PADDING-BOTTOM: 10px; PADDING-LEFT: 10px; PADDING-RIGHT: 10px;  COLOR: #575757; FONT-SIZE: 9pt; line-height:18px; BORDER-TOP: 0px; BORDER-RIGHT: 0px; PADDING-TOP: 10px"></TD>
                    </TR>
                    <TR>
                      <TD style="TEXT-ALIGN: left; FONT-FAMILY: Dotum,돋움;BORDER-BOTTOM: 0px; BORDER-LEFT: 0px; PADDING-BOTTOM: 10px; PADDING-LEFT: 10px; PADDING-RIGHT: 10px;  COLOR: #575757; FONT-SIZE: 9pt; line-height:18px; BORDER-TOP: 0px; BORDER-RIGHT: 0px; PADDING-TOP: 20px"><SPAN style="COLOR: #575757; FONT-WEIGHT: bold">가맹점 등록이 최종 승인되었습니다.<br>
                        작성하신 아이디, 비밀번호를 이용하여 가맹점 관리자 화면에 접속하실 수 있습니다.</SPAN><br>
                        <br>
                        단, 현재 가맹점의 상태는 비활성 상태입니다.<br>
                        가맹점 활성 상태를 위해 아래의 필수 정보를 작성하셔야 합니다.<br>
                        <span style="color:#d10000;">* 비활성 : 고객이 사용하는 앱에 가맹점이 노출되지 않아 예약이 불가한 상태</span><br>
                        <span style="color:#d10000;">* 활성 : 고객이 사용하는 앱에 가맹점이 노출되어 예약이 가능한 상태</span><br>
                        <br>
                        아래의 가맹점 인증버튼을 클릭하시면 추가정보를 작성할 수 있습니다.<br>
                      </TD>
                    </TR>
                    <tr>
                      <TD style="BORDER-BOTTOM: 0px; BORDER-LEFT: 0px; PADDING-BOTTOM: 0px; PADDING-LEFT: 0px; PADDING-RIGHT: 0px; BORDER-TOP: 0px; BORDER-RIGHT: 0px; PADDING-TOP: 25px"><TABLE style="WIDTH: 100%; BORDER-COLLAPSE: collapse !important">
                          <TBODY>
                            <TR>
                              <TD style="BORDER-BOTTOM: 0px; TEXT-ALIGN: left; BORDER-LEFT: 0px; FONT-FAMILY: Dotum,돋움; HEIGHT: 25px; COLOR: #000; FONT-SIZE: 8pt; BORDER-TOP: 0px; FONT-WEIGHT: bold; BORDER-RIGHT: 0px"><IMG style="BORDER-BOTTOM: 0px; BORDER-LEFT: 0px; BORDER-TOP: 0px; BORDER-RIGHT: 0px" src="http://crm.inplusweb.com/crm/img/email/mailIcon.jpg"> 필수정보입력</TD>
                            </TR>
                            <TR>
                              <TD style="BORDER-BOTTOM: 0px; BORDER-LEFT: 0px; BORDER-TOP: 0px; BORDER-RIGHT: 0px"><TABLE style="WIDTH: 100%; BORDER-COLLAPSE: collapse !important">
                              	<THEAD>
                                    <TR>
                                      <TD style="BORDER-BOTTOM: #ddd 1px solid; TEXT-ALIGN:center; BORDER-LEFT: #ddd 1px solid; PADDING-BOTTOM: 0px; BACKGROUND-COLOR: #f2f2f2; PADDING-LEFT: 15px; WIDTH: 20%; PADDING-RIGHT: 0px; FONT-FAMILY: Dotum,돋움; HEIGHT: 30px; COLOR: #949494; FONT-SIZE: 8pt; BORDER-TOP: #ddd 1px solid; FONT-WEIGHT: bold; BORDER-RIGHT: #ddd 1px solid; PADDING-TOP: 0px">1차메뉴</TD>
                                      <TD style="BORDER-BOTTOM: #ddd 1px solid; TEXT-ALIGN:center; BORDER-LEFT: #ddd 1px solid; PADDING-BOTTOM: 0px; BACKGROUND-COLOR: #f2f2f2; PADDING-LEFT: 15px; WIDTH: 20%; PADDING-RIGHT: 0px; FONT-FAMILY: Dotum,돋움; HEIGHT: 30px; COLOR: #949494; FONT-SIZE: 8pt; BORDER-TOP: #ddd 1px solid; FONT-WEIGHT: bold; BORDER-RIGHT: #ddd 1px solid; PADDING-TOP: 0px">2차메뉴</TD>
                                      <TD style="BORDER-BOTTOM: #ddd 1px solid; TEXT-ALIGN:center; BORDER-LEFT: #ddd 1px solid; PADDING-BOTTOM: 0px; BACKGROUND-COLOR: #f2f2f2; PADDING-LEFT: 15px; WIDTH: 60%; PADDING-RIGHT: 0px; FONT-FAMILY: Dotum,돋움; HEIGHT: 30px; COLOR: #949494; FONT-SIZE: 8pt; BORDER-TOP: #ddd 1px solid; FONT-WEIGHT: bold; BORDER-RIGHT: #ddd 1px solid; PADDING-TOP: 0px">설명</TD>
                                    </TR>
                                  </THEAD>
                                  <TBODY>
                                    <TR>
                                      <TD style="BORDER-BOTTOM: #ddd 1px solid; TEXT-ALIGN: LEFT; BORDER-LEFT: #ddd 1px solid; PADDING-BOTTOM: 0px; PADDING-LEFT: 15px; PADDING-RIGHT: 0px; FONT-FAMILY: Dotum,돋움; HEIGHT: 30px; COLOR: #575757; FONT-SIZE: 8pt; BORDER-TOP: #ddd 1px solid; FONT-WEIGHT: bold; BORDER-RIGHT: #ddd 1px solid; PADDING-TOP: 0px">가맹점관리</TD>
                                      <TD style="BORDER-BOTTOM: #ddd 1px solid; TEXT-ALIGN: LEFT; BORDER-LEFT: #ddd 1px solid; PADDING-BOTTOM: 0px; PADDING-LEFT: 15px; PADDING-RIGHT: 0px; FONT-FAMILY: Dotum,돋움; HEIGHT: 30px; COLOR: #575757; FONT-SIZE: 8pt; BORDER-TOP: #ddd 1px solid; FONT-WEIGHT: bold; BORDER-RIGHT: #ddd 1px solid; PADDING-TOP: 0px">가맹점정보</TD>
                                      <TD style="BORDER-BOTTOM: #ddd 1px solid; TEXT-ALIGN: left; BORDER-LEFT: #ddd 1px solid; PADDING-BOTTOM: 0px; PADDING-LEFT: 15px; PADDING-RIGHT: 0px; FONT-FAMILY: Dotum,돋움; HEIGHT: 30px; COLOR: #575757; FONT-SIZE: 8pt; BORDER-TOP: #ddd 1px solid; FONT-WEIGHT: bold; BORDER-RIGHT: #ddd 1px solid; PADDING-TOP: 0px">가맹점의 모든 기본 정보 입력은 필수</TD>
                                    </TR>
                                     <TR>
                                      <TD style="BORDER-BOTTOM: #ddd 1px solid; TEXT-ALIGN: LEFT; BORDER-LEFT: #ddd 1px solid; PADDING-BOTTOM: 0px; PADDING-LEFT: 15px; PADDING-RIGHT: 0px; FONT-FAMILY: Dotum,돋움; HEIGHT: 30px; COLOR: #575757; FONT-SIZE: 8pt; BORDER-TOP: #ddd 1px solid; FONT-WEIGHT: bold; BORDER-RIGHT: #ddd 1px solid; PADDING-TOP: 0px">가맹점관리</TD>
                                      <TD style="BORDER-BOTTOM: #ddd 1px solid; TEXT-ALIGN: LEFT; BORDER-LEFT: #ddd 1px solid; PADDING-BOTTOM: 0px; PADDING-LEFT: 15px; PADDING-RIGHT: 0px; FONT-FAMILY: Dotum,돋움; HEIGHT: 30px; COLOR: #575757; FONT-SIZE: 8pt; BORDER-TOP: #ddd 1px solid; FONT-WEIGHT: bold; BORDER-RIGHT: #ddd 1px solid; PADDING-TOP: 0px">담당자</TD>
                                      <TD style="BORDER-BOTTOM: #ddd 1px solid; TEXT-ALIGN: left; BORDER-LEFT: #ddd 1px solid; PADDING-BOTTOM: 0px; PADDING-LEFT: 15px; PADDING-RIGHT: 0px; FONT-FAMILY: Dotum,돋움; HEIGHT: 30px; COLOR: #575757; FONT-SIZE: 8pt; BORDER-TOP: #ddd 1px solid; FONT-WEIGHT: bold; BORDER-RIGHT: #ddd 1px solid; PADDING-TOP: 0px">담당자 정보 1명 이상 등록 필수</TD>
                                    </TR>
                                     <TR>
                                      <TD style="BORDER-BOTTOM: #ddd 1px solid; TEXT-ALIGN: LEFT; BORDER-LEFT: #ddd 1px solid; PADDING-BOTTOM: 0px; PADDING-LEFT: 15px; PADDING-RIGHT: 0px; FONT-FAMILY: Dotum,돋움; HEIGHT: 30px; COLOR: #575757; FONT-SIZE: 8pt; BORDER-TOP: #ddd 1px solid; FONT-WEIGHT: bold; BORDER-RIGHT: #ddd 1px solid; PADDING-TOP: 0px">가맹점관리</TD>
                                      <TD style="BORDER-BOTTOM: #ddd 1px solid; TEXT-ALIGN: LEFT; BORDER-LEFT: #ddd 1px solid; PADDING-BOTTOM: 0px; PADDING-LEFT: 15px; PADDING-RIGHT: 0px; FONT-FAMILY: Dotum,돋움; HEIGHT: 30px; COLOR: #575757; FONT-SIZE: 8pt; BORDER-TOP: #ddd 1px solid; FONT-WEIGHT: bold; BORDER-RIGHT: #ddd 1px solid; PADDING-TOP: 0px">요금관리</TD>
                                      <TD style="BORDER-BOTTOM: #ddd 1px solid; TEXT-ALIGN: left; BORDER-LEFT: #ddd 1px solid; PADDING-BOTTOM: 0px; PADDING-LEFT: 15px; PADDING-RIGHT: 0px; FONT-FAMILY: Dotum,돋움; HEIGHT: 30px; COLOR: #575757; FONT-SIZE: 8pt; BORDER-TOP: #ddd 1px solid; FONT-WEIGHT: bold; BORDER-RIGHT: #ddd 1px solid; PADDING-TOP: 0px">서비스 상품 정보 1개 이상 등록 필수 </TD>
                                    </TR>                                    
                                  </TBODY>
                                </TABLE></TD>
                            </TR>
                          </TBODY>
                        </TABLE></td>
                    </tr>
                    <TR>
                    	<TD style="TEXT-ALIGN: left; FONT-FAMILY: Dotum,돋움; BORDER-BOTTOM: 0px; BORDER-LEFT: 0px; PADDING-BOTTOM: 0px; PADDING-LEFT: 0px; PADDING-RIGHT: 0px; BORDER-TOP: 0px; BORDER-RIGHT: 0px; PADDING-TOP: 10px;  COLOR: #575757; FONT-SIZE: 9pt;">
                        지금부터, 가맹점 로그인 후 필수 정보 입력 및 사용매뉴얼 등을 확인할 수 있습니다.
                        </TD>
                    </TR>
                    <TR>
                    	 <TD height="49" style="TEXT-ALIGN: left; FONT-FAMILY: Dotum,돋움; BORDER-BOTTOM: 0px; BORDER-LEFT: 0px; PADDING-BOTTOM: 0px; PADDING-LEFT: 0px; PADDING-RIGHT: 0px; BORDER-TOP: 0px; BORDER-RIGHT: 0px; PADDING-TOP: 25px;  COLOR: #575757; FONT-SIZE: 9pt; font-weight:bold;">
                       <span style="color:#d10000;">※안내 :</span> 가맹점 관리화면 접속 주소는 즐겨찾기를 이용하여 저장해 두시기 바랍니다.                        </TD>
                    </TR>
                    
                </TABLE>
                <!-- 내용 : E --></TD>
            </TR>
            <TR>
              <TD align="center" style="BORDER-BOTTOM: 0px; BORDER-LEFT: 0px; PADDING-BOTTOM: 45px; PADDING-LEFT: 0px; PADDING-RIGHT: 0px; BORDER-TOP: 0px; BORDER-RIGHT: 0px; PADDING-TOP: 0px"><a href="http://<?=_HOMEPAGE_DOMAIN_?>/webmanager/member/login.html" target="_blank"><IMG style="BORDER-BOTTOM: 0px; BORDER-LEFT: 0px; BORDER-TOP: 0px; BORDER-RIGHT: 0px" alt=가맹점로그인 align=absMiddle src="http://<?=_HOMEPAGE_DOMAIN_?>/img/mailing//mailBtn2.gif"></a></TD>
            </TR>
            <TR>
              <TD style="BORDER-BOTTOM: 0px; TEXT-ALIGN: left; BORDER-LEFT: 0px; PADDING-BOTTOM: 20px; PADDING-LEFT: 20px; PADDING-RIGHT: 5px;  COLOR: #949494; FONT-SIZE: 8pt; BORDER-TOP: 0px; caFONT-WEIGHT: bold; BORDER-RIGHT: 0px; PADDING-TOP: 20px; FONT-FAMILY: Dotum,돋움;">본 메일은 <FONT color=#4f81bd>발신전용 메일</FONT>이므로 회신되지 않습니다.<BR>
                <!--문의사항은  <SPAN style="COLOR: #575757"><FONT color=#4f81bd>1566-5099</FONT></SPAN>로 연락주시기 바랍니다.<BR> -->
                <BR>
                <SPAN style="COLOR: #575757; FONT-FAMILY: Dotum,돋움;" >Copyright ⓒ <SPAN style="COLOR: #d10000">Reservation box</SPAN>. All Rights Reserved.</SPAN> </TD>
            </TR>
        </TABLE></TD>
    </TR>
  </TBODY>
</TABLE>
<!-- 메일폼 : E -->
