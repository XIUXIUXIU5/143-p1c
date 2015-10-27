<!DOCTYPE html>
	<html>
	<head>
		<title>add new movie</title>
		<style type="text/css">
		</style>
	</head>	
	<body bgcolor="#FFFFAA">
				Add new movie: <br/>
		<form action="./addMovieInfo.php" method="GET">			
			Title : <input type="text" name="title" maxlength="20"><br/>
			Compnay: <input type="text" name="company" maxlength="50"><br/>
			Year : <input type="text" name="year" maxlength="4"><br/>	<!-- Todo: validation-->	
			MPAA Rating : <select name="mpaarating">
					<option value="G">G</option>
					<option value="NC-17">NC-17</option>
					<option value="PG">PG</option>
					<option value="PG-13">PG-13</option>
					<option value="R">R</option>
					<option value="surrendere">surrendere</option>
			</select>		
			<br/>
			<input type="submit" value="Add it!!"/>
		</form>
	<hr/>


	<?php
   	if ($_SERVER["REQUEST_METHOD"] == "GET") {

	$db_connection = mysql_connect("localhost:1432", "cs143", ""); 
	mysql_select_db("CS143",$db_connection);

	#Get MaxID First
    $rs = mysql_query("SELECT id FROM MaxMovieID;",$db_connection);
	$row = mysql_fetch_row($rs);
	$newID = intval($row[0])+1;
	$updateIDQuery = "UPDATE MaxMovieID SET id = " . strval($newID) . " WHERE id = " . strval($newID-1) . ";";
	$rs = mysql_query($updateIDQuery, $db_connection);
	if (!$rs) {
		echo "fail to create id";
	}

	#Get All the attributes
	$attributes = array(strval($newID),$_GET['title'],$_GET['year'],$_GET['mpaarating'],$_GET['company']);
	var_dump($attributes);

    #Set Empty String to NULL & add ' to each attribute
    for ($i=0; $i < count($attributes); $i++) { 
    	if(($attributes[$i]) == "") {
    		$attributes[$i] = "NULL";
    	}
    	else 
    		$attributes[$i] = "'" . $attributes[$i] . "'";
    }

    #Create Query
	$addQuery = "INSERT INTO Movie (id, title, year, rating, company) VALUES (";
	for ($i=0; $i < count($attributes); $i++) { 
		$addQuery = $addQuery . $attributes[$i];
		if ($i < count($attributes) - 1) {
			$addQuery = $addQuery . ",";
		}
	}
	$addQuery = $addQuery . ");";
	
	var_dump($addQuery);
	
	$rs = mysql_query($addQuery, $db_connection);
	if ($rs) 
		echo "successfully added";
	else {
		echo "failed to add";
		#revert max id if failed
		$updateIDQuery = "UPDATE MaxMovieID SET id = " . strval($newID-1) . " WHERE id = " . strval($newID) . ";";
		$rs = mysql_query($updateIDQuery, $db_connection);
	}
    mysql_free_result($rs);
    mysql_close($db_connection);
	}
	?>
				
	</body>
</html>
