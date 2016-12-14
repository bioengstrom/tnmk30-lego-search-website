//runs the script so that it updates without requiring reload, (aka AJAX?)
//checks length of string entered in searchbar.
function checkLength() {
  var keyword = document.getElementById("keyword");
  if(keyword.value.length >= 3 || keyword.value.length == 0){
    display("none");
  }
  else {
    display("block");
  }
}
//Toggles the searchButton, runs once onLoad.
function toggleButton() {
  var keyword = document.getElementById("keyword");
  var searchButton = document.getElementById("searchButton");
  searchButton.disabled = true;
  if(keyword.value.length >= 3){
    searchButton.disabled = false;
  }
}

//reveals error message if entered string is too short.
function display(visual) {
  var alert = document.getElementsByClassName("alertWarning")[0];
  if (visual == "none") {
    console.log("No error message");
    if(alert.style.opacity == "1") { //Error message showing? if no, don't fadeOut.
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
  //takes care of animation for different browser variations
  alert.style.webkitAnimation = animationType;
  alert.style.MozAnimation = animationType;
  alert.style.msAnimation = animationType;
  alert.style.OAnimation = animationType;
  alert.style.animation = animationType;
}
