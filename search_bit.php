<?php include("startsida.php"); ?>

	<div class ="itemContainer">

		<?php
			$connection = mysqli_connect("mysql.itn.liu.se", "lego", "", "lego");

			if (!$connection) { //If unable to connect display error message
				die('MySQL connection error');
			}

			$PartID = $_GET['PartID'];
			$ColorID = $_GET['ColorID'];

			$result = mysqli_query($connection, "SELECT parts.Partname, parts.PartID, colors.Colorname, inventory.Quantity,
									sets.Setname, sets.SetID FROM sets, inventory, colors, parts WHERE parts.PartID='$PartID'
									AND parts.PartID=inventory.ItemID AND inventory.ColorID='$ColorID' AND inventory.SetID=
									sets.SetID AND inventory.ColorID=colors.ColorID ORDER BY Setname"); //Get wanted information about the parts

			$link = "http://weber.itn.liu.se/~stegu76/img.bricklink.com"; //Link to all images

			$setsearch = mysqli_query($connection, "SELECT parts.PartID, parts.Partname, colors.Colorname FROM parts, colors
									  WHERE parts.PartID='$PartID' AND colors.ColorID='$ColorID'"); //Get information about the part

			while($setinfo = mysqli_fetch_array($setsearch)) //Display image and information about the chosen set
			{

				$imagesearch = mysqli_query($connection, "SELECT * FROM images WHERE ItemID='$PartID' AND ColorID='$ColorID'
											ItemTypeID='P'");

				$imageinfo = mysqli_fetch_array($imagesearch);

				if($imageinfo['has_largejpg']) { // Use JPG if it exists
					$filename = "$link/PL/$PartID.jpg";
				}
				else if($imageinfo['has_largegif']) { // Use GIF if JPG is unavailable
					$filename = "$link/PL/$PartID.gif";
				}
				else { // If neither format is available, insert a placeholder image
					$filename = "error.png";
				}

				/*PRINTING FOR SINGLE ITEM*/
				echo "<div id='legoItem'>";
				echo "<span class='legoItemImgContainer'>";
				echo "<img src='".$filename."'></img>";
				echo "</span>";

				echo "<div class='infoText'>
								<p class='legoName'>".$setinfo["Partname"]."</p>
					 			<p class='legoID'><span>id: </span>".$PartID."</p>
								<p class='legoID'><span>color: </span>".$setinfo["Colorname"]."</p>
							</div>";
			 	echo "</div>";
			}

			echo "<p id ='setParts'>This item is part of the following sets:</p><div id='allParts'>";

			while($row = mysqli_fetch_array($result)) //Display all parts included in the set
			{

				$SetID = $row['SetID'];

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
				/*PRINT ITEM SETS OUTPUT*/
				echo "<a class='legoSet' href='search_sats.php?SetID=".$SetID."'>";
				echo "<div>";
				echo "<img src='".$filename."'>";
				echo "<span>";
				echo "<p class='legoSetTitle'>".$row["Setname"]."</p>";
				echo "<p class='legoSetId'><span>id: </span>".$row["SetID"]."</p>";
				echo "<p><span>Quantity: </span>".$row["Quantity"]."</p>";
				echo "</span>";
				echo "</div>";
				echo "</a>";
			}

			print ("</div>");
			mysqli_close($connection);
		?>

	</div>
	</body>
</html>
