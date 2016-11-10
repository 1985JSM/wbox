$(function() {
    // 문자 텍스트 박스에서 텍스트가 감지되었을 때
    $( "textarea[name=sms_send_text]" ).bind('change input keyup paste', function() {
        fnChkByte(this);
    });
    $("#but").bind("click",function(){
        $("#inptxt").val("Jquery not trigger the change function").trigger('change');
    });

    // 080 수신거부 버튼
    $( "input[name=sms_deny080]" ).on("change", function(e) {
        // 수신거부 번호
        var deny_num = "15665099";
        // 수신거부 인증번호
        var cert_num = "0000";

        // 수신거부 머릿말
        var header_text = "(광고)\n";
        // 수신거부 꼬릿말
        var footer_text = "\n무료수신거부\n" + deny_num + "\n인증번호 " + cert_num;

        var text_box = $( "textarea[name=sms_send_text]" );
        // 체크 되었을 때 문구 추가
        if ($( this ).is(":checked")) {
            var text = "";
            text += header_text;
            if (text_box.val() == "") {
                //text += "\n";
            } else {
                text += text_box.val();
            }
            text += footer_text;
            text_box.val(text);
        }
        // 해제 되었을 때 문구 제거
        else {
            //text_box.val(text_box.val().replace(header_text, ""));
            //text_box.val(text_box.val().replace(footer_text, ""));
            if (confirm("내용이 모두 삭제됩니다. 그래도 진행하시겠습니까?")){
                text_box.val("");
            } else {
                $( this ).attr("checked", "checked");
                e.preventDefault();
            }

        }
        fnChkByte(text_box.get(0));
    });

    // 직접입력, 고객선택 탭
    $( "div.tab_area > ul > li > a" ).on("click", function() {
        //var test = $(this).get(0);

        // li탭 클래스
        $( this ).parents("li").siblings().children("a").removeAttr("class");
        $( this ).attr("class", "on");

        // 탭 변경시 mode도 변경
        $( this ).closest("form").find("input[name=mode]").val($(this).attr("href").substring(1));

        // li링크에 대한 수신자 종류 표시
        var tab_area = $( ".tab_area_list" ).find($(this).attr("href"));
        tab_area.css("display", "");
        tab_area.siblings().css("display", "none");
    });

    // 고객 선택에서 대상고객 선택
    $( "input[name=chk_sort]" ).on("change", function() {
        // 탭 변경
        $( "div#memberSelect" ).find("div#" + $( this ).val()).css("display", "").siblings(".member_option").css("display", "none");

        // 탭 변경시 mode도 변경
        $( this ).closest("form").find("input[name=mode_memberSelect]").val($(this).val());

        if (this.value == "chk_sort_all") {
            $.ajax({
                url: "ajax.cnt_customer.html?cnt_customer_mode=all",
                method: "post",
                dataType: "json",
                success: function(res) {
                    $( "div#chk_sort_all").children("strong").text(res.total + "명");
                    showCntSentSms(res.total);
                }
            });
        }
    });

    // 수신번호 입력에서 추가 버튼을 클릭시 추가
    $( "div.recipient > button" ).on("click", function() {
        var name_elem = $( this ).siblings("input[name=recipient_name]");
        var hp_elem = $( this ).siblings("input[name=recipient_hp]");
        var name = name_elem.val();
        var hp = hp_elem.val();

        if (name == "") {
            alert("이름을 입력해주세요");
        } else if (hp == "") {
            alert("전화번호를 입력해주세요");
        } else {
            var list_elem = $( "ul.receive_list" );

            list_elem.append(
                "<li class=\"receive_test\">" +
                "<span class=\"name\">" + name + "</span>" +
                "<span class=\"num\">" + hp + "</span>" +
                "<button type=\"button\" onclick=\"deleteReceiveItem(this)\"><i class=\"xi-close\"></i></button>" +
                "</li>"
            );

            var total_cnt_elem = $( "p.total > strong" );
            total_cnt_elem.text((parseInt(total_cnt_elem.text()) + 1));
            showCntSentSms(total_cnt_elem.text());
            name_elem.val("");
            hp_elem.val("");
        }
    });

    // 수신번호 입력의 리스트 전체 삭제
    $( "div.btn_total" ).on("click", function() {
        var list_elem = $( "ul.receive_list" );
        if ((list_elem).children().length > 0) {
            list_elem.children().remove("li");
            $( "p.total > strong" ).text(0);
            alert("전체 삭제되었습니다");
        }

    });

    ////////////////////////////
    // 대상 고객 선택에서 선택된 고객수를 구하기 위한 트리거


    // 고객 등급 선택이 변경되었을 때
    $( "select[name=sch_cs_level]" ).on("change", function() {
        var data = "sch_cs_level=" + this.value;
        $.ajax({
            url: "ajax.cnt_customer.html?cnt_customer_mode=level",
            method: "post",
            data: data,
            dataType: "json",
            success: function(res) {
                $( "div#chk_sort_level").children("span.num").find("strong").text(res.total + "명");
                showCntSentSms(res.total);
            }
        });
    });

    // 전체 고객 발송일 때
    // 여기서 확인 $( "input[name=chk_sort]" ).on("change", function() {

    // 담당자별 고객이 변경되었을 때
    $( "select[name=sch_st_id]" ).on("change", function() {
        var data = "sch_st_id=" + this.value;
        $.ajax({
            url: "ajax.cnt_customer.html?cnt_customer_mode=staff",
            method: "post",
            data: data,
            dataType: "json",
            success: function(res) {
                $( "div#chk_sort_staff").children("span.num").find("strong").text(res.total + "명");
                showCntSentSms(res.total);
            }
        });
    });

    // 예약 고객에서 예약 횟수가 변경되었을 때
    $( "select[name=chk_selected_num]" ).on("change", function() {
        var data = "chk_selected_num=" + this.value;
        $.ajax({
            url: "ajax.cnt_customer.html?cnt_customer_mode=reservation",
            method: "post",
            data: data,
            dataType: "json",
            success: function(res) {
                $( "div#chk_sort_reservation").children("span.num").find("strong").text(res.total + "명");
                showCntSentSms(res.total);
            }
        });
    });

    ////////////////////////////

    // 테스트 전송
    $( "div.btn_test > button" ).on("click", function() {
        var text = $( "div.write_area > textarea" ).val();
        var tester_name = $( "input[name=test_recipient_name]" ).val();
        var tester_hp = $( "input[name=test_recipient_hp]" ).val();
        var sd_no = $( "select[name=sms_sd_no]" ).val();

        if (tester_name == "") {
            alert("이름을 입력해주세요");
        } else if (tester_hp == "") {
            alert("이름을 입력해주세요");
        } else if (text == "") {
            alert("텍스트를 입력해주세요")
        } else {
            var data = "mode=test_sending&sms_sd_no=" + sd_no + "&tester_name=" + tester_name + "&tester_hp=" + tester_hp + "&send_text=" + text;
            $.ajax({
                url: "process.html",
                method: "post",
                data: data,
                dataType: "json",
                success: function(res) {
                    console.log(res)
                    if (res.code == "success") {
                        alert("테스트 전송이 완료되었습니다.");
                    } else {
                        alert("문제가 발생하였습니다.\n" + res.msg);
                    }
                },
                error:function(request,status,error){
                    alert(msg_arr["ajax_error"]);
                    console.log("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
                },
            });
        }
    });

    // 특수문자에서 탭 변경
    $( "div#layer_popup" ).on("click", "div#char_figure > ul > li > a", function() {
        var current_li_elem = $( this ).closest("li");
        var index = current_li_elem.index();

        $( this ).closest("div").siblings("div.charWrap").eq(index).css("display", "").siblings("div.charWrap").css("display", "none");

        current_li_elem.html("<span>" + current_li_elem.find("a").text() + "</span>").siblings("li").find("span").replaceWith(function() {
            return $("<a/>", {
                html: this.innerHTML
            })
        });

    });

    // 이모티콘에서 클릭시
    $( "div#layer_popup" ).on("click", "div.charWrap > a", function() {
        var text = this.text;
        $( "textarea[name=sms_send_text]" ).append(text);
    });

    // 메시지 충전시 사용하는 스크립트
    $( "input[name=pa_subject]" ).on("change", function() {
        var price = $( this ).closest("td").siblings("#price").text();
        var price_elem = $( "table.write_table" ).find("tr#price").children("td");
        var tax_elem = $( "table.write_table" ).find("tr#tax").children("td");
        var amount_elem = $( "table.write_table" ).find("tr#amount").find("td > strong");

        var price_num = price.replace("원", "").replace(",", "").replace(",", "");
        var tax_num = parseInt(price_num) / 10;
        var amount = parseInt(price_num) + parseInt(tax_num);
        
        price_elem.text(price);
        tax_elem.text(setComma(tax_num) + "원");
        amount_elem.text(setComma(amount) + "원");
        //$( "input[name=pa_price]" ).val(amount);
    });

});

function sendSms(f) {
    if (confirm("정말 전송하시겠습니까?") == false) {
        return false;
    }

    var mode = f.mode.value;
    var mode_memberSelect = f.mode_memberSelect.value;
    if (f.sms_send_text == "") {
        alert("내용을 입력해주세요");
        return false;
    }
    var data = "";

    var url = "./process.html?mode=" + mode + "&mode_memberSelect=" + mode_memberSelect;

    if (mode == "typeRecipient") {
        var list_elem = $(f).find(".receive_list").children();

        data = $( f ).serialize();

        if (list_elem.length > 0) {
            for (var i=0; i<list_elem.length; i++) {
                var name = list_elem.eq(i).find(".name").text();
                var hp = list_elem.eq(i).find(".num").text();
                data += '&recipient_' + i + '_name=' + name;
                data += '&recipient_' + i + '_hp=' + hp;
            }
        }
        else {
            alert("수신자를 등록해주세요");
            return false;
        }
    }

    else if (mode == "memberSelect") {
        data = "mode=" + mode;
        data += "&mode_memberSelect=" + mode_memberSelect;
        data += "&sms_sd_no=" + f.sms_sd_no.value;
        data += "&sms_send_text=" + f.sms_send_text.value;
        data += "&sms_remove_repeated=" + f.sms_remove_repeated.value;
        data += "&sms_rs_type=" + f.sms_rs_type.value;
        data += "&sms_rs_date=" + f.sms_rs_date.value;
        data += "&sms_rs_hour=" + f.sms_rs_hour.value;
        data += "&sms_rs_minutes=" + f.sms_rs_minutes.value;
        if (mode_memberSelect == "chk_sort_level") {
            data += "&sch_cs_level=" + f.sch_cs_level.value;
        }
        else if (mode_memberSelect == "chk_sort_staff") {
            data += "&sch_st_id=" + f.sch_st_id.value;
        }
        else if (mode_memberSelect == "chk_sort_direct") {
            var list_elem = $( "div#chk_sort_direct > table#selected_list > tbody > tr" );
            for (var i=0; i < list_elem.length; i++) {
                data += "&recipient_" + i + "_csid=" + list_elem.eq(i).find("td:eq(7)").text();
            }
        }
    }
    console.log(data);
    $.ajax({
        url: url,
        method: "post",
        data: data,
        dataType: "json",
        success: function(res) {
            console.log(res);
            if (res.code == 'success') {
                alert(res.success + "건 성공, " + res.failed + "건 실패");
                $(location).attr('href', 'sms_send_list.html');
            } else {
                alert(res.msg);
            }
        },
        error:function(request,status,error){
            alert(msg_arr["ajax_error"]);
            console.log("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
        },
    });
    return false;

}

// 발송할 문자의 byte수를 구합니다
function fnChkByte(obj){
    // 문자열 길이 제한
    var sms_length = 90;
    var lms_length = 2000;
    // 입력된 문자 구하기
    var str = obj.value;

    // 정보 출력에 관한 요소들
    var byte_elem = $( obj ).parent().siblings(".byte");
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

// 수신번호 입력에서 수신자 리스트에서 삭제를 클릭한 아이템 지우기
function deleteReceiveItem(obj) {
    var cnt_elem = $( "p.total > strong" );
    $( obj ).parent().remove();
    cnt_elem.text((cnt_elem.text() - 1));
}

// 차감될 sms의 수를 구합니다
function showCntSentSms(num) {
    if ($( "p.byte > span.type" ).text() == "LMS") {
        num = num * 2;
    }
    $( "li#cnt_sent" ).find("span").text(num + "건수");
}

// 헬프
function showHelp(f) {
    var id = $( f ).attr("id");
    $( "div.message_info" ).find("p." + id).addClass("on").siblings("p").removeClass("on");

}

///////////////////////
// 고객선택 레이어의 함수들

// 고객 선택 등록 레이어팝업에서 검색할 때되었을 때
function customerSelector(f) {
    var data = $( f ).serialize();
    $.ajax({
        url: "ajax.search_customer.html",
        method: "get",
        data: data,
        success: function(res) {
            //console.log(res);
            $( f ).closest("div#layer_popup").find("div.table_td > table#search_list > tbody").html(res);
        }
    });
    return false;
}

// 고객선택에서 체크된 리스트들을 선택고객리스트에 추가합니다.
function addToSelectedList() {
    var test = $( "div#layer_popup" ).find("div.table_td > table#search_list > tbody > tr > td > input:checked").closest("tr");
    $( "div#layer_popup" ).find("div.table_td > table#selected_list > tbody").append(test);

    rearrangeNo();
}

// 선태고객리스트에서 체크된 항목들을 삭제합니다.
function deleteFromSelectedList() {
    var test = $( "div#layer_popup" ).find("div.table_td > table#selected_list > tbody > tr > td > input:checked").closest("tr").remove();

    rearrangeNo();
}

function loadFromSelectedList() {
    $("div#layer_popup").find("div.table_td > table#selected_list > tbody").html($( "div#chk_sort_direct > table#selected_list > tbody" ).html());
    rearrangeNo();
}

// 선택된 고객리스트 재정렬
function rearrangeNo() {
    var list_elem = $( "div#layer_popup" ).find("div.table_td > table#selected_list > tbody > tr");

    var list_length = list_elem.length;
    var added_list_arr = new Array();
    var removed_num = 0;
    for (var i = 0; i <= list_length; i++) {
        list_elem.eq(i).find("td:eq(0) > input").removeAttr("checked");
        list_elem.eq(i).find("td:eq(1)").text((i + 1) - removed_num);

        // 중복 제거
        if (added_list_arr.indexOf(list_elem.eq(i).find("td:eq(7)").text()) != -1) {
            list_elem.eq(i).remove();
            removed_num++;
        } else {
            added_list_arr.push(list_elem.eq(i).find("td:eq(7)").text());
        }
    }
}

// 선택 완료를 눌렸을 때
function completeSelect(f) {
    $( "div#chk_sort_direct > table#selected_list > tbody" ).html($( f ).closest("div#layer_popup").find("div.table_td > table#selected_list > tbody").html());
    $( "div#chk_sort_direct > span.num > strong.primary").text($( "div#chk_sort_direct > table#selected_list > tbody > tr" ).length + "명");
    $( "div#chk_sort_direct > span.num > strong.rejectCount").text($( "div#chk_sort_direct > table#selected_list > tbody > tr > td:contains('(거부)')" ).length);
    closeLayerPopup();
}
///////////////////////

// 메시지 저장함에서 선택했을 때
function textSelectFromBox(f) {
    if (confirm("입력된 내용이 모두 삭제됩니다.")) {
        $( "textarea[name=sms_send_text]" ).text($.trim($( f ).closest(".btn_layer").siblings(".message_view").text()));
        closeLayerPopup();
    }
}