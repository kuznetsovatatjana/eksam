<?php

	require("function.php");
	require("editfunctions.php");
	require("../vpconfig.php");
	
	$msg = "";
	$db = "if17_tanjak";
	$db = mysqli_connect("$serverHost", "$serverUsername", "$serverPassword", "$db");
	
	if (isset($_POST['upload'])) {

  	$food = mysqli_real_escape_string($db, $_POST['food']);
	$price = mysqli_real_escape_string($db, $_POST['price']);

  	$sql = "INSERT INTO efood (food,price) VALUES ('$food','$price')";
  	mysqli_query($db, $sql);
    }
	  //laadib kqik söök tabeli
	$eatfood = getAllFood();
?>




<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>
		Söökla menüü
	</title>
</head>

<body>
<ul>
  <li><a href="edit.php">Siin saab menüüd muuda</a></li>
</ul>
<div class="content">
	<h1>Siin saab lisada uue sööki</h1>
	<form method="POST"action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
	<!--food, price-->
	<input name="food" type="text" placeholder="Kirjuta söögi nimetus" required>
	<input name="price" type="number" placeholder="Kirjuta söögi hind" required>
	<input type="submit" value="upload" name="upload">
	</form>
</div>
	<!--TAABEL-->
	<h1>Siin saab vaadata menüü</h1>
	
<?php
	$html = "<table>";
		
		$html .= "<tr>";
			$html .= "<th>Söögi nimetus</th>";
			$html .= "<th>Söögi hind</th>";
		$html .= "</tr>";
		
		// iga liikme kohta massiivis
		foreach ($eatfood as $e) {
		
		$html .= "<tr>";
			$html .= "<td>".$e->food."</td>";
			$html .= "<td>".$e->price."</td>";
		$html .= "</tr>";
		}
	
	$html .= "</table>";
	echo $html;
?>

</body>
</html>