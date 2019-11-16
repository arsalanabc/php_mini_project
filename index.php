<?php

require("controller/Registration.php");
require("config/db_config.php");

if(isset($_POST["submit"])){
	$registration = new Registration($conn);
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Mini Project</title>
</head>
<body>

<div>
	<h3>welcome to my mini project </h3> 
	<p>Please login below </p>
</div>

<div id="login">
	<form method="post" action="">
		<label> Username</label>
		<input type="text" name="username" required>
		<br>
		<br>
		<label> Password</label>
		<input type="Password" name="password" required>
		<br>
		<br>
		<input type="submit" name="submit">
	</form>
</div>

</body>
</html>
