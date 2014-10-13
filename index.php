<?php
require("healthCalc.php");
require("database.php");

function getNutritionalData($company) {
	$url = "https://api.nutritionix.com/v1_1/search";    
	$content = '{
	  "appId":"5d908eb9",
	  "appKey":"f41227af7afccf61abd50fe1828819b5",  
	  "query":"' . $company . '",
	  "fields":["item_name", "nf_total_fat", "nf_saturated_fat", "nf_cholesterol", "nf_sodium", "nf_total_carbohydrate", "nf_dietary_fiber", "nf_protein"],
	  "sort":{
		"field":"item_name",
		"order":"desc"
	  }
	}';

	$curl = curl_init($url);
	curl_setopt($curl, CURLOPT_HEADER, false);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_HTTPHEADER,
			array("Content-type: application/json"));
	curl_setopt($curl, CURLOPT_POST, true);
	curl_setopt($curl, CURLOPT_POSTFIELDS, $content);

	$json_response = curl_exec($curl);

	$status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

	if ( $status != 200 ) {
		die("Error: call to URL $url failed with status $status, response $json_response, curl_error " . curl_error($curl) . ", curl_errno " . curl_errno($curl));
	}

	curl_close($curl);
	$response = json_decode($json_response, true);
	
	$returnArray = array($company);
	foreach($response["hits"] as $item){
		$tempArray = array($item["fields"]["item_name"], $item["fields"]["nf_total_fat"], $item["fields"]["nf_saturated_fat"], $item["fields"]["nf_cholesterol"], $item["fields"]["nf_sodium"], $item["fields"]["nf_total_carbohydrate"], $item["fields"]["nf_dietary_fiber"], $item["fields"]["nf_protein"]);
		array_push($returnArray, $tempArray);
	}
	return $returnArray;
}

//storeHealth(getNutritionalData("subway"), calcDv(getNutritionalData("subway")), connectDB());
//storeHealth(getNutritionalData("burger king"), calcDv(getNutritionalData("burger king")), connectDB());
//storeHealth(getNutritionalData("applebees"), calcDv(getNutritionalData("applebees")), connectDB());
?>
