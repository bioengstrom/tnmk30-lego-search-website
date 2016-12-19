<?php include("startsida.php"); ?>

  <div id="itemContainer">

    <?php
		$connection = mysqli_connect("mysql.itn.liu.se", "lego", "", "lego");

		//If unable to connect display error message
		if (!$connection) die('MySQL connection error');

		$Page = 1;

		if (isset($_GET['Page'])) $Page = $_GET['Page'];

		$link = "http://weber.itn.liu.se/~stegu76/img.bricklink.com"; //Link to all images

		$keyword = mysqli_real_escape_string($connection, $_POST["keyword"]);
		if (isset($_POST['oldKeyword'])) $keyword = $_POST['oldKeyword'];
		if (isset($_GET['Keyword'])) $keyword = $_GET['Keyword'];

		$sort = "Partname";
		if (isset($_GET['Sort'])) $sort = $_GET['Sort'];

		$result = mysqli_query($connection, "SELECT DISTINCT parts.Partname, parts.PartID, inventory.ColorID, colors.Colorname FROM parts, inventory, colors
								WHERE (PartID LIKE '%$keyword%' OR Partname LIKE '%$keyword%') AND parts.PartID=inventory.ItemID
								AND inventory.ColorID=colors.ColorID ORDER BY $sort"); //Get all parts that contain the keyword

		$counter = 0;
		$max_per_page = 20;

		while($row = mysqli_fetch_array($result)) {
			$counter++; }

		if ($counter == 0) {
			include("error_message.php");
		}
		else {
			print("<p id ='amountParts'>These parts contain the keyword: <span>".$keyword."</span></p>
					<div id='allParts'>");

			echo "<form name='sortForm' method='POST'>
				 <select name='sortForm'>
				 <option value='Partname'>Choose a sorting option</option>
				 <option value='Partname ASC'>Name Ascending</option>
				 <option value='Partname DESC'>Name Descending</option>
				 <option value='PartID ASC'>ID-number Ascending</option>
				 <option value='PartID DESC'>ID-number Descending</option>
				 </select>
				 <input type='hidden' name='oldKeyword' value='".$keyword."'/>
				 <input type = 'submit' value = 'Sort' />
				 </form>";
			if (isset($_POST['sortForm'])) $sort = $_POST['sortForm'];
			$total_pages = floor($counter / $max_per_page) + 1;

			$limit_start = ($Page * $max_per_page) - $max_per_page;

			$pageresult = mysqli_query($connection, "SELECT DISTINCT parts.Partname, parts.PartID, inventory.ColorID,
													 colors.Colorname FROM parts, inventory, colors WHERE (PartID LIKE
													 '%$keyword%' OR Partname LIKE '%$keyword%') AND parts.PartID=inventory.ItemID
													 AND inventory.ColorID=colors.ColorID ORDER BY $sort LIMIT $limit_start,
													 $max_per_page");

			while($row = mysqli_fetch_array($pageresult) AND $keyword != NULL){ //Display all parts containing the keyword

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

				echo "<a class='legoListItem' href='inventory_part.php?PartID=".$PartID."&ColorID=".$ColorID."'>"; //Link to the displayed set
				echo "<div>";
				echo "<img src='".$filename."' alt='Image does not exist'>";
				echo "<span>
					 <p class='legoListItemTitle'>".$Partname."</p>
					 <p class='legoListItemId'><span>ID: </span>".$PartID."</p>
					 <p class='legoListItemColor'><span>Color: </span>".$Colorname."</p>
					 </span>";
				echo "</div>";
				echo "</a>";
			}

			$link_search = "choose_part.php?Keyword=".$keyword."&Sort=".$sort;
			include("page_navigation.php");
		}
		mysqli_close($connection);
    ?>

	</div>
	</div>
  </body>
</html>
