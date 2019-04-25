window.onload = function(){
    var $button = document.querySelector("#register-button");

    $button.addEventListener('submit', function(event){
        event.preventDefault();
        var xhr = new XMLHttpRequest;
        var formData = serialize($button);
        console.log(formData);

        xhr.open('POST', '../ajax/register/register-user.php');
        xhr.onreadystatechange = function () {
            if(xhr.readyState != 4 || xhr.status != 200) return;
            
        }
        xhr.send(formData);
    })
}
