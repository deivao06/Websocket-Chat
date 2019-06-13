$(document).ready(function () {

    //OPEN ALTER FORM
    $(".alter-user").on('click', function () {
        var userId = $(this).attr('userid');

        $.post("ajax/forms/alter-user.php", {"userId" : userId}, function (response) {
            $("#response").html(response);
        })
    });

    //ALTER USER DATA
    $(document).on('submit','form[name=alter-user]', function (event) {
        event.preventDefault();
        $.post("ajax/alter/user.php", $(this).serialize(), function (response) {
            var responseParsed = JSON.parse(response);
            if(responseParsed.error === 0){
                $("#alter-response").removeClass().html(responseParsed.message).addClass('alert alert-success').show();
                setTimeout(function () {
                    $("#alter-response").hide();
                    $("#response").hide();
                    location.reload();
                }, 1500)
            }else{
                $("#alter-response").removeClass().html(responseParsed.message).addClass('alert alert-danger').show();
                setTimeout(function () {
                    $("#alter-response").hide();
                }, 2000)
            }
        })
    });

    //OPEN DELETE FORM
    $(".delete-user").on('click', function () {
        var userId = $(this).attr('userid');
        $.post("ajax/forms/delete-user.php", {"userId" : userId}, function (response) {
            $("#response").html(response);
        })
    })

    //DELETE USER
    $(document).on('submit', 'form[name=delete-user]', function (event) {
        event.preventDefault();
        $.post('ajax/delete/user.php', $(this).serialize(), function (response) {
            var responseParsed = JSON.parse(response);
            if(responseParsed.error === 0){
                $("#delete-response").removeClass().html(responseParsed.message).addClass('alert alert-success').show();
                setTimeout(function () {
                    $("#delete-response").hide();
                    $("#response").hide();
                    location.reload();
                }, 1500)
            }else{
                $("#delete-response").removeClass().html(responseParsed.message).addClass('alert alert-danger').show();
                setTimeout(function () {
                    $("#delete-response").hide();
                }, 2000)
            }
        })
    })
});