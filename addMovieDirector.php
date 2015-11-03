<!DOCTYPE html>
<html>
<head>
	<title>Add a director to a movie</title>
	<style type="text/css">
	</style>
</head>	
<body bgcolor="#FFFFAA">
	Add new director to a movie: <br/>
	<form method="get" action="<?php echo $_SERVER['PHP_SELF'];?>">
		<?php
		$db_connection = mysql_connect("localhost:1432", "cs143", ""); 
		mysql_select_db("CS143",$db_connection);

		$rs = mysql_query("SELECT * FROM Movie;",$db_connection);

		echo "Movie : <select name=mid>";
		while ($row = mysql_fetch_array($rs)) {
			echo "<option value='" . $row['0'] . "'>" . $row[1] . "(" . $row[2] . ")" . "</option>";
		}
		echo "</select>";

		mysql_free_result($rs);
		mysql_close($db_connection);

		?>		

		<br/>		
		
		<?php
		$db_connection = mysql_connect("localhost:1432", "cs143", ""); 
		mysql_select_db("CS143",$db_connection);

		$rs = mysql_query("SELECT * FROM Director ORDER BY first ASC;",$db_connection);

		echo "Director : <select name=did>";
		while ($row = mysql_fetch_array($rs)) {
			echo "<option value='" . $row['0'] . "'>" . $row[2] ." ". $row[1] . "(" . $row[3] . ")" . "</option>";
		}
		echo "</select>";

		mysql_free_result($rs);
		mysql_close($db_connection);

		?>		
	</select>
	<br/>	
	<input type="submit" value="Add it!!"/>
</form>
<hr/>

<?php
if ($_SERVER["REQUEST_METHOD"] == "GET" && !is_null($_GET['mid'])) {

	$db_connection = mysql_connect("localhost:1432", "cs143", ""); 
	mysql_select_db("CS143",$db_connection);

	$checkQuery = "SELECT * FROM MovieDirector WHERE mid = '" . $_GET['mid'] . "' AND did = '" . $_GET['did']."';";
	$rs = mysql_query($checkQuery, $db_connection);
	$row = mysql_fetch_array($rs);
	if($row)
		echo "This relationship has been added already";
	else {
		$addQuery = "INSERT INTO MovieDirector(mid, did) VALUES (" . "'" . $_GET['mid'] ."'".","."'".$_GET['did']."');";
		$rs = mysql_query($addQuery, $db_connection);
		if ($rs) 
			echo "successfully added";
		else {
			echo "failed to add";
			echo "<br/>";
			echo mysql_error();
		}
	}
	mysql_free_result($rs);
	mysql_close($db_connection);
}
?>


</body>
</html>

