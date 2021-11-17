var current_user = JSON.parse(localStorage.getItem("current_user"))

document.addEventListener("DOMContentLoaded",
    function(){
        document.querySelector("#username").textContent = current_user.username;
        document.querySelector("user").addEventListener("click", function(){
            window.location.href = "user_setting.html";
        })
        document.querySelector(".form button").addEventListener("click", function(){
            if(document.querySelector("#password").value != document.querySelector("#confirm_password").value){
                alert("password must be same as the confirm password");
            }else if(document.querySelector("#password").value ==""){
                alert("password can not be empty")
            }else if(document.querySelector("#original_password").value != current_user.password){
                alert("please enter the correct original password")
            }else{
                current_user.password = document.querySelector("#password").value;
                localStorage.setItem("current_user", JSON.stringify(current_user));
                window.location.href = "user_setting.html";
            }

        });
    }
);