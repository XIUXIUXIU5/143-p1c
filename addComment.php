<!DOCTYPE html>
	<html>
	<head>
		<title>add actor / director</title>
		<style type="text/css">
		</style>
	</head>	
	<body bgcolor="#FFFFAA">
				Add new comment: <br/>
		<form action="./addComment.php" method="GET">			
					<?php
		$db_connection = mysql_connect("localhost:1432", "cs143", ""); 
		mysql_select_db("CS143",$db_connection);
		$movieNameQuery = "SELECT * FROM Movie WHERE id = '".$_GET['mid']."';";
		$rs = mysql_query($movieNameQuery,$db_connection);

		echo "Movie : <select name=mid>";
		while ($row = mysql_fetch_array($rs)) {
			echo "<option value='" . $row['0'] . "'>" . $row[1] . "(" . $row[2] . ")" . "</option>";
		}
		echo "</select>";

		mysql_free_result($rs);
		mysql_close($db_connection);

		?>		
			Your Name:	<input type="text" name="yourname" value="Mr. Anonymous" maxlength="20"><br/>
			Rating:	<select name="rating">
						<option value="5"> 5 - Excellent </option>
						<option value="4"> 4 - Good </option>
						<option value="3"> 3 - It's ok~ </option>
						<option value="2"> 2 - Not worth </option>
						<option value="1"> 1 - I hate it </option>
					</select>
			<br/>
			Comments: <br/>
			<textarea name="comment" cols="80" rows="10"></textarea>
			<br/>
			<input type="submit" value="Rate it!!"/>
		</form>
		<hr/>
				
<?php
if ($_SERVER["REQUEST_METHOD"] == "GET" && !is_null($_GET['yourname'])) {

	$db_connection = mysql_connect("localhost:1432", "cs143", ""); 
	mysql_select_db("CS143",$db_connection);
	$today = date("Y-m-d H:i:s");
	$addComment = "INSERT INTO Review(name, time, mid, rating, comment) VALUES ('".$_GET['yourname']."','".$today."','".$_GET['mid']."','".$_GET['rating']."','".$_GET['comment']."');";
	$rs = mysql_query($addComment, $db_connection);

		if ($rs) {
		echo "<font color='Red'><b>Thanks your comment!! We appreciate it!!</b></font><br/><a href = './showMovieInfo.php?mid= ".$_GET['mid']."'>See Movie Info (including others' reviews)</a><hr/>	";	
		}
		else {
			echo "failed to add";
		}
	
	mysql_free_result($rs);
	mysql_close($db_connection);
}
?>
	</body>
</html>
