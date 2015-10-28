<!DOCTYPE html>
<html>
	<head>
		<title>Actor Information</title>
		<style type="text/css">
		</style>
	</head>	
	<body bgcolor="#FFFFAA">
				
	<?php
	if ($_SERVER["REQUEST_METHOD"] == "GET") {
		$keyword = $_GET['keyword'];
		$db_connection = mysql_connect("localhost:1432", "cs143", ""); 
		mysql_select_db("CS143",$db_connection);

		echo "-- Show Actor Info -- ";
		echo "<br>";

		$actorInfoQuery = "SELECT * FROM Actor WHERE id = '".$_GET['aid']."';";

		$rs = mysql_query($actorInfoQuery,$db_connection);
		$row = mysql_fetch_array($rs);
		$name = "Name: ".$row[2]." ".$row[1];
		$sex = "Sex: ".$row[3];
		$dob = "Date of Birth: ".$row[4];
		$dod = "Date of Death: ".$row[5];
		if($row[5] == "")
		{
			$dod = "Date Of Death: --Still Alive--";
		}
		echo $name;
		echo "<br/>";
		 		echo $sex;
		echo "<br/>";
				echo $dob;
		echo "<br/>";
				echo $dod;
		echo "<br/>";

		#Act In
				echo "<br/>";

		echo "-- Act in -- ";
		echo "<br/>";

		$actinQuery = "SELECT * FROM MovieActor WHERE aid = '".$_GET['aid']."';";
		$rs = mysql_query($actinQuery,$db_connection);
		while ($row = mysql_fetch_array($rs)) {
			echo "Act \"".$row[2]."\" in ";
			$movieQuery = "SELECT * FROM Movie WHERE id = '".$row[0]."';";
			$subrs = mysql_query($movieQuery,$db_connection);
			$subrow = mysql_fetch_array($subrs);
			$text = $subrow[1]."(".$subrow[2] . ")";
			echo "<a href='showMovieInfo.php?aid=".$subrow[0]."'>".$text."</a>";
			echo "<br/>";
			mysql_free_result($subrs);
		}

		mysql_free_result($rs);
		mysql_close($db_connection);

	}
	?>
	<br/>
				<hr/>

                Search for other actors/movies <form action="./search.php" method="GET">
                        Search: <input type="text" name="keyword"></input>
                        <input type="submit" value="Search"/>
                </form>

			</body>
</html>