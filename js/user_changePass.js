var current_user = JSON.parse(localStorage.getItem("current_user"))

function changePassword(newPassword){
    current_user.password = newPassword;
    localStorage.setItem("current_user", JSON.stringify(current_user));
    window.location.href = "user_setting.php";
}