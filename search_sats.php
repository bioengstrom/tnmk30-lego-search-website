	<?php include("startsida.php"); ?>

		<div class ="itemContainer">

		<?php
			$connection = mysqli_connect("mysql.itn.liu.se", "lego", "", "lego");

			if (!$connection) {
				die('MySQL connection error');
			}

			$SetID = $_GET['SetID'];

			$result = mysqli_query($connection, "SELECT parts.Partname, parts.PartID, inventory.ItemID, colors.ColorID,
									colors.Colorname, inventory.Quantity, sets.Setname, sets.SetID FROM sets, inventory,
									colors, parts WHERE sets.SetID='$SetID'
									AND sets.SetID=inventory.SetID AND inventory.ItemID=parts.PartID AND
									inventory.ColorID=colors.ColorID ORDER BY Partname");

			$link = "http://weber.itn.liu.se/~stegu76/img.bricklink.com";

			$setsearch = mysqli_query($connection, "SELECT SetID, Setname FROM sets WHERE SetID='$SetID'");

			while($setinfo = mysqli_fetch_array($setsearch)) {

				$imagesearch = mysqli_query($connection, "SELECT * FROM images WHERE ItemID='$SetID' AND ItemTypeID = 'S'");
			// By design, the query above should return exactly one row.
				$imageinfo = mysqli_fetch_array($imagesearch);
					if($imageinfo['has_largejpg']) { // Use JPG if it exists
							$filename = "$link/SL/$SetID.jpg";
					} else if($imageinfo['has_largegif']) { // Use GIF if JPG is unavailable
							$filename = "$link/SL/$SetID.gif";
					} else { // If neither format is available, insert a placeholder image
							$filename = "error.png";
					}
					/*PRINT SET OUTPUT*/
					echo "<div id='legoItem'>";
					echo "<span class='legoItemImgContainer'>";
					echo "<img src='".$filename."'></img>";
					echo "</span>";

					echo "<div class='infoText'><p class='legoName'>".$setinfo["Setname"]."</p>
					 			<p class='legoID'><span>ID-number: </span>".$setinfo["SetID"]."</p></div>";
				 	echo "</div>";
					}

			print("<p id ='setParts'>This item consists of:</p>
			<div id='allParts'>");

			while($row = mysqli_fetch_array($result))
			{
				$ItemID = $row['ItemID'];
				$ColorID = $row['ColorID'];
				$imagesearch = mysqli_query($connection, "SELECT * FROM images WHERE ItemTypeID='P' AND ItemID='$ItemID' AND ColorID=$ColorID");
		    // By design, the query above should return exactly one row.
		    $imageinfo = mysqli_fetch_array($imagesearch);
			    if($imageinfo['has_jpg']) { // Use JPG if it exists
			 	 			$filename = "$link/P/$ColorID/$ItemID.jpg";
			    } else if($imageinfo['has_gif']) { // Use GIF if JPG is unavailable
			 	 			$filename = "$link/P/$ColorID/$ItemID.gif";
			    } else { // If neither format is available, insert a placeholder image
			 	 			$filename = "error.png";
			    }

						/*PRINT SET PARTS OUTPUT*/
					echo "<a class='legoSet' href='#'>";
					echo "<div>";
					echo "<img src='".$filename."'>";
					echo "<span>";
					echo "<p class='legoSetTitle'>".$row["Partname"]."</p>";
					echo "<p class='legoSetId'><span>id: </span>".$row["PartID"]."</p>";
					echo "<p><span>Color: </span>".$row["Colorname"]."</p>";
					echo "<p><span>Quantity: </span>".$row["Quantity"]."</p>";
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
