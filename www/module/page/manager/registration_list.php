<?
if(!defined('_INPLUS_')) { exit; } 

/* set URI */
$layout_size = 'tiny';
$doc_title = '발신번호사전등록';
?>

<style>
div.sub_registration > div.info_box > p {padding:5px 0 20px 0;}
div.sub_registration > div.btn_add {margin-bottom:10px;text-align:right;}
</style>

<!-- <?=$module?> -->
<div id="<?=$module?>">

	<!-- subWrap -->
	<div class="subWrap sub_registration">
		<div class="info_box">
			<h4><span class="icon tip_info"></span> 도움말</h4>
			- 발송시 표기를 희망하는 번호는 사전 인증 후 등록하여 사용해주세요.<br />
			- 사전등록 된 번호가 없다면 문자발송을 할 수 없습니다.<br />
			- 발송 번호는 최대 10개까지 등록이 가능합니다.
			<p><a href="#" class="sButton small info">발신번호 사전등록 안내</a>
			<a href="#" class="sButton small active">광고성문자 표기 의무 안내</a></p>

			<h4>발송번호 사전등록이란?</h4>
			전기통신사업법 제 84조 의거 거짓으로 표시된 전화번호로 인한 이용자 피해 예방을 위해서 2015년 10월 16일 이후 문자 전송시 인증된 발신번호로만 사용할 수 있도록 등록하는 제도 입니다.

			<h4>기업회원 유의사항</h4>
			기업회원으로 가입된 고객님께서 전화번호를 등록하실 경우에는 ARS인증이나, 통신서비스 이용증명원을 통하여 인증하여 주시기 바랍니다. 고객명과 휴대전화 소유주명(사람이름)이 다르기 때문에 휴대폰 인증은 사용하실 수 없습니다.
		</div>			
		
		<div class="btn_add">
			<a href="#" class="sButton small active">추가등록</a>
		</div>

		<!-- list -->
		<table class="list_table border" summary="발신번호 사전등록에 관련된 표로써 발송번호설명, 발신번호, 인증방식, 인증상태, 등록일시, 삭제 등 순으로 출력됩니다.">
		<caption>발신번호 사전등록</caption>
		<colgroup>
		<col width="16%">
		<col width="16%">
		<col width="*">
		<col width="14%">
		<col width="20%">
		<col width="10%">
		</colgroup>
		<thead>
		<tr>
			<th>발송번호설명</th>
			<th>발신번호</th>
			<th>인증방식</th>
			<th>인증상태</th>
			<th>등록일시</th>
			<th>삭제</th>
		</tr>	
		</thead>
		<tbody>
		<tr>
			<td>인플러스</td>
			<td>07086300000</td>
			<td>휴대폰 인증</td>
			<td>인증 완료</td>
			<td>2016-03-04 19:27</td>
			<td><button type="button" class="sButton small">삭제</button></td>
		</tr>
		<tr>
			<td>인플러스</td>
			<td>07086300000</td>
			<td>ARS 인증</td>
			<td>인증 완료</td>
			<td>2016-03-04 19:27</td>
			<td><button type="button" class="sButton small">삭제</button></td>
		</tr>
		<tr>
			<td>인플러스</td>
			<td>07086300000</td>
			<td>통신서비스 이용증명원</td>
			<td>인증 완료</td>
			<td>2016-03-04 19:27</td>
			<td><button type="button" class="sButton small">삭제</button></td>
		</tr>									
		</tbody>
		</table>
		<!-- //list -->					
	</div>
	<!-- //subWrap -->	
	
</div>
<!-- //<?=$module?> -->

<!-- layer popup -->
<div id="layer_back" style="display:block;"></div>

<!-- 발신번호사전등록안내 -->
<div id="layer_popup" style="width:780px;height:700px;margin:-346px 0 0 -390px;">
	<div id="layer_header">
		<h1>발신번호사전등록안내</h1>
		<button type="button" onclick="closeLayerPopup()" title="닫기"><img src="http://wbox.inplus21.com/layout/manager/img/common/btn_close_layer.gif" alt="Close" /></button>
	</div>

	<div id="layer_content" class="layerRegistration" style="height:600px;">		
		
		<p class="txt">전기통신사업법 제 84조에 의거하여 2015년 10월 16일부터 인터넷을 통해 발송하는 문자메시지의 발신번호에 대해서 발신번호 사전등록제가 시행됩니다.<br />
		<strong>2015년 10월 16일부터 사전에 등록 및 인증완료가 되지 않은 발신번호는 발송제한</strong> 되므로 발신번호 사전등록을 하셔서 서비스 이용에 불편함이 없으시기 바랍니다.</p>

		<dl>
		<dt>발신번호 사전등록제란 무엇인가요?</dt>
		<dd>(전기통신사업법 제 84조의 2)거짓으로 표시된 전화번호로 인한 이용자 피해 예방을 위해서 문자 발송 시 사전 인증된<br /><strong>발신번호로만 사용할 수 있도록 등록하는 제도</strong>입니다.</dd>

		<dt>발신번호 사전등록 방법은 어떤것이 있나요?</dt>
		<dd>
			<ul>
			<li><strong>가. 휴대폰 문자인증, 일반전화, ARS 인증 후 발신번호 등록하는 방식</strong></li>
			<li>
				<strong>나. 서류접수 방식</strong><br />
				통신사에서 제공하는 ‘통신서비스 이용 증명원’ 본인의 전화번호임을 입증하는 서류(가입통신사 발급)를 통해 등록이 가능합니다.<br />
				통화 가능한 본인명의의 전화번호만 등록 가능합니다. (휴대폰번호, 일반번호, 대표번호)
			</li>
			</ul>
		</dd>
		
		<dt>번호체계에 맞지 않는 번호에 대한 차단 기준은 어떻게 되나요?</dt>
		<dd>
			<ul>
			<li>- 전체 번호수 8~11자리인 경우에만 허용</li>
			<li>- 특수번호 : 112, 119(국가, 공공기관)등 예외처리 이외는 차단됩니다.</li>
			<li>- 030번호 : 12자리 허용</li>
			</ul>
		</dd>

		<dt>통신서비스 이용증명원은 어떻게 받나요?</dt>
		<dd>각 통신사마다 가입유형에 따라 요구하는 서류가 다를 수 있습니다.<br />
		가입하신 통신사의 고객센터 혹은 홈페이지 연결 후, 필요한 내역을 안내받으신 후 증명서를 발급 받아 주세요.</dd>		
		</dl>

		<div class="service_area">
			<div class="service">
				<img src="/img/manager/img_tworld.jpg" alt="T world" />				
				
				<dl>
				<dt>이동전화 고객센터</dt>
				<dd>114(무료), 080-011-6000(무료),<br />1599-0011(유료)</dd>
				<dt>유선서비스 고객센터</dt>
				<dd>080-816-2000(무료), 1600-2000(유료)</dd>
				</dl>

				<div class="btn_go">					
					<a href="http://www.tworld.co.kr" class="sButton small active" target="_blank">바로가기</a>
				</div>
			</div>

			<div class="service middle">
				<img src="/img/manager/img_sktelink.jpg" alt="SK telink" />
				
				<dl>
				<dt>알뜰폰 서비스 문의</dt>
				<dd>ARS 1599-0999(유료)<br />SK텔링크 휴대폰에서 114(무료)<br />080-899-0999(무료)</dd>
				</dl>

				<div class="btn_go">
					<a href="http://www.sktelink.com/os/cs/gd/cs_ph_guide_info.do" class="sButton small active" target="_blank">바로가기</a>
				</div>
			</div>
			
			<div class="service last">
				<img src="/img/manager/img_skbroadband.jpg" alt="SK broadband" />
				
				<dl>
				<dt>고객센터</dt>
				<dd>080-8282-106</dd>
				</dl>

				<div class="btn_go">
					<a href="http://www.skbroadband.com/Main.do" class="sButton small active" target="_blank">바로가기</a>
				</div>
			</div>

			<div class="service">
				<img src="/img/manager/img_hello.jpg" alt="hello 모바일" />				
				
				<dl>
				<dt>KT망</dt>
				<dd>1588-1144(유료)<br />080-888-0114(무료)</dd>
				<dt>SKT망</dt>
				<dd>1855-2114(유료)</dd>
				</dl>

				<div class="btn_go">				
					<a href="http://www.cjhello.com/mv_Client/customer/customer_03.asp" class="sButton small active" target="_blank">바로가기</a>
				</div>
			</div>

			<div class="service middle">
				<img src="/img/manager/img_kt.jpg" alt="kt" />
				
				<dl>
				<dt>고객센터</dt>
				<dd>100</dd>
				</dl>

				<div class="btn_go">
					<a href="http://www.olleh.com" class="sButton small active" target="_blank">바로가기</a>
				</div>
			</div>
			
			<div class="service last">
				<img src="/img/manager/img_sejong.jpg" alt="세종텔레콤" />
				
				<dl>
				<dt>대표번호</dt>
				<dd>1688-1000</dd>
				</dl>

				<div class="btn_go">
					<a href="http://www.sejongtelecom.net/main.jsp" class="sButton small active" target="_blank">바로가기</a>
				</div>
			</div>

			<div class="service">
				<img src="/img/manager/img_uplus.jpg" alt="유플러스" />				
				
				<dl>
				<dt>모바일</dt>
				<dd>휴대폰에서 114(무료), 1544-0010</dd>
				<dt>인터넷/TV/070</dt>
				<dd>국번없이 101</dd>
				</dl>

				<div class="btn_go">
					<a href="http://www.uplus.co.kr" class="sButton small active" target="_blank">바로가기</a>
				</div>
			</div>

			<div class="service middle">
				<img src="/img/manager/img_kct.jpg" alt="kct" />
				
				<dl>
				<dt>대표번호</dt>
				<dd>070-8188-0114</dd>
				</dl>

				<div class="btn_go">
					<a href="http://www.kcttel.com" class="sButton small active" target="_blank">바로가기</a>
				</div>
			</div>		
		</div>		
			
		<!-- btn_layer -->
		<div class="btn_layer" style="margin:50px 0;">
			<a href="#" class="sButton large primary">발신번호 등록(인증) 바로가기</a>
		</div>
		<!-- //btn_layer -->
	</div>	
</div>
<!-- //발신번호사전등록안내 -->

<!-- 광고성 문자 표기의무 안내 -->
<div id="layer_popup" style="width:780px;height:700px;margin:-346px 0 0 -390px;">
	<div id="layer_header">
		<h1>광고성 문자 표기의무 안내</h1>
		<button type="button" onclick="closeLayerPopup()" title="닫기"><img src="../img/btn_close2.png" alt="Close" /></button>
	</div>

	<div id="layer_content" class="layerRegistration" style="height:600px;">				
		<p class="txt">2014년 11월 29일 부로 시행된 정보통신망이용촉진 및 정보보호등에 관한 법률(정보통신망법) 제 50조의 의거하여 광고성 문자 전송에 관한 법령이 일부 개정/강화 시행되었습니다.<br />
		강화되는 관련 법 조항은 아래와 같습니다.</p>

		<div class="obligation">
			<dl>
			<dt>법에서 정하고 있는 표시 의무사항  -</dt>
			<dd>(광고) 전송자의 명칭, 연락처, 무료거부</dd>
			</dl>
		</div>

		<img src="/img/manager/img_adGuide.jpg" alt="광고성 문자 표기의무 안내" />

		<p class="adtxt center">광고메시지 표기 의무 미준수시 아이디정지 및 사이트 이용에 제한이 있을 수 있으니<br />
		꼭 광고 표기 의무를 준시하여 전송하시기 바랍니다.</p>

		<table class="list_table border" summary="광고성 문자 표기의무에 관련된 표로써 표기의무 위반문자, 위반내용, 개선결과 등 순으로 출력됩니다.">
		<caption>광고성 문자 표기의무</caption>
		<colgroup>
		<col width="33%">
		<col width="*%">
		<col width="33%">
		</colgroup>
		<thead>
		<tr>
			<th>표기의무 위반문자</th>
			<th>위반내용</th>
			<th>개선결과</th>
		</tr>	
		</thead>
		<tbody>
		<tr>
			<td>
				<div class="violation">
					(광고)OO홈쇼핑-OO홍삼진!<br />
					30%최대할인전!<br />
					지금방송중!<br />
					<strong class="primary">수신거부</strong> 080-000-0000
				</div>
			</td>
			<td>“무료”없음</td>
			<td><strong class="info">무료거부</span></td>
		</tr>
		<tr>
			<td>
				<div class="violation">
					<strong class="primary">광고)</strong>고객님 누적포인트<br />
					3300원~ 행복한 주말<br />
					보내세요~^^<br />
					무료수신거부☎,<br />
					원회신번호:157122876701
				</div>
			</td>
			<td>“(광고)” 표기오류</td>
			<td><strong class="info">(광고)고객님</span></td>
		</tr>
		<tr>
			<td>
				<div class="violation">
					<strong class="primary">광고)</strong>OO대리 ☎1234-1234<br />
					전화주세요.^^<br />
					<strong>철회080123123</strong>
				</div>
			</td>
			<td>“(광고)” 표기오류<br />“무료수신동의”없음<br />080 번호 표기 오류</td>
			<td><strong class="info">(광고)OO대리<br />무료거부<br />080123123X<br />※ 080번호 끝에 3자리가 올 수 없음</span></td>
		</tr>
		</tbody>
		</table>

		<p>아래와 같이 관련 “KISA 불법 스팸 방지를 위한 정보통신망법 안내서”를 첨부 하오니 광고성 문자를 이용하시는 모든 고객<br />여러분들께서는 반드시 필독하시기 바랍니다.<br />감사합니다.</p>
			
		<!-- btn_layer -->
		<div class="btn_layer" style="margin:50px 0;">
			<a href="#" class="sButton large primary">정보통신망법 안내서 보기</a>
		</div>
		<!-- //btn_layer -->
	</div>	
</div>
<!-- //광고성 문자 표기의무 안내 -->

<!-- 발신 번호 등록하기 > 휴대폰 인증 -->
<div id="layer_popup" style="width:480px;height:500px;margin:-240px 0 0 -240px;">
	<div id="layer_header">
		<h1>발신 번호 등록하기</h1>
		<button type="button" onclick="closeLayerPopup()" title="닫기"><img src="http://wbox.inplus21.com/layout/manager/img/common/btn_close_layer.gif" alt="Close" /></button>
	</div>

	<div id="layer_content" class="layerRegistration" style="400px;">
		<span class="title">발신번호 등록 제한 안내</span>
		<p>발송번호의 추가등록은 본인(이용자가 법인·단체인 경우 그 구성원을 포함하며, 그 구성원임을 소명할 수 있어야 함) 소유 전화번호의 최대 10개까지입니다. 10개가 넘는 번호의 등록을 원하시는 고객은 사유서와 함께 소정의 양식을 제출해 주시기 바랍니다.</p>
		<div class="check">
			<span class="txt">필수 동의 사항입니다.</span> 
			<label><input type="checkbox" name="chk_agree" value="Y" class="required" title="동의" /> 동의함</label>
		</div>

		<table class="write_table" summary="발신 번호 등록 인증에 관련된 표로써 인증방식 선택, 발송번호 설명, 인증 확인 등 순으로 출력됩니다.">
		<caption>발신 번호 등록하기</caption>
		<colgroup>
		<col width="96">
		<col width="*">
		</colgroup>
		<tbody>
		<tr>
			<th scope="row">인증방식 선택</th>
			<td>
				<label><input type="radio" name="" class="" value="" checked="checked" title="휴대폰 인증">휴대폰 인증</label>
				<label><input type="radio" name="" class="" value="" title="ARS 인증">ARS 인증</label>
				<label><input type="radio" name="" class="" value="" title="통신서비스 이용증명원">통신서비스 이용증명원</label>
			</td>
		</tr>
		<tr>
			<th scope="row">발송번호 설명</th>
			<td>
				<input type="text" name="" value="" class="text" size="30" maxlength="30" title="발송번호 설명">
			</td>
		</tr>
		<tr>
			<th scope="row">인증 확인</th>
			<td><a href="#" class="sButton small">휴대폰 인증</a></td>
		</tr>
		</tbody>
		</table>		
			
		<!-- btn_layer -->
		<div class="btn_layer">
			<a href="#" class="sButton primary">추가</a>
			<a href="#" class="sButton active">취소</a>
		</div>
		<!-- //btn_layer -->
	</div>	
</div>
<!-- //발신 번호 등록하기 > 휴대폰 인증 -->

<!-- 발신 번호 등록하기 > ARS 인증 -->
<div id="layer_popup" style="width:480px;height:500px;margin:-240px 0 0 -240px;">
	<div id="layer_header">
		<h1>발신 번호 등록하기</h1>
		<button type="button" onclick="closeLayerPopup()" title="닫기"><img src="http://wbox.inplus21.com/layout/manager/img/common/btn_close_layer.gif" alt="Close" /></button>
	</div>

	<div id="layer_content" class="layerRegistration" style="height:400px;">
		<span class="title">발신번호 등록 제한 안내</span>
		<p>발송번호의 추가등록은 본인(이용자가 법인·단체인 경우 그 구성원을 포함하며, 그 구성원임을 소명할 수 있어야 함) 소유 전화번호의 최대 10개까지입니다. 10개가 넘는 번호의 등록을 원하시는 고객은 사유서와 함께 소정의 양식을 제출해 주시기 바랍니다.</p>
		<div class="check">
			<span class="txt">필수 동의 사항입니다.</span> 
			<label><input type="checkbox" name="chk_agree" value="Y" class="required" title="동의" /> 동의함</label>
		</div>

		<table class="write_table" summary="발신 번호 등록 인증에 관련된 표로써 인증방식 선택, 발송번호 설명, 인증 확인 등 순으로 출력됩니다.">
		<caption>발신 번호 등록하기</caption>
		<colgroup>
		<col width="96">
		<col width="*">
		</colgroup>
		<tbody>
		<tr>
			<th scope="row">인증방식 선택</th>
			<td>
				<label><input type="radio" name="" class="" value="" title="휴대폰 인증">휴대폰 인증</label>
				<label><input type="radio" name="" class="" value="" checked="checked" title="ARS 인증">ARS 인증</label>
				<label><input type="radio" name="" class="" value="" title="통신서비스 이용증명원">통신서비스 이용증명원</label>
			</td>
		</tr>
		<tr>
			<th scope="row">발송번호 설명</th>
			<td>
				<input type="text" name="" value="" class="text" size="30" maxlength="30" title="발송번호 설명">
			</td>
		</tr>
		<tr>
			<th scope="row">발송번호</th>
			<td>
				<input type="text" name="" value="" class="text" size="30" maxlength="30" title="발송번호">
				<a href="#" class="sButton small">인증번호 요청</a>
			</td>
		</tr>
		</tbody>
		</table>		
			
		<!-- btn_layer -->
		<div class="btn_layer">
			<a href="#" class="sButton primary">추가</a>
			<a href="#" class="sButton active">취소</a>
		</div>
		<!-- //btn_layer -->
	</div>	
</div>
<!-- //발신 번호 등록하기 > ARS 인증 -->

<!-- 발신 번호 등록하기 > 통신서비스 이용증명원 -->
<div id="layer_popup" style="display:block;width:480px;height:690px;margin:-330px 0 0 -240px;">
	<div id="layer_header">
		<h1>발신 번호 등록하기</h1>
		<button type="button" onclick="closeLayerPopup()" title="닫기"><img src="http://wbox.inplus21.com/layout/manager/img/common/btn_close_layer.gif" alt="Close" /></button>
	</div>

	<div id="layer_content" class="layerRegistration" style="height:590px;">
		<span class="title">발신번호 등록 제한 안내</span>
		<p>발송번호의 추가등록은 본인(이용자가 법인·단체인 경우 그 구성원을 포함하며, 그 구성원임을 소명할 수 있어야 함) 소유 전화번호의 최대 10개까지입니다. 10개가 넘는 번호의 등록을 원하시는 고객은 사유서와 함께 소정의 양식을 제출해 주시기 바랍니다.</p>
		<div class="check">
			<span class="txt">필수 동의 사항입니다.</span> 
			<label><input type="checkbox" name="chk_agree" value="Y" class="required" title="동의" /> 동의함</label>
		</div>

		<table class="write_table" summary="발신 번호 등록 인증에 관련된 표로써 인증방식 선택, 발송번호 설명, 인증 확인 등 순으로 출력됩니다.">
		<caption>발신 번호 등록하기</caption>
		<colgroup>
		<col width="96">
		<col width="*">
		</colgroup>
		<tbody>
		<tr>
			<th scope="row">인증방식 선택</th>
			<td>
				<label><input type="radio" name="" class="" value="" title="휴대폰 인증">휴대폰 인증</label>
				<label><input type="radio" name="" class="" value="" title="ARS 인증">ARS 인증</label>
				<label><input type="radio" name="" class="" value="" checked="checked" title="통신서비스 이용증명원">통신서비스 이용증명원</label>
			</td>
		</tr>
		<tr>
			<th scope="row">발송번호 설명</th>
			<td>
				<input type="text" name="" value="" class="text" size="30" maxlength="30" title="발송번호 설명">
			</td>
		</tr>
		<tr>
			<th scope="row">발송번호</th>
			<td>
				<input type="text" name="" value="" class="text" size="30" maxlength="30" title="발송번호">
				<a href="#" class="sButton small">번호 확인</a>
			</td>
		</tr>
		<tr>
			<th scope="row">인증 확인 /<br />완료</th>
			<td class="confirm">
				Fax 050-8082-1800 으로 아래의 서류를 발송하여 주시면 확인 후 인증처리가 완료됩니다. 기업 회원 : 통신서비스 이용증명원 1부 / 사업자등록 사본 1부 / 담당자분의 신분증(생년월일 이하 뒷부분 블라인드 처리)<br /><br />
				개인 회원 : 통신서비스 이용증명원 1부 / 명의자분의 신분증 (생년월일 이하 뒷부분 블라인드 처리) 통신서비스 이용증명원의 명의자(사업자)와 요청장의 명의(사업자명)는 동일해야만 인증이 처리되어니 이점 유의 부탁드립니다.
			</td>
		</tr>
		</tbody>
		</table>		
			
		<!-- btn_layer -->
		<div class="btn_layer">
			<a href="#" class="sButton primary">추가</a>
			<a href="#" class="sButton active">취소</a>
		</div>
		<!-- //btn_layer -->
	</div>	
</div>
<!-- //발신 번호 등록하기 > 통신서비스 이용증명원 -->