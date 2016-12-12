function changeTab(clicked){
  console.log(clicked);
  if (clicked == "searchBit") {
    document.getElementById('searchSats').style.backgroundColor = "#1A237E";
    document.getElementById(clicked).style.backgroundColor = "#3F51B5";

    document.getElementsByTagName('form')[0].action = "search_bit.php";
    /*document.getElementById('startContainerBG').style.backgroundImage = "url('search_bg.JPG')";
    document.getElementById('startContainerBG').style.backgroundPositionY = "-100px";*/
  }
  else if (clicked == "searchSats") {
      document.getElementById('searchBit').style.backgroundColor = "#1A237E";
      document.getElementById(clicked).style.backgroundColor = "#3F51B5";

      document.getElementsByTagName('form')[0].action = "search_sats.php";
      /*document.getElementById('startContainerBG').style.backgroundImage = "url('search_sats.jpg')";
      document.getElementById('startContainerBG').style.backgroundPositionY = "-200px";*/
  }
}
