var current_user = JSON.parse(localStorage.getItem("current_user"))
// var current_user = {
//     username: ""
// }

document.addEventListener("DOMContentLoaded",
    function(){
        if(current_user!=null && current_user.username!=""){
            document.querySelector("#username").textContent = current_user.username;
            document.querySelector("user").addEventListener("click", function(){
                window.location.href = "user_setting.html";
            })
        }else{
            document.querySelector("#username").textContent = "User Name";
            document.querySelector("user").addEventListener("click", function(){
                window.location.href = "user_sign.html";
            })
        }

    }
);