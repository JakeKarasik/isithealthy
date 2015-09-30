<?php 
	
function connectDB() {
	$mysql_host = "mysql12.000webhost.com";
	$mysql_database = "*****";
	$mysql_user = "*****";
	$mysql_password = "******";
	$connection = mysqli_connect($mysql_host,$mysql_user,$mysql_password,$mysql_database);

	// Check connection
	if (!$connection){
		die("Failed to connect to MySQL: " . mysqli_connect_error());
	} else {
		return $connection;
	}
}
	
function storeOverall($restaurant, $food, $tasteRating, $healthRating) {

	mysqli_query($connection, "REPLACE INTO `a7385706_health`.`dataTable` (`restaurant` ,`food` ,`tasteRating` ,`healthRating`) VALUES ('$restaurant', '$food', '$tasteRating', '$healthRating')");
	mysqli_close($connection);
}
function storeTaste($restaurant, $food, $ratingT, $conn) {
	
	mysqli_query($conn, "REPLACE INTO `a7385706_health`.`taste` (`restaurant` ,`food` ,`rating`) VALUES ('$restaurant', '$food', '$ratingT')");
	mysqli_close($conn);
}
function storeHealth($dataArray, $rating, $conn) {
	for ($i=1;$i<count($dataArray);$i++) {
		$restaurant = $dataArray[0];
		$food = $dataArray[$i][0];
		$total_fat = $dataArray[$i][1];
		$saturated_fat = $dataArray[$i][2];
		$cholesterol = $dataArray[$i][3];
		$sodium = $dataArray[$i][4];
		$total_carbohydrate = $dataArray[$i][5];
		$dietary_fiber = $dataArray[$i][6];
		$protein = $dataArray[$i][7];
		$theRating = $rating[$i-1];
		
		mysqli_query($conn, "REPLACE INTO `a7385706_health`.`health` (`restaurant` ,`food` ,`rating` ,`total_fat` ,`saturated_fat` ,`cholesterol` ,`sodium` ,`total_carbohydrate` ,`dietary_fiber` ,`protein`) VALUES ('$restaurant','$food', '$theRating', '$total_fat', '$saturated_fat', '$cholesterol', '$sodium', '$total_carbohydrate', '$dietary_fiber', '$protein')");
	}

	mysqli_close($conn);
}

?>
