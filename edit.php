<?php
	//edit.php
	require("function.php");
	require("editfunctions.php");
	
	//kustutamine
	if(isset($_GET["delete"])){
		deleteFood($_GET["id"]);
		header("Location: upload.php");
		exit();
	}

	//uuendamine
	if(isset($_POST["update"])){
		
		updateFood(cleanInput($_POST["id"]), cleanInput($_POST["food"]), cleanInput($_POST["price"]));
		
		header("Location: edit.php?id=".$_POST["id"]."&success=true");
        exit();	
		
	}
	
	//saadan kaasa id
	$p = getSingleFoodData($_GET["id"]);
	var_dump($p);
	
?>
<br><br>
<a href="upload.php"> tagasi </a>

<h2>Siin saab muuda toitu menüüs</h2>
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" >
	<input type="hidden" name="id" value="<?=$_GET["id"];?>" > 
  	<label for="food" >Toit</label><br>
	<input id="food" name="food" type="text" value="<?php echo $p->food;?>" ><br><br>
  	<label for="color" >Hind</label><br>
	<input id="price" name="price" type="number" value="<?=$p->price;?>"><br><br>
  	
	<input type="submit" name="update" value="Salvesta">
  </form>
  
  
  <a href="?id=<?=$_GET["id"];?>&delete=true">kustuta</a>