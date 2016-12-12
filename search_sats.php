	<?php include("startsida.php"); ?>
	
		<div class ="itemContainer">
	
		<?php 
			$connection = mysqli_connect("mysql.itn.liu.se", "lego", "", "lego");
			
			if (!$connection) {
				die('MySQL connection error');
			}
			
			$keyword = mysqli_real_escape_string($connection, $_POST["keyword"]);
		
			$result = mysqli_query($connection, "SELECT images.has_gif, images.has_jpg, images.ItemtypeID, sets.Setname, sets.SetID FROM sets INNER JOIN images ON sets.SetID = images.ItemID WHERE sets.Setname LIKE '%$keyword%' OR sets.SetID LIKE '%$keyword%'");
			
			while($row = mysqli_fetch_row($result)) { // AND $keyword != null
				$test = $row['Setname'];
				print ("<p>$test</p>");
				// print("<tr>");
				// for($i = 0; $i<mysqli_num_fields($result); $i++) {
					// print("<td>$row[$i]</td>");		
				// }
				// print "<tr>\n";
			}
			
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