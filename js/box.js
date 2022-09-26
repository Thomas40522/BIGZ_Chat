var isEnglish = JSON.parse(localStorage.getItem("isEnglish"))

document.addEventListener("DOMContentLoaded",
    function(){
        i = 0;
        document.querySelector("#submit").addEventListener("click", function(){
            if(document.querySelector("#input").value == ""){
                document.querySelector("#status").value = 1;
            }
        })
        if(!isEnglish){
            document.querySelector("#box_main").textContent = "意见箱";
            document.querySelector("#update").textContent = "更新";
            document.querySelector("#submit").value = "发送意见";
            document.querySelector("#retype").value = "重新填写";
            document.querySelector("#input").placeholder = "欢迎在这里输入您的意见。您可以将任何对于网站的漏洞，改进建议，以及对于学校校规和生活设施的各种提议发送给我们，我们会尽快给您一个答复...";
        }else{
            document.querySelector("#box_main").textContent = "Suggestion Box";
            document.querySelector("#update").textContent = "Updates";
            document.querySelector("#submit").value = "Submit";
            document.querySelector("#retype").value = "Retype";
            document.querySelector("#input").placeholder = "You are welcome to enter your suggestions here. You can report any bug on the website, suggestions for improvement, and various grievances for school rules and living facilities. We will reply to your message as soon as possible...";
        }
        document.querySelector("#chinese").addEventListener("click", function(){
            document.querySelector("#box_main").textContent = "意见箱";
            document.querySelector("#update").textContent = "更新";
            document.querySelector("#submit").value = "发送意见";
            document.querySelector("#retype").value = "重新填写";
            document.querySelector("#input").placeholder = "欢迎在这里输入您的意见。您可以将任何对于网站的漏洞，改进建议，以及对于学校校规和生活设施的各种提议发送给我们，我们会尽快给您一个答复...";
        })
        document.querySelector("#english").addEventListener("click", function(){
            document.querySelector("#box_main").textContent = "Suggestion Box";
            document.querySelector("#update").textContent = "Updates";
            document.querySelector("#submit").value = "Submit";
            document.querySelector("#retype").value = "Retype";
            document.querySelector("#input").placeholder = "You are welcome to enter your suggestions here. You can report any bug on the website, suggestions for improvement, and various grievances for school rules and living facilities. We will reply to your message as soon as possible...";
        })
        document.querySelector("#submit").addEventListener("click", function(){
            if(document.querySelector("#input").value != "" ){
                i = i + 1;
            }
            if(i == 2){
                document.querySelector("#submit").disabled = true;
            }
        })
    }
);