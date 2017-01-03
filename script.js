//sets autofocus when certain URL's 
function focusOnPathname(){
  //if(location.pathname == "index.php")
  if(location.pathname == "search_menu.html"){
    console.log("focuuuus");
    //set autofocus for searchbar
    document.getElementById("keyword").focus();
  }

}

//resets the user at the index page
function reloadPage(){
  window.location = "index.php";
}
//loads the about page
function loadAbout(){
  window.location = "about.php";
}

//takes care of animations for different browser variations
function animation(animationType, directory){
  directory.style.webkitAnimation = animationType;
  directory.style.MozAnimation = animationType;
  directory.style.msAnimation = animationType;
  directory.style.OAnimation = animationType;
  directory.style.animation = animationType;
}
