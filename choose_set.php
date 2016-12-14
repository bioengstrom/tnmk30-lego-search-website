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

		print("<p id ='amountParts'>These sets contain the keyword: ".$keyword."</p>
				<div id='allParts'>");

		while($row = mysqli_fetch_array($result) AND $keyword != NULL){

			print ("<div class='legoPart'>");

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

			echo "<div class='imgContainer'><img src='".$filename."'></div>";

			echo "<div class='infoText'><p><a href='search_sats.php?SetID=".$SetID."'>
			".$Setname."</a></p><p>ID-number: ".$SetID."</p></div>";
			print ("</div>");
		}
		
		print ("</div>");
		mysqli_close($connection);
    ?>

  </div>
  </body>
</html>
