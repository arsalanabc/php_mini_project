<?php

require_once("ENV.php");
require("controller/Registration.php");
require_once("config/db_config.php");

if(isset($_POST["submit"])){
	$registration = new Registration($conn);
    $response = $registration->login($_POST["email"], $_POST["password"]);
    if($response){
        foreach ($response as $error){
            if($error != null){echo "<p style='color: red'>*".$error."</p>";}
        }
    }
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
	<form method="post" name="login_form" action="">
		<label> Email</label>
		<input type="email" name="email" required>
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
