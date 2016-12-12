function checkLength(){
    var keyword = document.getElementById("keyword");
    if(keyword.value.length >= 3){
        alert("success");
    }
    else{
       alert("fail"); 
    }
}