<?php include("startsida.php"); ?>

	<div class ="itemContainer">

		<?php
			$connection = mysqli_connect("mysql.itn.liu.se", "lego", "", "lego");

			if (!$connection) {
				die('MySQL connection error');
			}

			$keyword = mysqli_real_escape_string($connection, $_POST["keyword"]);

			$result = mysqli_query($connection, "SELECT parts.Partname, parts.PartID, inventory.ItemID, colors.ColorID,
									colors.Colorname, sets.Setname, sets.SetID FROM sets, inventory,
									colors, parts WHERE (parts.PartID LIKE '%$keyword%' OR parts.Partname LIKE '%$keyword%')
									AND parts.PartID=inventory.ItemID AND inventory.SetID=sets.SetID AND
									inventory.ColorID=colors.ColorID ORDER BY Partname");

			print("<p id ='amountSets'>This item is part of:</p>
			<div id='allSets'>");

			while($row = mysqli_fetch_row($result) AND $keyword != NULL)
			{
				for($i = 0; $i<mysqli_num_fields($result); $i++) {
					$row = mysqli_fetch_array($result);
					print ("<div class='legoSet'>");
					// echo "<img class='setImg' src='http://weber.itn.liu.se/~stegu76/img.bricklink.com/P/".$row["ColorID"]."/".$row["ItemID"].".gif'></img>";
					echo "<div class='infoText'><p>", $row["Setname"], "</p><p>", $row["SetID"], "</p></div>";
					print ("</div>");
				}
			}

			print ("</div>");
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
			<p id ="amountSets">This item is part of ... sets:</p>
			<div id="allSets">
				<div class="legoSet">
					<img src="http://1.bp.blogspot.com/-23j6MHmmuto/T3qT9y4oItI/AAAAAAAAALc/-UYN6YSdZLM/s1600/Lego-Brick-4x2.jpg"></img>
					<div class="infoText">
						<p>Setname</p><p>Id-number</p></td>
					</div>
				</div>
				<div class="legoSet">
					<img src="http://1.bp.blogspot.com/-23j6MHmmuto/T3qT9y4oItI/AAAAAAAAALc/-UYN6YSdZLM/s1600/Lego-Brick-4x2.jpg"></img>
					<div class="infoText">
						<p>Setname</p><p>Id-number</p></td>
					</div>
				</div>

			</div>
		</div>
	</div>
	</body>
</html>
