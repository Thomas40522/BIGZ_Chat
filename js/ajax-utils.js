(function (global) {

var ajaxUtils = {};

function getRequestObject(){
    if(window.XMLHttpRequest){
        return (new XMLHttpRequest());
    }else{
        global.alert("ajax not available");
        return(null)
    }
}

ajaxUtils.sendPostRequest = 
    function(requestUrl, responseHandler){
        var request = getRequestObject();
        request.onreadystatechange = 
            function(){
                handleResponse(request, responseHandler);
            };
        request.open("POST", requestUrl, true);
        request.send();
    };

function handleResponse(request, responseHandler){
    if((request.readyState == 4)&&(request.status==200)){
        responseHandler(request);
    }
}

global.$ajaxUtils = ajaxUtils

})(window);