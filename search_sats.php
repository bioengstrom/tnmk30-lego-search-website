	<?php include("startsida.php"); ?>
	
		<div class ="itemContainer">
	
		<?php 
			$connection = mysqli_connect("mysql.itn.liu.se", "lego", "", "lego");
			
			if (!$connection) {
				die('MySQL connection error');
			}
			
			$keyword = mysqli_real_escape_string($connection, $_POST["keyword"]);
			
			$result = mysqli_query($connection, "SELECT parts.Partname, parts.PartID, inventory.Quantity, sets.Setname, sets.SetID FROM sets, inventory, parts WHERE (sets.SetID LIKE '%$keyword%' OR sets.Setname LIKE '%$keyword%') AND sets.SetID=inventory.SetID AND inventory.ItemID=parts.PartID");
			
			while($row = mysqli_fetch_row($result) AND $keyword != NULL) {
			for($i = 0; $i<mysqli_num_fields($result); $i++) {
				$row = mysqli_fetch_array($result);
				echo "<p>", $row["Partname"], "</p>", $row["PartID"], "</p>", 
				$row["Quantity"], "</p>";
			}}
			// while($row = mysqli_fetch_row($result)) {
				// $partname = $row['parts.Partname'];
				// print("<p>$partname</p>\n");
				// $partID = $row['parts.PartID'];
				// print("<p>$partID</p>\n");
				// $quantity = $row['inventory.Quantity'];
				// print("<p>Number of pieces: $quantity</p>\n");
				
			// for($i = 0; $i<mysqli_num_fields($result); $i++) {
				// print("<p>$row[$i]</p>");
			// }
			// }
			
			mysqli_close($connection);
			
		?>
		
			<div id="legoItem">
				<!-- Här ska bitens bild in, bredvid ska namnet på biten finnas, id-nummer 
				och en drop-down meny med färgalternativ som ska ändra färg på bilden vid 
				tryckning.-->
				<img src="http://1.bp.blogspot.com/-23j6MHmmuto/T3qT9y4oItI/AAAAAAAAALc/-UYN6YSdZLM/s1600/Lego-Brick-4x2.jpg"></img>
				<div class="infoText">
					<p class="legoName">Namn</p>
					<p class="legoID">ID</p>
				</div>	
			</div>
			<p id ="amountParts">This item consists of:</p>
			<div id="allParts">
				<div class="legoPart">
					<img src="http://1.bp.blogspot.com/-23j6MHmmuto/T3qT9y4oItI/AAAAAAAAALc/-UYN6YSdZLM/s1600/Lego-Brick-4x2.jpg"></img>
					<div class="infoText">
						<p>Partname</p>
						<p>Id-number</p>
						<p>Antal bitar</p>
					</div>
				</div>
				<div class="legoPart">
					<img src="http://1.bp.blogspot.com/-23j6MHmmuto/T3qT9y4oItI/AAAAAAAAALc/-UYN6YSdZLM/s1600/Lego-Brick-4x2.jpg"></img>
					<div class="infoText">
						<p>Partname</p>
						<p>Id-number</p>
						<p>Antal bitar</p>
					</div>
				</div>
				<div class="legoPart">
					<img src="http://1.bp.blogspot.com/-23j6MHmmuto/T3qT9y4oItI/AAAAAAAAALc/-UYN6YSdZLM/s1600/Lego-Brick-4x2.jpg"></img>
					<div class="infoText">
						<p>Partname</p>
						<p>Id-number</p>
						<p>Antal bitar</p>
					</div>
				</div>
				<div class="legoPart">
					<img src="http://1.bp.blogspot.com/-23j6MHmmuto/T3qT9y4oItI/AAAAAAAAALc/-UYN6YSdZLM/s1600/Lego-Brick-4x2.jpg"></img>
					<div class="infoText">
						<p>Partname</p><p>Id-number</p>
						<p>Antal bitar</p>
					</div>
				</div>
				
			</div>
		</div>
	</div>
	

	</body>
</html>