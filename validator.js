//runs the script so that it updates without requiring reload, (aka AJAX?)

function runFunction() {
  setTimeout(startInterval, 3000);
}
function startInterval() {
  setInterval(checkLength, 1000);
}

//checks length of string entered in searchbar.
function checkLength() {
  var keyword = document.getElementById("keyword");
  if(keyword.value.length >= 3 || keyword.value.length == 0){
    display("block");
  }
  else { //if (keyword.value.length != 0)
    display("none");
  }
}
//reveals error message if entered string is too short.
function display(visual) {
  var alert = document.getElementsByClassName("alertWarning")[0];
  if (visual == "block") {
    console.log("length >= 3 || length == 0");
    if(alert.style.opacity == "1") { //Error message showing? if no, don't fadeOut.
      var fadeOutTrig = "fadeOut 0.5s";
      //takes care of animation for different browser variations
      alert.style.webkitAnimation = fadeOutTrig;
      alert.style.MozAnimation = fadeOutTrig;
      alert.style.msAnimation = fadeOutTrig;
      alert.style.OAnimation = fadeOutTrig;
      alert.style.animation = fadeOutTrig;

      alert.style.opacity = "0"; //keeps error message OFF
    }
  }
  else if (visual == "none") {
    console.log("0 < length < 3");
    var fadeInTrig = "fadeIn 0.5s";
    //takes care of animation for different browser variations
    alert.style.webkitAnimation = fadeInTrig;
    alert.style.MozAnimation = fadeInTrig;
    alert.style.msAnimation = fadeInTrig;
    alert.style.OAnimation = fadeInTrig;
    alert.style.animation = fadeInTrig;

    alert.style.opacity = "1"; //keeps error message ON
  }
}

/*-------------------------OLD VERSION-------------------------*/

/*
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
*/
