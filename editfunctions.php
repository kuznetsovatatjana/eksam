<?php
	require_once("../vpconfig.php");
	
		//uhe toidu andmed
		function getSingleFoodData($edit_id){
    
        $database = "if17_tanjak";
		
		$mysqli = new mysqli($GLOBALS["serverHost"], 
		$GLOBALS["serverUsername"], 
		$GLOBALS["serverPassword"], 
		$database);
		
		$stmt = $mysqli->prepare("SELECT food, price FROM efood WHERE id=? AND deleted IS NULL");
		$stmt->bind_param("i", $edit_id);
		$stmt->bind_result($food, $price);
		$stmt->execute();
		
		//tekitan objekti
		$p = new Stdclass();
		//saime ühe rea andmeid
		if($stmt->fetch()){
			// saan siin alles kasutada bind_result muutujaid
			$p->food = $food;
			$p->price = $price;
		}else{
			// ei saanud rida andmeid kätte
			// sellist id'd ei ole olemas
			// see rida võib olla kustutatud
			header("Location: upload.php");
			exit();
		}
		$stmt->close();
		$mysqli->close();
		return $p;
	}
	
	
	function updateFood($id, $food, $price){
    	
        $database = "if17_tanjak";
		
		$mysqli = new mysqli($GLOBALS["serverHost"], 
		$GLOBALS["serverUsername"], 
		$GLOBALS["serverPassword"], 
		$database);
		
		$stmt = $mysqli->prepare("UPDATE efood SET food=?, price=? WHERE id=? AND deleted IS NULL");
		$stmt->bind_param("sii",$food, $price, $id);
		
		// kas õnnestus salvestada
		if($stmt->execute()){
			// õnnestus
			echo "salvestus õnnestus!";
		}
		
		$stmt->close();
		$mysqli->close();
		
	}
	
	function deleteFood($id){
    	
        $database = "if17_tanjak";
		
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $database);
		
		$stmt = $mysqli->prepare("UPDATE efood 
		SET deleted=NOW()
		WHERE id=? AND deleted IS NULL"
		);
		
		$stmt->bind_param("i",$id);
		
		// kas õnnestus salvestada
		if($stmt->execute()){
			// õnnestus
			echo "salvestus õnnestus!";
		}
		
		$stmt->close();
		$mysqli->close();
		
	}
	
	
?>
?>