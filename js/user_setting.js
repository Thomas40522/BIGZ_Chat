var current_user = JSON.parse(localStorage.getItem("current_user"))

document.addEventListener("DOMContentLoaded",
    function(){
        document.querySelector("#username").textContent = current_user.nickname;
        document.querySelector("#nickname").textContent = current_user.nickname;
        document.querySelector("#myName").textContent = current_user.username;
        document.querySelector("#myEmail").textContent = current_user.email;
        document.querySelector("#myGrade").textContent = current_user.grade;
        document.querySelector("#myGender").textContent = current_user.gender;
        document.querySelector("#bio").textContent = current_user.bio;
        document.querySelector(".form button").addEventListener("click", changeSetting)
        document.querySelector("#change_password button").addEventListener("click", changePassword)
        document.querySelector("#logout button").addEventListener("click", logout)

    }
);

function changeSetting(nickname, email, grade, gender, bio){
    if(nickname.length > 10){
        alert("nick name must be under 10 characters")
        document.querySelector("#status").value = 3;
    }else{
        current_user.nickname = nickname;
        current_user.email = email;
        current_user.gender = gender;
        current_user.grade = grade;
        current_user.bio = bio;
    }
    localStorage.setItem("current_user", JSON.stringify(current_user));
    // window.location.href = "user_setting.php"
}

function logout(){
    localStorage.removeItem("current_user");
    document.querySelector("#status").value = 1;
}

function changePassword(){
    document.querySelector("#status").value = 2;
}