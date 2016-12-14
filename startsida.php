<!doctype html>
<html>
	<head>
		<title>Lego DB searcher 2000</title>
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700" rel="stylesheet">
		<link href="utseende.css" rel="stylesheet" type="text/css"/>
		<script src="searchtab.js"></script>
		<script src="validator.js"></script>
		<link href="utseende_search_bitar.css" rel="stylesheet" type="text/css"/>
		<link href="utseende.css" rel="stylesheet" type="text/css"/>
		<link href="animation.css" rel="stylesheet" type="text/css"/>
	</head>
	<body onload="tabColor()">
		<div class="colContainer">
			<div id="startContainerBG">
			</div>
			<div id="startContainer">
				<h1 id="startHeader">welcome to <span>Lego Database Finder<span></h1>
				<div id="searchBarContainer">
					<div id="searchTabContainer">
						<div id="searchBit" onclick="changeTab(this.id)">
							<h3>Part</h3>
						</div>
						<div id="searchSats" onclick="changeTab(this.id)">
							<h3>Sets</h3>
						</div>
					</div>
					<form action="search_bit.php" method="post">
						<h5 class="alertWarning">Search value must be longer than 3 characters</h5>
						<input type="text" placeholder="Type in a Piece Name to start Finding" name="keyword" id="keyword" onClick="runFunction()" onblur="intervalController('stop')">
						<input type="submit" value="search" name="search">
						<p>
							Specify your search after attributes like color or size
							<span>e.g corner piece ref 2x2</span>
						</p>
					</form>
				</div>
			</div>
<!--- NOT END OF FILE. NEED TO INCLUDE --->
