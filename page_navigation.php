<?php
	echo "<ul>";
		if ($Page != 1) { //Display previous button only if not on first page
			echo "<li class='pageList'><a href='".$link_search."&Page=".($Page-1)."'>Previous</a></li>";
		}
		if ($total_pages <= 10) {
			for ($i = 1; $i <= $total_pages; $i++) {
				echo "<li class='pageList'><a href='".$link_search."&Page=".$i."'>".$i."</a></li>";
			}
		}
		else if ($Page <= 6) {
			for ($i = 1; $i <= 10; $i++) {
				echo "<li class='pageList'><a href='".$link_search."&Page=".$i."'>".$i."</a></li>";
			}
		}
		else if ($Page >= ($total_pages - 6)) {
			for ($i = ($total_pages - 10); $i <= $total_pages; $i++) {
				echo "<li class='pageList'><a href='".$link_search."&Page=".$i."'>".$i."</a></li>";
			}
		}
		else {
			for ($i = ($Page - 5); $i < ($Page + 5); $i++) {
				echo "<li class='pageList'><a href='".$link_search."&Page=".$i."'>".$i."</a></li>";
			}
		}
		if ($Page != $total_pages) { //Display next button only if not on last page
			echo "<li class='pageList'><a href='".$link_search."&Page=".($Page+1)."'>Next</a></li>";
		}
	echo "</ul>";
?>