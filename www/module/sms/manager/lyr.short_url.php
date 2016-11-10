<!-- 짧은주소 -->
<p class="dot">짧은 URL로 변경할 URL을 입력한 후 변환하기 버튼을 눌러주세요.</p>

<ul class="shortUrl">
	<li>
		<dt>사이트</dt>
		<dd><textarea rows="3" id="url_area"></textarea></dd>
	</li>
	<!-- 변환버튼 클릭시 짧은 url 생성 -->
	<li>
		<dt>짧은 URL</dt>
		<dd><input type="text" name="short_url" value="" class="text readonly" title="짧은 URL" /></dd>
	</li>
	<!-- //변환버튼 클릭시 짧은 url 생성 -->
</ul>

<p>예약박스의 짧은URL은 Google URL Shortener Api로 제공됩니다.</p>

<!-- btn_layer -->
<div class="btn_layer">
	<button class="sButton small primary" onclick="requestShortener()"><span class="text">변환</span></button>
</div>
<script>
	function requestShortener() {
		var url = $( "textarea#url_area" ).val();
		$.get( "ajax.make_short_url.html?url=" + url, function( data ) {
			if (data.code == "success") {
				$( "input[name=short_url]" ).val(data.id);
			} else {
				alert("문제가 발생하였습니다. 잠시 후 다시 시도해주세요.");
			}
		}, "json");
	}

</script>
<!-- //btn_layer -->
<!-- //짧은주소 -->