var isEnglish = JSON.parse(localStorage.getItem("isEnglish"))

document.addEventListener("DOMContentLoaded",
    function(){
        if(!isEnglish){
            document.querySelector("#c_navbar").style.visibility = 'visible';
            document.querySelector("#e_navbar").style.display = 'none';
            document.querySelector("#c_navbar").style.display = 'block';
            document.querySelector("#chinese").style.color = "#7e7e7e";
            document.querySelector("#english").style.color = "white";
        }else{
            document.querySelector("#c_navbar").style.display = 'none';
            document.querySelector("#e_navbar").style.display = 'block';
            document.querySelector("#english").style.color = "#7e7e7e";
            document.querySelector("#chinese").style.color = "white";
        }
        document.querySelector("#chinese").addEventListener("click", function(){
            document.querySelector("#c_navbar").style.visibility = 'visible';
            document.querySelector("#e_navbar").style.display = 'none';
            document.querySelector("#c_navbar").style.display = 'block';
            document.querySelector("#chinese").style.color = "#7e7e7e";
            document.querySelector("#english").style.color = "white";
            var isEnglish = false;
            localStorage.setItem("isEnglish", isEnglish);
        })
        document.querySelector("#english").addEventListener("click", function(){
            document.querySelector("#c_navbar").style.display = 'none';
            document.querySelector("#e_navbar").style.display = 'block';
            document.querySelector("#english").style.color = "#7e7e7e";
            document.querySelector("#chinese").style.color = "white";
            var isEnglish = true;
            localStorage.setItem("isEnglish", isEnglish);
        })
    }
);
