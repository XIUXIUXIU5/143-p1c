<!DOCTYPE html>
	<html>
	<head>
		<title>add actor / director</title>
		<style type="text/css">
		</style>
	</head>	
	<body bgcolor="#FFFFAA">
				Add new actor/director: <br/>
		<form action="./addActorDirector.php" method="GET">
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
				
	</body>
</html>
