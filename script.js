//resets the user at the index page
function reloadPage() {
  window.location = "index.php";
}
//loads the about page
function loadAbout() {
  window.location = "about.php";
}

//takes care of animations for different browser variations
function animation(animationType, directory) {
  directory.style.webkitAnimation = animationType;
  directory.style.MozAnimation = animationType;
  directory.style.msAnimation = animationType;
  directory.style.OAnimation = animationType;
  directory.style.animation = animationType;
}
