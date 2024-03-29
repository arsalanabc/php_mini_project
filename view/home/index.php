<?php
require_once("../../ENV.php");
require_once BASE_PATH."/config/Database.php";
require(BASE_PATH."/controller/HomeController.php");

$conn = new Database();
$home_controller = new HomeController($conn->get_connection());
$data = $home_controller->index($_POST);

$user = $data['user'];
$restaurants = $data['restaurants'];


?>
<!DOCTYPE html>
<html>
<head>
    <title>Mini Project</title>
    <title>jQuery UI Autocomplete - Default functionality</title>
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#restaurant_name" ).autocomplete({
      source: <? echo json_encode($data['restaurant_names'])?>
    });
  } );
  </script>
</head>
<body>

<div>
    <h3>Hello <?php echo $user->get_username();?>, welcome to my mini project
        <form method="post" action="">
            <input type="submit" name="logout" value="logout"/>
        </form>
    </h3>
</div>

<div id="restaurant-view">
    <form method="post" name="add_restaurant" action="<?php echo $_SERVER['PHP_SELF'];?>">
        <label> Name</label>
        <input type="text" name="restaurant_name" id="restaurant_name" required>
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
        <div><?php echo "Name: ".$restaurant->get_name();?></div>
            <?php foreach($restaurant->get_reviews() as $review){?>
                <div><?php echo "Review: ".$review->get_content()." posted at ".$review->get_timestamp();?></div>

            <?php }?></div>
    <br>
    <?php }?></div>
</body>
</html>
