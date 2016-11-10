$(function() {
    $(document).off("click", ".btn_delete"); // 기존 delete의 트리거 삭제
    $( "button.trash" ).on("click", function(e) {
        if (confirm("내용을 모두 삭제하시겠습니까?")) {
            $( this ).parent().siblings("textarea").val("");
            e.preventDefault();
        }
    });
});

// 발송할 문자의 byte수를 구합니다
function fnChkByte(obj){
    // 문자열 길이 제한
    var sms_length = 90;
    var lms_length = 2000;
    // 입력된 문자 구하기
    var str = obj.value;

    // 정보 출력에 관한 요소들
    var byte_elem = $( obj ).siblings(".byte");
    var byte_length_elem = byte_elem.find(".length");
    var byte_limit_elem = byte_elem.find(".limit");
    var byte_type_elem = byte_elem.find(".type");

    // Byte 계산
    stringByteLength = (function(s,b,i,c){
        for(b=i=0;c=s.charCodeAt(i++);b+=c>>11?2:c>>7?2:1);
        return b
    })(str);

    byte_length_elem.text(stringByteLength);
    if ((stringByteLength > sms_length) && (byte_type_elem.text() == "SMS")) {
        byte_limit_elem.text("/ 2000byte");
        byte_type_elem.text("LMS");
    } else if ((stringByteLength <= sms_length) && (byte_type_elem.text() == "LMS")) {
        byte_limit_elem.text("/ 90byte");
        byte_type_elem.text("SMS");
    } else if (stringByteLength > lms_length) {
        alert("LMS는 최대 2000Byte까지 입력할 수 있습니다.");
        //preventDefault() 를 어떻게 넣지?
    }
}





// 바이트계산
function chkBytes(maxbyte){
    var sms_length = 90;
    var lms_length = 2000;

    var msg = $("#message").val();
    var textbytes = byte_calculate(msg);

    var msglen = length(msg);

    if(msglen > maxbyte){
        dialog_alert('Message','더 이상 입력할 수 없습니다.');
        msg = cut_byte_msg(msg, maxbyte);
        $("#message").val(msg);
        $("#message_length").html(maxbyte);
    }else{
        $("#message_length").html(textbytes);
    }
}

function byte_calculate(itext){
    var textbytes = length(itext);
    if(textbytes > 90){
        $('#message_limit').html('/2000 Bytes');
        $('#msg_inputbox').addClass('smsBoxover90');
    }else{
        $('#message_limit').html('/90 Bytes');
        $('#msg_inputbox').removeClass('smsBoxover90');
    }
    return textbytes;
}