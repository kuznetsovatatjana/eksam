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
	
	//naitab yhe food name
	
		function getSingleId($show_id){
		
		$mysqli = new mysqli($GLOBALS["serverHost"], 
		$GLOBALS["serverUsername"], 
		$GLOBALS["serverPassword"], 
		$GLOBALS["database"]);
		
		$stmt = $mysqli->prepare("
		SELECT id, food, price
		FROM efood 
		WHERE id = ?");
		
		$stmt->bind_param("i", $show_id);
		$stmt->bind_result($id, $food , $price);
		$stmt->execute();
		$finish = new Stdclass();
		
		if($stmt->fetch()){
			$finish->id = $id;
			$finish->food = $food;
			$finish->price = $price;
		
		}else{
			header("Location: onefood.php");
			exit();
		}
		
		$stmt->close();
		
		return $finish;	
	}
	
	//UUENDA POSTITUSE
		function updateFood($food, $price){
		$mysqli = new mysqli($GLOBALS["serverHost"],
		$GLOBALS["serverUsername"],
		$GLOBALS["serverPassword"],
		$GLOBALS["database"]);
		
		$stmt = $mysqli->prepare("UPDATE efood SET food=?, price=? WHERE id=?");
		$stmt->bind_param("ssi", $food, $price, $_GET["id"]);
		if($stmt->execute()){
			header("Location: onefood.php?id=". $_GET["id"]."&success=true");
		}
		$stmt->close();
		$mysqli->close();	
	}
	
	//clean input
	function cleanInput($input) {
		$input = trim($input);
		$input = stripslashes($input);
		$input = htmlspecialchars($input);
		return $input;
	}
	
	//toitu kustutamine
	function deleteFood($id){	
		$mysqli = new mysqli($GLOBALS["serverHost"], 
		$GLOBALS["serverUsername"], 
		$GLOBALS["serverPassword"], 
		$GLOBALS["database"]
		);		
		
		$stmt = $mysqli->prepare("
		DELETE from efood WHERE id=?");
		$stmt->bind_param("i", $id);
		if($stmt->execute()){
		}
		$stmt->close();	
	}
	
?>