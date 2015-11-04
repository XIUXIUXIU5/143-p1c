<!DOCTYPE html>
<html>
<head>
	<title>add new movie</title>
	<style type="text/css">
	</style>
</head>	
<body bgcolor="#FFFFAA">
	Add new movie: <br/>
	<form method="get" action="<?php echo $_SERVER['PHP_SELF'];?>">
		Title : <input type="text" name="title" maxlength="20"><br/>
		Company: <input type="text" name="company" maxlength="50"><br/>
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
	Genre : 
	<input type="checkbox" name="genre_Action" value="Action">Action</input>
	<input type="checkbox" name="genre_Adult" value="Adult">Adult</input>
	<input type="checkbox" name="genre_Adventure" value="Adventure">Adventure</input>
	<input type="checkbox" name="genre_Animation" value="Animation">Animation</input>
	<input type="checkbox" name="genre_Comedy" value="Comedy">Comedy</input>
	<input type="checkbox" name="genre_Crime" value="Crime">Crime</input>
	<input type="checkbox" name="genre_Documentary" value="Documentary">Documentary</input>
	<input type="checkbox" name="genre_Drama" value="Drama">Drama</input>
	<input type="checkbox" name="genre_Family" value="Family">Family</input>
	<input type="checkbox" name="genre_Fantasy" value="Fantasy">Fantasy</input>
	<input type="checkbox" name="genre_Horror" value="Horror">Horror</input>
	<input type="checkbox" name="genre_Musical" value="Musical">Musical</input>
	<input type="checkbox" name="genre_Mystery" value="Mystery">Mystery</input>
	<input type="checkbox" name="genre_Romance" value="Romance">Romance</input>
	<input type="checkbox" name="genre_Sci-Fi" value="Sci-Fi">Sci-Fi</input>
	<input type="checkbox" name="genre_Short" value="Short">Short</input>
	<input type="checkbox" name="genre_Thriller" value="Thriller">Thriller</input>
	<input type="checkbox" name="genre_War" value="War">War</input>
	<input type="checkbox" name="genre_Western" value="Western">Western</input>
	<br/>
	<input type="submit" value="Add it!!"/>
</form>
<hr/>

<?php
if ($_SERVER["REQUEST_METHOD"] == "GET" && !is_null($_GET['title'])) {
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
	$_title = mysql_real_escape_string($_GET['title']);
	$_company = mysql_real_escape_string($_GET['company']);

	$attributes = array(strval($newID),$_title,$_GET['year'],$_GET['mpaarating'],$_company);

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

$rs = mysql_query($addQuery, $db_connection);
if ($rs) {
	echo "successfully added";

	$genres = array($_GET['genre_Action'] ,
		$_GET['genre_Adult'] ,
		$_GET['genre_Adventure'] ,
		$_GET['genre_Animation'] ,
		$_GET['genre_Comedy'] ,
		$_GET['genre_Crime'] ,
		$_GET['genre_Documentary'] ,
		$_GET['genre_Drama'] ,
		$_GET['genre_Family'] ,
		$_GET['genre_Fantasy'] ,
		$_GET['genre_Horror'],
		$_GET['genre_Musical'],
		$_GET['genre_Mystery'],
		$_GET['genre_Romance'],
		$_GET['genre_Sci-Fi'],
		$_GET['genre_Short'],
		$_GET['genre_Thriller'],
		$_GET['genre_War'],
		$_GET['genre_Western'],);

	$genreQueries = array();
	for ($i=0; $i < count($genres); $i++) { 
		if($genres[$i] != "")
		{
			$query = "INSERT INTO MovieGenre(mid, genre) VALUES ( '" . $newID . "'," . "'". $genres[$i] . "');";
			array_push($genreQueries,$query);
		}
	}

	//var_dump($genreQueries);

	for ($i=0; $i < count($genreQueries); $i++) { 
		$rs = mysql_query($genreQueries[$i],$db_connection);
	}
}
else {
	echo "failed to add";
	echo "<br/>";
	echo mysql_error();
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
