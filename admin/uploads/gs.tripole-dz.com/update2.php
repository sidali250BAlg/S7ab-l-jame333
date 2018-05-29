<?php 
$error = "Sorry product not found!";
echo $error;
 ?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<form  method="POST" action="update1.php">
		<center><div style="margin-top: 10%; border-radius: 20px; border: solid; width: 50%; padding-bottom: 20px;">
		<h1 style="text-align: center;">Stock</h1><br><h3 style="text-align: left;">Entrer le code de produit et cliquer sur afficher :</h3>
		<label>Code produit :</label>
		<input type="text" name="code_produit"><br><br>

		

		<a href="dashboard.php">Back   </a>
		
		<input type="submit" name="show" value="afficher">

		</div></center>





	</form>


</body>
</html>       

