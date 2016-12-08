<?php

?>
<!doctype html>
<html>
	<head>
		<title>Lego DB searcher 2000</title>
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700" rel="stylesheet">
		<link href="utseende.css" rel="stylesheet" type="text/css"/>
	</head>
	<body>
		<div class="colContainer">
			<div id="startContainer">
				<h1 id="startHeader">welcome to <span>Lego Database Finder<span></h1>
			</div>
			<div id="searchBarContainerBG">
			</div>
			<div id="searchBarContainer">
				<div id="searchTabContainer">
					<div id="searchSelected">
						<h3>Bit</h3>
					</div>
					<div id="searchUnselected">
						<h3>Sats</h3>
					</div>
				</div>
				<form action="search.php" method="post">
					<input type="text" name="keyword">
					<input type="submit" name="search">
				</form>
			</div>



<!--- NOT END OF FILE. NEED TO INCLUDE --->