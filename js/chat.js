$(document).ready(function () {
    // ----------------------WEBSOCKET---------------------
    var conn = new WebSocket('ws://192.168.10.209:8080');

    conn.onopen = function (event) {
        $("#status")
            .removeClass('alert-danger')
            .addClass('alert-success')
            .html("<h5 class='text-center' style='margin-bottom: 0;'>ONLINE</h5>");
    };
    conn.onmessage = function (event) {
        var data = JSON.parse(event.data);
        if (typeof data.type !== 'undefined' && data.type === 'card'){
            var images = "";
            if (typeof data.message !== 'string'){
                $.each(data.message, function(key, value){
                    images += '<a href="'+value+'" target="_blank"><img height=350 src="'+value+'"></a>';
                });
                $("#messages-area").append("<div class='col-md-7 "+data.position+"' style='clear:both;margin-bottom:10px;background:"+data.backcolor+";padding: 15px;border-radius: 25px;display: flex;overflow: auto;align-items: center'><b style='color:"+data.colorImportant+"'>" + data.name + "</b><br>"+ images +"</div>");
            }else{
                $("#messages-area").append("<div class='col-md-6 "+data.position+"' style='clear:both;margin-bottom:10px;background:"+data.backcolor+";padding: 15px;border-radius: 25px'><b style='color:"+data.color+"'>" + data.name + "</b><br>"+ data.message +"</div>");
            }
        }else{
            $("#messages-area").append("<div class='col-md-6 "+data.position+"' style='clear:both;margin-bottom:10px;background:"+data.backcolor+";padding: 15px;border-radius: 25px'><b style='color:"+data.color+"'>" + data.name + "</b><br>"+ data.message +"</div>");
        }
        $('#messages-area').scrollTop($('#messages-area')[0].scrollHeight);
    };
    conn.onclose = function (event) {
        $("#status")
            .removeClass('alert-success')
            .addClass('alert-danger')
            .html("<h5 class='text-center' style='margin-bottom: 0;'>OFFLINE</h5>");
    };
    // -----------------------------------------------------

    // --------------------MESSAGE FORM---------------------
    $("form[name=form-message]").on('submit', function (event) {
        event.preventDefault();
        var username = $("#user-name").val();
        var message = $("#user-message").val();

        $msgObject = {
            "name" : username,
            "message" : message
        };
        var formatMsgObject = JSON.stringify($msgObject)

        if(message.trim() !== ""){
            conn.send(formatMsgObject);
        }
        $("#user-message").val("");
    });
    // -----------------------------------------------------
});