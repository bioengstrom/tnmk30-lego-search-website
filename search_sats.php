	<?php include("startsida.php"); ?>

		<div class ="itemContainer">

		<?php
			$connection = mysqli_connect("mysql.itn.liu.se", "lego", "", "lego");

			if (!$connection) {
				die('MySQL connection error');
			}

			$keyword = mysqli_real_escape_string($connection, $_POST["keyword"]);

			$result = mysqli_query($connection, "SELECT parts.Partname, parts.PartID, inventory.ItemID, colors.ColorID,
									colors.Colorname, inventory.Quantity, sets.Setname, sets.SetID FROM sets, inventory,
									colors, parts WHERE (sets.SetID LIKE '%$keyword%' OR sets.Setname LIKE '%$keyword%')
									AND sets.SetID=inventory.SetID AND inventory.ItemID=parts.PartID AND
									inventory.ColorID=colors.ColorID ORDER BY Partname");

			print("<p id ='amountParts'>This item consists of:</p>
			<div id='allParts'>");

			// print("<div id='legoItem'>");
				// echo "<div class='infoText'><p class='legoName'>".$row["Setname"]."</p>
					// <p class='legoID'>".$row["SetID"]."</p></div>";
				// print ("</div>");


			while($row = mysqli_fetch_array($result) AND $keyword != NULL)
			{
					print ("<div class='legoPart'>");

					$link = "http://weber.itn.liu.se/~stegu76/img.bricklink.com";
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


				  echo "<div class='imgContainer'><img src='".$filename."'></div";
					echo "<div class='infoText'><p>", $row["Partname"], "</p><p class='legoPartId'>", $row["PartID"], "</p><p>",
					$row["Colorname"], "</p><p>Quantity: ", $row["Quantity"], "</p></div>";
					print ("</div>");

			}

			print ("</div>");
			mysqli_close($connection);

		?>
		<div id="allParts">
			<div class="legoPart">
				<div class="imgContainer">
					<img class="partImg" src="http://1.bp.blogspot.com/-23j6MHmmuto/T3qT9y4oItI/AAAAAAAAALc/-UYN6YSdZLM/s1600/Lego-Brick-4x2.jpg">
				</div>

				<div class="infoText">
					<p class="legoPartTitle">Antenna whip flag lorem ipsum dolor</p>
					<p class="legoPartId"><span>ID:</span>124324</p>
					<p class="legoPartColor"><span>Color: </span>trans-light blue</p>
					<p><span>Quantity: </span> 23</p>
				</div>
			</div>
			<div class="legoPart">
				<img src="http://1.bp.blogspot.com/-23j6MHmmuto/T3qT9y4oItI/AAAAAAAAALc/-UYN6YSdZLM/s1600/Lego-Brick-4x2.jpg">
				<div class="infoText">
					<p>Antenna whip flag lorem ipsum dolor</p>
					<p>124324</p>
					<p>trans-light blue</p>
					<p>Quantity: 23</p>
				</div>
			</div>
			<div class="legoPart">
				<img src="http://1.bp.blogspot.com/-23j6MHmmuto/T3qT9y4oItI/AAAAAAAAALc/-UYN6YSdZLM/s1600/Lego-Brick-4x2.jpg">
				<div class="infoText">
					<p>Antenna whip flag lorem ipsum dolor</p>
					<p>124324</p>
					<p>trans-light blue</p>
					<p>Quantity: 23</p>
				</div>
			</div>
		</div>

	</div>


	</body>
</html>
