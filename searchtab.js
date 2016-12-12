function changeTab(clicked){
  console.log(clicked);
  if (clicked == "searchBit") {
    document.getElementById('searchSats').style.backgroundColor = "#7c1313";
    document.getElementById(clicked).style.backgroundColor = "#C62828";

    document.getElementsByTagName('form')[0].action = "search_bit.php";
    /*document.getElementById('startContainerBG').style.backgroundImage = "url('search_bg.JPG')";
    document.getElementById('startContainerBG').style.backgroundPositionY = "-100px";*/
  }
  else if (clicked == "searchSats") {
      document.getElementById('searchBit').style.backgroundColor = "#7c1313";
      document.getElementById(clicked).style.backgroundColor = "#C62828";

      document.getElementsByTagName('form')[0].action = "search_sats.php";
      /*document.getElementById('startContainerBG').style.backgroundImage = "url('search_sats.jpg')";
      document.getElementById('startContainerBG').style.backgroundPositionY = "-200px";*/
  }
}
