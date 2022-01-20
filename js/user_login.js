var current_user = JSON.parse(localStorage.getItem("current_user"))

document.addEventListener("DOMContentLoaded",
    function(){
        document.querySelector("button").addEventListener("click", login)
    }
);

function login(){
    if(document.querySelector("#logname").value == current_user.username && document.querySelector("#logpassword").value == current_user.password){
        window.location.href = "titlepage.php";
    }else{
        alert("username does not exist or password is incorrect")
    }
}