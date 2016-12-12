function changeTab(clicked){
  console.log(clicked);
  if (clicked == "searchSelected") {
    document.getElementById('searchUnselected').style.backgroundColor = "#216A9C";
    document.getElementById(clicked).style.backgroundColor = "rgba(1,1,1, 0)";

    document.getElementById('searchBarContainerBG').style.backgroundImage = "url('search_bg.JPG')";
    document.getElementById('searchBarContainerBG').style.backgroundPositionY = "-100px";
  }
  else if (clicked == "searchUnselected") {
      document.getElementById('searchSelected').style.backgroundColor = "#216A9C";
      document.getElementById(clicked).style.backgroundColor = "rgba(1,1,1, 0)";

      document.getElementById('searchBarContainerBG').style.backgroundImage = "url('search_sats.jpg')";
      document.getElementById('searchBarContainerBG').style.backgroundPositionY = "-200px";
  }
}

