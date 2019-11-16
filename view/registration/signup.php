<?php
require_once '../../ENV.php';
require(BASE_PATH."/controller/Registration.php");
require_once(BASE_PATH."/config/db_config.php");

?>
<!DOCTYPE html>
<html>
<head>
    <title>Mini Project</title>
</head>
<body>

<div>
    <h3>welcome to my mini project </h3>
    <p>Please sign up below or login <a href="<?php echo SITE_URL."/index.php" ?>"> here </a> </p>
</div>

<div id="login">
    <form method="post" action="">
        <label> First Name</label>
        <input type="text" name="first_name" required>
        <br>
        <br>
        <label> Last Name</label>
        <input type="text" name="last_name" required>
        <br>
        <br>
        <label> Username</label>
        <input type="text" name="username" required>
        <br>
        <br>
        <label> Password</label>
        <input type="Password" name="password" required>
        <br>
        <br>
        <label> Email</label>
        <input type="email" name="email" required>
        <br>
        <br>
        <label> Confirm Password</label>
        <input type="Password" name="password_confirm" required>
        <br>
        <br>
        <input type="submit" name="submit">
    </form>
</div>

</body>
</html>
