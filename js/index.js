var isEnglish = JSON.parse(localStorage.getItem("isEnglish"))

document.addEventListener("DOMContentLoaded",
    function(){
        if(!isEnglish){
            document.querySelector("#e_info").style.display = 'none';
            document.querySelector("#c_info").style.display = 'block';
        }else{
            document.querySelector("#c_info").style.display = 'none';
            document.querySelector("#e_info").style.display = 'block';
        }
        document.querySelector("#chinese").addEventListener("click", function(){
            document.querySelector("#e_info").style.display = 'none';
            document.querySelector("#c_info").style.display = 'block';
        })
        document.querySelector("#english").addEventListener("click", function(){
            document.querySelector("#c_info").style.display = 'none';
            document.querySelector("#e_info").style.display = 'block';
        })
    }
);
