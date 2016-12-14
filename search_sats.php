<?php include("startsida.php"); ?>

	<div class ="itemContainer">

		<?php
			$connection = mysqli_connect("mysql.itn.liu.se", "lego", "", "lego");

			if (!$connection) { //If unable to connect display error message
				die('MySQL connection error');
			}

			$SetID = $_GET['SetID']; //Get the SetID from the webpage link created by choose_set.php

			$result = mysqli_query($connection, "SELECT parts.Partname, parts.PartID, inventory.ItemID, colors.ColorID,
									colors.Colorname, inventory.Quantity, sets.Setname, sets.SetID FROM sets, inventory,
									colors, parts WHERE sets.SetID='$SetID'
									AND sets.SetID=inventory.SetID AND inventory.ItemID=parts.PartID AND
									inventory.ColorID=colors.ColorID ORDER BY Partname"); //Get wanted information about the set

			$link = "http://weber.itn.liu.se/~stegu76/img.bricklink.com"; //Link to all images

			$setsearch = mysqli_query($connection, "SELECT SetID, Setname FROM sets WHERE SetID='$SetID'"); //Get information about the set

			while($setinfo = mysqli_fetch_array($setsearch)) {

				$imagesearch = mysqli_query($connection, "SELECT * FROM images WHERE ItemID='$SetID' AND ItemTypeID = 'S'");
			
				$imageinfo = mysqli_fetch_array($imagesearch);

				if($imageinfo['has_largejpg']) { // Use JPG if it exists
					$filename = "$link/SL/$SetID.jpg";
				} 
				else if($imageinfo['has_largegif']) { // Use GIF if JPG is unavailable
					$filename = "$link/SL/$SetID.gif";
				} 
				else { // If neither format is available, insert a placeholder image
					$filename = "error.png";
				}
				
				echo "<div id='legoItem'>";
				echo "<img class='setImg' src='".$filename."'></img>";

				echo "<div class='infoText'><p class='legoName'>".$setinfo["Setname"]."</p>
					  <p class='legoID'>ID-number: ".$setinfo["SetID"]."</p></div>";
				echo "</div>";	  
			}

			print("<p id ='amountParts'>This item consists of:</p>
				  <div id='allParts'>");

			while($row = mysqli_fetch_array($result)) //Display all parts included in the set
			{
				print ("<div class='legoPart'>");

				$PartID = $row['PartID'];
				$ColorID = $row['ColorID'];
				
				$imagesearch = mysqli_query($connection, "SELECT * FROM images WHERE ItemTypeID='P' AND ItemID='$PartID' 
											AND ColorID=$ColorID");
											
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
				
				/*PRINT SET PARTS OUTPUT*/
				echo "<a class='legoPart' href='search_bit.php?PartID=".$PartID."&ColorID=".$ColorID."'>";
				echo "<div>";
				echo "<img src='".$filename."'>";
				echo "<span>";
				echo "<p class='legoPartTitle'>".$row["Partname"]."</p>";
				echo "<p class='legoPartId'>id: ".$row["PartID"]."</p>";
				echo "<p>Color: ".$row["Colorname"]."</p>";
				echo "<p>Quantity: ".$row["Quantity"]."</p>";
				echo "</span>";
				echo "</div>";
				echo "</a>";
			}
			
			echo "</div>";
			mysqli_close($connection);
		?>

	</div>
</body>
</html>
