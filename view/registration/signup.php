<?php
require_once '../../ENV.php';
require(BASE_PATH."/controller/Registration.php");
require_once(BASE_PATH."/config/db_config.php");

if(isset($_POST['submit'])){
    $reg = new Registration($conn);
    $response = $reg->signup($_POST);
    if($response['error']){
        foreach ($response['error'] as $error){
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
    <p>Please sign up below or login <a href="<?php echo SITE_URL."/index.php" ?>"> here </a> </p>
</div>

<div id="sign_up">
    <form method="post" name="signup_form" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
        <label> First Name</label>
        <input type="text" name="first_name" value="<?php echo $_POST['first_name'];?>" required>
        <br>
        <br>
        <label> Last Name</label>
        <input type="text" name="last_name" value="<?php echo $_POST['last_name'];?>" required>
        <br>
        <br>
        <label> Username</label>
        <input type="text" name="username" value="<?php echo $_POST['username'];?>" required>
        <br>
        <br>
        <label> Password</label>
        <input type="Password" name="password" required>
        <br>
        <br>
        <label> Confirm Password</label>
        <input type="Password" name="password_confirm" required>
        <br>
        <br>
        <label> Email</label>
        <input type="email" name="email" value="<?php echo $_POST['email'];?>" required>
        <br>
        <br>
        <input type="submit" name="submit">
    </form>
</div>

</body>
</html>
