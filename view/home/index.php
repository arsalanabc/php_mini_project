<?php
require_once("../../ENV.php");
require_once BASE_PATH."/config/db_config.php";
require(BASE_PATH."/controller/HomeController.php");

$home_controller = new HomeController($conn);
$data = $home_controller->index();

$user = $data['user'];
$restaurants = $data['restaurants'];

if(isset($_POST['add_restaurant'])){
    $home_controller->add_restaurant($_POST, $user);
}

if(isset($_POST['logout'])){
    $home_controller->logout();
}


?>
<!DOCTYPE html>
<html>
<head>
    <title>Mini Project</title>
</head>
<body>

<div>
    <h3>Hello <?php echo $user->getUsername();?>, welcome to my mini project
        <form method="post" action="">
            <input type="submit" name="logout" value="logout"/>
        </form>
    </h3>
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

<div>
<h3>Restaurants</h3>

    <?php foreach($restaurants as $restaurant){?>
        <div><?php echo "Name: ".$restaurant->getName();?></div>
            <?php foreach($restaurant->get_reviews() as $review){?>
                <div><?php echo "Review: ".$review->get_content()." posted at ".$review->get_timestamp();?></div>

            <?php }?></div>
    <br>
    <?php }?></div>
</body>
</html>
