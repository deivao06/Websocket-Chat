$(document).ready(function(){
    $("form[name='register-form']").on('submit', function(event){
        event.preventDefault();
        $.post('../ajax/register/register-user.php',$(this).serialize(), function(response){
            var decode = JSON.parse(response)
            $("#response").html(decode.message)
        })
    })
});