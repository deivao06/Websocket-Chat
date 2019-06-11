$(document).ready(function () {
    $("form[name=register-user]").on('submit', function (event) {
        event.preventDefault();
        $.post("ajax/register/user.php",$(this).serialize(), function (response) {
            console.log(response);
            var responseParsed = JSON.parse(response);
            if(responseParsed.error === 0){
                $("#register-response").removeClass().html(responseParsed.message).addClass('alert alert-success').show();
                setTimeout(function () {
                    $("#register-response").hide();
                }, 2000)
            }else{
                $("#register-response").removeClass().html(responseParsed.message).addClass('alert alert-danger').show();
                setTimeout(function () {
                    $("#register-response").hide();
                }, 2000)
            }
        })
    });
});