<!DOCTYPE html>
<html>
<head>
	<title>DashBoard</title>
</head>
<body>
	<?php

	session_start();
	 echo '<h1><i><center>WELCOME '.$_SESSION['uname'].'</center></i></h1>' ;  ?>
	<div style=" width: 75%; margin-left: 25%; margin-top: 5%;">
		<a href="produit.html">Ajouter un produit</a><br><br>

		
		<a href="update.php">modifier un produit</a><br><br>

		<a href="consulte.php">consulter </a><br><br>

		<a href="BV1.php">Bon de livraison </a><br><br>

		<a href="BV2.php">Historique </a><br><br>
	
	</div>

</body>
</html>