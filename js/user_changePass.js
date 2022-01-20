var current_user = JSON.parse(localStorage.getItem("current_user"))

document.addEventListener("DOMContentLoaded",
    function(){
        document.querySelector("#username").textContent = current_user.nickname;
        document.querySelector("user").addEventListener("click", function(){
            window.location.href = "user_setting.php";
        })
    }
);