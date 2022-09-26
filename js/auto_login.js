var current_user = JSON.parse(localStorage.getItem("current_user"))

document.addEventListener("DOMContentLoaded",
    function(){
        if(document.querySelector("#isLogin").value == false && current_user !== null){
            console.log(current_user.password);
            document.querySelector("#logname").value = current_user.username;
            document.querySelector("#logpassword").value = current_user.password;
            document.querySelector("button").click();
        }
    }
);