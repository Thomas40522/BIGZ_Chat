var current_user = {
    username:"",
    password:""
};

function login(username, password){
    current_user.username = username;
    current_user.password = password;
    localStorage.setItem("current_user", JSON.stringify(current_user));
    window.location.href = "titlepage.php";
};

