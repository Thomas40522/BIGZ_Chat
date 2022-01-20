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
    }else if(document.querySelector("#name").value.length > 15){
        alert("username must be under 15 characters")
    }else{
        document.querySelector("#isValidated").value = 1;
    }
};
