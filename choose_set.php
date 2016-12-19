<?php include("startsida.php"); ?>

  <div id="itemContainer">

    <?php
		$connection = mysqli_connect("mysql.itn.liu.se", "lego", "", "lego");
		
		//If unable to connect display error message
		if (!$connection) die('MySQL connection error'); 
			
		$Page = 1;
		if (isset($_GET['Page'])) $Page = $_GET['Page']; 
		
		$link = "http://weber.itn.liu.se/~stegu76/img.bricklink.com"; //Link to all images
		
		$keyword = mysqli_real_escape_string($connection, $_POST["keyword"]); //The users search-word
		if (isset($_POST['oldKeyword'])) $keyword = $_POST['oldKeyword'];
		if (isset($_GET['Keyword'])) $keyword = $_GET['Keyword']; 

		$sort = "Setname";
		if (isset($_GET['Sort'])) $sort = $_GET['Sort'];


		$result = mysqli_query($connection, "SELECT Setname, SetID FROM sets WHERE (SetID LIKE '%$keyword%' 
											OR Setname LIKE '%$keyword%') ORDER BY $sort"); 
		
		$counter = 0;
		$max_per_page = 20;
		
		while($row = mysqli_fetch_array($result)) {
			$counter++;
		}
		
		if ($counter == 0) {
			echo "<p class='wrongSearch'><span>".$keyword."</span> didn't match any result.</p>
				 <p class='wrongSearch'>Suggestions:</p>
				 <ul class='wrongSearch'>
				 <li>Make sure that all words are spelled correctly.</li>
				 <li>Try another search phrase.</li>
				 <li>If your search contains multiple words, make sure that they are written in chronological order.</li>
				 <li>Make sure any specified measurements are written in a correct manner (ex. 2 x 2).</li>
				 </ul>";
		}
		else {
			echo "<p id ='amountParts'><span>These sets contain the keyword: </span>".$keyword."</p>";
			echo "<div id='allParts'>";

			echo "<form name='sortForm' method='POST'>
				<select name='sortForm'>
				<option value='Setname'>-- Choose a sorting option --</option>
				<option value='Setname ASC'>Name Ascending</option>
				<option value='Setname DESC'>Name Descending</option>
				<option value='SetID ASC'>ID-number Ascending</option>
				<option value='SetID DESC'>ID-number Descending</option>
				</select>
				<input type='hidden' name='oldKeyword' value='".$keyword."'/>
				<input type = 'submit' value = 'Sort' />
				</form>";
		
			if (isset($_POST['sortForm'])) $sort = $_POST['sortForm'];
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
				echo "<img src='".$filename."' alt='Image does not exist'alt='Image does not exist'>";
				echo "<span>
				  <p class='legoListItemTitle'>".$Setname."</p>
				  <p class='legoListItemId'><span>id: </span>".$SetID."</p>
				</span>";
				echo "</div>";
				echo "</a>";
			}
			
			$link_search = "choose_set.php?Keyword=".$keyword."&Sort=".$sort;
			include("page_navigation.php"); 
		}
		mysqli_close($connection);
    ?>

		
	</div>
	</div>
  </body>
</html>
