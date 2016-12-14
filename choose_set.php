<?php include("startsida.php"); ?>

  <div id="itemContainer">

    <?php
		$connection = mysqli_connect("mysql.itn.liu.se", "lego", "", "lego");

		if (!$connection) {
			die('MySQL connection error');
		}

		$keyword = mysqli_real_escape_string($connection, $_POST["keyword"]);

		$result = mysqli_query($connection, "SELECT Setname, SetID FROM sets WHERE (sets.SetID LIKE '%$keyword%' OR sets.Setname LIKE '%$keyword%')
								ORDER BY Setname");

		$link = "http://weber.itn.liu.se/~stegu76/img.bricklink.com";
    echo "<p id ='amountParts'><span>These sets contain the keyword: </span>".$keyword."</p>";
    echo "<div id='allParts'>";

		while($row = mysqli_fetch_array($result) AND $keyword != NULL){

			$SetID = $row['SetID'];
			$Setname = $row['Setname'];

			$imagesearch = mysqli_query($connection, "SELECT * FROM images WHERE ItemTypeID='S' AND ItemID='$SetID'");

			$imageinfo = mysqli_fetch_array($imagesearch);

			if($imageinfo['has_jpg']) { // Use JPG if it exists
				$filename = "$link/S/$SetID.jpg";
			} else if($imageinfo['has_gif']) { // Use GIF if JPG is unavailable
				$filename = "$link/S/$SetID.gif";
			} else { // If neither format is available, insert a placeholder image
				 $filename = "error.png";
			}

      /*BEGIN PRINTING OUTPUT*/
      /* output for one one set*/
      echo "<a class='legoSet' href='search_sats.php?SetID=".$SetID."'>";
      echo "<div>";
			echo "<img src='".$filename."'>";
			echo "<span>
              <p class='legoSetTitle'>".$Setname."</p>
              <p class='legoSetId'>id: ".$SetID."</p>
            </span>";
      echo "</div>";

			//echo "</div>"; //close allParts div
		}

		print ("</div>"); // close itemContainer div
		mysqli_close($connection);
    ?>

    <!---<div id="itemContainer">
      <a href="#" class='legoSet'>
        <div>
          <img src="http://placehold.it/100x150">
          <span>
            <p class="legoSetTitle">Aqua thingy much wow</p>
            <p class="legoSetId"><span>id: </span>134134</p>
          </span>

        </div>
      </a>
      <a href="#" class='legoSet'>
        <div>
          <img src="http://placehold.it/100x150">
          <p class="legoSetTitle">Aqua thingy much wow</p>
          <p class="legoSetId"><span>id: </span>134134</p>
        </div>
      </a>
    </div>
  </div> -->
  </body>
</html>
