document.addEventListener("DOMContentLoaded",
    function(){
        i = 0;
        document.querySelector("#button").addEventListener("click", function(){
            if(document.querySelector("#n_title").value != "" && document.querySelector("#n_content").value != "" ){
                i = i + 1;
            }
            if(i == 2){
                document.querySelector("#button").disabled = true;
            }
        })
    }
);


