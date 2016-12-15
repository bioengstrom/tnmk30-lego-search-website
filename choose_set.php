<?php include("startsida.php"); ?>

  <div id="itemContainer">

    <?php
		$connection = mysqli_connect("mysql.itn.liu.se", "lego", "", "lego");
		
		//If unable to connect display error message
		if (!$connection) die('MySQL connection error'); 
			
		$Page = 1;
		
		if (isset($_GET['Page'])) $Page = $_GET['Page']; 
			
		$keyword = mysqli_real_escape_string($connection, $_POST["keyword"]); //The users search-word

		$link = "http://weber.itn.liu.se/~stegu76/img.bricklink.com"; //Link to all images

		if (isset($_POST['oldKeyword'])) $keyword = $_POST['oldKeyword'];
		
		if (isset($_GET['Keyword'])) $keyword = $_GET['Keyword']; 

		echo "<p id ='amountParts'><span>These sets contain the keyword: </span>".$keyword."</p>";
		echo "<div id='allParts'>";

		echo "<form name='sortForm' method='POST'>
			 <select name='sortForm'>
			 <option value='Setname'>-- Choose an option --</option>
			 <option value='Setname ASC'>Name Ascending</option>
			 <option value='Setname DESC'>Name Descending</option>
			 <option value='SetID ASC'>ID-number Ascending</option>
			 <option value='SetID DESC'>ID-number Descending</option>
			 </select>
			 <input type = 'submit' value = 'Sort' />
			 </form>";

		$sort = "Setname";

		if (isset($_POST['sortForm'])) $sort = $_POST['sortForm'];

		$result = mysqli_query($connection, "SELECT Setname, SetID FROM sets WHERE (sets.SetID LIKE '%$keyword%' 
											OR sets.Setname LIKE '%$keyword%') ORDER BY $sort"); 
		
		$counter = 0;
		$max_per_page = 20;
		
		while($row = mysqli_fetch_array($result)) {
			$counter++;
		}

		$total_pages = floor($counter / $max_per_page) + 1;
		$limit_start = ($Page * $max_per_page) - $max_per_page;
		
		$pageresult = mysqli_query($connection, "SELECT Setname, SetID FROM sets WHERE (sets.SetID LIKE '%$keyword%' 
												 OR sets.Setname LIKE '%$keyword%') ORDER BY $sort LIMIT $limit_start, 
												 $max_per_page"); //Get all sets that contain the keyword
								
		while($row = mysqli_fetch_array($pageresult) AND $keyword != NULL){ //Display all sets containing the keyword

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

		$link_search = "choose_set.php?Keyword=".$keyword;
		
		mysqli_close($connection);
    ?>
	
	<?php include("page_navigation.php"); ?>
		
	</div>
	</div>
  </body>
</html>
