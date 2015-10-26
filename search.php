<!DOCTYPE html>
	<html>
	<head>
		<title>Search Actor / Movie</title>
		<style type="text/css">
		</style>
	</head>	
	<body bgcolor="#FFFFAA">
			
		Search for actors/movies
	  	<form method="get" action="<?php echo $_SERVER['PHP_SELF'];?>">
			Search: <input type="text" name="keyword"></input>
			<input type="submit" value="Search"/>
		</form>
		<hr/>
	<?php
   	if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $keyword = $_GET['keyword'];
    echo "<br>";
	}
	?>
	</body>
</html>
