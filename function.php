<?php

	$database = "if17_tanjak";
	
	function saveFood($food, $price) {
		$mysqli = new mysqli($GLOBALS["serverHost"], 
		$GLOBALS["serverUsername"], 
		$GLOBALS["serverPassword"], 
		$GLOBALS["database"]);
		
		$stmt = $mysqli->prepare("INSERT INTO efood (food, price) VALUE (?, ?)");
		echo $mysqli->error;
		
		$stmt->bind_param("ss", $food, $price);
	
		if ( $stmt->execute() ) {
		} else {
			echo "ERROR ".$stmt->error;
		}
	}