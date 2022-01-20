var current_user = {
    username:"",
    password:"",
    email:"",
    grade:"",
    gender:"",
    bio:"",
    nickname:""
};

function login(username, email, grade, gender, bio, nickname){
    current_user.username = username;
    current_user.email = email;
    current_user.grade = grade;
    current_user.gender = gender;
    current_user.bio = bio;
    current_user.nickname = nickname;
    localStorage.setItem("current_user", JSON.stringify(current_user));
    window.location.href = "titlepage.php";
};

