<?php

require_once("ENV.php");
require("controller/Registration.php");
require_once("config/db_config.php");

if(isset($_POST["submit"])){
	$registration = new Registration($conn);
	$registration->login($_POST["username"],$_POST["password"]);
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
	<?php echo Registration::sign_up_message();?>
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
