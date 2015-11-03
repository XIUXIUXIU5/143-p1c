<!DOCTYPE html>
<html>
<head>
	<title>add actor / director</title>
	<style type="text/css">
	</style>
</head>	
<body bgcolor="#FFFFAA">
	Add new actor/director: <br/>
	<form method="get" action="<?php echo $_SERVER['PHP_SELF'];?>">
		Identity:	<input type="radio" name="identity" value="Actor" checked="true">Actor
		<input type="radio" name="identity" value="Director">Director<br/>
		<hr/>
		First Name:	<input type="text" name="first" maxlength="20"><br/>
		Last Name:	<input type="text" name="last" maxlength="20"><br/>
		Sex:		<input type="radio" name="sex" value="Male" checked="true">Male
		<input type="radio" name="sex" value="Female">Female<br/>

		Date of Birth:	<input type="text" name="dob"><br/>
		Date of Die:	<input type="text" name="dod"> (leave blank if alive now)<br/>
		<input type="submit" value="add it!!"/>
	</form>
	<hr/>

	<?php
	if ($_SERVER["REQUEST_METHOD"] == "GET" && !is_null($_GET['identity'])) {

		$db_connection = mysql_connect("localhost:1432", "cs143", ""); 
		mysql_select_db("CS143",$db_connection);

	#Get MaxID First
		$rs = mysql_query("SELECT id FROM MaxPersonID;",$db_connection);
		$row = mysql_fetch_row($rs);
		$newID = intval($row[0])+1;
		$updateIDQuery = "UPDATE MaxPersonID SET id = " . strval($newID) . " WHERE id = " . strval($newID-1) . ";";
		$rs = mysql_query($updateIDQuery, $db_connection);
		if (!$rs) {
			echo "fail to create id";
		}

	#Get All the attributes
		$identity = $_GET['identity'];
		$attributes = array(strval($newID),$_GET['last'],$_GET['first'],$_GET['sex'],$_GET['dob'],$_GET['dod']);

    #Set Empty String to NULL & add ' to each attribute
		for ($i=0; $i < count($attributes); $i++) { 
			if(($attributes[$i]) == "") {
				$attributes[$i] = "NULL";
			}
			else 
				$attributes[$i] = "'" . $attributes[$i] . "'";
		}

    #Create Query
		$addQuery = "";
		if($identity == "Actor") {
			$addQuery = "INSERT INTO Actor (id, last, first, sex, dob, dod) VALUES (";
				for ($i=0; $i < count($attributes); $i++) { 
					$addQuery = $addQuery . $attributes[$i];
					if ($i < count($attributes) - 1) {
						$addQuery = $addQuery . ",";
					}
				}
				$addQuery = $addQuery . ");";
}

else if($identity == "Director") {
	$addQuery = "INSERT INTO Director (id, last, first, dob, dod) VALUES (";
		for ($i=0; $i < count($attributes); $i++) { 
			if ($i != 3) #get rid of sex attribute
			{
				$addQuery = $addQuery . $attributes[$i];
				if ($i < count($attributes) - 1) {
					$addQuery = $addQuery . ",";
				}			
			}
		}
		$addQuery = $addQuery . ");";
}

$rs = mysql_query($addQuery, $db_connection);
if ($rs) 
	echo "successfully added";
else {
	echo "failed to add";
	echo "<br/>";
	echo mysql_error();
	#revert max id if failed
	$updateIDQuery = "UPDATE MaxPersonID SET id = " . strval($newID-1) . " WHERE id = " . strval($newID) . ";";
	$rs = mysql_query($updateIDQuery, $db_connection);
}
mysql_free_result($rs);
mysql_close($db_connection);
}
?>

</body>
</html>
