
var timerValidator = true;

function runFunction() {
  if(timerValidator == true) {
    setTimeout(checkLength, 5000);
  }
  else if(timerValidator == false) {
    checkLength();
  }
}


//runs the script so that it updates without requiring reload.
//checks length of string entered in searchbar.
function checkLength() {
  var keyword = document.getElementById("keyword");
  if(keyword.value.length >= 3 || keyword.value.length == 0) {
    displayWarning("none");
  }
  else {
    displayWarning("block");
  }
  timerValidator = false;
}

//decides if the warning message should be displayed when the button is pressed.
function warningOnClick() {
  console.log("invisButton")
  if(keyword.value.length >= 3){
    displayWarning("none");
  }
  else {
    displayWarning("block");
  }
  timerValidator = false; //warning message skips timed event if the button is pressed.
}
//Toggles the searchButton, either clickable or not. Runs once onload.
function toggleButtonOnOff() {
  var keyword = document.getElementById("keyword");
  var searchButton = document.getElementById("searchButton");
  var warningButton = document.getElementById("warningButton");
  if(keyword.value.length >= 3){
    searchButton.disabled = false;
    warningButton.style.display = "none";
    timerValidator = false; //warning message skips timed event if string's length >= 3 is entered.
  }
  else {
    searchButton.disabled = true;
    warningButton.style.display = "";
  }
}

//reveals warning message if entered string is too short.
function displayWarning(visual) {
  var alert = document.getElementsByClassName("alertWarning")[0];
  if (visual == "none") {
    console.log("No error message");
    if(alert.style.opacity == "1") { //Error message showing? if yes, fadeOut.
      animation("fadeOut 0.5s", alert);
      alert.style.opacity = "0"; //keeps error message OFF
    }
  }
  else if (visual == "block") {
    console.log("Display error message");
    animation("fadeIn 0.5s", alert);
    alert.style.opacity = "1"; //keeps error message ON
  }
}

function animation(animationType, alert) {
  alert.style.webkitAnimation = animationType;
  alert.style.MozAnimation = animationType;
  alert.style.msAnimation = animationType;
  alert.style.OAnimation = animationType;
  alert.style.animation = animationType;
}
