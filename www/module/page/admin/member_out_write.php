<?
if(!defined('_INPLUS_')) { exit; } 
/* set URI */
$layout_size = 'normal';
$doc_title = '고객관리(관리자)';
?>


<!-- <?=$module?> -->
<div id="<?=$module?>">

	<div class="write">

		<form name="write_form" method="post" action="./process.html" onsubmit="return submitWriteForm(this);" enctype="multipart/form-data" autocomplete="off">
		<fieldset>
		<legend>검색관련</legend>
		<input type="hidden" name="mode" value="<?=$mode?>" />	
		<input type="hidden" name="page" value="<?=$page?>" />
		<input type="hidden" name="query_string" value="<?=$query_string?>" />
		</fieldset>

		<fieldset>
		<legend>등록/수정</legend>	
		<h4>기본사항</h4>
		<input type="hidden" name="<?=$pk?>" value="<?=$uid?>" />
		<input type="hidden" name="mb_level" value="9" />		
		
		<table class="write_table" border="1">
		<caption>등록/수정</caption>
		<colgroup>
		<col width="140" />
		<col width="*" />
		<col width="140" />
		<col width="*" />
		</colgroup>
		<tbody>
		<tr>
			<th class="required">이름</th>
			<td colspan="3">			
				<input type="text" name="" id="" value="" class="text required" size="30" maxlength="20" title="이름" />
			</td>
		</tr>		
		</tr>
		<tr>
			<th class="required">이메일</th>
			<td colspan="3">
				<input type="text" name="" id="" value="" class="text required" size="50" maxlength="50" title="이메일" />
				<a href="#" class="sButton small" title="메일발송">메일전송</a>
			</td>
		</tr>
		<tr>
			<th class="required">휴대폰</th>
			<td colspan="3">
				<input type="text" name="" id="" value="0102345678" class="text required" size="30" maxlength="20" title="휴대폰" />
				<a href="#" class="sButton small" title="SMS발송">SMS발송</a>
			</td>
		</tr>
		<tr>
			<th>비밀번호</th>
			<td colspan="3">
				<input type="password" name="mb_pass" value="" class="text" size="30" maxlength="20" title="비밀번호" />
				<br />
				<span class="comment">-비밀번호 20자 이하의 영대/소문자, 숫자, 특수숫자만 입력 가능합니다.</span>
			</td>
		</tr>
		<tr>
			<th>비밀번호 확인</th>
			<td colspan="3">
				<input type="password" name="mb_pass2" value="" class="text" size="30" maxlength="20" title="비밀번호 확인" />				
			</td>
		</tr>
		<tr>
			<th class="required">닉네임</th>
			<td colspan="3">
				<input type="text" name="" id="" value="닉네임은열글자까지" class="text required" size="20" maxlength="10" title="닉네임" />
			</td>
		</tr>
		<tr>
			<th class="required">지역</th>
			<td>
				<input type="text" name="" id="" value="울산광역시" class="text required" size="20" maxlength="10" title="시" />				
			</td>	
			<th class="required">생년월일/성별</th>
			<td>
				<input type="text" name="sch_s_date" id="sch_s_date" value="" class="text date" size="12" maxlength="10" title="생년월일" />
				<select name="sch_type" class="select" title="음력/양력">
				<option value="">양력</option>
				<option value="">음력</option>
				</select>
				<input type="radio" name="" value=""/> <label>남자</label>
				<input type="radio" name="" value=""/> <label>여자</label>
			</td>
		</tr>
		</tbody>
		</table>
		</fieldset>


		<fieldset class="etc">
		<legend>등록/수정</legend>	
		<h4>약관동의</h4>
		<input type="hidden" name="<?=$pk?>" value="<?=$uid?>" />
		<input type="hidden" name="mb_level" value="9" />		
		
		<table class="write_table" border="1">
		<caption>등록/수정</caption>
		<colgroup>
		<col width="140" />
		<col width="*" />
		<col width="140" />
		<col width="*" />
		</colgroup>
		<tbody>		
		<tr>
			<th>서비스이용약관</th>
			<td>
				이용자동의:<span class="info">동의함</span> (※ 해당부분은 관리자가 임의 수정이 불가능합니다.)
			</td>
			<th>개인정보취급<br />방침</th>
			<td>
				이용자동의:<span class="info">동의함</span> (※ 해당부분은 관리자가 임의 수정이 불가능합니다.)
			</td>
		</tr>
		<tr>
			<th>개인정보제3자<br />제공동의</th>
			<td>
				이용자동의:<span class="info">동의함</span> (※ 해당부분은 관리자가 임의 수정이 불가능합니다.)
			</td>
			<th>위치기반서비스이용약관</th>
			<td>
				이용자동의:<span class="info">동의함</span> (※ 해당부분은 관리자가 임의 수정이 불가능합니다.)
			</td>
		</tr>
		<tr>
			
		</tr>
		<tr>
			<th>이벤트소식수신동의(선택)</th>
			<td colspan="3">
				이용자동의:<span class="info">동의안함</span> (※ 해당부분은 관리자가 임의 수정이 불가능합니다.)
			</td>
		</tr>
		
		</tbody>
		</table>
		</fieldset>


		<fieldset class="etc">
		<legend>등록/수정</legend>	
		<h4>고객관리정보</h4>
		<input type="hidden" name="<?=$pk?>" value="<?=$uid?>" />
		<input type="hidden" name="mb_level" value="9" />		
		
		<table class="write_table" border="1">
		<caption>등록/수정</caption>
		<colgroup>
		<col width="140" />
		<col width="*" />
		<col width="140" />
		<col width="*" />
		</colgroup>
		<tbody>
		<tr>	
			<th>예약건</th>
			<td>			
				총 <strong class="primary">30</strong>건 (완료 <strong>25</strong>건, 정상취소 <strong>3</strong>건, 비정상취소 <strong>2</strong>건)
			</td>
			<th>회원등급</th>
			<td>			
				<select name="sch_cnt_rows" class="select order_select" title="예약박스회원등급">
				<option value="" >일반</option>
				<option value="">브론즈</option>
				<option value="">실버</option>
				<option value="">골드</option>
				<option value="">vip</option>
				</select>
				
				예약박스에서 관리하는 고객 등급입니다.
			</td>
		</tr>
		<tr>
			<th>관리자메모</th>
			<td colspan="3">
				<textarea name="" class="textarea" rows="5" cols="100" title="관리자메모"></textarea>
				<br />
				<span class="comment">관리자가 관리하는 고객 관리 메모입니다. 관리자 메모는 가맹점관리자, 회원에게 노출되지 않습니다. </span>
			</td>
		</tr>
		</tbody>
		</table>
		</fieldset>	

		<fieldset class="etc">
		<legend>등록/수정</legend>	
		<h4>로그인정보</h4>
		<input type="hidden" name="<?=$pk?>" value="<?=$uid?>" />
		<input type="hidden" name="mb_level" value="9" />		
		
		<table class="write_table" border="1">
		<caption>등록/수정</caption>
		<colgroup>
		<col width="140" />
		<col width="*" />
		<col width="140" />
		<col width="*" />
		</colgroup>
		<tbody>
		<tr>
			<th>상태</th>
			<td colspan="3">
				<input type="radio" name="" value=""/> <label>승인</label>
				<input type="radio" name="" value=""/> <label>대기</label>	
				<input type="radio" name="" value=""/> <label>탈퇴</label>	
			</td>
		</tr>
		<tr>
			<th>가입일</th>
			<td>
				2016-05-01 16:21:45
			</td>
			<th >최근접속일</th>
			<td>
				2016-05-13 20:10:48		
			</td>
		</tr>
		<tr>
			<th>탈퇴일</th>
			<td colspan="3">
				2016-05-01 16:21:45
			</td>			
		</tr>
		<tr>
			<th>탈퇴사유</th>
			<td colspan="3">
				<textarea name="" class="textarea" rows="2" cols="100" title="로그인허용IP" ></textarea>	
			</td>
		</tr>
		<tr>
			<th>최종접속IP</th>
			<td>
				-				
			</td>
			<th>로그인차단</th>
			<td>
				<input type="checkbox" name="flag_no_login" id="flag_no_login" class="checkbox" value="Y" title="로그인차단"  />
				<label for="flag_no_login">로그인차단</label>				
			</td>
		</tr>	
		<tr>
			<th>로그인허용IP</th>
			<td colspan="3">
				<textarea name="auth_ip" class="textarea" rows="2" cols="100" title="로그인허용IP" ></textarea>	
			</td>
		</tr>
		</tbody>
		</table>
		</fieldset>


		<p class="button">
			<button type="submit" class="sButton primary">확인</button>
			<a href="/webadmin/page/member_list.html" class="sButton active" title="목록">목록</a>			
			<a href="#" id="btn_delete" class="sButton warning" title="즉시탈퇴처리">즉시탈퇴처리</a>
		</p>

		</form>
	</div>
</div>
<!-- //<?=$module?> -->
