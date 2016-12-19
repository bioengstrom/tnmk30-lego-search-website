//adds timed event, therefor, warning message doesn't display directly
var timerValidator = true;
function runFunction() {
  if(timerValidator == true) {
    setTimeout(checkLength, 5000);
  }
  else if(timerValidator == false) {
    checkLength();
  }
}
//checks length of string entered in searchbar.
function checkLength() {
  timerValidator = false;
  var keyword = document.getElementById("keyword");
  if(keyword.value.length >= 3 || keyword.value.length == 0) {
    displayWarning("none");
  }
  else {
    displayWarning("block");
  }
}
//reveals warning message if entered string is too short.
function displayWarning(visual) {
  var alert = document.getElementsByClassName("alertWarning")[0];
  var fadeTime = 200;
  if (visual == "none") {
    console.log("No error message");
    if(alert.style.opacity == "1") { //Error message showing? if no, don't fadeOut.
      animation("fadeOut "+fadeTime+"ms", alert);
      alert.style.opacity = "0"; //keeps error message OFF
    }
  }
  else if (visual == "block") {
    console.log("Display error message");
    animation("fadeIn "+fadeTime+"ms", alert);
    alert.style.opacity = "1"; //keeps error message ON
  }
}
