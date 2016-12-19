<!doctype html>
<html>
	<head>
		<title>Lego DB searcher 2000</title>
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700" rel="stylesheet">
		<link href="utseende.css" rel="stylesheet" type="text/css"/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="animation.css" rel="stylesheet" type="text/css"/>
		<link href="utseende_search_bitar.css" rel="stylesheet" type="text/css"/>
		<script src="searchtab.js"></script>
		<script src="validator.js"></script>
		<meta name="theme-color" content="#1A237E">
		<script src="validatorButton.js"></script>
	</head>
	<body onload="tabColor(), toggleButtons()">
		<div class="colContainer">
			<div id="startContainerBG">
			</div>
			<div id="startContainer">
				<h1 id="startHeader">welcome to <span>Lego Database Finder<span></h1>
				<div id="searchBarContainer">
					<div id="searchTabContainer">
						<div id="searchBit" onclick="changeTab(this.id)">
							<h3>Parts</h3>
						</div>
						<div id="searchSats" onclick="changeTab(this.id)">
							<h3>Sets</h3>
						</div>
					</div>
					<form action="search_bit.php" method="post">
						<h5 class="alertWarning">Search value must be at least 3 characters</h5>
						<input id="keyword" type="text" name="keyword" onkeyup="runFunction(), toggleButtons(), enterKeyPress(event)" placeholder="Type in a Piece Name to start Finding" autofocus autocomplete="off">
						<div id="searchButtonContainer">
							<input id="searchButton" type="submit" value="search" name="search">
							<div id="warningButton" onclick="checkLength()"></div>
						</div>
						<p>Search the database via name or id</p>
					</form>
				</div>
			</div>
<!--- NOT END OF FILE. NEED TO INCLUDE --->
