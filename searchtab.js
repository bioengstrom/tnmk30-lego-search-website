function changeTab(clicked){
  console.log(clicked);
  if (clicked == "searchBit") {
    document.getElementById('searchSats').style.backgroundColor = "#3949AB";
    document.getElementById(clicked).style.backgroundColor = "#5C6BC0";

    /*document.getElementById('startContainerBG').style.backgroundImage = "url('search_bg.JPG')";
    document.getElementById('startContainerBG').style.backgroundPositionY = "-100px";*/
  }
  else if (clicked == "searchSats") {
      document.getElementById('searchBit').style.backgroundColor = "#3949AB";
      document.getElementById(clicked).style.backgroundColor = "#5C6BC0";

      /*document.getElementById('startContainerBG').style.backgroundImage = "url('search_sats.jpg')";
      document.getElementById('startContainerBG').style.backgroundPositionY = "-200px";*/
  }
}

