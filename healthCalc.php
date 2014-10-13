<?php


//$lol = array('r',array('s',1,2,3,4,5,6,7),array('t',1,2,3,4,4,5,7));

//print_r(calcDv($lol));



//return suggest daily value
function nutValue(){
	$valueList = array(65,20,.3,2.4,300,25,50);
	return $valueList;
}

//calculates daily value percentage and outputs 
//array with food array and health
function calcDv($restFood){
	//array containing the food and its health
	$outPut = array();

	//the daily value percentage array
	$dV = array();

	//for each food in the restaurant grab its name and properties
	for($i = 1; $i < count($restFood); $i++){
		for($j = 1; $j < count($restFood[$i]); $j++){
			if(is_null($restFood[$i][$j])){
				$dV[$j-1]=0;
				continue;
			}

			$nuts = nutValue();
			$dV[$j-1] = round(($restFood[$i][$j]/($nuts[$j-1]))*100,2);

		}
		$health = calcHealth($dV);
		array_push($outPut,$health);
		//$dV = array();
	}
	
	return $outPut;
}

//calculates the health of a food
function calcHealth($dailyValueList){

	$dV=$dailyValueList;

	$sumHealth = 0;
		//goes through dail percentages
		foreach($dV as $dailyValue){
			//checks if dV is out of range
			if($dailyValue <= 5 || $dailyValue >= 15)
				//remove 1 for bad health
				$sumHealth = $sumHealth -1 ;
			
		}

		$roundValue=floor(($sumHealth + 7)*(5/7)*2)/2;
		if($roundValue == 0)
			$roundValue = 1;
	return $roundValue;
}

?>