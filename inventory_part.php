<?php include("startsida.php"); ?>

	<div class ="itemContainer">

		<?php
			$connection = mysqli_connect("mysql.itn.liu.se", "lego", "", "lego");
			
			//If unable to connect display error message
			if (!$connection) die('MySQL connection error'); 

			$PartID = $_GET['PartID'];
			$ColorID = $_GET['ColorID'];

			$Page = 1;
			
			if (isset($_GET['Page']))$Page = $_GET['Page'];
			
			$link = "http://weber.itn.liu.se/~stegu76/img.bricklink.com"; //Link to all images

			$setsearch = mysqli_query($connection, "SELECT parts.PartID, parts.Partname, colors.Colorname FROM parts, 
													colors WHERE parts.PartID='$PartID' AND colors.ColorID='$ColorID'"); 

			while($setinfo = mysqli_fetch_array($setsearch)) //Display image and information about the chosen set
			{
				$imagesearch = mysqli_query($connection, "SELECT * FROM images WHERE ItemID='$PartID' AND ColorID='$ColorID' 
														  AND ItemTypeID='P'");

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

				/*PRINTING FOR SINGLE ITEM*/
				echo "<div id='legoItem'>";
				echo "<span class='legoItemImgContainer'>";
				echo "<img src='".$filename."' alt='Image does not exist'>";
				echo "</span>";

				echo "<div class='infoText'>
								<p class='legoName'>".$setinfo["Partname"]."</p>
					 			<p class='legoID'><span>ID: </span>".$PartID."</p>
								<p class='legoID'><span>Color: </span>".$setinfo["Colorname"]."</p>
							</div>";
			 	echo "</div>";
			}

			echo "<p id ='ListItemParts'>This item is part of the following sets:</p><div id='allParts'>";

			echo "<form name='sortForm' method='POST'>
				 <select name='sortForm'>
				 <option value='Setname'>-- Choose a sorting option --</option>
				 <option value='Setname ASC'>Name Ascending</option>
				 <option value='Setname DESC'>Name Descending</option>
				 <option value='SetID ASC'>ID-number Ascending</option>
				 <option value='SetID DESC'>ID-number Descending</option>
				 </select>
				 <input type = 'submit' value = 'Sort' />
				 </form>";

			$sort = "Setname";
			
			if (isset($_GET['Sort'])) $sort = $_GET['Sort']; 

			if (isset($_POST['sortForm'])) $sort = $_POST['sortForm']; 
		
			$result = mysqli_query($connection, "SELECT parts.Partname, parts.PartID, colors.Colorname, inventory.Quantity,
									sets.Setname, sets.SetID FROM sets, inventory, colors, parts WHERE parts.PartID='$PartID'
									AND parts.PartID=inventory.ItemID AND inventory.ColorID='$ColorID' AND inventory.SetID=
									sets.SetID AND inventory.ColorID=colors.ColorID ORDER BY $sort"); 

			$counter = 0;
			$max_per_page = 20;
			
			while($row = mysqli_fetch_array($result)) $counter++; 
	
			$total_pages = floor($counter / $max_per_page) + 1;	
			$limit_start = ($Page * $max_per_page) - $max_per_page;
			
			$pageresult = mysqli_query($connection, "SELECT parts.Partname, parts.PartID, colors.Colorname, inventory.Quantity,
									sets.Setname, sets.SetID, sets.Year FROM sets, inventory, colors, parts WHERE parts.PartID='$PartID'
									AND parts.PartID=inventory.ItemID AND inventory.ColorID='$ColorID' AND inventory.SetID=
									sets.SetID AND inventory.ColorID=colors.ColorID ORDER BY $sort LIMIT $limit_start, $max_per_page"); 

			while($row = mysqli_fetch_array($pageresult)) //Display all parts included in the set
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
				echo "<a class='legoListItem' href='inventory_set.php?SetID=".$SetID."'>";
				echo "<div>";
				echo "<img src='".$filename."' alt='Image does not exist'>";
				echo "<span>";
				echo "<p class='legoListItemTitle'>".$row["Setname"]."</p>";
				echo "<p class='legoListItemId'><span>ID: </span>".$row["SetID"]."</p>";
				echo "<p><span>Release year: </span>".$row["Year"]."</p>";
				echo "</span>";
				echo "</div>";
				echo "</a>";
			}
			
			$link_search = "inventory_part.php?PartID=".$PartID."&ColorID=".$ColorID."&Sort=".$sort;
			
			mysqli_close($connection);
		?>
		
		<?php include("page_navigation.php"); ?>
		
		</div>
	</div>
	</body>
</html>
