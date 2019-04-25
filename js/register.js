window.onload = function(){
    var form = document.querySelector("form[name='register-form']");

    form.addEventListener('submit', function(event){
        event.preventDefault();

        var username = document.getElementById("username-register").value;
        var password = document.getElementById("password-register").value;
        var dataObj = {
            'username' : username,
            'password' : password
        }

        var json = JSON.stringify(dataObj);

        var xhr = new XMLHttpRequest;
        xhr.onreadystatechange = function(){

        }
        xhr.open("POST","../ajax/register/register-user.php")
        xhr.send(json)
    });
};