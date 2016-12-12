function runFunction() {
  setTimeout(startInterval, 2000);
}
function startInterval() {
  setInterval(checkLength, 50);
}
function checkLength() {
    var keyword = document.getElementById("keyword");
    if(keyword.value.length >= 3 || keyword.value.length == 0){
        var interval = setInterval(display("block"), 1);
    }
    else if (keyword.value.length != 0){
        var interval = setInterval(display("none"), 1);
    }
}
var opacity = 0;
function display(visual) {
  var alert = document.getElementsByClassName("alertWarning")[0];
  if (visual == "block") {
    console.log("waddup");
    if (opacity >= 0) {
        opacity -= 0.15;
    } else {
        clearInterval(interval);
    }

    alert.style.opacity = opacity + "";
  }
  else if (visual == "none") {
    console.log("boi");
    if (opacity <= 1) {
        opacity += 0.15;
    } else {
        clearInterval(interval);
    }


    alert.style.display = "block";
    alert.style.opacity = opacity +"";
  }
}
 /*FIX THIS BULLSHIT ASS CODE!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!*/
