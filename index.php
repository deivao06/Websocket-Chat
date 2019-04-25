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
    <title>ZAP ZAP</title>
    <link rel="shortcut icon" href="misc/favicon.ico" />
</head>
<body>
    <div id="log">

    </div>
    <div style="width: 600px; margin: 0 auto; background: white; padding: 10px">
        <div style="padding-bottom: 10px">
            <span>Nome: </span>
            <input type="text" id="name" autocomplete="off">
        </div>
        <div style="border: 1px solid black; height: 500px; overflow-y: scroll;" name="" id="response" cols="30" rows="10"></div>
        <form name="form-teste" action="" style="text-align: right; margin-top: 5px;">
            <input type="text" id="text" autocomplete="off">
            <button type="submit">Enviar</button>
        </form>
    </div>
</body>

</html>
<script type="text/javascript" src="jquery-3.4.0.min.js"></script>
<script>
    // ---------------------WEBSOCKET--------------------------
    var conn = new WebSocket('ws://192.168.1.115:8080');

    conn.onopen = function(event) {
        $("#response").html('<p style="text-align: center; background: #aaffaa;">ONLINE!</p>');
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
            $('#response').append('<p style="text-align:center"><strong style="color:'+data.color+'">'+name+'</strong>: '+data.message+'</p>')
        }else{
            $('#response').append('<p style="text-align: left"><strong style="color:'+data.color+'">'+name+'</strong>: '+data.message+'</p>')
        }

        //scroll to bottom
        $('#response').scrollTop($('#response')[0].scrollHeight); 
    };

    conn.onclose = function(event) {
        $("#response").html('<p style="text-align: center; background: #e84949">OFFLINE!</p>');
    }
    // ---------------------WEBSOCKET--------------------------

    // -------------------MESSAGE FORM-------------------------
    $("form[name='form-teste']").on('submit', function(event) {
        event.preventDefault();

        var message = $("#text").val().trim();
        var name = $("#name").val().trim();
        
        var messageObj = {
            'name' : name,
            'message' : message
        }
        var jsonConvert = JSON.stringify(messageObj);
        conn.send(jsonConvert)

        $('#text').val('');
    });
    // -------------------MESSAGE FORM-------------------------

    //---------------------FUNCTIONS---------------------------
    function getRandomColor() {
        var letters = '0123456789ABCDEF';
        var color = '#';
        for (var i = 0; i < 6; i++) {
            color += letters[Math.floor(Math.random() * 16)];
        }
        return 'color:'+color;
    }
    //---------------------FUNCTIONS---------------------------
</script>