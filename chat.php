<?php
require __DIR__ . '/boostrap.php';

use MyApp\DBcommands;

$commands = new DBcommands;

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
    <title id="title">GADO ZAP</title>
    <link rel="shortcut icon" href="misc/favicon.ico" />
</head>
<body>
    <div style="width: 761px; margin: 0 120px; background: white; padding: 10px; display:flex">
        <input type="hidden" id="name" autocomplete="off" value="<?= $_SESSION['name'] ?>">
        <div>
            <div id="status"></div>
            <form action="logout.php" method="post" style="float: right; padding: 4.5px; margin-right: 15px">
                <input type="hidden" name="name" value="<?= $_SESSION['name'] ?>">
                <button id="logout">Logout</button><br><br>
            </form>
        </div>
        <div style="text-align: center;display: flex; align-items: center;height: 477px;">
            <span style="margin-right: 10px"><strong>Pessoas Online</strong></span>
            <div style="border: solid 1px; margin-right: 10px; height: 455px;padding: 10px" id="online">
            </div>
        </div>
        <div>
            <div style="border: 1px solid black; overflow-y: scroll;height: 475px;width: 700px" name="" id="response" cols="30" rows="10"></div>
            <form name="form-send" action="" style="text-align: right; margin-top: 5px;float: right;">
                <input type="text" id="text" autocomplete="off">
                <button type="submit">Enviar</button>
            </form>
        </div>
    </div>
</body>

</html>
<script type="text/javascript" src="js/jquery-3.4.0.min.js"></script>
<script>
$(document).ready(function(){
    // ---------------------WEBSOCKET--------------------------
    var conn = new WebSocket('ws://192.168.10.209:8080');

    conn.onopen = function(event) {
        $("#status").html('<p style="text-align:center; background: #aaffaa;">ONLINE!</p>');
    };

    conn.onmessage = function(event) {
        var data = JSON.parse(event.data);
        var name = data.name;
        
        //if name is null
        if(name == ""){
            name = data.ip
        }

        //if message is from GM
        if(data.ip == 'bot'){
            $('#response').append('<p style="text-align:'+data.position+'"><strong style="color:'+data.color+'">'+name+'</strong>: '+data.message+'</p>')
            $('#online').html("");
            $.each(data.online,function(key, value){
                $('#online').append(value + "\n");
            });
        }else if(data.type == 'card'){
            var images = "";

            $.each(data.message, function(key, value){
                images += '<img height=350 src="'+value+'">';
            });
            $('#response').append('<p style="text-align:'+data.position+'; display:flex; overflow:scroll; align-items: center;"><strong style="color:'+data.color+'">'+name+'</strong>:'+images+'</p>')
        }else{
            document.title = "Mensagem de: " + name;
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