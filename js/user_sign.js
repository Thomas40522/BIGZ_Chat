document.addEventListener("DOMContentLoaded",
    function(){
        document.querySelector("button").addEventListener("click",signup);
        document.querySelector("#name").addEventListener("change", function(){
            if(!document.querySelector("#name").value.match(/^[A-Za-z0-9_.]+$/)){
                document.querySelector("#changeNameColor").style.display = "inline";
                document.querySelector("#changeNameColor").style.color = "red";
                document.querySelector("#changeNameColor").textContent = "NOT Satisfied";
            }else{
                document.querySelector("#changeNameColor").style.display = "inline";
                document.querySelector("#changeNameColor").style.color = "green";
                document.querySelector("#changeNameColor").textContent = "Satisfied";
            }
        })
        document.querySelector("#email").addEventListener("change", function(){
            if(!document.querySelector("#email").value.includes("@basisinternational")){
                document.querySelector("#changeEmailColor").style.display = "inline";
                document.querySelector("#changeEmailColor").style.color = "red";
                document.querySelector("#changeEmailColor").textContent = "NOT Satisfied";
            }else{
                document.querySelector("#changeEmailColor").style.display = "inline";
                document.querySelector("#changeEmailColor").style.color = "green";
                document.querySelector("#changeEmailColor").textContent = "Satisfied";
            }
        })
        document.querySelector("#password").addEventListener("change", function(){
            if(!document.querySelector("#password").value.match(/^[A-Za-z0-9_.]+$/)){
                document.querySelector("#changePasswordColor").style.display = "inline";
                document.querySelector("#changePasswordColor").style.color = "red";
                document.querySelector("#changePasswordColor").textContent = "NOT Satisfied";
            }else{
                document.querySelector("#changePasswordColor").style.display = "inline";
                document.querySelector("#changePasswordColor").style.color = "green";
                document.querySelector("#changePasswordColor").textContent = "Satisfied";
            }
        })
        document.querySelector("#password").addEventListener("change", confirm_change);
        document.querySelector("#confirm_password").addEventListener("change", confirm_change);
    });


function confirm_change(){
    if(document.querySelector("#confirm_password").value != null){
        if(document.querySelector("#password").value != document.querySelector("#confirm_password").value){
            document.querySelector("#changeConPasswordColor").style.display = "inline";
            document.querySelector("#changeConPasswordColor").style.color = "red";
            document.querySelector("#changeConPasswordColor").textContent = "NOT Satisfied";
        }else{
            document.querySelector("#changeConPasswordColor").style.display = "inline";
            document.querySelector("#changeConPasswordColor").style.color = "green";
            document.querySelector("#changeConPasswordColor").textContent = "Satisfied";
        }
    }
}

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
