<?php
require 'vendor/autoload.php';

session_start();
if($_SESSION['logged'] == false){
    header('location: index.php');
}
?>
<!DOCTYPE html>
<html>
<style>
    p {
        border: 1px #afafaf solid;
        margin: 10px;
        padding: 10px;
        box-shadow: 3px 5px 4px #6b6b6b;
    }
</style>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gado Zap</title>
    <link rel="shortcut icon" href="misc/favicon.ico" />
</head>
<body>
    <div style="width: 600px; margin: 0 auto; background: white; padding: 10px">
        <input type="hidden" id="name" autocomplete="off" value="<?= $_SESSION['name'] ?>">
        <div id="status"></div>
        <div style="border: 1px solid black; height: 500px; overflow-y: scroll;" name="" id="response" cols="30" rows="10"></div>
        <form name="form-send" action="" style="text-align: right; margin-top: 5px;float: right;">
            <input type="text" id="text" autocomplete="off">
            <button type="submit">Enviar</button>
        </form>
        <form action="logout.php" style="float: right; padding: 4.5px;">
            <button id="logout">Logout</button><br><br>
        </form>
    </div>
</body>

</html>
<script type="text/javascript" src="js/jquery-3.4.0.min.js"></script>
<script>
$(document).ready(function(){
    // ---------------------WEBSOCKET--------------------------
    var conn = new WebSocket('wss://192.168.10.209:8080');

    conn.onopen = function(event) {
        $("#status").html('<p style="text-align:center; background: #aaffaa;">ONLINE!</p>');
    };

    conn.onmessage = function(event) {
        var data = JSON.parse(event.data);
        var name = data.name

        //if name is null
        if(name == ""){
            name = data.ip
        }

        //if message is from GM
        if(data.ip == '666'){
            $('#response').append('<p style="text-align:'+data.position+'"><strong style="color:'+data.color+'">'+name+'</strong>: '+data.message+'</p>')
        }else{
            $('#response').append('<p style="text-align:'+data.position+'"><strong style="color:'+data.color+'">'+name+'</strong>: '+data.message+'</p>')
        }

        //scroll to bottom
        $('#response').scrollTop($('#response')[0].scrollHeight); 
    };

    conn.onclose = function(event) {
        $("#status").html('<p style="text-align:center; background: #e84949">OFFLINE!</p>');
    }
    // ---------------------WEBSOCKET--------------------------

    // -------------------MESSAGE FORM-------------------------
    $("form[name='form-send']").on('submit', function(event) {
        event.preventDefault();

        var message = $("#text").val().trim();
        var name = $("#name").val().trim();
        
        var messageObj = {
            'name' : name,
            'message' : message
        }
        var jsonConvert = JSON.stringify(messageObj);
        if(messageObj.message != ""){
            conn.send(jsonConvert)
        }
        $('#text').val('');
    });
    // -------------------MESSAGE FORM-------------------------
})
</script>