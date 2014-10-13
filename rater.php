<?php 
require("database.php");	
$restaurant = $_POST['restaurant'];
$food = $_POST['food'];
$ratingT = $_POST['rating'];
storeTaste($restaurant, $food, $ratingT, connectDB());
?>