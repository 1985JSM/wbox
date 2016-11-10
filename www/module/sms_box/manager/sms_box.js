$(function() {
    $( "button#createNewBox" ).on('click', function() {
        var data = "mode=createNewBox";
        $.post("process.html", data, function(result) {
            if (result.code == "insert_ok") {
                $div = $("<div />").replaceWith("<div class=\"box_list\" id=\"" + result.sms_box_id + "\"><textarea class=\"messageBox\"></textarea><div class=\"btn_area\"> <button type=\"button\" id=\"save\" class=\"sButton small info\">저장</button> <button type=\"button\" id=\"delete\" class=\"sButton small active\">삭제</button> </div> </div>");
                $("div.messageAdd").after($div);
                initContent($div);
                //$( "div.messageAdd" ).after("<div class=\"box_list\" id=\"" + result.sms_box_id + "\"><textarea class=\"messageBox\"></textarea><div class=\"btn_area\"> <button type=\"button\" id=\"save\" class=\"sButton small info\">저장</button> <button type=\"button\" class=\"sButton small active\">삭제</button> </div> </div>");
                //initContent("div#" + result.sms_box_id);

            }
        }, 'json');
    });

    $( "div#content" ).on("click", "button#save", function() {
        var box_elem = $( this ).closest( "div.box_list" );
        var uid = box_elem.attr("id");
        var contents = box_elem.children( "textarea.messageBox" ).val();
        var data = "mode=updateBox&sms_box_id=" + uid + "&sms_box_contents=" + contents;
        $.post("process.html", data, function(result) {
            console.log(result.code);
        }, 'json');
    });

    $(document).off("click", ".btn_delete"); // 기존 delete의 트리거 삭제
    $( "div#sms_box" ).on("click", "button#delete", function() {
        if (confirm("메시지를 삭제하시겠습니까?")) {
            var box_elem = $( this ).closest( "div.box_list" );
            var uid = box_elem.attr("id");
            data = "mode=deleteBox&sms_box_id=" + uid;
            $.post("process.html", data, function(result) {
                console.log(result);
                if (result.code == "delete_ok") {
                    box_elem.remove();
                    alert("정상적으로 삭제되었습니다.");
                }
            }, 'json');
        }
    });
});