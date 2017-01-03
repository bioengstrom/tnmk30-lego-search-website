//change tabColor depending on session var, if not set default selected tab is Part
function tabColor() {
  var lastClicked = sessionStorage.getItem("lastClicked"); //fetch session var
  if (lastClicked == "bit") {
    focus("bit");
  }
  else if (lastClicked == "sats") {
    focus ("sats");
  } else {
    focus("bit");
  }
}
//change tabcolor denpending on clicked item
function changeTab(clicked){
  keyword.focus(); //set autofocus for searchbar

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
//help function for changing all necessary vars both visually and logically
function focus(type) {
  //fetch vars
  var searchSats = document.getElementById('searchSats');
  var searchBit = document.getElementById('searchBit');
  var aboutTab = document.getElementById('aboutTab');
  var keyword = document.getElementById("keyword");
  var formTag = document.getElementsByTagName('form')[0];

  if (type == "bit") {
    searchSats.style.backgroundColor = "#1A237E";
    searchBit.style.backgroundColor = "#3F51B5"; //gives this tab lighter color

    //change placeholder and form action
    keyword.placeholder = "Search for Parts";
    formTag.action = "choose_part.php";
  }
  else if (type == "sats") {
    searchSats.style.backgroundColor = "#3F51B5"; //gives this tab lighter color
    searchBit.style.backgroundColor = "#1A237E";

    //change placeholder and form action
    keyword.placeholder = "Search for Sets";
    formTag.action = "choose_set.php";
  }
}
