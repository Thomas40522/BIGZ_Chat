document.addEventListener("DOMContentLoaded",
    function(){
        document.querySelector("select").addEventListener("change", function(){
            if(document.querySelector("select").value == "video"){
                document.querySelector("#image").style.display = 'none';
                document.querySelector("#video").style.display = 'block';
            }else if(document.querySelector("select").value == "image"){
                document.querySelector("#image").style.display = 'block';
                document.querySelector("#video").style.display = 'none';
            }
        })
    }
);
