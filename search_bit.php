<?php include("startsida.php"); ?>

	<div class ="itemContainer">

		<?php
			$connection = mysqli_connect("mysql.itn.liu.se", "lego", "", "lego");

			if (!$connection) {
				die('MySQL connection error');
			}

			$PartID = $_GET['PartID'];
			$ColorID = $_GET['ColorID'];

			$result = mysqli_query($connection, "SELECT parts.Partname, parts.PartID, colors.Colorname, inventory.Quantity, 
									sets.Setname, sets.SetID FROM sets, inventory, colors, parts WHERE parts.PartID='$PartID'
									AND parts.PartID=inventory.ItemID AND inventory.ColorID='$ColorID' AND 
									inventory.SetID=sets.SetID AND inventory.ColorID=colors.ColorID ORDER BY Setname");

			print("<p id ='amountSets'>This item is part of the following sets:</p>
			<div id='allSets'>");
			
			$link = "http://weber.itn.liu.se/~stegu76/img.bricklink.com";
			
			while($row = mysqli_fetch_array($result))
			{
				print ("<div class='legoPart'>");

				$SetID = $row['SetID'];
					
				$imagesearch = mysqli_query($connection, "SELECT * FROM images WHERE ItemTypeID='S' AND ItemID='$SetID'");
			    
			    $imageinfo = mysqli_fetch_array($imagesearch);
				
				if($imageinfo['has_jpg']) { // Use JPG if it exists
				 	 $filename = "$link/S/$SetID.jpg";
				} else if($imageinfo['has_gif']) { // Use GIF if JPG is unavailable
				 	 $filename = "$link/S/$SetID.gif";
				} else { // If neither format is available, insert a placeholder image
				 	 $filename = "error.png";
				}

				echo "<div class='imgContainer'><img src='".$filename."'></div";
				
				echo "<div class='infoText'><p>", $row["Setname"], "</p><p>ID-number: ", $row["SetID"], 
					 "</p><p>Quantity: ", $row["Quantity"], "</p></div>";
					 
				print ("</div>");
			}

			print ("</div>");
			mysqli_close($connection);
		?>

	</div>
	</body>
</html>
