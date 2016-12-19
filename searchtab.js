//
function tabColor() {
  //var lastClicked = "";
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
    var searchSats = document.getElementById('searchSats');
    var searchBit = document.getElementById('searchBit');
    var aboutTab = document.getElementById('aboutTab');
    var keyword = document.getElementById("keyword");
    var formTag = document.getElementsByTagName('form')[0];
    keyword.focus();
  if (type == "bit") {
    searchSats.style.backgroundColor = "#1A237E";
    searchBit.style.backgroundColor = "#3F51B5"; //gives this tab lighter color

    keyword.placeholder = "Search for Parts";
    formTag.action = "choose_part.php";
  }
  else if (type == "sats") {
    searchSats.style.backgroundColor = "#3F51B5"; //gives this tab lighter color
    searchBit.style.backgroundColor = "#1A237E";

    keyword.placeholder = "Search for Sets";
    formTag.action = "choose_set.php";
  }
}
