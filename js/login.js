$(document).ready(function(){
    $("form[name='login-form']").on('submit', function(event){
        event.preventDefault();
        
        $.post('../ajax/login/verify-login.php', $(this).serialize(), function(response){
            var data = JSON.parse(response);
            if(data.error == 0){
                window.location.replace('../../chat.php')
            }else{
                $("#response").html(data.message);
            }
        })
    })
});