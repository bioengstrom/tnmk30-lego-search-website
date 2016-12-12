function runFunction() {
  setTimeout(setInterval(checkLength, 1000), 5000);
}

function checkLength() {
    var keyword = document.getElementById("keyword");
    if(keyword.value.length >= 3 || keyword.value.length == 0){
        var interval = setInterval(display("block"), 500);
    }
    else if (keyword.value.length != 0){
        var interval = setInterval(display("none"), 500);
    }
}

function display(visual) {
  var alert = document.getElementsByClassName("alertWarning")[0];
  if (visual == "block") {
    console.log("waddup");
    var opacity = 0;
    opacity += 0.10;
    alert.style.display = "none";
    alert.style.opacity = opacity;
  }
  else if (visual == "none") {
    console.log("boi");
    var opacity = 1;
    opacity -= 0.10;
    alert.style.display = "block";
    alert.style.opacity = "1";
  }
}
 /*FIX THIS BULLSHIT ASS CODE*/
