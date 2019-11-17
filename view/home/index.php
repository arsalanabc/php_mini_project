<?php

require_once("../../ENV.php");
require_once BASE_PATH."/config/db_config.php";
require(BASE_PATH."/controller/HomeController.php");

$home_controller = new HomeController($conn);
$data = $home_controller->index();

if(isset($_POST['add_restaurant'])){
    var_dump($_POST);
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Mini Project</title>
</head>
<body>

<div>
    <h3>Hello <? echo $data->getUsername();?>, welcome to my mini project </h3>
</div>

<div id="restaurant-view">
    <form method="post" name="add_restaurant" action="<?php echo $_SERVER['PHP_SELF'];?>">
        <label> Name</label>
        <input type="text" name="restaurant_name" required>
        <br>
        <br>
        <label> Review </label>
        <textarea type="text" name="review" required></textarea>
        <br>
        <input type="submit" name="add_restaurant">
    </form>
</div>

</body>
</html>
