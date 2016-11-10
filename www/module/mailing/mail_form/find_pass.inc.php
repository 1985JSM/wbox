<?
if(!defined('_INPLUS_')) { exit; } 

$to_mail = $arr['mb_email'];
$to_name = $arr['mb_name'];
$subject = '['._HOMEPAGE_TITLE_.'] 비밀번호 안내';
?>
<TABLE style=" background:url(http://<?=_HOMEPAGE_DOMAIN_?>/img/mailing/bg_right.gif) right top no-repeat; WIDTH: 630px; BORDER-COLLAPSE: collapse !important">
  <TBODY>
    <TR>
      <TD style="BORDER-BOTTOM: 0px; BORDER-LEFT: 0px; PADDING-BOTTOM: 5px; PADDING-LEFT: 15px; PADDING-RIGHT: 15px; BORDER-TOP: 0px; BORDER-RIGHT: 0px; PADDING-TOP: 5px"><TABLE style="BORDER-BOTTOM: #ddd 1px solid; BORDER-LEFT: #ddd 1px solid; BACKGROUND-COLOR: #fff; WIDTH: 100%; BORDER-COLLAPSE: collapse !important; BORDER-TOP: #ddd 1px solid; BORDER-RIGHT: #ddd 1px solid">
          <TBODY>
            <TR>
              <TD style="TEXT-ALIGN: right; HEIGHT:100px; padding-top:20px; padding-right:20px;"><IMG style="BORDER-BOTTOM: 0px; BORDER-LEFT: 0px; BORDER-TOP: 0px; BORDER-RIGHT: 0px" alt=예약박스 align=absMiddle src="http://<?=_HOMEPAGE_DOMAIN_?>/img/mailing/mailLogo.jpg"></TD>
            </TR>
            <TR>
              <TD style="TEXT-ALIGN: center; PADDING-BOTTOM: 30px; PADDING-LEFT: 20px; PADDING-RIGHT: 20px; PADDING-TOP:0px"><!-- 내용 : S -->
                <TABLE style="WIDTH: 100%; BORDER-COLLAPSE: collapse !important">
                  <TBODY>
                    <TR>
                      <TD style="FONT-FAMILY: Dotum,돋움;BORDER-BOTTOM: 1px #e5e5e5 solid; TEXT-ALIGN:left; BORDER-LEFT: 0px; PADDING-BOTTOM:10px; PADDING-LEFT: 10px; PADDING-RIGHT: 10px;  COLOR: #000000; FONT-SIZE: 12pt; BORDER-TOP: 0px; FONT-WEIGHT: bold; BORDER-RIGHT: 0px; PADDING-TOP: 10px">비밀번호 안내</TD>
                    </TR>
                    <TR>
                      <TD style="BORDER-BOTTOM: 0px; BORDER-LEFT: 0px; PADDING-BOTTOM: 10px; PADDING-LEFT: 10px; PADDING-RIGHT: 10px;  COLOR: #575757; FONT-SIZE: 9pt; line-height:18px; BORDER-TOP: 0px; BORDER-RIGHT: 0px; PADDING-TOP: 10px"></TD>
                    </TR>
                    
                    <TR>
                      <TD style="TEXT-ALIGN: left; FONT-FAMILY: Dotum,돋움;BORDER-BOTTOM: 0px; BORDER-LEFT: 0px; PADDING-BOTTOM: 10px; PADDING-LEFT: 10px; PADDING-RIGHT: 10px;  COLOR: #575757; FONT-SIZE: 9pt; line-height:18px; BORDER-TOP: 0px; BORDER-RIGHT: 0px; PADDING-TOP: 20px"><SPAN style="COLOR: #575757; FONT-WEIGHT: bold">회원님의 임시비밀번호는 <SPAN style="COLOR: #d10000"><?=$arr['new_pass']?></SPAN> 입니다.</SPAN><br>
                        <br>임시 비밀번호 로그인 하신 후<br><SPAN style="font-weight:bold;"> 프로필관리에서 비밀번호를 변경</SPAN>하여 주시기 바랍니다.<br>
                      </TD>
                    </TR>
                    
                </TABLE>
                <!-- 내용 : E --></TD>
            </TR>
            <!--<TR>
              <TD align="center" style="BORDER-BOTTOM: 0px; BORDER-LEFT: 0px; PADDING-BOTTOM: 45px; PADDING-LEFT: 0px; PADDING-RIGHT: 0px; BORDER-TOP: 0px; BORDER-RIGHT: 0px; PADDING-TOP: 0px"><IMG style="BORDER-BOTTOM: 0px; BORDER-LEFT: 0px; BORDER-TOP: 0px; BORDER-RIGHT: 0px" alt=가맹점인증 align=absMiddle src="http://<?=_HOMEPAGE_DOMAIN_?>/img/mailing/mailBtn1.gif"></TD>
            </TR> -->
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