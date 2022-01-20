var current_user = JSON.parse(localStorage.getItem("current_user"))

document.addEventListener("DOMContentLoaded",
    function(){
        document.querySelector("#username").textContent = current_user.username;
        document.querySelector("#myName").textContent = current_user.username;
        document.querySelector("#myEmail").textContent = current_user.email;
        document.querySelector("#myGrade").textContent = current_user.grade;
        document.querySelector("#myGender").textContent = current_user.gender;
        document.querySelector(".form button").addEventListener("click", changeSetting)
        document.querySelector("#change_password button").addEventListener("click", changePassword)
        document.querySelector("#logout button").addEventListener("click", logout)

    }
);

function changeSetting(){
    if(document.querySelector("#name").value.length > 10){
        alert("username must be under 10 characters")
    }else if(document.querySelector("#name").value != ""){
        current_user.username = document.querySelector("#name").value
    }
    if(document.querySelector("#email").value != ""){
        current_user.email = document.querySelector("#email").value
    }
    if(document.querySelector("#gender").value != ""){
        current_user.gender = document.querySelector("#gender").value
    }
    if(document.querySelector("#grade").value != ""){
        current_user.grade = document.querySelector("#grade").value
    }
    localStorage.setItem("current_user", JSON.stringify(current_user));
    window.location.href = "user_setting.php"
}

function logout(){
    localStorage.removeItem("current_user");
    window.location.href = "user_login.php";
}

function changePassword(){
    window.location.href = "user_changePass.php";
}