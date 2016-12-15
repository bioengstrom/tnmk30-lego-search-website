<?php include("startsida.php"); ?>

  <div id="itemContainer">

    <?php
		$connection = mysqli_connect("mysql.itn.liu.se", "lego", "", "lego");

		if (!$connection) { //If unable to connect display error message
			die('MySQL connection error');
		}
		$keyword = mysqli_real_escape_string($connection, $_POST["keyword"]); //The users search-word

		$link = "http://weber.itn.liu.se/~stegu76/img.bricklink.com"; //Link to all images

		if (isset($_POST['oldKeyword'])){
			$keyword = $_POST['oldKeyword'];
		}

		echo "<p id ='amountParts'><span>These sets contain the keyword: </span>".$keyword."</p>";
		echo "<div id='allParts'>";

		echo "<form name='sortForm' method='POST'>
			 <select name='sortForm'>
			 <option value='Setname'>-- Choose an option --</option>
			 <option value='Setname'>Name</option>
			 <option value='SetID'>ID-number</option>
			 </select>
			 <input type='hidden' name='oldKeyword' value='".$keyword."'/>
			 <input type = 'submit' value = 'Sort' />
			 </form>";

		$sort = "Setname";

		if (isset($_POST['sortForm'])){
			$sort = $_POST['sortForm'];
		}

		$result = mysqli_query($connection, "SELECT Setname, SetID FROM sets WHERE (sets.SetID LIKE '%$keyword%' OR sets.Setname
								LIKE '%$keyword%') ORDER BY $sort"); //Get all sets that contain the keyword

		while($row = mysqli_fetch_array($result) AND $keyword != NULL){ //Display all sets containing the keyword

			$SetID = $row['SetID'];
			$Setname = $row['Setname'];

			$imagesearch = mysqli_query($connection, "SELECT * FROM images WHERE ItemTypeID='S' AND ItemID='$SetID'");

			$imageinfo = mysqli_fetch_array($imagesearch);

			if($imageinfo['has_jpg']) { // Use JPG if it exists
				$filename = "$link/S/$SetID.jpg";
			}
			else if($imageinfo['has_gif']) { // Use GIF if JPG is unavailable
				$filename = "$link/S/$SetID.gif";
			}
			else { // If neither format is available, insert a placeholder image
				$filename = "error.png";
			}

			echo "<a class='legoListItem' href='inventory_set.php?SetID=".$SetID."'>"; //Link to the displayed set
			echo "<div>";
			echo "<img src='".$filename."'>";
			echo "<span>
              <p class='legoListItemTitle'>".$Setname."</p>
              <p class='legoListItemId'><span>id: </span>".$SetID."</p>
            </span>";
			echo "</div>";
			echo "</a>";
		}

		echo "</div>"; //close allParts div
		echo "</div>"; // close itemContainer div
		mysqli_close($connection);
    ?>

  </body>
</html>
