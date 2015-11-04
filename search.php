<!DOCTYPE html>
<html>
<head>
	<title>Search Actor / Movie</title>
	<style type="text/css">
	</style>
</head>	
<body bgcolor="#FFFFAA">

	Search for actors/movies
	<form action="./search.php" method="GET">		
		Search: <input type="text" name="keyword"></input>
		<input type="submit" value="Search"/>
	</form>
	<hr/>
	<?php
	if ($_SERVER["REQUEST_METHOD"] == "GET" && !is_null($_GET['keyword'])) {
		$keyword = $_GET['keyword'];
		$db_connection = mysql_connect("localhost:1432", "cs143", ""); 
		mysql_select_db("CS143",$db_connection);

		
		echo "You are searching [".$keyword."] results...";
		echo "<br>";
		echo "<br>";

		echo "Searching match records in Actor database ... ";
		echo "<br>";

		$_keyword = mysql_real_escape_string($keyword);
		$actorQuery = "SELECT * FROM Actor A WHERE CONCAT(first,' ',last) LIKE '%".$_keyword."%' ORDER BY first ASC ;";

		$rs = mysql_query($actorQuery,$db_connection);

		while ($row = mysql_fetch_array($rs)) {
			echo "Actor: ";
			$text = $row[2]." ".$row[1] . "(".$row[4] . ")";
			echo "<a href='showActorInfo.php?aid=".$row[0]."'>".$text."</a>";
			echo "<br/>";
		}

		echo "<br/>";
		echo "Searching match records in Movie database ... ";

		
		$movieQuery = "SELECT * FROM Movie WHERE title LIKE '%". $_keyword."%' ORDER BY title ASC";
		echo "<br>";

		$rs = mysql_query($movieQuery,$db_connection);

		while ($row = mysql_fetch_array($rs)) {
			echo "Movie: ";
			$text = $row[1]."(".$row[2] . ")";
			echo "<a href='showMovieInfo.php?mid=".$row[0]."'>".$text."</a>";
			echo "<br/>";
		}


		mysql_free_result($rs);
		mysql_close($db_connection);

	}
	?>
</body>
</html>
