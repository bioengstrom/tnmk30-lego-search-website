<?php include("startsida.php"); ?>

  <div id="itemContainer">

    <?php
		$connection = mysqli_connect("mysql.itn.liu.se", "lego", "", "lego");

		if (!$connection) { //If unable to connect display error message
			die('MySQL connection error');
		}

		if (empty($_GET['page'])){
			$limit_results = 'LIMIT 0,20';
		}

		$keyword = mysqli_real_escape_string($connection, $_POST["keyword"]);

		$result = mysqli_query($connection, "SELECT DISTINCT parts.Partname, parts.PartID, inventory.ColorID, colors.Colorname FROM parts, inventory, colors
								WHERE (PartID LIKE '%$keyword%' OR Partname LIKE '%$keyword%') AND parts.PartID=inventory.ItemID
								AND inventory.ColorID=colors.ColorID ORDER BY Partname"); //Get all parts that contain the keyword

		$link = "http://weber.itn.liu.se/~stegu76/img.bricklink.com"; //Link to all images

		print("<p id ='amountParts'>These parts contain the keyword: ".$keyword."</p>
				<div id='allParts'>");

		while($row = mysqli_fetch_array($result) AND $keyword != NULL){ //Display all parts containing the keyword

			$PartID = $row['PartID'];
			$Partname = $row['Partname'];
			$ColorID = $row['ColorID'];
			$Colorname= $row['Colorname'];

			$imagesearch = mysqli_query($connection, "SELECT * FROM images WHERE ItemTypeID='P' AND ItemID='$PartID' AND ColorID='$ColorID'");

			$imageinfo = mysqli_fetch_array($imagesearch);

			if($imageinfo['has_jpg']) { // Use JPG if it exists
				$filename = "$link/P/$ColorID/$PartID.jpg";
			}
			else if($imageinfo['has_gif']) { // Use GIF if JPG is unavailable
				$filename = "$link/P/$ColorID/$PartID.gif";
			}
			else { // If neither format is available, insert a placeholder image
				 $filename = "error.png";
			}

      echo "<a class='legoListItem' href='search_bit.php?PartID=".$PartID."&ColorID=".$ColorID."'>"; //Link to the displayed set
			echo "<div>";
			echo "<img src='".$filename."'>";
			echo "<span>
              <p class='legoListItemTitle'>".$Partname."</p>
              <p class='legoListItemId'><span>id: </span>".$PartID."</p>
              <p class='legoListItemColor'><span>color: </span>".$ColorID."</p>
            </span>";
      echo "</div>";
      echo "</a>";
		}
		echo "</div>"; //close allParts div
		echo "</div>"; // close itemContainer div
		mysqli_close($connection);
    ?>

  </div>
  </body>
</html>
