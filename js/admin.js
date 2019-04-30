$(document).ready(function(){
    $("form[name='alter-form']").on('submit', function(event){
        event.preventDefault();

        $.post('../ajax/alter/alter-user.php', $(this).serialize(), function(response){
            var data = JSON.parse(response);

            $("#response").html(data.message);
        })
    })
});