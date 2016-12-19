//simulates warningButton to work like type=submit, as the enterKey toggles warning message.
function enterKeyPress(event) {
  timerValidator = false;
  var enterKey = 13; //13 is the standard keyCode for the Enter button
  if(event.keyCode == enterKey || event.which == enterKey) {
    warningButtonClick();
  }
}
//if the warningButton is pressed, checks if the warning message should be displayed.
function warningButtonClick() {
  timerValidator = false;
  var keyword = document.getElementById("keyword");
  if(keyword.value.length >= 3) { //displays even if nothing is entered yet.
    displayWarning("none");
  }
  else {
    displayWarning("block");
  }
}
//runs toggleSearchButton and toggleWarningButton
function toggleButtons() {
  var keyword = document.getElementById("keyword");
  var searchButton = document.getElementById("searchButton");
  var warningButton = document.getElementById("warningButton");
  toggleSearchButton(keyword, searchButton);
  toggleWarningButton(keyword, warningButton);
}
//Toggles the searchButton, either clickable/submitable or not. Runs once onload.
function toggleSearchButton(keyword, searchButton) {
  if(keyword.value.length >= 3) {
    searchButton.disabled = false;
    timerValidator = false; //warning message skips timed event if string's length >= 3 is entered.
  }
  else {
    searchButton.disabled = true;
  }
}
//Toggles warningButton, either display it or not.
function toggleWarningButton(keyword, warningButton) {
  var fadeTime = 200;
  var warningDelay = 150;
  if(keyword.value.length >= 3) {
    if(warningButton.style.opacity == "1") {
      animation("fadeOut "+fadeTime+"ms", warningButton);
      setTimeout(warningButtonDisable, warningDelay); //lets the fadeOut animation finish before disable.
    }
  }
  else {
    animation("fadeIn "+fadeTime+"ms", warningButton);
    warningButton.style.display = "";
    warningButton.style.opacity = "1";
  }
}
//sets display to "none", so that the button underneath can be pressed.
function warningButtonDisable() {
  document.getElementById("warningButton").style.display = "none";
}
