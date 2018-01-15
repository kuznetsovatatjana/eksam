<?php
	//Require
	require("function.php");
	require("../vpconfig.php");
	
	$p = getsingleId($_GET["id"]);
	
	//postituse uuendamine
	if(isset($_POST["updateFood"])){	
		updateFood(cleanInput($_POST["food"]), cleanInput($_POST["price"]));
		exit();	
	}
	
	if(isset($_GET["delete"])){
		deleteFood($_GET["id"]);
		header("Location: upload.php");
		exit();
	}
	
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>
		Söökla menuu
	</title>
</head>

<body>
</div>
	<!--TAABEL-->
	<h1>Ühe postituse info redakteerimine</h1>
	<a href="upload.php">Tagasi</a>
	
<?php 
$html = "<table>";
	$html .= "<tr>";
		$html .= "<td>".$p->food."</td>";
		$html .= "<td>".$p->price."</a></td>";		
	$html .= "</tr>";
$html .= "</table>";
echo $html
?>

<form method="POST">

<br><label for="food" >Pealkiri:</label></br>
<input class="text" name="food" value="<?=$p->food;?>" required> <br>

<label for="price" >Hind:</label><br>
<input name="price" type="number" placeholder="Kirjuta soogi hind" value="<?php echo $p->price;?>" required>

<input type="submit" name="updatefood" value="Uuenda">
<a href="?id=<?=$_GET["id"];?>&delete=true">Kustuta</a></h1>

</form>
</body>
</html>