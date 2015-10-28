<!DOCTYPE html>
	<html>
	<head>
		<title>Movie Information</title>
		<style type="text/css">
		</style>
	</head>	
	<body bgcolor="#FFFFAA">

	<?php
	if ($_SERVER["REQUEST_METHOD"] == "GET") {
		$keyword = $_GET['keyword'];
		$db_connection = mysql_connect("localhost:1432", "cs143", ""); 
		mysql_select_db("CS143",$db_connection);

		echo "-- Show Movie Info --";
		echo "<br>";

		$actorInfoQuery = "SELECT * FROM Movie WHERE id = '".$_GET['mid']."';";

		$rs = mysql_query($actorInfoQuery,$db_connection);
		$row = mysql_fetch_array($rs);
		$title = "Title: ".$row[1]."(".$row[2].")";
		$producer = "Producer: ".$row[4];
		$rating = "MPAA Rating: ".$row[3];

		echo $title;
		echo "<br/>";
		 		echo $producer;
		echo "<br/>";
				echo $rating;
		echo "<br/>";

		#show director info
		echo "Director: ";
		echo "<font color='Green'>";		
		$director = "";
		$directorQuery = "SELECT DISTINCT * FROM MovieDirector WHERE mid = '".$_GET['mid']."';";
		$rs = mysql_query($directorQuery,$db_connection);
		while ($row = mysql_fetch_array($rs)) {
			$movieQuery = "SELECT * FROM Director WHERE id = '".$row[1]."';";
			$subrs = mysql_query($movieQuery,$db_connection);
			$subrow = mysql_fetch_array($subrs);
			$text = $subrow[2]." ".$subrow[1] . " (". $subrow[3] . ")";
			if(strlen($director) != 0)
				$director = $director . ", ";
			$director = $director . $text;
			mysql_free_result($subrs);
		}
		echo $director;
		echo "</font>";
		echo "<br/>";
		

		#show genre info
		echo "Genre: ";
		echo "<font color='Brown'>";		
		$genre = "";
		$genreQuery = "SELECT * FROM MovieGenre WHERE mid = '".$_GET['mid']."';";
		$rs = mysql_query($genreQuery,$db_connection);
		while ($row = mysql_fetch_array($rs)) {
			if(strlen($genre) != 0)
				$genre = $genre . ", ";
			$genre = $genre . $row[1];
		}
		echo $genre;
		echo "</font>";
		echo "<br/>";

		#Actor in this movie
		echo "<br/>";
		echo "-- Actor in this movie --";
		echo "<br/>";
		$actorInQuery = "SELECT DISTINCT * FROM MovieActor WHERE mid = '".$_GET['mid']."';";
		$rs = mysql_query($actorInQuery,$db_connection);
		while ($row = mysql_fetch_array($rs)) {
			$actorQuery = "SELECT * FROM Actor WHERE id = '".$row[1]."';";
			$subrs = mysql_query($actorQuery,$db_connection);
			$subrow = mysql_fetch_array($subrs);


			$text = $subrow[2]." ".$subrow[1];
			echo "<a href='showActorInfo.php?aid=".$subrow[0]."'>".$text."</a>";
			echo " act as \"".$row[2]."\"";
			echo "<br/>";
			mysql_free_result($subrs);
		}


	#user review	
	echo "<br/>";
	echo "-- User Review --";
	echo "<br/>";

	$ratingQuery = "SELECT AVG(rating),COUNT(*) FROM Review WHERE mid = '".$_GET['mid'] . "';";
	$rs = mysql_query($ratingQuery,$db_connection);
	$row = mysql_fetch_array($rs);
	if($row[1] > 0)
		echo "Average Score: " .$row[0]. "/5 (5.0 is best) by ".$row[1]. "reviews(s)";
	else
		echo "Average Score: (Sorry, none review this movie)";

	echo "<a href='addComment.php?mid=".$_GET['mid']."'> Add your review now!! </a>";
	echo "<br/>";
	echo "All Comments in Details:";
	echo "<br/>";


		mysql_free_result($rs);
		mysql_close($db_connection);

	}
	?>			
		<hr/>
		<!-- Search Box -->
                Search for other actors/movies <form action="./search.php" method="GET">
                        Search: <input type="text" name="keyword"></input>
                        <input type="submit" value="Search"/>
                </form>


			</body>
</html>
