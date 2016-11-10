<?
if(!defined('_INPLUS_')) { exit; } 



$doc_title = '탈퇴하기';
$footer_nav['1'] = true;

$oPage = new PageUser();
$oPage->init();

?>

<style type="text/css">
z

</style>

	<div id="container" class="container">

		<div class="leave">

			<form name="write_form" action="" method="" onsubmit="">
			<input type="hidden" name="" value="" />
			
			<div class="leave_intro">
				<p>회원탈퇴를 진행하기 위해 본인 확인이 필요합니다.<br />회원탈퇴시, 회원님의 개인정보 및 관련 모든 정보가 삭제처리 됩니다.</p>
				<div class="join_intro_cloud_ani"></div>
			</div>
			
			<ul class="leave_form">
			<li>
				<span class="tit">탈퇴할 이메일</span>
				<input type="text" name="" class="input_txt required readonly" placeholder="이메일" maxlength="50" title="이메일">
			</li>
			 <li>
				<span class="tit">비밀번호</span>
				<input type="text" name="" class="input_txt required" placeholder="비밀번호를 입력해주세요." maxlength="10" title="비밀번호">
			</li>
			<li>
				<span class="tit">기본정보</span>
				<ul class="inp_info01">
				<li>
					<div>
						<input type="text" name="mb_name" class="input_txt required  readonly" placeholder="이름" maxlength="10" title="이름">
					</div>
				</li>
				<li>
					<div>
						<select name="mb_area" class="required" title="지역">
						<option value="">지역</option>
						<option value="02">서울특별시</option><option value="051">부산광역시</option><option value="053">대구광역시</option><option value="032">인천광역시</option><option value="062">광주광역시</option><option value="042">대전광역시</option><option value="052">울산광역시</option><option value="044">세종특별자치시</option><option value="031">경기도</option><option value="033">강원도</option><option value="043">충청북도</option><option value="041">충청남도</option><option value="063">전라북도</option><option value="061">전라남도</option><option value="054">경상북도</option><option value="055">경상남도</option><option value="064">제주특별자치도</option>				</select>
					</div>
				</li>
				</ul>
				<ul class="inp_info02">
				<li>
					<div>
						<input type="text" name="mb_birth" class="input_txt input_date required readonly" placeholder="생년월일" title="생년월일">                   
					</div>
				</li>
				<li>
					<div>
						<select name="mb_birth_type" class="required  readonly" title="양력/음력">
						<option value="">양력/음력</option>
						<option value="S">양력</option>
						<option value="L">음력</option>				
						</select>
					</div>
				</li>
				<li>
					<div>
						<select name="mb_gender" class="required" title="성별">
						<option value="">성별</option>
						<option value="M">남</option><option value="F">여</option>				</select>
					</div>
				</li>
				</ul>
			</li>			
			<li>
				<span class="tit">탈퇴이유</span>
				<textarea type="text" name="ap_memo" class="input_txt" title="탈퇴이유"  placeholder="예약박스를 탈퇴하시는 이유를 작성해주시면 앞으로 더 좋은 모습으로 만나될 수 있도록 노력하겠습니다." ></textarea>
				<p class="txt"></p>
			</li>
			</ul>
		

			<div class="leave_btn"> 
				<ul>
					<li><button type="button" onclick="" class="btn_gray">취소</button></li>
					<li><button type="button" class="btn_orange">확인</button></li>
				</ul>
			</div>
		</div>
		</form>

	</div>
	<!-- //leave -->
