var current_user = JSON.parse(localStorage.getItem("current_user"))


document.addEventListener("DOMContentLoaded",
    function(){
        if(current_user!=null && current_user.username!=""){
            document.querySelector("#username").textContent = current_user.nickname;
            document.querySelector("user").addEventListener("click", function(){
                window.location.href = "user_setting.php";
            })
        }else{
            document.querySelector("#username").textContent = "User Name";
            document.querySelector("user").addEventListener("click", function(){
                window.location.href = "user_sign.php";
            })
        }
        document.querySelector(".post").addEventListener("click", function(){
            window.location.href = "posting.php";
        })

    }
);