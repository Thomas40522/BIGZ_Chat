
function display(){
    input = document.querySelector("#something input").value;
    document.querySelector("#two").textContent = input;
}


document.querySelector("button").addEventListener("click", display);
