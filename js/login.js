$(document).ready(function () {
    $("form[name=login-form]").on('submit', function (event) {
        event.preventDefault();
        $.post("ajax/login/user.php", $(this).serialize(), function (response) {
            var responseParsed = JSON.parse(response);
            if (responseParsed.error === 0){
                window.location = "/chat.php";
            }else{
                $("#login-response").removeClass().html(responseParsed.message).addClass('alert alert-danger').show();
                setTimeout(function () {
                    $("#login-response").hide();
                }, 2000)
            }
        })
    });
});