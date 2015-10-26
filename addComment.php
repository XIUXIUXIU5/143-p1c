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
			Movie:	<select name="mid">
					<option value="2632" selected="selected">Matrix, The(1999)</option>
					</select>
			<br/>
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
				
	</body>
</html>
