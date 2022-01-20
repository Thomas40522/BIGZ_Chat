var current_user = JSON.parse(localStorage.getItem("current_user"))

document.addEventListener("DOMContentLoaded",
    function(){
        document.querySelector("#username").textContent = current_user.nickname;
    }
);