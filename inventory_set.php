<?php include("startsida.php"); ?>

	<div class ="itemContainer">

		<?php
			$connection = mysqli_connect("mysql.itn.liu.se", "lego", "", "lego");
			
			//If unable to connect display error message
			if (!$connection) die('MySQL connection error');

			$SetID = $_GET['SetID']; //Get the SetID from the webpage link created by choose_set.php
			
			$Page = 1;
			
			if (isset($_GET['Page'])) $Page = $_GET['Page'];

			$link = "http://weber.itn.liu.se/~stegu76/img.bricklink.com"; //Link to all images

			$setsearch = mysqli_query($connection, "SELECT SetID, Setname, Year FROM sets WHERE SetID='$SetID'"); //Get information about the set

			while($setinfo = mysqli_fetch_array($setsearch)) 
			{
				$imagesearch = mysqli_query($connection, "SELECT * FROM images WHERE ItemID='$SetID' AND ItemTypeID = 'S'");

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
				echo "<img src='".$filename."' alt='Image does not exist'>";
				echo "</span>";

				echo "<div class='infoText'><p class='legoName'>".$setinfo["Setname"]."</p>
				 	 <p class='legoID'><span>ID: </span>".$setinfo["SetID"]."</p><p>Release year: 
					 ".$setinfo["Year"]."</p></div>";
			 	echo "</div>";
			}

			print("<p id ='ListItemParts'>This item consists of:</p>
			<div id='allParts'>");

			echo "<form name='sortForm' method='POST'>
				 <select name='sortForm'>
				 <option value='Partname'>-- Choose a sorting option --</option>
				 <option value='Partname ASC'>Name Ascending</option>
				 <option value='Partname DESC'>Name Descending</option>
				 <option value='PartID ASC'>ID-number Ascending</option>
				 <option value='PartID DESC'>ID-number Descending</option>
				 </select>
				 <input type = 'submit' value = 'Sort' />
				 </form>";

			$sort = "Partname ASC";
			
			if (isset($_GET['Sort'])) $sort = $_GET['Sort']; 

			if (isset($_POST['sortForm'])) $sort = $_POST['sortForm'];

			$result = mysqli_query($connection, "SELECT parts.Partname, parts.PartID, inventory.ItemID, colors.ColorID,
									colors.Colorname, inventory.Quantity, sets.Setname, sets.SetID FROM sets, inventory,
									colors, parts WHERE sets.SetID='$SetID'
									AND sets.SetID=inventory.SetID AND inventory.ItemID=parts.PartID AND
									inventory.ColorID=colors.ColorID"); 

			$counter = 0;
			$max_per_page = 20;
			
			while($row = mysqli_fetch_array($result)) $counter++;
	
			$total_pages = floor($counter / $max_per_page) + 1;
		
			$limit_start = ($Page * $max_per_page) - $max_per_page;
			
			$pageresult = mysqli_query($connection, "SELECT parts.Partname, parts.PartID, inventory.ItemID, colors.ColorID,
									colors.Colorname, inventory.Quantity, sets.Setname, sets.SetID FROM sets, inventory,
									colors, parts WHERE sets.SetID='$SetID'
									AND sets.SetID=inventory.SetID AND inventory.ItemID=parts.PartID AND
									inventory.ColorID=colors.ColorID ORDER BY $sort LIMIT $limit_start, $max_per_page"); //Get wanted information about the set
			
			while($row = mysqli_fetch_array($pageresult)) //Display all parts included in the set
			{
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
				echo "<a class='legoListItem' href='inventory_part.php?PartID=".$PartID."&ColorID=".$ColorID."'>";
				echo "<div>";
				echo "<img src='".$filename."' alt='Image does not exist'>";
				echo "<span>";
				echo "<p class='legoListItemTitle'>".$row["Partname"]."</p>";
				echo "<p class='legoListItemId'><span>ID: </span>".$row["PartID"]."</p>";
				echo "<p><span>Color: </span>".$row["Colorname"]."</p>";
				echo "<p><span>Quantity: </span>".$row["Quantity"]."</p>";
				echo "</span>";
				echo "</div>";
				echo "</a>";
			}
			
			$link_search = "inventory_set.php?SetID=".$SetID."&Sort=".$sort;
			var_dump($link_search);
			
			mysqli_close($connection);
		?>
		
		<?php include("page_navigation.php"); ?>
		
		</div>
	</div>
</body>
</html>
