document.addEventListener("DOMContentLoaded",
    function(){
        document.querySelector("#yes button").addEventListener("click", function(){
            document.querySelector("#status").value = 1;
        })
        document.querySelector("#no button").addEventListener("click", function(){
            document.querySelector("#status").value = 2;
        })

    }
);
