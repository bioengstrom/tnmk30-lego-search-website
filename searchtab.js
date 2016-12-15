
function tabColor() {
  var lastClicked = "";
  var lastClicked = sessionStorage.getItem("lastClicked");
    console.log("mans" + lastClicked);
  if (lastClicked == "bit") {
    focus("bit");
  }
  else if (lastClicked == "sats") {
    focus ("sats");
  } else {
    focus("bit");
  }
}

function changeTab(clicked){
  if (clicked == "searchBit") {
    focus("bit");
    lastClicked = "bit";
    sessionStorage.setItem("lastClicked", lastClicked);
  }
  else if (clicked == "searchSats") {
    focus("sats");
    lastClicked = "sats";
    sessionStorage.setItem("lastClicked", lastClicked);
  }
}

function focus(type) {
  if (type == "bit") {
    document.getElementById('searchSats').style.backgroundColor = "#1A237E";
    document.getElementById('searchBit').style.backgroundColor = "#3F51B5";
//    document.getElementById("keyword").placeholder = "Search for Parts";
    document.getElementsByTagName('form')[0].action = "choose_part.php";
  }
  else if (type == "sats") {
    document.getElementById('searchBit').style.backgroundColor = "#1A237E";
    document.getElementById('searchSats').style.backgroundColor = "#3F51B5";
//    document.getElementById("keyword").placeholder = "Search for Sets";
    document.getElementsByTagName('form')[0].action = "choose_set.php";
  }
}

function reloadPage() {
  window.location = "startsida.php";
}

/* check this link out for fixing 'flicking' on tabs http://stackoverflow.com/questions/19844545/replacing-css-file-on-the-fly-and-apply-the-new-style-to-the-page*/
