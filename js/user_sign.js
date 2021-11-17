var current_user = {
    username:"",
    password:"",
    email:"",
    grade:"",
    gender:""
};

document.addEventListener("DOMContentLoaded",
    function(){
        document.querySelector("button").addEventListener("click",signup);
    }
);


function signup(){
    if(document.querySelector("#password").value != document.querySelector("#confirm_password").value){
        alert("password must be same as the confirm password");
    }else if(document.querySelector("#name").value == "" ||
             document.querySelector("#password").value == "" || 
             document.querySelector("#email").value == ""
    ){
        alert("required field must be filled");
    }else if(document.querySelector("#name").value.length > 10){
        alert("username must be under 10 characters")
    }else{
        current_user.username = document.querySelector("#name").value;
        current_user.password = document.querySelector("#password").value;
        current_user.email = document.querySelector("#email").value;
        current_user.grade = document.querySelector("#grade").value;
        current_user.gender = document.querySelector("#gender").value;
        postElement(current_user, "http://ptsv2.com/t/z36na-1637150376/post")
        localStorage.setItem("current_user", JSON.stringify(current_user));
        window.location.href = "user_login.html";
    }
};

function postElement(current_user, url){
    console.log("1")
    var post = new XMLHttpRequest();
    post.open("PUT", url, true);
    post.setRequestHeader('Content-Type', 'application/json');
    post.send(JSON.stringify({
        value: current_user
    }));
}