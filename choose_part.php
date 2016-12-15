<?php include("startsida.php"); ?>

  <div id="itemContainer">

    <?php
		$connection = mysqli_connect("mysql.itn.liu.se", "lego", "", "lego");

		if (!$connection) { //If unable to connect display error message
			die('MySQL connection error');
		}
		
		$keyword = mysqli_real_escape_string($connection, $_POST["keyword"]);

		$link = "http://weber.itn.liu.se/~stegu76/img.bricklink.com"; //Link to all images
		
		if (isset($_POST['oldKeyword'])){
			$keyword = $_POST['oldKeyword'];
		}
		
		print("<p id ='amountParts'>These parts contain the keyword: ".$keyword."</p>
				<div id='allParts'>");
		
		echo "<form name='sortForm' method='POST'>
			 <select name='sortForm'>
			 <option value='Partname'>-- Choose an option --</option>
			 <option value='Partname'>Name</option>
			 <option value='PartID'>ID-number</option>
			 </select>
			 <input type='hidden' name='oldKeyword' value='".$keyword."'/>
			 <input type = 'submit' value = 'Sort' />
			 </form>";
			
		$sort = "Partname";
			
		if (isset($_POST['sortForm'])){
			$sort = $_POST['sortForm'];
		}
		
		$result = mysqli_query($connection, "SELECT DISTINCT parts.Partname, parts.PartID, inventory.ColorID, colors.Colorname FROM parts, inventory, colors
								WHERE (PartID LIKE '%$keyword%' OR Partname LIKE '%$keyword%') AND parts.PartID=inventory.ItemID
								AND inventory.ColorID=colors.ColorID ORDER BY $sort"); //Get all parts that contain the keyword
								
		while($row = mysqli_fetch_array($result) AND $keyword != NULL){ //Display all parts containing the keyword

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

			echo "<a class='legoSet' href='inventory_part.php?PartID=".$PartID."&ColorID=".$ColorID."'>"; //Link to the displayed set
			echo "<div>";
			echo "<img src='".$filename."'>";
			echo "<span>
				<p class='legoSetTitle'>".$Partname."</p>
				<p class='legoSetId'><span>id: </span>".$PartID."</p>
				<p class='legoSetColor'><span>color: </span>".$ColorID."</p>
				 </span>";
			echo "</div>";
			echo "</a>";
		}

		echo "</div>"; //close allParts div
		echo "</div>"; // close itemContainer div

		mysqli_close($connection);
    ?>

  </body>
</html>
