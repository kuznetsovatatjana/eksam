<?php

	$database = "if17_tanjak";
	
	//SALVESTAN SOOKI
	function saveFood($food, $price) {
		$mysqli = new mysqli($GLOBALS["serverHost"], 
		$GLOBALS["serverUsername"], 
		$GLOBALS["serverPassword"], 
		$GLOBALS["database"]);
		
		$stmt = $mysqli->prepare("INSERT INTO efood (food, price) VALUE (?, ?)");
		echo $mysqli->error;
		
		$stmt->bind_param("si", $food, $price);
	
		if ( $stmt->execute() ) {
		} else {
			echo "ERROR ".$stmt->error;
		}
	}
	
	
	function getAllFood(){
		$mysqli = new mysqli($GLOBALS["serverHost"], 
		$GLOBALS["serverUsername"], 
		$GLOBALS["serverPassword"], 
		$GLOBALS["database"]);
		
		$stmt = $mysqli->prepare("
		SELECT id, food, price
		FROM efood
		");
		$stmt->bind_result($id, $food, $price);
		$stmt->execute();
		
		$results = array();
		
		while($stmt->fetch()) {
			
			$foods = new StdClass();
			$foods->id = $id;
			$foods->food = $food;
			$foods->price = $price;

			array_push($results, $foods);
			
		}
		return $results;	
	}
?>